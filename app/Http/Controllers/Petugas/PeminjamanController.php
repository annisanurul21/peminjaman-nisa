<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Daftar semua pengajuan
    public function index()
    {
        $peminjamans = Peminjaman::with(['user','alat'])->latest()->get();
        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // Detail pengajuan
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user','alat']);
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    // Setujui peminjaman
    public function setujui(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error','Pengajuan sudah diproses.');
        }

        $alat = $peminjaman->alat;
        if ($peminjaman->jumlah_pinjam > $alat->jumlah_tersedia) {
            return back()->with('error','Stok tidak mencukupi.');
        }

        // Kurangi stok tersedia
        $alat->decrement('jumlah_tersedia', $peminjaman->jumlah_pinjam);

        $peminjaman->update([
            'status'          => 'disetujui',
            'catatan_petugas' => $request->catatan_petugas,
            'diproses_oleh'   => auth()->id(),
        ]);

        return redirect()->route('petugas.peminjaman.index')
                         ->with('success','Peminjaman disetujui!');
    }

    // Tolak peminjaman
    public function tolak(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error','Pengajuan sudah diproses.');
        }

        $peminjaman->update([
            'status'          => 'ditolak',
            'catatan_petugas' => $request->catatan_petugas,
            'diproses_oleh'   => auth()->id(),
        ]);

        return redirect()->route('petugas.peminjaman.index')
                         ->with('success','Peminjaman ditolak.');
    }
}