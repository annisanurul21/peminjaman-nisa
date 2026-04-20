<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user','alat'])
                                 ->where('status','disetujui')
                                 ->latest()->get();
        return view('petugas.pengembalian.index', compact('peminjamans'));
    }

    public function proses(Peminjaman $peminjaman)
{
    $peminjaman->alat->increment('jumlah_tersedia', $peminjaman->jumlah_pinjam);
    $peminjaman->update(['status' => 'dikembalikan']);

    // Cek terlambat — redirect ke form denda
    if ($peminjaman->tanggal_kembali->isPast()) {
        return redirect()->route('petugas.denda.create', $peminjaman)
                         ->with('warning', '⚠️ Pengembalian terlambat! Silakan input denda.');
    }

    return redirect()->route('petugas.pengembalian.index')
                     ->with('success', 'Alat berhasil dikembalikan! Stok sudah diperbarui.');
}
}