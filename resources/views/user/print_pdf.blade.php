<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Target Tabungan</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Data Pegadaian Terverifikasi</h2>

    <table class="table table-bordered align-middle mb-0">
        <thead class="table-light" style="z-index: 10;">
            <tr>
                <th>No.</th>
                <th>Target</th>
                <th>Berapa Lama</th>
                <th>Target Uang</th>
                <th>Bayar per Bulan</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
