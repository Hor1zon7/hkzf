<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Apiuser;
use Illuminate\Http\Request;

class ApiuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data=Apiuser::paginate(10);

        return view('admin.apiuser.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.apiuser.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data=$request->except(['_token']);
        Apiuser::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     */
    public function show(Apiuser $apiuser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     */
    public function edit(Apiuser $apiuser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Apiuser  $apiuser
     */
    public function update(Request $request, Apiuser $apiuser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Apiuser  $apiuser
     */
    public function destroy(Apiuser $apiuser)
    {
        //
    }
}
