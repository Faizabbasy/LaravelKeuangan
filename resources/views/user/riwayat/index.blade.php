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


            @foreach ($riwayats as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['target'] }}</td>
                    <td>{{ $item['stor'] }}</td>
                    <td>
                            Rp. {{ number_format($item->targetUang, 0, ',', '.') }}
                    </td>
                    <td>{{ $item['Tanggal']}}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="" class="btn btn-primary">Edit</a>

                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ms-2">Hapus</button>
                            </form>
                        </div>
                    </td>
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
