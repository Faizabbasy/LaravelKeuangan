@extends('templates.app')

@section('navbar')
    <h2 class="text-center mt-5">Selamat datang di halaman admin😊✌️</h2>
    {{-- <div class="row gap-2" style="margin-left: 25%">
        <div class="col-6" style="background-color:aliceblue; border-radius:10px; border-style:solid; margin-top:5%">
            <h5>Data Nabung Hari ini {{ now()->format('F') }}</h5>
            <canvas id="chartBar"></canvas>
        </div>
        <div class="col-6"
            style="background-color:aliceblue; border-radius:10px; border-style:solid; margin-top:5%; width:30% !important;">
            <h5>Data Nabung Kemarin</h5>
            <canvas id="chartPie" class="w-65 h-75 px-5 ps-4"></canvas>
        </div>
    </div> --}}
@endsection

{{-- @push('script')
    <script>
        let labelBar = [];
        let dataBar = [];
        let labelPie = [];
        let dataPie = [];
        // ketika html selesai di render, jalankan fungsi js ini
        $(function() {
            $.ajax({
                url: "{{ route('admin.chart') }}",
                method: "GET",
                success: function(res) {
                    // Bar → Nabung Hari Ini
                    labelBar = res.today.labels;
                    dataBar = res.today.data;

                    // Pie → Nabung Kemarin
                    labelPie = res.yesterday.labels;
                    dataPie = res.yesterday.data;

                    chartBar();
                    chartPie();
                },
                error: function(err) {
                    alert('Gagal mengambil data chart!');
                }
            });
        });
    </script>
@endpush --}}
