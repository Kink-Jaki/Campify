<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->latest()->paginate(10);
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.barang.create', compact('kategori'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nama_barang'         => 'required|string|max:255',
        'kategori_id'         => 'required|exists:kategori,id',
        'stok'                => 'required|integer|min:0',
        'harga_sewa_per_hari' => 'required|numeric|min:0',
        'kondisi'            => 'required|in:baik,rusak',
        'deskripsi'          => 'nullable|string',
        'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');

        $filename = time() . '_' . $file->getClientOriginalName();

        $data['foto'] = $file->storeAs('barang', $filename, 'public');
    }

    Barang::create($data);

    return redirect()
        ->route('admin.barang.index')
        ->with('success', 'Barang berhasil ditambahkan.');
}

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama_barang'        => 'required|string|max:255',
            'kategori_id'        => 'required|exists:kategori,id',
            'stok'               => 'required|integer|min:0',
            'harga_sewa_per_hari'=> 'required|numeric|min:0',
            'kondisi'            => 'required|in:baik,rusak',
            'deskripsi'          => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public.storage');
        }

        $barang->update($data);
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}