<?php

namespace App\Http\Controllers;

use App\Models\MClient;
use App\Models\MProject;
use Illuminate\Http\Request;

class CProject extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request()->all());
        $project = MProject::query();
        if (request()->project_name)
            $project->where('project_name', 'like', '%' . request()->project_name . '%');
        if (request()->client)
            $project->where('client_id', request()->client);
        if (request()->status)
            $project->where('project_status', request()->status);

        $data = [
            'title' => 'Project',
            'data' => $project->get(),
            'client' => MClient::all(),
        ];
        session([
            'project' => request()->project_name,
            'client' => request()->client,
            'status' => request()->status,
        ]);

        // dd(session());

        return view('auth.project', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'project_name' => 'required',
            'client_id' => 'required',
            'project_start' => 'required',
            'project_end' => 'required',
            'project_status' => 'required',
        ]);

        // dd($validasi);
        MProject::create($validasi);
        return redirect('/project')->with('message', 'New data project successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MKolega  $mKolega
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MKolega  $mKolega
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MKolega  $mKolega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MProject $project)
    {
        // dd($project);

        $validasi = $request->validate([
            'project_name' => 'required',
            'client_id' => 'required',
            'project_start' => 'required',
            'project_end' => 'required',
            'project_status' => 'required',
        ]);
        MProject::where('project_id', $project->project_id)->update($validasi);
        return redirect('/project')->with('message', 'Update data project successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MKolega  $mKolega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        // dd($req->project_id);
        if ($req->project_id == null)
            return redirect('/project')->with('error', 'No data to delete');
        $project = $req->project_id;
        MProject::whereIn('project_id', $project)->delete();
        return redirect('/project')->with('message', 'Delete data project successfully');
    }
}
