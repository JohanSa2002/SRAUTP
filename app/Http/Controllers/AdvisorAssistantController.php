<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdvisorAssistantController extends Controller
{
    public function index()
    {
        if (!Auth::user()->is_advisor) {
            abort(403);
        }

        $assistants = User::where('parent_advisor_id', Auth::id())->get();

        return view('advisor.assistants.index', compact('assistants'));
    }

    /**
     * Create a brand-new user account as assistant directly.
     */
    public function storeNew(Request $request)
    {
        if (!Auth::user()->is_advisor) {
            abort(403);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'cedula'   => ['required', 'string', 'max:20', 'unique:users,cedula'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'cedula.unique'  => 'Ya existe un usuario con esa cédula.',
            'email.unique'   => 'Ya existe un usuario con ese correo.',
        ]);

        User::create([
            'name'               => $request->name,
            'cedula'             => $request->cedula,
            'email'              => $request->email,
            'institutional_email' => $request->email,
            'password'           => Hash::make($request->password),
            'is_advisor_assistant' => true,
            'parent_advisor_id'  => Auth::id(),
        ]);

        return redirect()->route('advisor.assistants.index')
            ->with('success', "Cuenta de asistente para '{$request->name}' creada correctamente.");
    }

    /**
     * Promote an existing user to assistant.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_advisor) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $target = User::where('email', $request->email)->first();

        if ($target->is_admin || $target->is_advisor || $target->is_advisor_assistant) {
            return back()->withErrors(['email' => 'Este usuario no puede ser registrado como asistente (ya tiene un rol asignado).'])->withInput();
        }

        if ($target->id === Auth::id()) {
            return back()->withErrors(['email' => 'No puedes registrarte como tu propio asistente.'])->withInput();
        }

        $target->update([
            'is_advisor_assistant' => true,
            'parent_advisor_id'    => Auth::id(),
        ]);

        return back()->with('success', "'{$target->name}' registrado como asistente correctamente.");
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->is_advisor) {
            abort(403);
        }

        if ($user->parent_advisor_id !== Auth::id()) {
            abort(403);
        }

        $user->update([
            'is_advisor_assistant' => false,
            'parent_advisor_id'    => null,
        ]);

        return back()->with('success', "'{$user->name}' removido como asistente.");
    }
}
