<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRental extends Model
{
    protected $table    = 'detail_rental';
    protected $fillable = [
        'rental_id',
        'barang_id',
        'jumlah'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}