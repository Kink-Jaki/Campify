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
    // 1. Samakan nama dengan di VIEW (ktp_foto)
    $request->validate([
        'barang_id'       => 'required|exists:barang,id',
        'jumlah'          => 'required|integer|min:1',
        'tanggal_mulai'   => 'required|date|after_or_equal:today',
        'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        'ktp_foto'        => 'required|image|max:2048', // Ganti ke ktp_foto
    ]);

    $barang = Barang::findOrFail($request->barang_id);

    if ($barang->stok < $request->jumlah) {
        return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.']);
    }

    // 2. Pastikan mengambil file yang benar (ktp_foto)
    $fotoPath = null;
    if ($request->hasFile('ktp_foto')) {
        $fotoPath = $request->file('ktp_foto')->store('foto_ident', 'public');
    }

    DB::transaction(function () use ($request, $barang, $fotoPath) {
        $rental = Rental::create([
            'user_id'         => Auth::id(),
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => 'pending',
            'foto_ident'      => $fotoPath, // Disimpan ke kolom foto_ident
        ]);

        DetailRental::create([
            'rental_id' => $rental->id,
            'barang_id' => $barang->id,
            'jumlah'    => $request->jumlah,
        ]);
    });

    return redirect()->route('riwayat')->with('success', 'Berhasil!');
}    public function riwayat()
    {
        $rentals = Rental::with(['details.barang', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('rental.riwayat', compact('rentals'));
    }
}
