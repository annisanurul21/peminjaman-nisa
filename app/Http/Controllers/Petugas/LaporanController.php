<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user','alat']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->dari) {
            $query->whereDate('tanggal_pinjam', '>=', $request->dari);
        }
        if ($request->sampai) {
            $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
        }
        if ($request->nama) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->nama.'%');
            });
        }

        $peminjamans = $query->latest()->get();
        return view('petugas.laporan.index', compact('peminjamans'));
    }

    public function print(Request $request)
    {
        $query = Peminjaman::with(['user','alat']);

        if ($request->status) $query->where('status', $request->status);
        if ($request->dari) $query->whereDate('tanggal_pinjam', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
        if ($request->nama) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->nama.'%');
            });
        }

        $peminjamans = $query->latest()->get();
        $filter = $request->all();
        return view('petugas.laporan.print', compact('peminjamans','filter'));
    }
}