<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->latest()->get();
        return view('admin.alats.index', compact('alats'));
    }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alats.create', compact('kategoris'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'     => 'required|exists:kategoris,id',
            'nama_alat'       => 'required|string|max:255',
            'kode_alat'       => 'required|string|max:50|unique:alats',
            'jumlah_total'    => 'required|integer|min:1',
            'kondisi'         => 'required|in:baik,rusak,perbaikan',
            'deskripsi'       => 'nullable|string',
            'foto'            => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['kategori_id','nama_alat','kode_alat','jumlah_total','kondisi','deskripsi']);
        $data['jumlah_tersedia'] = $request->jumlah_total;
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alat', 'public');
        }
        Alat::create($data);
        return redirect()->route('admin.alats.index')
                         ->with('success','Alat berhasil ditambahkan!');
    }
    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alats.edit', compact('alat','kategoris'));
    }
    public function update(Request $request, Alat $alat)
{
    $request->validate([
        'kategori_id'  => 'required|exists:kategoris,id',
        'nama_alat'    => 'required|string|max:255',
        'kode_alat'    => 'required|string|max:50|unique:alats,kode_alat,'.$alat->id,
        'jumlah_total' => 'required|integer|min:1',
        'kondisi'      => 'required|in:baik,rusak,perbaikan',
        'deskripsi'    => 'nullable|string',
        'foto'         => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['kategori_id','nama_alat','kode_alat','jumlah_total','kondisi','deskripsi']);
    
    // Tersedia selalu sama dengan total (sebelum ada peminjaman aktif)
    $data['jumlah_tersedia'] = $request->jumlah_total;

    if ($request->hasFile('foto')) {
        if ($alat->foto) Storage::disk('public')->delete($alat->foto);
        $data['foto'] = $request->file('foto')->store('alat', 'public');
    }

    $alat->update($data);

    return redirect()->route('admin.alats.index')
                     ->with('success','Alat berhasil diperbarui!');
}

    public function destroy(Alat $alat)
    {
        if ($alat->foto) Storage::disk('public')->delete($alat->foto);
        $alat->delete();
        return redirect()->route('admin.alats.index')
                         ->with('success','Alat berhasil dihapus!');
    }
}