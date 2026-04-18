<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table    = 'rental';
    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(DetailRental::class, 'rental_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'rental_id');
    }
}