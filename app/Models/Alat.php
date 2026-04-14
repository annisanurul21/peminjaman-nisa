<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [
        'kategori_id','nama_alat','kode_alat',
        'jumlah_total','jumlah_tersedia','kondisi','deskripsi','foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}