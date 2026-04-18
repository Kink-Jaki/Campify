<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Rental;
use App\Models\DetailRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function create(Barang $barang)
    {
        return view('rental.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'       => 'required|exists:barang,id',
            'jumlah'          => 'required|integer|min:1',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stok]);
        }

        DB::transaction(function () use ($request, $barang) {
            $rental = Rental::create([
                'user_id'         => Auth::id(),
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status'          => 'pending',
            ]);

            DetailRental::create([
                'rental_id' => $rental->id,
                'barang_id' => $barang->id,
                'jumlah'    => $request->jumlah,
            ]);
        });

        return redirect()->route('riwayat')->with('success', 'Pengajuan rental berhasil! Tunggu konfirmasi admin.');
    }

    public function riwayat()
    {
        $rentals = Rental::with(['details.barang', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('rental.riwayat', compact('rentals'));
    }
}
