@extends('templates.app')

@section('navbar')
    <div class="container mt-5 w-75" style="margin-left: 20%">
        {{-- @if (Session::get('login'))
            <div class="alert alert-success">{{ Session::get('login') }},
                <b>Selamat Datang {{ Auth::user()->name }}</b>
            </div>
        @endif --}}
        <h4>Riwayat</h4>

        <div class="d-flex justify-content-end">
            <a href="" class="btn btn-secondary me-2">Export (.xlsx)</a>
            <a href="" class="btn btn-secondary me-2">Data Sampah</a>
        </div>

        <table class="table table-responsive table-bordered mt-3" style="border-radius: 10px">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Target</th>
                    <th>Stor</th>
                    <th>Target Uang</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>


            @foreach ($riwayats as $key => $target)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $target->Target }}</td>
                    <td>{{ $target->stor }}</td>
                    <td>{{ $target->Berapa_Bulan }} bulan</td>
                    <td>Rp . {{ number_format($target->Target_Uang, 0, ',', '.') }}</td>
                    <td>Rp . {{ number_format($target->Perbulan, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('user.riwayats.create', $target->id) }}" class="btn btn-success"
                            style="border-radius: 20px;">
                            <i class="fa-solid fa-plus text-white"></i>
                        </a>
                        <a href="{{ route('user.targets.edit', $target->id) }}" class="btn btn-sm btn-primary mt-1"
                            style="border-radius: 20px; width: 58px;"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('user.targets.delete', $target->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-1"
                                style="border-radius: 20px; width: 58px;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endsection

    {{-- @section('Footer')
    @endsection

    @push('script')
        <script>
            $(function() {
                $('#promoTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('staff.promos.datatables') }}",

                    columns:[
                        { data: 'DT_RowIndex', name: 'RowIndex', orderable: false, searchable: false},
                        { data: 'promo_code', name: 'promo_code', orderable: true, searchable: true},
                        { data: 'hasil', name: 'hasil', orderable: true, searchable: true},
                        { data: 'discount', name: 'discount', visible: false, searchable: true},
                        { data: 'activedBadge', name: 'activedBadge', orderable: true, searchable: true },
                        { data: 'buttons', name: 'buttons', orderable: false, searchable: false }

                    ]
                })
            })
        </script>
    @endpush --}}
