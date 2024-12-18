<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function createUser(Request $request)
    {
        try {
            $validatedData =  $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'is_project' => 'required',
                'address' => 'required',
                'phone' => 'required|string|max:14',
                'city' => 'required|string|max:255'
            ]);

            $user = Client::create([
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'is_project' => $validatedData['is_project'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'city' => $validatedData['city']
            ]);

            return response()->json([
                'message' => 'Success',
                'data' => ([
                    'id' => $user->id,
                    'name' => $user->name,
                    'slug' => $user->slug,
                    'is_project' => $user->is_project,
                    'address' => $user->address,
                    'phone' => $user->phone,
                    'city' => $user->city
                ])
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Gagal membuat user',
                'data' => $err->getMessage()
            ], 500);
        }
    }
    function index()
    {
        $data = Client::all();
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }
    function updateClient(Request $request)
    {
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json([
                'message' => 'Data Tidak ada',
            ]);
        }

        $client->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'is_project' => $request->is_project,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => $client
        ]);
    }
    public function deleteClient(Request $request)
    {
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json(['message' => 'Client Tidak Ditemukan']);
        }
        $client->delete();
        return response()->json(['message' => 'Berhasil Menghapus Client']);
    }
}
