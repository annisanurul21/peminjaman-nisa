<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans'; // ← tambahkan ini

    protected $fillable = [
        'user_id','alat_id','no_hp','jumlah_pinjam',
        'tanggal_pinjam','tanggal_kembali','keperluan',
        'status','catatan_petugas','diproses_oleh'
    ];

    protected $casts = [
        'tanggal_pinjam'  => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function alat() { return $this->belongsTo(Alat::class); }
    public function petugas() { return $this->belongsTo(User::class, 'diproses_oleh'); }
}