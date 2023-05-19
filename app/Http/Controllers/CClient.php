<?php

namespace App\Http\Controllers;

use App\Models\MClient;
use Illuminate\Http\Request;

class CClient extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Client',
            'data' => MClient::all(),
        ];
        // dd(session());

        return view('auth.client', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'client_name' => 'required',
            'client_address' => 'required',
        ]);

        // dd($validasi);
        MClient::create($validasi);
        return redirect('/client')->with('message', 'New data client successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MClient $mClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MClient $mClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MClient $client)
    {
        // dd($client);
        $request->validate([
            'id' => 'required'
        ]);
        $validasi = $request->validate([
            'client_name' => 'required',
            'client_address' => 'required',
        ]);

        // dd($validasi);
        MClient::where('client_id', $client->client_id)->update($validasi);
        return redirect('/client')->with('message', 'Update data client successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MClient $client)
    {
        MClient::destroy($client->client_id);
        return redirect('/client')->with('message', 'Delete data client successfully');
    }
}
