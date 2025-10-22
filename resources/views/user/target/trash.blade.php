    @extends('templates.app')

    @section('navbar')
        <div class="card-body p-3" style="overflow-y: auto; max-height: calc(80vh - 70px); width: 80%; margin-left: 18%;">
            <div class="d-flex justify-content-end">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <table class="table table-bordered align-middle mb-0 mt-3">
                <thead class="table-light" style="z-index: 10;">
                    <tr>
                        <th>No.</th>
                        <th>Target</th>
                        <th>Berapa Lama</th>
                        <th>Target Uang</th>
                        <th>Bayar per Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($targets as $key => $target)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $target->Target }}</td>
                            <td>{{ $target->Berapa_Bulan }} bulan</td>
                            <td>Rp . {{ number_format($target->Target_Uang, 0, ',', '.') }}</td>
                            <td>Rp . {{ number_format($target->Perbulan, 0, ',', '.') }}</td>
                            <td class="d-flex justify-content-center">
                                <form action="{{ route('user.targets.restore', $target->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Kembalikan</button>
                                </form>
                                <form action="{{ route('user.targets.delete_permanent', $target->id) }}" class="ms-2"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus Selamanya</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
