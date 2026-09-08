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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp_code' => sprintf("%06d", mt_rand(1, 999999)),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        event(new Registered($user));

        // Note: For production with valid SMTP, send a real Mailable here.
        // \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OtpMail($user->otp_code));
        \Illuminate\Support\Facades\Log::info("YOUR REGISTRATION OTP CODE FOR {$user->email} IS: {$user->otp_code}");

        // Redirect to OTP Verification page instead of auto-login
        return redirect()->route('otp.verify.form')->with('email', $user->email)->with('success', 'Silakan periksa email Anda (atau file laravel.log di lokal) untuk kode OTP.');
    }
}
