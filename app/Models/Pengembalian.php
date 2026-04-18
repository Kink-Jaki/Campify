<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table    = 'pengembalian';
    protected $fillable = [
        'rental_id',
        'tanggal_kembali_real',
        'total_hari',
        'denda',
        'total_bayar',
        'status_pembayaran'
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}