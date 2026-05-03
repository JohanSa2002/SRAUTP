<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            $articles = Article::latest()->get();
        } elseif ($user->is_advisor) {
            $articles = Article::where('advisor_id', $user->id)->latest()->get();
        } elseif ($user->is_advisor_assistant) {
            // Assistant sees articles belonging to their parent advisor
            $articles = Article::where('advisor_id', $user->parent_advisor_id)->latest()->get();
        } else {
            $articles = Article::where('user_id', $user->id)->latest()->get();
        }

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        // Only real advisors appear in the dropdown — assistants are not selectable as advisor
        $advisors = User::where('is_advisor', true)->get();
        $events = Event::where('is_active', true)
            ->where('end_date', '>=', now())
            ->get();
        return view('articles.create', compact('advisors', 'events'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'title' => 'required|string|max:255',
            'students' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'career' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ];

        if ($user->isAdvisorRole()) {
            $rules['student_email'] = 'required|email|exists:users,email';
        } else {
            $rules['advisor_id'] = 'required|exists:users,id';
        }

        $rules['event_id'] = 'nullable|exists:events,id';
        $rules['event_category'] = 'nullable|string';

        $request->validate($rules);

        $path = $request->file('pdf_file')->store('articles', 'public');

        $data = [
            'title' => $request->title,
            'students' => $request->students,
            'year' => $request->year,
            'career' => $request->career,
            'pdf_path' => $path,
            'status' => 'revisión',
            'event_id' => $request->event_id,
            'event_category' => $request->event_category,
        ];

        if ($user->is_advisor) {
            $student = User::where('email', $request->student_email)->first();
            $data['user_id'] = $student->id;
            $data['advisor_id'] = $user->id;
        } elseif ($user->is_advisor_assistant) {
            // Article is assigned to the parent advisor, not the assistant
            $student = User::where('email', $request->student_email)->first();
            $data['user_id'] = $student->id;
            $data['advisor_id'] = $user->parent_advisor_id;
        } else {
            $data['user_id'] = $user->id;
            $data['advisor_id'] = $request->advisor_id;
        }

        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Articulo subido con éxito.');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $user = Auth::user();

        $isAssistantOfAdvisor = $user->is_advisor_assistant && $article->advisor_id === $user->parent_advisor_id;

        if ($user->id !== $article->user_id && $user->id !== $article->advisor_id && !$user->is_admin && !$isAssistantOfAdvisor) {
            abort(403);
        }

        $advisors = User::where('is_advisor', true)->get();
        $events = Event::where('is_active', true)
            ->where('end_date', '>=', now())
            ->get();
        return view('articles.edit', compact('article', 'advisors', 'events'));
    }

    public function update(Request $request, Article $article)
    {
        $user = Auth::user();

        $isAssistantOfAdvisor = $user->is_advisor_assistant && $article->advisor_id === $user->parent_advisor_id;

        if ($user->id !== $article->user_id && $user->id !== $article->advisor_id && !$user->is_admin && !$isAssistantOfAdvisor) {
            abort(403);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'students' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'career' => 'required|string|max:255',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
        ];

        if ($user->isAdvisorRole()) {
            $rules['student_email'] = 'required|email|exists:users,email';
        } elseif (!$user->is_admin) {
            $rules['advisor_id'] = 'required|exists:users,id';
        }

        $rules['event_id'] = 'nullable|exists:events,id';
        $rules['event_category'] = 'nullable|string';

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'students' => $request->students,
            'year' => $request->year,
            'career' => $request->career,
            'event_id' => $request->event_id,
            'event_category' => $request->event_category,
        ];

        if ($user->isAdvisorRole()) {
            $student = User::where('email', $request->student_email)->first();
            $data['user_id'] = $student->id;
            // advisor_id stays unchanged — assistant cannot reassign the advisor
        }

        if ($request->hasFile('pdf_file')) {
            if ($article->pdf_path) {
                Storage::disk('public')->delete($article->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf_file')->store('articles', 'public');
        }

        if (isset($rules['advisor_id'])) {
            $data['advisor_id'] = $request->advisor_id;
        }

        // Only students reset status on edit; advisor-role users and admins do not
        if (!$user->isAdvisorRole() && !$user->is_admin) {
            $data['status'] = 'revisión';
            $data['comments'] = null;
        }

        $article->update($data);

        return redirect()->route('articles.show', $article)->with('success', 'Articulo actualizado con éxito.');
    }

    public function evaluate(Request $request, Article $article)
    {
        $user = Auth::user();

        $canEvaluate = ($user->is_advisor && $user->id === $article->advisor_id)
            || ($user->is_advisor_assistant && $article->advisor_id === $user->parent_advisor_id);

        if (!$canEvaluate) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:aprobado,revisión,rechazado',
            'comments' => 'nullable|string',
        ]);

        $article->update([
            'status' => $request->status,
            'comments' => $request->comments,
        ]);

        return redirect()->route('articles.index')->with('success', 'Evaluación guardada.');
    }

    public function destroy(Article $article)
    {
        $user = Auth::user();

        if (!$user->is_admin) {
            abort(403);
        }

        if ($article->pdf_path) {
            Storage::disk('public')->delete($article->pdf_path);
        }

        $article->delete();

        return redirect()->back()->with('success', 'Investigación eliminada permanentemente.');
    }
}
