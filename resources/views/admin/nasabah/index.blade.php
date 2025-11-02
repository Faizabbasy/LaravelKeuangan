@extends('templates.app')

@section('navbar')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <div class="container mt-5" style="height: 100vh; width: 80%; margin-left:18%">

        @if (Session::get('failed'))
            <div class="alert alert-danger p-2 mt-4 rounded shadow-sm text-center">{{ Session::get('failed') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="" class="btn btn-danger me-2"><i class="bi bi-trash"></i>
                Data Sampah</a>
            <a href="" class="btn btn-success me-2"><i
                    class="bi bi-file-earmark-excel"></i> Export Excel</a>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success p-2 mt-4 rounded shadow-sm text-center">{{ Session::get('success') }}</div>
        @endif

        <d`iv class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <h5 class="card-title mb-3 text-center">Data Pengguna</h5>
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 60px;">No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nasabahs as $key => $nasabah)
                        <thead>
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $nasabah->name }}</td>
                                <td>{{ $nasabah->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
