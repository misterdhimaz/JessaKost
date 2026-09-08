<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $email = $request->session()->get('email') ?? old('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp_code' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->otp_code === $request->otp_code && $user->otp_expires_at > now()) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Akun berhasil diverifikasi!');
        }

        return back()->with('email', $request->email)->withErrors(['otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.']);
    }
}

