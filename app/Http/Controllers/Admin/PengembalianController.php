<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        // Tampilkan rental yang DISEWA atau SELESAI tapi belum lunas
        $rentals = Rental::with(['user', 'details.barang', 'pengembalian'])
            ->where(function ($query) {
                $query->where('status', 'disewa')
                    ->orWhere(function ($q) {
                        $q->where('status', 'selesai')
                            ->whereHas('pengembalian', function ($p) {
                                $p->where('status_pembayaran', 'belum_lunas');
                            });
                    });
            })
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('rentals'));
    }

    public function proses(Request $request, Rental $rental)
    {
        $request->validate([
            'tanggal_kembali_real' => 'required|date',
        ]);

        $tanggalMulai    = Carbon::parse($rental->tanggal_mulai);
        $tanggalSelesai  = Carbon::parse($rental->tanggal_selesai);
        $tanggalKembali  = Carbon::parse($request->tanggal_kembali_real);

        $totalHari = $tanggalMulai->diffInDays($tanggalKembali) ?: 1;

        // Hitung total sewa normal
        $totalSewa = 0;
        foreach ($rental->details as $detail) {
            $totalSewa += $detail->jumlah * $detail->barang->harga_sewa_per_hari * $totalHari;
        }

        // Hitung denda (50% harga/hari per hari telat)
        $denda = 0;
        if ($tanggalKembali->gt($tanggalSelesai)) {
            $hariTelat = $tanggalSelesai->diffInDays($tanggalKembali);
            foreach ($rental->details as $detail) {
                $denda += $detail->jumlah * ($detail->barang->harga_sewa_per_hari * 0.5) * $hariTelat;
            }
        }

        $totalBayar = $totalSewa + $denda;

        DB::transaction(function () use ($rental, $request, $totalHari, $denda, $totalBayar) {
            Pengembalian::create([
                'rental_id'            => $rental->id,
                'tanggal_kembali_real' => $request->tanggal_kembali_real,
                'total_hari'           => $totalHari,
                'denda'                => $denda,
                'total_bayar'          => $totalBayar,
                'status_pembayaran'    => 'belum_lunas',
            ]);

            // Kembalikan stok
            foreach ($rental->details as $detail) {
                $detail->barang->increment('stok', $detail->jumlah);
            }

            $rental->update(['status' => 'selesai']);
        });

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil diproses.');
    }

    public function konfirmasiPembayaran(Pengembalian $pengembalian)
    {
        $pengembalian->update(['status_pembayaran' => 'lunas']);
        return back()->with('success', 'Pembayaran dikonfirmasi.');
    }
}
