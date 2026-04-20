<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DendaController extends Controller
{
    // Daftar denda milik user
    public function index()
    {
        $dendas = Denda::with('peminjaman.alat')
                       ->where('user_id', auth()->id())
                       ->latest()->get();
        return view('user.denda.index', compact('dendas'));
    }

    // Form isi alasan + pilih metode bayar
    public function bayar(Denda $denda)
    {
        if ($denda->user_id !== auth()->id()) abort(403);
        return view('user.denda.bayar', compact('denda'));
    }

    // Simpan alasan + bukti QRIS
    public function submitBayar(Request $request, Denda $denda)
    {
        if ($denda->user_id !== auth()->id()) abort(403);

        $request->validate([
            'alasan_user'  => 'required|string|min:10',
            'metode_bayar' => 'required|in:cash,qris',
            'bukti_bayar'  => 'required_if:metode_bayar,qris|nullable|image|max:2048',
        ]);

        $data = [
            'alasan_user'  => $request->alasan_user,
            'metode_bayar' => $request->metode_bayar,
            'status'       => $request->metode_bayar === 'cash' ? 'menunggu_konfirmasi' : 'menunggu_konfirmasi',
        ];

        if ($request->hasFile('bukti_bayar')) {
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_denda', 'public');
        }

        $denda->update($data);

        return redirect()->route('user.denda.index')
                         ->with('success', 'Pembayaran dikirim! Menunggu konfirmasi petugas.');
    }
}