@extends('layouts_web.app')
@section('container')
<div class="container">
    <section id="banner" class="mt-3">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="silder1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="slider2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="slider3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="liga" class="mt-5">
        <h5 style="font-weight: bold">Pilih Liga</h5>
        <div class="row">
            @foreach($liga as $l)
            <div class="col-3">
                <a href="/jersey/{{$l->id}}">
                    <div class="card card-liga">
                        <div class="card-body" style="display: flex; justify-content: center;align-items: center;">
                            <img src="{{ asset('storage/'.$l->gambar) }}" class="img-fluid img-liga">
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section id="bestproduk" class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h5 style="font-weight: bold">Best Produk</h5>
            <a href="/jersey" class="btn btn-secondary"> <i class="fa fa-eye"></i> Lihat Semua</a>
        </div>

        <div class="row">
            @foreach($produk as $p)
            <div class="col-3">
                <div class="card mt-3">
                    <div class="card-body card-produk">
                        <img src="{{ asset('storage/'.$p->gambar) }}" class="img-fluid img-produk">
                        <span class="nama-produk" style="font-size: 14px">{{$p->nama}}</span>
                        <div>
                            <span class="harga-produk">Rp. {{$p->harga}}</span>
                            @if($p->stok <= 0)
                                <span class="badge bg-danger">Stok Habis</span>
                            @else
                                <span class="badge bg-success">Stok {{$p->stok}}</span>
                            @endif
                        </div>
                        <a href="/jersey/detail/{{$p->id}}" class="btn btn-secondary btn-sm w-100 mt-2"><i class="fa fa-eye"></i> Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
