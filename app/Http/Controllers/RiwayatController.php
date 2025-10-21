<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Target;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayats = Riwayat::all();
        return view('user.riwayat.index', compact('riwayats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $targets = Target::all();
        $data = Target::where('id',$id)->first();
        $target = $data->Target;
        $targetUang = $data->Target_Uang;
        $riwayats = Riwayat::with('target')->get();
        return view('user.riwayat.create', compact('targets','riwayats','id','target','targetUang'));
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
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }
}
