@extends('templates.app')

@section('navbar')
<div class="containerr mt-5">

    <div class="card  p-4" style="margin-left: 18%">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Riwayat <i class="fa-solid fa-file-waveform text-danger"></i></h4>
            <div>
                <a href="{{ route('user.riwayats.export')}}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-file-export me-1"></i> Export (.xlsx)
                </a>
                <a href="{{ route('user.riwayats.trash') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-trash-can me-1"></i> Data Sampah
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 25%;">Target</th>
                        <th style="width: 15%;">Stor</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 20%;">Target Uang</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayats as $key => $target)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $target->target->Target ?? '-' }}</td>
                            <td>Rp {{ number_format($target->stor, 0, ',', '.') }}</td>
                            <td>{{ $target->Tanggal }}</td>
                            <td>Rp {{ number_format($target->Target_Uang, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('user.riwayats.delete', $target->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        style="border-radius: 10px;">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
