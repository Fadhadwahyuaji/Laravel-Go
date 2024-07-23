<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function Index()
    {
        // Ambil token dari sesi
        $token = session('token');

        // Hapus kata "Bearer " jika ada
        $token = str_replace('Bearer ', '', $token);

        // Kirimkan permintaan ke API dengan token yang telah dibersihkan
        $response = Http::withToken($token)->get('http://localhost:8080/employee');

        // Decode the response JSON into an array
        $employees = $response->json();

        // Check if $users is an array and not null
        if (is_array($employees)) {
            return view('employees.index', compact('employees'));
        } else {
            return view('employees.index', ['employees' => []]);
        }
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $token = session('token'); // Asumsi token disimpan di sesi

        $response = Http::withToken($token)->post('http://localhost:8080/employee', [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'position_id' => (int) $request->position_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('employees.index')->with('status', 'Employee created successfully');
        } else {
            return redirect()->route('employees.create')->withErrors('Failed to create Employee: ' . $response->body());
        }
    }

    public function edit($id)
    {
        $token = session('token'); // Pastikan token disimpan di sesi

        $response = Http::withToken($token)->get("http://localhost:8080/employee/$id");

        if ($response->successful()) {
            $employee = $response->json();
            return view('employees.edit', compact('employee'));
        } else {
            return redirect()->route('employees.index')->withErrors('Employee not found');
        }
    }


    public function update(Request $request, $id)
    {
        $token = session('token');
        $employeeData = $request->all();

        // Pastikan role_id adalah integer
        $employeeData['id'] = (int) $id;
        $employeeData['position_id'] = (int) $employeeData['position_id'];


        Log::info('employee data to update:', ['data' => $employeeData]);

        $response = Http::withToken($token)->put("http://localhost:8080/employee/$id", $employeeData);

        if ($response->successful()) {
            Log::info('Update successful:', ['response' => $response->json()]);
            return redirect()->route('employees.index')->with('success', 'employee updated successfully');
        } else {
            Log::error('Update failed:', ['response' => $response->body()]);
            return redirect()->route('employees.index')->withErrors('Failed to update employee');
        }
    }

    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete("http://localhost:8080/employee/$id");

        if ($response->successful()) {
            return redirect()->route('employees.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('employees.index')->withErrors('Failed to delete user');
        }
    }
}
