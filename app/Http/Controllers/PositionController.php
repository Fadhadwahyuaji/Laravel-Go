<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PositionController extends Controller
{
    public function Index()
    {
        // Ambil token dari sesi
        $token = session('token');

        // Hapus kata "Bearer " jika ada
        $token = str_replace('Bearer ', '', $token);

        // Kirimkan permintaan ke API dengan token yang telah dibersihkan
        $response = Http::withToken($token)->get('http://localhost:8080/position');

        // Decode the response JSON into an array
        $positions = $response->json();

        // Check if $users is an array and not null
        if (is_array($positions)) {
            return view('positions.index', compact('positions'));
        } else {
            return view('positions.index', ['positions' => []]);
        }
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $token = session('token'); // Asumsi token disimpan di sesi

        $response = Http::withToken($token)->post('http://localhost:8080/position', [
            'position_name' => $request->position_name,
        ]);

        if ($response->successful()) {
            return redirect()->route('positions.index')->with('status', 'Position created successfully');
        } else {
            return redirect()->route('positions.create')->withErrors('Failed to create Position: ' . $response->body());
        }
    }

    public function edit($id)
    {
        $token = session('token'); // Pastikan token disimpan di sesi

        $response = Http::withToken($token)->get("http://localhost:8080/position/$id");

        if ($response->successful()) {
            $position = $response->json();
            return view('positions.edit', compact('position'));
        } else {
            return redirect()->route('positions.index')->withErrors('position not found');
        }
    }


    public function update(Request $request, $id)
    {
        $token = session('token');
        $positionData = $request->all();

        // Pastikan role_id adalah integer
        $positionData['id'] = (int) $id;


        Log::info('position data to update:', ['data' => $positionData]);

        $response = Http::withToken($token)->put("http://localhost:8080/position/$id", $positionData);

        if ($response->successful()) {
            Log::info('Update successful:', ['response' => $response->json()]);
            return redirect()->route('positions.index')->with('success', 'position updated successfully');
        } else {
            Log::error('Update failed:', ['response' => $response->body()]);
            return redirect()->route('positions.index')->withErrors('Failed to update position');
        }
    }

    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete("http://localhost:8080/position/$id");

        if ($response->successful()) {
            return redirect()->route('positions.index')->with('success', 'position deleted successfully');
        } else {
            return redirect()->route('positions.index')->withErrors('Failed to delete position');
        }
    }
}
