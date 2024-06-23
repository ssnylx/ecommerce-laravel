@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <img src="{{ asset('images/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $produk->nama }}</h5>
                    <p class="card-text">{{ $produk->deskripsi }}</p>
                    <p class="card-text">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="card-text">Stok: {{ $produk->stok }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
