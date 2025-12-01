@extends('templates.app')

@section('navbar')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <div class="w-50 bg-white mt-5 p-5" style="margin-left: 30%;">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <h4 class="text-center fw-bold mb-4"><i class="fa fa-line-chart text-success"></i></h4>
        <h5 class="text-center mb-3 p-2">Edit Target</h5>
        <form method="POST" action="{{ route('user.targets.update', $target->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="Target" class="form-label">Target</label>
                <input type="text" name="Target" id="Target" class="form-control"
                    @error('Target') is-invalid @enderror>
                @error('Target')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Berapa_Bulan" class="form-label">Berapa lama menabung</label>
                <input type="text" name="Berapa_Bulan" id="Berapa_Bulan" class="form-control"
                    @error('name') is-invalid @enderror>
                @error('Berapa_Bulan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Target_Uang" class="form-label">Target Uang</label>
                <input type="Target_Uang" name="Target_Uang" id="Target_Uang" class="form-control"
                    @error('name') is-invalid @enderror>
                @error('Target_Uang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group my-2">
                <label for="foto">Foto Target</label>
                <input type="file" name="foto" id="foto" class="form-control"
                    @error('foto')
                    is-invalid
                @enderror>
                @error('foto')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="Perbulan" class="form-label">Bayar per Bulan</label>
                <input type="text" name="Perbulan" id="Perbulan" class="form-control"
                    @error('Perbulan') is-invalid @enderror>
                @error('Perbulan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-primary">Kirim Data</button>
        </form>
    </div>
@endsection
