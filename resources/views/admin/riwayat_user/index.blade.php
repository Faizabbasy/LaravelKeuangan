@extends('templates.app')

@section('navbar')
    <div class="container">
        <h2 class="mb-3">Riwayat User</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama User</th>
                    <th>Target</th>
                    <th>Stor</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($riwayats as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->target->nama_target }}</td>
                        <td>{{ $item->target->stor }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada riwayat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
