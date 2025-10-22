@extends('templates.app')

@section('navbar')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <div class="w-50 bg-white mt-5 p-5" style="margin-left: 30%;">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <h4 class="text-center fw-bold mb-4"><i class="fa fa-line-chart text-success"></i></h4>
        <h5 class="text-center mb-3 p-2">Buat Target Tabungan Baru</h5>
        <form method="POST" action="{{ route('user.riwayats.store') }}">
            @csrf
            <div class="mb-3">
                <label for="target_id" class="form-label">Target</label>
                <select type="text" name="target_id" id="target_id" class="form-control"
                    @error('target_id') is-invalid @enderror>
                    <option value="{{$target->id}}" selected hidden>{{$target->Target}}</option>
                </select>
                @error('target_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Target_Uang" class="form-label">Target Uang</label>
                <input type="text" name="Target_Uang" id="Target_Uang" class="form-control" value="{{ $target->Target_Uang }}"
                    @error('name') is-invalid @enderror>
                @error('Target_Uang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Berapa_Bulan" class="form-label">Stor</label>
                <input type="text" name="stor" id="stor" class="form-control"
                    @error('stor') is-invalid @enderror>
                @error('stor')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Perbulan" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    @error('tanggal') is-invalid @enderror>
                @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim Data</button>
        </form>
    </div>
@endsection
