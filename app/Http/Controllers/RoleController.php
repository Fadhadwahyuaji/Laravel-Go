<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function Index()
    {
        // Ambil token dari sesi
        $token = session('token');

        // Hapus kata "Bearer " jika ada
        $token = str_replace('Bearer ', '', $token);

        // Kirimkan permintaan ke API dengan token yang telah dibersihkan
        $response = Http::withToken($token)->get('http://localhost:8080/role');

        // Decode the response JSON into an array
        $roles = $response->json();

        // Check if $users is an array and not null
        if (is_array($roles)) {
            return view('roles.index', compact('roles'));
        } else {
            return view('roles.index', ['roles' => []]);
        }
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $token = session('token'); // Asumsi token disimpan di sesi

        $response = Http::withToken($token)->post('http://localhost:8080/role', [
            'role_name' => $request->role_name,
        ]);

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('status', 'role created successfully');
        } else {
            return redirect()->route('roles.create')->withErrors('Failed to create role: ' . $response->body());
        }
    }

    public function edit($id)
    {
        $token = session('token'); // Pastikan token disimpan di sesi

        $response = Http::withToken($token)->get("http://localhost:8080/role/$id");

        if ($response->successful()) {
            $role = $response->json();
            return view('roles.edit', compact('role'));
        } else {
            return redirect()->route('roles.index')->withErrors('role not found');
        }
    }


    public function update(Request $request, $id)
    {
        $token = session('token');
        $roleData = $request->all();

        // Pastikan role_id adalah integer
        $roleData['id'] = (int) $id;


        Log::info('role data to update:', ['data' => $roleData]);

        $response = Http::withToken($token)->put("http://localhost:8080/role/$id", $roleData);

        if ($response->successful()) {
            Log::info('Update successful:', ['response' => $response->json()]);
            return redirect()->route('roles.index')->with('success', 'role updated successfully');
        } else {
            Log::error('Update failed:', ['response' => $response->body()]);
            return redirect()->route('roles.index')->withErrors('Failed to update role');
        }
    }

    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete("http://localhost:8080/role/$id");

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('roles.index')->withErrors('Failed to delete user');
        }
    }
}
