<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jadwal Laboratorium & Simulator</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #000;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .header img {
            width: 70px;
            position: absolute;
            top: 10px;
            left: 50px;
        }
        .info {
            text-align: right;
            font-size: 11px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo" />
        <h2>POLITEKNIK MARITIM AMI MAKASSAR</h2>
        <h4>Laporan Jadwal Penggunaan Laboratorium & Simulator</h4>
    </div>

    <div class="info">
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lab / Simulator</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Jenis Kegiatan</th>
                <th>Detail Materi</th>
                <th>Jumlah Peserta</th>
                <th>Status</th>
                <th>Pengajar</th>
                <th>Kepala Lab</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $i => $schedule)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $schedule->labSimulator->name ?? '-' }}</td>
                    <td>{{ $schedule->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }}</td>
                    <td>{{ $schedule->jenis_kegiatan }}</td>
                    <td>{{ $schedule->detail_materi }}</td>
                    <td>{{ $schedule->jumlah_peserta }}</td>
                    <td>{{ $schedule->status_verifikasi }}</td>
                    <td>{{ $schedule->pengajar->name ?? '-' }}</td>
                    <td>{{ $schedule->kalab->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
