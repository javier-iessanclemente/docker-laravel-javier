<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required', 'same:password'],
            ], [
                'name.required' => 'El nombre debe ser introducido', 
                'name.max' => 'El nombre no puede tener más de 255 caracteres', 
                'email.required' => 'El email debe ser introducido', 
                'email.lowercase' => 'El email debe estar en minúsculas', 
                'email.email' => 'El email debe tener el formato correcto', 
                'email.max' => 'El email no puede tener más de 255 caracteres', 
                'email.unique' => 'El email ya esta asociado a un usuario', 
                'password.required' => 'La contraseña debe ser introducida', 
                'password.confirmed' => 'La contraseña no fue confirmada correctamente',
                'password.min' => 'La contraseña debe tener minimo 8 caraceteres',
                'password_confirmation' => 'La contraseña debe ser confirmada',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                //'password' => Hash::make($request->password),
                'role' => 'cliente',
            ]);
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect(route('dashboard', absolute: false));
        }
        catch (ValidationException $e) {
            throw $e;
        }
        catch(\Exception $e) {
            return redirect()->route('register')->with('error', 'No se pudo registrar al usuario: ' . $e->getMessage());
        }
    }
}
