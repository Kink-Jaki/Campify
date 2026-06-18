<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Rental;
use App\Models\DetailRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        return view('keranjang');
    }

    // Tampilkan form tambah ke keranjang
    public function create(Barang $barang)
    {
        return view('rental.create', compact('barang'));
    }

    // Tambah barang ke keranjang (session)
    public function add(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stok]);
        }

        $cart = session()->get('cart', []);

        $cart[$barang->id] = [
            'nama'   => $barang->nama_barang,
            'harga'  => $barang->harga_sewa_per_hari,
            'jumlah' => $request->jumlah,
            'stok'   => $barang->stok,
        ];

        session()->put('cart', $cart);

        return redirect()->route('keranjang')->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }

    // Checkout — simpan ke database
    public function checkout(Request $request)
    {
        $request->validate([
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'ktp_foto'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang')->withErrors(['cart' => 'Keranjang kosong.']);
        }

        // Cek stok semua barang
        foreach ($cart as $id => $item) {
            $barang = Barang::findOrFail($id);
            if ($barang->stok < $item['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok ' . $barang->nama_barang . ' tidak mencukupi.']);
            }
        }

        // Upload KTP sebelum transaksi
        $ktpPath = $request->file('ktp_foto')->store('ktp', 'public');

        DB::transaction(function () use ($request, $cart, $ktpPath) {
            $rental = Rental::create([
                'user_id'         => Auth::id(),
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status'          => 'pending',
                'foto_ident'      => $ktpPath,
            ]);

            foreach ($cart as $id => $item) {
                DetailRental::create([
                    'rental_id' => $rental->id,
                    'barang_id' => $id,
                    'jumlah'    => $item['jumlah'],
                ]);
            }
        });

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('riwayat')->with('success', 'Rental berhasil diajukan! Tunggu konfirmasi admin.');
    }
}