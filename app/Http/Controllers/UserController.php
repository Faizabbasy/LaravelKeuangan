<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn('role', ['admin','staff'])->get();
        return view('input.index', compact('users'));
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
        //(Request $request) : class yang digunakan untuk mengamil value request, form get/post
        //Validasi
        $request->validate([
            // 'name_input' => 'validasi'
            // required : wajib isi, min : minimal karakter
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            // email : dns -> memastikan email valid, @gmail, @smkwikrama dsb
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            // custom tulisan error
            'first_name.required' => 'Nama depan tidak boleh kosong',
            'first_name.min' => 'Nama depan harus diisi minimal 3 karakter',
            'last_name.required' => 'Nama belakang tidak boleh kosong',
            'last_name.min' => 'Nama belakang harus diisi minimal 3 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus diisi dengan data valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus diisi minimal 8 karakter'
            // 'name_input.validasi' => 'Pesan'
        ]);

        // Proses kirim data
        // create() : membuat data baru
        // 'column' => $request->name_input
        $createUser = User::create([
            // concat
            'name' => $request->first_name . "" . $request->last_name,
            'email' => $request->email,
            // Hash : enkripsi data agar yang tersimpan di db karakter acak, untuk menghindari kebocoran data password
            'password' => Hash::make($request->password),
            // role diisi langsung dengan user, agar tidak mengakses admin/staff
            'role' => 'user'
        ]);

        // menentukan perpindahan halaman
        if ($createUser) {
            //  redirect() : memindahkan halaman, route() : memanggil name route, with () : mengirimkan session data, biasanya untuk notifikasi
            return redirect()->route('login')->with('ok', 'Berhasil membuat akun! silahkan login');
        } else {
            // back() : kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Gagal! Silahkan coba lagi');
        }
    }

    public function findOrfail(Request $request) {
        $request -> validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Nama Wajib Diisi!!',
            'name.min' => 'Nama diisi minimal 3 karakter',
            'email.required' => 'Email Wajib Diisi!!',
            'password.required' => 'Password Wajib Diisi!!',
            'password.min' => 'Password diisi minimal 8 karakter'
        ]);
            $createData = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'admin'

            ]);
            if ($createData) {
                return redirect()->route('admin.index')->with('success',
                'Berhasil membuat data!');
            }else {
                return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
            }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi'
        ]);
        //mengambil data yang akan dicek kecocokannya : email-pw, username-pw
        $data = $request->only(['email', 'password']);
        // Auth -> class Authentitacation pada laravel yang menyimpan data session yang berhubungan dengan pengguna
        // attempt -> melakukan pengecekan data, jika sesuai maka data pengguna disimpan pada session auth
        if (Auth::attempt($data)) {
            //kalau admin ke dashboard, selain itu home
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil dilakukan!');
            }  else {
                return redirect()->route('user.dashboard')->with('success', 'Login berhasil dilakukan!');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal Login! coba lagi');
        }
    }

    public function logout()
    {
        //menghapus sesi login
        Auth::logout();
        return redirect()->route('home')->with(
            'logout',
            'Berhasil Logout! Silahkan login kembali untuk akses lengkap'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
