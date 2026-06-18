<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['user', 'details.barang'])->latest()->paginate(10);
        return view('admin.rental.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'details.barang', 'pengembalian']);
        return view('admin.rental.show', compact('rental'));
    }

    public function approve(Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            $rental->update(['status' => 'disewa']);

            // Kurangi stok
            foreach ($rental->details as $detail) {
                $detail->barang->decrement('stok', $detail->jumlah);
            }
        });

        return back()->with('success', 'Rental disetujui.');
    }

    public function tolak(Request $request, $id)
{
    $request->validate([
        'alasan_ditolak' => 'required|string|max:1000',
    ]);

    $rental = Rental::findOrFail($id);

    $rental->update([
        'status' => 'ditolak',
        'alasan_ditolak' => $request->alasan_ditolak,
    ]);

    return back()->with('success', 'Rental berhasil ditolak');
}
}