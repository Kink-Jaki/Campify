<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Barang;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang'   => Barang::count(),
            'total_user'     => User::where('role', 'user')->count(),
            'rental_pending' => Rental::where('status', 'pending')->count(),
            'rental_aktif'   => Rental::where('status', 'disewa')->count(),
        ];

        $rental_terbaru = Rental::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'rental_terbaru'));
    }
}