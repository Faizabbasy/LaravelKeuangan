<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nasabahs = User::all();
        return view('admin.nasabah.index', compact('nasabahs'));
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nasabah $nasabah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        //
    }
}
