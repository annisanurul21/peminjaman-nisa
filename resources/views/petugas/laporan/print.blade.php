<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Alat - {{ now()->format('d/m/Y') }}</title>
    <style>
        /* Base Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            font-size: 11px; 
            color: #1f2937; 
            line-height: 1.5;
            background-color: #fff;
        }

        /* Container Laporan */
        .report-wrapper { padding: 30px; max-width: 1000px; margin: auto; }

        /* Kop Surat / Header */
        .header { 
            text-align: center; 
            border-bottom: 3px double #374151; 
            padding-bottom: 15px; 
            margin-bottom: 20px; 
        }
        .header .logo { font-size: 24px; font-weight: 800; color: #4F46E5; letter-spacing: -1px; }
        .header h1 { font-size: 16px; font-weight: bold; text-transform: uppercase; margin-top: 5px; }
        .header p { font-size: 11px; color: #6b7280; }

        /* Meta Info */
        .meta { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .meta table { width: auto; border: none; }
        .meta td { padding: 1px 0; border: none; font-size: 10px; color: #4b5563; }
        .meta td:first-child { font-weight: 600; padding-right: 10px; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 25px; }
        .stat-card { 
            border: 1px solid #e5e7eb; 
            border-radius: 8px; 
            padding: 10px; 
            text-align: center; 
            background: #f9fafb;
        }
        .stat-card .val { font-size: 18px; font-weight: 800; display: block; }
        .stat-card .lbl { font-size: 9px; font-weight: 600; color: #6b7280; text-transform: uppercase; }

        /* Table Style */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { 
            background: #4F46E5; 
            color: white; 
            font-weight: 600; 
            padding: 10px 8px; 
            text-align: left; 
            text-transform: uppercase;
            font-size: 9px;
        }
        td { padding: 8px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        tr:nth-child(even) { background-color: #fcfcfd; }

        /* Badges */
        .badge { 
            padding: 3px 10px; 
            border-radius: 9999px; 
            font-size: 9px; 
            font-weight: 700; 
            display: inline-block;
            text-transform: uppercase;
        }
        .menunggu { background: #fef3c7; color: #92400e; }
        .disetujui { background: #d1fae5; color: #065f46; }
        .ditolak { background: #fee2e2; color: #991b1b; }
        .dikembalikan { background: #dbeafe; color: #1e40af; }

        /* Footer Tanda Tangan */
        .signature-area { margin-top: 40px; display: flex; justify-content: flex-end; }
        .signature-box { text-align: center; width: 200px; }
        .signature-space { margin-top: 60px; border-top: 1.5px solid #1f2937; padding-top: 5px; font-weight: bold; }

        /* Utility */
        .no-print { 
            display: flex; gap: 10px; background: #1f2937; padding: 15px 30px; 
            color: white; align-items: center; justify-content: center;
        }
        .btn { 
            padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600; 
            cursor: pointer; border: none; text-decoration: none;
        }
        .btn-primary { background: #4F46E5; color: white; }
        .btn-secondary { background: #374151; color: #d1d5db; }

        @media print {
            .no-print { display: none !important; }
            body { margin: 0; padding: 0; }
            .report-wrapper { padding: 0; }
            .stat-card { border: 1px solid #ddd; background: none; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    <nav class="no-print">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Laporan / PDF</button>
        <button onclick="window.close()" class="btn btn-secondary">✕ Tutup Halaman</button>
        <p style="font-size: 11px; color: #9ca3af; margin-left: 10px;">Gunakan margin "Default" pada pengaturan print.</p>
    </nav>

    <div class="report-wrapper">
        <header class="header">
            <div class="logo">PEMINJAMAN ALAT</div>
            <h1>Laporan Data Peminjaman Alat</h1>
            <p>Sistem Informasi Inventaris & Peminjaman Lab — SMK Indonesia</p>
        </header>

        <section class="meta">
            <table>
                <tr><td>Dicetak oleh</td><td>: {{ auth()->user()->name }}</td></tr>
                <tr><td>Waktu Cetak</td><td>: {{ now()->format('d/m/Y H:i') }}</td></tr>
            </table>
            <table>
                @if(!empty($filter['dari']) || !empty($filter['sampai']))
                <tr>
                    <td>Periode</td>
                    <td>: {{ $filter['dari'] ? date('d/m/Y', strtotime($filter['dari'])) : 'Awal' }} s/d {{ $filter['sampai'] ? date('d/m/Y', strtotime($filter['sampai'])) : 'Akhir' }}</td>
                </tr>
                @endif
                @if(!empty($filter['status']))
                <tr><td>Status</td><td>: {{ ucfirst($filter['status']) }}</td></tr>
                @endif
                <tr><td>Volume Data</td><td>: {{ $peminjamans->count() }} Record</td></tr>
            </table>
        </section>

        <section class="stats-grid">
            <div class="stat-card"><span class="val">{{ $peminjamans->count() }}</span><span class="lbl">Total</span></div>
            <div class="stat-card"><span class="val" style="color:#b45309">{{ $peminjamans->where('status','menunggu')->count() }}</span><span class="lbl">Menunggu</span></div>
            <div class="stat-card"><span class="val" style="color:#059669">{{ $peminjamans->where('status','disetujui')->count() }}</span><span class="lbl">Disetujui</span></div>
            <div class="stat-card"><span class="val" style="color:#dc2626">{{ $peminjamans->where('status','ditolak')->count() }}</span><span class="lbl">Ditolak</span></div>
            <div class="stat-card"><span class="val" style="color:#2563eb">{{ $peminjamans->where('status','dikembalikan')->count() }}</span><span class="lbl">Kembali</span></div>
        </section>

        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Peminjam (NISN)</th>
                    <th>Kelas</th>
                    <th>Nama Alat</th>
                    <th>Jml</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <strong>{{ $p->user->name }}</strong><br>
                        <span style="color: #6b7280; font-size: 9px;">{{ $p->user->nisn ?? '-' }}</span>
                    </td>
                    <td>{{ $p->user->kelas ?? '-' }}</td>
                    <td>{{ $p->alat->nama_alat }}</td>
                    <td>{{ $p->jumlah_pinjam }} <small>Unit</small></td>
                    <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $p->tanggal_kembali->format('d/m/Y') }}</td>
                    <td><span class="badge {{ $p->status }}">{{ $p->status }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 30px; color: #9ca3af;">Data tidak ditemukan untuk periode/filter ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <footer class="signature-area">
            <div class="signature-box">
                <p>Tanda Tangan Petugas,</p>
                <div class="signature-space">
                    {{ auth()->user()->name }}
                </div>
            </div>
        </footer>
    </div>

</body>
</html>