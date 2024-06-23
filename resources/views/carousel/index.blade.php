@extends('adminlte.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Carousel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Carousel</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Carousel</h3>
                            <div class="card-tools">
                                <a href="{{ route('carousel.create') }}" class="btn btn-primary">Tambah Carousel</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Carousel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carousels as $carousel)
                                    <tr>
                                        <td>{{ $carousel->id_carousel }}</td>
                                        <td>@if($carousel->nama_carousel)
                                            <img src="{{ asset('images/'.$carousel->nama_carousel) }}" alt="Gambar carousel"
                                                style="width: 100px;">
                                            @else
                                            No Image
                                            @endif</td>
                                        <td>
                                            <a href="{{ route('carousel.edit', $carousel->id_carousel) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('carousel.destroy', $carousel->id_carousel) }}"
                                                method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
