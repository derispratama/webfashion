@extends('layouts_web.app')
@section('container')
<div class="container">
    <section id="bestproduk" class="mt-5">
                <form action="{{$id_liga == '' ? '/jersey' : '/jersey/'.$id_liga }}" method="get">
                    @csrf
                    @method('get')
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 style="font-weight: bold">List Jersey - All</h5>
                            <div class="input-group mb-3 w-25">
                                    <input type="text" autofocus autocomplete="off" name="search_jersey" class="form-control" placeholder="Search...">
                                    <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                            </div>
                    </div>
                </form>

        <div class="row">
            @if(count($produk) <= 0)
                <h1 class="text-center">Jersey tidak ditemukan</h1>
            @else
                @foreach($produk as $p)
                    <div class="col-3">
                        <div class="card mt-3">
                            <div class="card-body card-produk">
                                <img src="{{ asset('storage/'.$p->gambar) }}" class="img-fluid img-produk">
                                <span class="nama-produk">{{$p->nama}}</span>
                                <span class="harga-produk">Rp. {{$p->nama}}</span>
                                <a href="/jersey/detail/{{$p->id}}" class="btn btn-secondary btn-sm w-100 mt-2"><i class="fa fa-eye"></i> Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</div>
@endsection
