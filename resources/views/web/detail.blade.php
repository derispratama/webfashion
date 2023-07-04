@extends('layouts_web.app')
@section('container')
<div class="container">
    <section id="bestproduk" class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h5 style="font-weight: bold">Detail Jersey</h5>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div class="foto-produk">
                    <img src="{{ asset('storage/'.$produk->gambar) }}" class="img-fluid img-produk" style="height: 500px">
                </div>
            </div>
            <div class="col-6">
                <h2 style="font-weight: bold">{{$produk->nama}}</h2>
                <div class="d-flex">
                    <h5>Rp. {{$produk->harga}}</h5>
                    @if($produk->stok <= 0)
                        <h5 class="badge bg-danger" style="margin-left: 10px">Stok Habis</h5>
                    @else
                        <h5 class="badge bg-success" style="margin-left: 10px">Stok {{$produk->stok}}</h5>
                    @endif
                </div>

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/keranjang" method="post" id="form">
                    @csrf
                    @method('post')
                    <input type="hidden" name="id_produk" id="id_produk" value="{{$produk->id}}" readonly>
                    <table class="table mt-3 w-75">
                        <tr>
                            <td style="width: 10px;">Liga</td>
                            <td>:</td>
                            <td><img src="{{ asset('storage/'.$produk->gambar_liga) }}" class="img-fluid img-produk" style="width: 50px"></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>
                                <input name="qty" id="qty" type="number" class="form-control">
                                @error('qty')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </td>
                        </tr>
                    </table>
                    @if($produk->stok > 0)
                        <button type="submit" id="btn-submit" class="btn btn-secondary w-75"><i class="fa fa-cart-arrow-down"></i> Check Out</button>
                    @endif
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    $('#btn-submit').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Untuk menambahkan produk ini ke keranjang?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambahkan!'
        }).then((result) => {
            if(result.value){
                form.submit();
            }
        })
    });
</script>
@endsection
