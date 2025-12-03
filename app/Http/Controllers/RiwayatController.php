<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Target;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatExport;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayats = Riwayat::with('target')->get();
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
    public function destroy(Riwayat $riwayat, $id)
    {
        $deleteData = Riwayat::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->route('user.riwayats.index')->with('success', 'Berhasil menghapus');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function trash()
    {
        $riwayats = Riwayat::onlyTrashed()->get();
        return view('user.riwayat.trash', compact('riwayats'));
    }

    public function restore($id)
    {
        $riwayats = Riwayat::onlyTrashed()->find($id);
        // restore() : mengembalikan data ke belum dihapus
        $riwayats->restore();
        return redirect()->route('user.riwayats.index')->with('success', 'Berhasil mengembalikan data!!');
    }

    public function deletePermanent($id)
    {
        $riwayats = Riwayat::onlyTrashed()->find($id);
        // forceDelete() : hapus selamanya dari database
        $riwayats->forceDelete();
        return redirect()->back()->with('success', 'Berhasil mengepaus data selamanya!!');
    }

    public function exportExcel ()
    {
        $file_name = "data-Riwayat.xlsx";
        return Excel::download(new RiwayatExport, $file_name);
    }
}
