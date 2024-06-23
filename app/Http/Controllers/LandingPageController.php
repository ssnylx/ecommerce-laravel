<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Carousel;
use App\Models\Kategori;

class LandingPageController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $categories = Kategori::all();
        $produks = Produk::paginate(10); // Ambil produk dari database, misalnya 10 produk per halaman
        return view('landingpage.index', compact('produks', 'carousels', 'categories'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('landingpage.show', compact('produk'));
    }

    public function search(Request $request)
    {
        $carousels = Carousel::all();
        $categories = Kategori::all();
        $query = $request->q;
        $produks = Produk::where('nama', 'like', '%' . $query . '%')->paginate(10);
        return view('landingpage.index', compact('produks', 'carousels', 'categories'));
    }

    public function kategori($kategori_id)
    {   $carousels = Carousel::all();
        $categories = Kategori::all();
        $kategori = Kategori::findOrFail($kategori_id);
        $produks = $kategori->produks()->paginate(10);
        return view('landingpage.index', compact('produks', 'carousels', 'categories'));
    }
}
