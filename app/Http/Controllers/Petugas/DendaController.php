<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DendaController extends Controller
{
    // Daftar semua denda
    public function index()
    {
        $dendas = Denda::with(['peminjaman.alat','user'])->latest()->get();
        return view('petugas.denda.index', compact('dendas'));
    }

    // Form input denda (petugas buat denda baru)
    public function create(Peminjaman $peminjaman)
    {
        $hari_terlambat = 0;
        if ($peminjaman->tanggal_kembali->isPast()) {
            $hari_terlambat = Carbon::now()->diffInDays($peminjaman->tanggal_kembali);
        }
        return view('petugas.denda.create', compact('peminjaman','hari_terlambat'));
    }

    // Simpan denda baru
    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'jenis'               => 'required|in:terlambat,kehilangan,kerusakan',
            'nominal_denda'       => 'required|integer|min:1000',
            'keterangan_petugas'  => 'nullable|string',
        ]);

        $hari = 0;
        if ($request->jenis === 'terlambat' && $peminjaman->tanggal_kembali->isPast()) {
            $hari = Carbon::now()->diffInDays($peminjaman->tanggal_kembali);
        }

        Denda::create([
            'peminjaman_id'      => $peminjaman->id,
            'user_id'            => $peminjaman->user_id,
            'jenis'              => $request->jenis,
            'hari_terlambat'     => $hari,
            'nominal_denda'      => $request->nominal_denda,
            'keterangan_petugas' => $request->keterangan_petugas,
            'status'             => 'belum_bayar',
        ]);

        return redirect()->route('petugas.denda.index')
                         ->with('success', 'Denda berhasil ditambahkan!');
    }

    // Konfirmasi pembayaran cash
    public function konfirmasiCash(Denda $denda)
    {
        $denda->update([
            'status'            => 'lunas',
            'metode_bayar'      => 'cash',
            'dibayar_at'        => now(),
            'dikonfirmasi_oleh' => auth()->id(),
        ]);
        return redirect()->route('petugas.denda.index')
                         ->with('success', 'Pembayaran cash dikonfirmasi!');
    }

    // Konfirmasi pembayaran QRIS
    public function konfirmasiQris(Denda $denda)
    {
        $denda->update([
            'status'            => 'lunas',
            'metode_bayar'      => 'qris',
            'dibayar_at'        => now(),
            'dikonfirmasi_oleh' => auth()->id(),
        ]);
        return redirect()->route('petugas.denda.index')
                         ->with('success', 'Pembayaran QRIS dikonfirmasi!');
    }
}