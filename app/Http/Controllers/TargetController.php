<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TargetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targets = Target::all();
        return view('user.dashboard', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $targets = Target::all();
        return view('user.target.create', compact('targets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Target' => 'required|min:3',
            'Berapa_Bulan' => 'required|integer|min:1',
            'Target_Uang' => 'required|integer|min:1',
            // 'Perbulan' => 'required',
        ], [
            'Target.required' => 'Target harus diisi',
            'Target.min' => 'Target minimal 3 karakter',
            'Berapa_Bulan.required' => 'Target bulan harus diisi',
            'Target_Uang.required' => 'Target uang harus diisi',
            // 'Perbulan.required' => 'Perbulan harus diisi',
        ]);
        $perBulan =

        $createData = Target::create([
            'Target' => $request->Target,
            'Berapa_Bulan' => $request->Berapa_Bulan,
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
    public function show(Target $target)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Target $target)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Target $target)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Target $target)
    {
        //
    }
}
