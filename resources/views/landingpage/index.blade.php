@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Carousel -->
            <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($carousels as $index => $carousel)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" @if($index == 0) class="active" @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($carousels as $index => $carousel)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <img src="{{ asset('images/' . $carousel->nama_carousel) }}" class="d-block w-100" alt="{{ $carousel->nama_carousel }}" style="max-height: 300px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <h1 class="text-center mb-4">Produk</h1>

            <!-- Category Buttons -->
            <div class="card mb-4">
                <div class="card-body">
                    @foreach($categories as $category)
                        <a href="{{ route('landingpage.kategori', $category->id_kategori) }}" class="btn btn-secondary m-1">{{ $category->nama_kategori }}</a>
                    @endforeach
                </div>
            </div>

            <form action="{{ route('landingpage.search') }}" method="POST" class="mb-4">
                @csrf
                @method('POST')
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari produk...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <div class="row">
                @forelse($produks as $produk)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text">{{ $produk->deskripsi }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('landingpage.show', $produk->id_produk) }}" class="btn btn-primary btn-sm btn-block">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                        Produk tidak ditemukan.
                    </div>
                </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $produks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
