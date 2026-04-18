<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barang')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100|unique:kategori']);
        Kategori::create($request->only('nama_kategori'));
        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id]);
        $kategori->update($request->only('nama_kategori'));
        return back()->with('success', 'Kategori diupdate.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}