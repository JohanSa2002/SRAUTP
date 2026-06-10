<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CertificateController extends Controller
{
    /**
     * Display the user's certificates. Advisor-role users also see
     * the certificates they have issued to their students.
     */
    public function index()
    {
        $user = Auth::user();

        $myCertificates = Certificate::with('uploader')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $issuedCertificates = collect();
        if ($user->isAdvisorRole()) {
            $issuedCertificates = Certificate::with('owner')
                ->where('uploaded_by', $user->id)
                ->where('user_id', '!=', $user->id)
                ->latest()
                ->get();
        }

        return view('certificates.index', compact('myCertificates', 'issuedCertificates'));
    }

    /**
     * Store a new certificate.
     * Students upload for themselves. Advisors and advisor assistants
     * can upload for themselves or assign one to their students by email.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];

        if ($user->isAdvisorRole()) {
            $rules['student_email'] = 'nullable|email|exists:users,email';
        }

        $request->validate($rules);

        // By default the certificate belongs to the uploader
        $recipientId = $user->id;

        if ($user->isAdvisorRole() && $request->filled('student_email')) {
            $student = User::where('email', $request->student_email)->first();

            // The advisor (or the assistant's parent advisor) can only issue
            // certificates to students that have articles assigned to them
            $advisorId = $user->is_advisor ? $user->id : $user->parent_advisor_id;
            $isMyStudent = Article::where('advisor_id', $advisorId)
                ->where('user_id', $student->id)
                ->exists();

            if (!$isMyStudent) {
                throw ValidationException::withMessages([
                    'student_email' => 'Este correo no pertenece a uno de tus estudiantes asignados.',
                ]);
            }

            $recipientId = $student->id;
        }

        $path = $request->file('file')->store('certificates', 'public');

        Certificate::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'user_id' => $recipientId,
            'uploaded_by' => $user->id,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificado subido con éxito.');
    }

    /**
     * Remove a certificate. Only the owner, the uploader or an admin can delete it.
     */
    public function destroy(Certificate $certificate)
    {
        $user = Auth::user();

        if ($user->id !== $certificate->user_id && $user->id !== $certificate->uploaded_by && !$user->is_admin) {
            abort(403);
        }

        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        $certificate->delete();

        return redirect()->back()->with('success', 'Certificado eliminado.');
    }
}
