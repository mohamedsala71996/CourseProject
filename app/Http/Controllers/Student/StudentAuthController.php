<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('students.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_blocked'] = 0;

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة أو الحساب محظور.',
        ])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }
}
