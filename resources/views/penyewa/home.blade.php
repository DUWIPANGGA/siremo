<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIREMO – Dashboard Penyewa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FDF9F5;
            color: #2A1F18;
            min-height: 100vh;
        }
        header {
            background: #fff;
            border-bottom: 1px solid #F0E8E0;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .header-left .logo {
            font-size: 20px;
            font-weight: 800;
            color: #E8622A;
        }
        .header-left .logo i { margin-right: 6px; }
        .header-left .page-title {
            font-size: 14px;
            font-weight: 600;
            color: #6A5A4E;
            border-left: 1.5px solid #E0D0CA;
            padding-left: 14px;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-right .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #3A2A1A;
        }
        .btn-logout {
            background: none;
            border: 1.5px solid #E0D0CA;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            color: #6A5A4E;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: background .15s, border-color .15s;
        }
        .btn-logout:hover { background: #FEF0EA; border-color: #E8622A; color: #E8622A; }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 32px 20px;
        }
        .welcome-card {
            background: linear-gradient(135deg, #E8622A 0%, #FF9A3C 100%);
            border-radius: 16px;
            padding: 32px;
            color: #fff;
            margin-bottom: 28px;
        }
        .welcome-card h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .welcome-card p {
            font-size: 14px;
            opacity: .9;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            border: 1px solid #F0E8E0;
        }
        .stat-card .stat-icon {
            font-size: 28px;
            color: #E8622A;
            margin-bottom: 10px;
        }
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1A130E;
        }
        .stat-card .stat-label {
            font-size: 13px;
            color: #6A5A4E;
            font-weight: 500;
        }
        .section-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #1A130E;
        }
        .table-wrap {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #F0E8E0;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #8A7A6E;
            padding: 14px 18px;
            background: #FAF5F2;
            border-bottom: 1px solid #F0E8E0;
        }
        td {
            font-size: 13px;
            padding: 14px 18px;
            border-bottom: 1px solid #F5EDE8;
        }
        tr:last-child td { border-bottom: none; }
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
        }
        .badge-aktif { background: #E8F5E9; color: #2E7D32; }
        .badge-selesai { background: #E3F2FD; color: #1565C0; }
        .badge-batal { background: #FFEBEE; color: #C62828; }
        .badge-disewa { background: #FFF3E0; color: #E65100; }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #8A7A6E;
        }
        .empty-state i { font-size: 48px; display: block; margin-bottom: 12px; opacity: .5; }
        .empty-state p { font-size: 14px; }
        @media (max-width: 768px) {
            header { padding: 12px 16px; }
            .stats-grid { grid-template-columns: 1fr; }
            .container { padding: 20px 12px; }
            .welcome-card { padding: 24px; }
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <span class="logo"><i class="bi bi-car-front-fill"></i>SIREMO</span>
        <span class="page-title">Dashboard Penyewa</span>
    </div>
    <div class="header-right">
        <span class="user-name"><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->nama_lengkap ?: Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>Keluar</button>
        </form>
    </div>
</header>

<div class="container">
    @php
        $penyewa = Auth::user()->penyewa;
        $transaksi = $penyewa?->transaksiSewa ?? collect();
        $totalTransaksi = $transaksi->count();
        $transaksiAktif = $transaksi->whereIn('status_transaksi', ['Aktif', 'Disewa'])->count();
        $transaksiSelesai = $transaksi->where('status_transaksi', 'Selesai')->count();
    @endphp

    <div class="welcome-card">
        <h1>Selamat Datang, {{ Auth::user()->nama_lengkap ?: Auth::user()->name }}!</h1>
        <p>Kelola penyewaan kendaraan Anda dengan mudah melalui dashboard ini.</p>
    </div>

    @if($penyewa)
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-car-front"></i></div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
            <div class="stat-label">Total Transaksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
            <div class="stat-value">{{ $transaksiAktif }}</div>
            <div class="stat-label">Sedang Berjalan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
            <div class="stat-value">{{ $transaksiSelesai }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>
    @endif

    <div class="section-title"><i class="bi bi-receipt me-1"></i>Riwayat Transaksi</div>
    <div class="table-wrap">
        @if($penyewa && $transaksi->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mobil</th>
                    <th>Tgl Sewa</th>
                    <th>Tgl Rencana Kembali</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->sortByDesc('id_transaksi') as $t)
                <tr>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ $t->mobil?->merek }} {{ $t->mobil?->model }}</td>
                    <td>{{ $t->tgl_sewa?->format('d/m/Y') }}</td>
                    <td>{{ $t->tgl_rencana_kembali?->format('d/m/Y') }}</td>
                    <td>Rp{{ number_format($t->totalKeseluruhan, 0, ',', '.') }}</td>
                    <td>
                        @switch($t->status_transaksi)
                            @case('Aktif') <span class="badge badge-aktif">Aktif</span> @break
                            @case('Disewa') <span class="badge badge-disewa">Disewa</span> @break
                            @case('Selesai') <span class="badge badge-selesai">Selesai</span> @break
                            @case('Batal') <span class="badge badge-batal">Batal</span> @break
                            @default <span class="badge">{{ $t->status_transaksi }}</span>
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada transaksi penyewaan.</p>
        </div>
        @endif
    </div>
</div>

</body>
</html>
