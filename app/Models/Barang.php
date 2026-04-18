<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table    = 'barang';
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'stok',
        'harga_sewa_per_hari',
        'kondisi',
        'deskripsi',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailRental()
    {
        return $this->hasMany(DetailRental::class, 'barang_id');
    }
}