<?php
// app/Http/Controllers/CarouselController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;

class CarouselController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $carousels = Carousel::all();
        return view('carousel.index', compact('carousels'));
    }

    public function create()
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        return view('carousel.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Memastikan file yang diunggah adalah gambar dengan format yang diizinkan dan ukuran maksimum 2MB
        ]);
    
        // Mengambil file gambar dari request
        $gambar = $request->file('gambar');
    
        // Membuat nama unik untuk gambar dengan menggunakan timestamp
        $nama_gambar = time() . '.' . $gambar->extension();
    
        // Menyimpan gambar ke direktori public/storage/images/
        $gambar->move(public_path('images'), $nama_gambar);
    
        // Membuat entri baru dalam database untuk Carousel
        Carousel::create([
            'nama_carousel' => $nama_gambar,
        ]);
    
        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil ditambahkan');
    }
    

    public function show($id)
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $carousel = Carousel::findOrFail($id);
        return view('carousel.show', compact('carousel'));
    }

    public function edit($id)
    {
        if(Auth::user()->role == 'user'){
            return redirect('/landing');
        }
        $carousel = Carousel::findOrFail($id);
        return view('carousel.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        // Menyimpan gambar baru
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->extension();
            $gambar->move(public_path('images'), $nama_gambar);
            $carousel->nama_carousel = $nama_gambar;
        }

        $carousel->save();

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        $carousel->delete();

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil dihapus');
    }
}
