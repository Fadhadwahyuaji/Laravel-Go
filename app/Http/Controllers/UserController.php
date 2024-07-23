<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function userIndex()
    {
        // Ambil token dari sesi
        $token = session('token');

        // Hapus kata "Bearer " jika ada
        $token = str_replace('Bearer ', '', $token);

        // Kirimkan permintaan ke API dengan token yang telah dibersihkan
        $response = Http::withToken($token)->get('http://localhost:8080/users');

        // Decode the response JSON into an array
        $users = $response->json();

        // Check if $users is an array and not null
        if (is_array($users)) {
            return view('users.index', compact('users'));
        } else {
            return view('users.index', ['users' => []]);
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $token = session('token'); // Asumsi token disimpan di sesi

        $response = Http::withToken($token)->post('http://localhost:8080/users', [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => (int) $request->role_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('users.index')->with('status', 'User created successfully');
        } else {
            return redirect()->route('users.create')->withErrors('Failed to create user: ' . $response->body());
        }
    }

    public function edit($id)
    {
        $token = session('token'); // Pastikan token disimpan di sesi

        $response = Http::withToken($token)->get("http://localhost:8080/users/$id");

        if ($response->successful()) {
            $user = $response->json();
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('users.index')->withErrors('User not found');
        }
    }


    public function update(Request $request, $id)
    {
        $token = session('token');
        $userData = $request->all();

        // Pastikan role_id adalah integer
        $userData['id'] = (int) $id;
        $userData['role_id'] = (int) $userData['role_id'];

        // Hapus password dari data yang dikirim jika tidak diisi
        if (empty($userData['password'])) {
            unset($userData['password']);
        }

        Log::info('User data to update:', ['data' => $userData]);

        $response = Http::withToken($token)->put("http://localhost:8080/users-update/$id", $userData);

        if ($response->successful()) {
            Log::info('Update successful:', ['response' => $response->json()]);
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } else {
            Log::error('Update failed:', ['response' => $response->body()]);
            return redirect()->route('users.index')->withErrors('Failed to update user');
        }
    }

    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete("http://localhost:8080/users/$id");

        if ($response->successful()) {
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')->withErrors('Failed to delete user');
        }
    }

}
