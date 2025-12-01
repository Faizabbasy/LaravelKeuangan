    @extends('templates.app')

    @section('navbar')
        <div class="card-body p-3" style="overflow-y: auto; max-height: calc(80vh - 70px); width: 80%; margin-left: 18%;">
            <div class="d-flex justify-content-end">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
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
                                <form action="{{ route('user.riwayats.delete', $target->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 10px;">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
