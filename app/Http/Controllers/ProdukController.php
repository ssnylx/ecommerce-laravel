<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
class ProdukController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $request->gambar = $imageName;
        }
        $produk = new Produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->gambar = $imageName; 
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    // Jika terdapat file gambar yang diunggah
    if ($request->hasFile('gambar')) {
        // Validasi input gambar
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Mengambil file gambar dari request
        $gambar = $request->file('gambar');

        // Membuat nama unik untuk gambar dengan menggunakan timestamp
        $nama_gambar = time() ."." . $gambar->extension();

        // Menyimpan gambar ke direktori public/storage/images/
        $gambar->move(public_path('images'), $nama_gambar);

        // Mengupdate atribut gambar produk dengan nama gambar yang baru
        $produk->gambar = $nama_gambar;
    }

    // Validasi input (termasuk validasi gambar jika tidak ada gambar yang diunggah)
    $request->validate([
        'id_kategori' => 'required|exists:kategori,id_kategori',
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'deskripsi' => 'required|string',
    ]);

    // Mengupdate atribut lainnya dengan data dari request
    $produk->update($request->only(['id_kategori', 'nama', 'harga', 'stok', 'deskripsi']));

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
