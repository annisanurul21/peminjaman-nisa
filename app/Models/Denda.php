<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $fillable = [
        'peminjaman_id','user_id','jenis','hari_terlambat',
        'nominal_denda','keterangan_petugas','alasan_user',
        'status','metode_bayar','bukti_bayar','dibayar_at','dikonfirmasi_oleh'
    ];
    protected $casts = ['dibayar_at' => 'datetime'];

    public function peminjaman() { return $this->belongsTo(Peminjaman::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function konfirmator() { return $this->belongsTo(User::class, 'dikonfirmasi_oleh'); }

    public function getNominalFormatAttribute()
    {
        return 'Rp ' . number_format($this->nominal_denda, 0, ',', '.');
    }
}