@extends('templates.app')

@section('navbar')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <div style="margin-left: 16%">
        @if (Session::get('success'))
            {{-- Auth::user() : mengambil data pengguna, Auth::user()->fieldtableusers --}}
            <div class="alert alert-success w-100">{{ Session::get('success') }}
                <b>Selamat Datang, {{ Auth::user()->name }}</b>
            </div>
        @endif
        @if (Session::get('logout'))
            <div class="alert alert-warning">{{ Session::get('logout') }}</div>
        @endif
    </div>
    <div class="container-fluid px-4 mt-4">
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card bg-white text-dark position-relative overflow-hidden shadow-sm border-0 h-100">
                            <i class="fa-solid fa-chart-simple card-bg-icon text-dark"></i>
                            <div class="card-body text-center">
                                <h6 class="fw-semibold">Hasil Seluruh Tabungan 💰</h6>
                                <h3 class="d-flex text-center justify-content-center mb-0">
                                    <div class="circle-icon">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                        @php
                                            $total = $riwayats->sum('stor');
                                        @endphp
                                        <tr>
                                            <td><strong>{{ number_format($total, 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-white text-dark position-relative overflow-hidden shadow-sm border-0 h-100"
                            style="height: 80vh;">
                            <i class="fa-solid fa-bullseye card-bg-icon text-dark"></i>
                            <div class="card-body text-center">
                                <h5 class="fw-semibold">Target Tabungan 📌</h5>
                                <div style="max-height: 300px; overflow-y: auto; text-align: left;">
                                    <ol class="mb-0">
                                        @foreach ($targets as $key => $target)
                                            <li class="mb-1">{{ $target->Target }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="card bg-light border-0 shadow-sm p-4 text-center h-100">
                            <h4 class="fw-semibold text-secondary mb-3">📅 Calendar</h4>
                            <div class="calendar">
                                <header>
                                    <h2 id="month-year"></h2>
                                </header>
                                <div class="days">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="dates" id="dates"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-white shadow-sm border-0" style="height: 80vh;">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                        <h5 class="mb-0 text-secondary fw-semibold">Daftar Target Tabungan <i
                                class="fa-solid fa-clipboard text-primary"></i></h5>
                        {{-- <a href="{{ route('user.targets.export') }}" class="btn btn-secondary me-2">Export (.xlsx)</a>
                        <a href="{{ route('user.targets.trash') }}" class="btn btn-secondary btn-sm">Data Sampah</a> --}}
                        <div class="d-flex w-75 ">
                            <a href="{{ route('user.targets.export') }}" class="btn btn-outline-secondary m-1">
                                <i class="fa-solid fa-file-export me-1"></i> Export (.xlsx)
                            </a>
                            <a href="{{ route('user.targets.trash') }}" class="btn btn-outline-secondary m-1">
                                <i class="fa-solid fa-trash-can me-1"></i> Data Sampah
                            </a>
                            <a href="{{ route('user.targets.print_pdf') }}" class="btn btn-outline-secondary m-1">
                                <i class="fa-solid fa-trash-can me-1"></i> Cetak PDF
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-3" style="overflow-y: auto; max-height: calc(80vh - 70px);">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light" style="z-index: 10;">
                                <tr>
                                    <th>No.</th>
                                    <th>Target</th>
                                    <th>Berapa Lama</th>
                                    <th>Target Uang</th>
                                    <th>Bayar per Bulan</th>
                                    <th>Lihat Foto Target</th>
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
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalfoto{{ $target->id }}">
                                                Lihat Foto
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.riwayats.create', $target->id) }}"
                                                class="btn btn-success" style="border-radius: 20px;">
                                                <i class="fa-solid fa-plus text-white"></i>
                                            </a>
                                            <a href="{{ route('user.targets.edit', $target->id) }}"
                                                class="btn btn-sm btn-primary mt-1"
                                                style="border-radius: 20px; width: 58px;"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('user.targets.delete', $target->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-1"
                                                    style="border-radius: 20px; width: 58px;"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- modal --}}
                {{-- <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('user.targets.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="cinema_id" class="col-form-label">Bioskop:</label>
                                        <select name="cinema_id" id="cinema_id"
                                            class="form-select @error('cinema_id') is-invalid
                                @enderror">
                                            <option disabled hidden selected>Pilih Bioskop</option>
                                            @foreach ($cinemas as $cinema)
                                                jumlah opsi select sesuai data cinemas
                                                FK cinema_id menyimpan id jadi value ['id'] tapu munculkan ['name']nya
                                                <option value="{{ $cinema['id'] }}">{{ $cinema['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('cinema_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="movie_id" class="col-form-label">Film:</label>
                                        <select name="movie_id" id="mocie_id"
                                            class="form-select @error('movie_id')is-invalid
                                @enderror">
                                            <option disabled hidden selected>Pilih FIlm</option>
                                            @foreach ($movies as $movie)
                                                <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('movie_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="col-form-label">Harga:</label>
                                        <input name="price" id="mocie_id"
                                            class="form-control @error('price')is-invalid
                                @enderror">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="hours" class="form-label">Jam Tayang</label>
                                        kalau ada error yang berhubungan dengan item array hours
                                        @if ($errors->has('hours.*'))
                                            ambil keterangan error pada item pertama
                                            <small class="text-danger">{{ $errors->first('hours.*') }}</small>
                                        @endif
                                        <input type="time" name="hours[]"
                                            class="form-control @if ($errors->has('hours.*')) is-invalid @endif">
                                        akan diisi input tambahan dari JS
                                        <div id="additionalInput"></div>
                                        <span class="text-primary my-3" style="cursor: pointer;" onclick="addInput()">+
                                            Tambah Input Jam</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            </div>

        </div>
    </div>

    <!-- Carousel wrapper -->
    <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <!-- Inner -->
        <div class="carousel-inner m-3 w-75" style="margin-left: 20% !important;">
            <!-- Single item -->
            <div class="carousel-item active">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100"
                    alt="Sunset Over the City" />
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100"
                    alt="Canyon at Nigh" />
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100"
                    alt="Cliff Above a Stormy Sea" />
            </div>
        </div>
        <!-- Inner -->

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
            data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
            data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Carousel wrapper -->

    {{-- chart js --}}
    <div class="card bg-white shadow-sm border-0 p-3 mt-3">
        <h5 class="text-center">Perbandingan Stor: Kemarin & Hari Ini</h5>
        <canvas id="storPieChart" width="400" height="400"></canvas>
    </div>



    @foreach ($targets as $key => $target)
        <div class="modal fade" id="modalfoto{{ $target->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Target</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $target->foto) }}" alt="foto"
                            class="img-fluid border border-danger">
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <script>
        const monthYear = document.getElementById("month-year");
        const datesContainer = document.getElementById("dates");

        const now = new Date();
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        const renderCalendar = () => {
            const year = now.getFullYear();
            const month = now.getMonth();

            monthYear.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);

            datesContainer.innerHTML = "";

            for (let i = 0; i < firstDay.getDay(); i++) {
                datesContainer.innerHTML += `<div></div>`;
            }

            for (let day = 1; day <= lastDay.getDate(); day++) {
                const todayClass =
                    day === new Date().getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear() ? "today" : "";
                datesContainer.innerHTML += `<div class="${todayClass}">${day}</div>`;
            }
        };

        renderCalendar();
    </script>
@endsection
