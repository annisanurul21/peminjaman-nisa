<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Daftar alat yang bisa dipinjam
    public function daftarAlat()
    {
        $alats = Alat::with('kategori')
                     ->where('jumlah_tersedia', '>', 0)
                     ->where('kondisi', 'baik')
                     ->get();
        return view('user.alat.index', compact('alats'));
    }

    // Form ajukan peminjaman
    public function create($alat_id)
    {
        $alat = Alat::findOrFail($alat_id);
        return view('user.peminjaman.create', compact('alat'));
    }

    // Simpan pengajuan
    public function store(Request $request)
{
    $request->validate([
        'alat_id'         => 'required|exists:alats,id',
        'no_hp'           => 'required|string|max:20',
        'jumlah_pinjam'   => 'required|integer|min:1',
        'tanggal_pinjam'  => 'required|date|after_or_equal:today',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'keperluan'       => 'nullable|string',
    ]);

    $alat = Alat::findOrFail($request->alat_id);

    if ($request->jumlah_pinjam > $alat->jumlah_tersedia) {
        return back()->withErrors(['jumlah_pinjam' => 'Jumlah melebihi stok tersedia ('.$alat->jumlah_tersedia.')']);
    }

    Peminjaman::create([
        'user_id'         => auth()->id(),
        'alat_id'         => $request->alat_id,
        'no_hp'           => $request->no_hp,
        'jumlah_pinjam'   => $request->jumlah_pinjam,
        'tanggal_pinjam'  => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'keperluan'       => $request->keperluan,
        'status'          => 'menunggu',
    ]);

    return redirect()->route('user.peminjaman.riwayat')
                     ->with('success','Pengajuan peminjaman berhasil dikirim! Tunggu persetujuan petugas.');
}

    // Riwayat peminjaman user
    public function riwayat()
    {
        $peminjamans = Peminjaman::with('alat')
                                 ->where('user_id', auth()->id())
                                 ->latest()->get();
        return view('user.peminjaman.riwayat', compact('peminjamans'));
    }
}