@extends('templates.app')

@section('navbar')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

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
                                    </div> <span class="fs-4 mt-3">Rp 12.500.000</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-white text-dark position-relative overflow-hidden shadow-sm border-0 h-100">
                            <i class="fa-solid fa-bullseye card-bg-icon text-dark"></i>
                            <div class="card-body text-center">
                                <h5 class="fw-semibold">Target Tabungan 📌</h5>
                                <h3 class="fw-bold mb-0">...</h3>
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
                <div class="card bg-white shadow-sm border-0" style="height: 50vh">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                        <h5 class="mb-0 text-secondary fw-semibold">Daftar Target Tabungan</h5>
                        <a href="#" class="btn btn-secondary btn-sm">Data Sampah</a>
                        {{-- <a href="#" class="btn btn-success">Tambah data</a> --}}
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Target</th>
                                    <th>Berapa Lama</th>
                                    <th>Target Uang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($targets as $key => $target)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$target['target']}}</td>
                                        <td>{{$target['Berapa_Bulan']}}</td>
                                        <td>{{$target['Target_Uang']}}</td>
                                        <td>
                                            aksi --}}
                                            {{-- <a href="{{ route('staff.schedules.edit', $schedule->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('staff.schedules.delete', $schedule->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ms-2">Hapus</button>
                                            </form> --}}
                                        {{-- </td>
                                    </tr>
                                @endforeach --}}
                                {{-- @foreach ($schedules as $key => $schedule)
                <tr>
                    <td>{{$key+1}}</td>
                    ambil nama relasi kemudian nama field
                    <td>{{$schedule['cinema']['name']}}</td>
                    <td>{{$schedule['movie']['title']}}</td>
                    <td>Rp. {{number_format($schedule['price'], 0, ',', '.')}}</td>
                    <td>
                        <ul>
                            karena hours bentuknya array, jadi pake loop
                            @foreach ($schedule['hours'] as $hours)
                                bentuk array item : ['09.00', '10.00'] jadi $hours langsung berisi datanya
                                <li>{{$hours}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('staff.schedules.edit', $schedule->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('staff.schedules.delete', $schedule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
