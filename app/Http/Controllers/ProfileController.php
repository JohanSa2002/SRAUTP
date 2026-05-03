<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * For advisors: shows article search page.
     * For everyone else: shows settings (edit profile, password, delete).
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        if ($user->is_advisor) {
            return $this->articleSearchView($request, $user,
                base: Article::where('advisor_id', $user->id),
                subtitle: 'Busca entre todos los artículos asignados a ti como asesor.'
            );
        }

        if ($user->is_advisor_assistant) {
            return $this->articleSearchView($request, $user,
                base: Article::where('advisor_id', $user->parent_advisor_id),
                subtitle: 'Busca entre todos los artículos asignados a tu asesor.'
            );
        }

        if (!$user->is_admin) {
            return $this->articleSearchView($request, $user,
                base: Article::where('user_id', $user->id),
                subtitle: 'Busca entre tus artículos e investigaciones.'
            );
        }

        return view('profile.edit', ['user' => $user]);
    }

    private function articleSearchView(Request $request, $user, $base, string $subtitle): View
    {
        $search = $request->get('search', '');
        $query = $base->latest();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('students', 'like', "%{$search}%")
                  ->orWhere('career', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%");
            });
        }

        return view('profile.articles-search', [
            'user' => $user,
            'advisorArticles' => $query->get(),
            'search' => $search,
            'subtitle' => $subtitle,
        ]);
    }

    /**
     * Settings page (edit profile, password, delete account) for all users.
     */
    public function settings(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->hasFile('photo')) {
            if ($request->user()->profile_photo_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($request->user()->profile_photo_path);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $request->user()->profile_photo_path = $path;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.settings')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
