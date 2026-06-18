<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $kategori = Kategori::all();

    $barang = Barang::with('kategori')
        ->where('kondisi', 'baik')
        ->where('stok', '>', 0);

    // FILTER KATEGORI
    if ($request->filled('kategori')) {
        $barang->where('kategori_id', $request->kategori);
    }

    $barang = $barang->get();

    return view('home', compact('barang', 'kategori'));
}

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }
}
