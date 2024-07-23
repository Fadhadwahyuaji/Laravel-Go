<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Login request data:', $request->all());

        $response = Http::post('http://localhost:8080/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Log::info('Login response:', $response->json());

        if ($response->successful()) {
            session(['token' => $response['token']]);
            return redirect()->route('users.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Log::info('Register request data:', $request->all());

        $response = Http::post('http://localhost:8080/register', [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => (int) $request->role_id,
        ]);

        Log::info('Register response:', $response->json());

        if ($response->successful()) {
            return redirect()->route('view.login')->with('success', 'Registration successful');
        }

        return back()->withErrors($response->json())->withInput();
    }

    public function logout(Request $request)
    {
        // Hapus token dari session
        $request->session()->forget('token');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('view.login')->with('success', 'You have been logged out.');
    }
}
