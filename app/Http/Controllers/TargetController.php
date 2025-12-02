<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TargetExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



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
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            // 'Perbulan' => 'required',
        ], [
            'Target.required' => 'Target harus diisi',
            'Target.min' => 'Target minimal 3 karakter',
            'Berapa_Bulan.required' => 'Target bulan harus diisi',
            'Target_Uang.required' => 'Target uang harus diisi',
            // 'Perbulan.required' => 'Perbulan harus diisi',
        ]);

        $foto = $request->file('foto');
        $file_name = Str::random(5) . "-foto." . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('foto_target', $foto, $file_name);
        $path = $foto->storeAs("foto", $file_name, "public");

        $createData = Target::create([
            'Target' => $request->Target,
            'Berapa_Bulan' => $request->Berapa_Bulan,
            'Target_Uang' => $request->Target_Uang,
            'foto' => $path,
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
    public function edit($id)
    {
        $target = Target::find($id);
        return view('user.target.edit', compact('target'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'Target' => 'required|min:3',
            'Berapa_Bulan' => 'required|integer|min:1',
            'Target_Uang' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            // 'Perbulan' => 'required',
        ], [
            'Target.required' => 'Target harus diisi',
            'Target.min' => 'Target minimal 3 karakter',
            'Berapa_Bulan.required' => 'Target bulan harus diisi',
            'Target_Uang.required' => 'Target uang harus diisi',
            // 'Perbulan.required' => 'Perbulan harus diisi',
        ]);

        $foto = $request->file('foto');
        $file_name = Str::random(5) . "-foto." . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('foto_target', $foto, $file_name);
        $path = $foto->storeAs("foto", $file_name, "public");



        $updateData = Target::where('id', $id)->update([
            'Target' => $request->Target,
            'Berapa_Bulan' => $request->Berapa_Bulan,
            'Target_Uang' => $request->Target_Uang,
            'foto' => $path,
            // 'Perbulan' => $perBulan,
        ]);

        if ($updateData) {
            return redirect()->route('user.dashboard')->with('success', 'Berhasil menambah data');
        } else {
            return back()->with('failed', 'Silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Target $target, $id)
    {
        $deleteData = Target::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->route('user.dashboard')->with('success', 'Berhasil menghapus');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function exportExcel ()
    {
        $file_name = "data-target.xlsx";
        return Excel::download(new TargetExport, $file_name);
    }

    public function trash()
    {
        $targets = Target::onlyTrashed()->get();
        return view('user.target.trash', compact('targets'));
    }

    public function restore($id)
    {
        $targets = Target::onlyTrashed()->find($id);
        // restore() : mengembalikan data ke belum dihapus
        $targets->restore();
        return redirect()->route('user.dashboard')->with('success', 'Berhasil mengembalikan data!!');
    }

    public function deletePermanent($id)
    {
        $targets = Target::onlyTrashed()->find($id);
        // forceDelete() : hapus selamanya dari database
        $targets->forceDelete();
        return redirect()->back()->with('success', 'Berhasil mengepaus data selamanya!!');
    }

    public function dataChart()
    {
        $targetActive = Target::where('actived', 1)->count();
        $targetNonActive = Target::where('actived', 0)->count();

        $labels = ['Film Aktif', 'Film Non-Aktif'];
        $data = [$targetActive, $targetNonActive];

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    // public function printPDF()
    // {
    //     $target = Target::get();
    //     view()->share('Target',$target);
    //     $pdf = PDF::loadView('user.targets.print_pdf', ['target' => $target])->setPaper('a4', 'landscape');
    //     return $pdf->download('Data_Target_Tabungan.pdf');
    // }
}
