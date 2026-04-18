<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $barang   = Barang::with('kategori')
            ->where('kondisi', 'baik')
            ->where('stok', '>', 0)
            ->get();
        return view('home', compact('barang', 'kategori'));
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }
}
