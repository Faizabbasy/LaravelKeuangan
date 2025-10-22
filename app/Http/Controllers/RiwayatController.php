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
        $target = Target::find($id);
        return view('user.riwayat.create', compact('target'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
            'target_id' => 'required',
            'stor' => 'required|integer|min:1',
            'tanggal' => 'required',
            'Target_Uang' => 'required|integer|min:1',
            // 'Perbulan' => 'required',
        ], [
            'target_id.required' => 'Target harus diisi',
            'stor.required' => 'stor harus diisi!!',
            'tanggal.required' => 'Target bulan harus diisi',
            'Target_Uang.required' => 'Target uang harus diisi',
            // 'Perbulan.required' => 'Perbulan harus diisi',
        ]);
        $perBulan =

        $createData = Riwayat::create([
            'target_id' => $request->target_id,
            'stor' => $request->stor,
            'Tanggal' => $request->tanggal,
            'Target_Uang' => $request->Target_Uang,
            // 'Perbulan' => $perBulan,
        ]);

        if ($createData) {
            return redirect()->route('user.dashboard')->with('success', 'Berhasil menambah data');
        } else {
            return back()->with('failed', 'Silahkan coba lagi');
        }
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
