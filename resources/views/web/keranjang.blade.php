@extends('layouts_web.app')
@section('container')
<div class="container">
    <section id="bestproduk" class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h5 style="font-weight: bold">Keranjang ({{$countKeranjang}})</h5>
        </div>

        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Gambar</th>
                <th scope="col" class="text-center">Keterangan</th>
                <th scope="col" class="text-center">Jumlah</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Total Harga</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(count($data) <= 0)
                <tr>
                    <th colspan="6" class="text-center">Data tidak ditemukan</th>
                </tr>
            @else
                @foreach($data as $key => $row)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/jersey/acmilan.png') }}" class="img-fluid img-produk w-25">
                        </td>
                        <td class="text-center">{{$row->nama}}</td>
                        <td class="text-center">{{$row->qty}}</td>
                        <td class="text-center">Rp. {{$row->harga}}</td>
                        <td class="text-center">Rp. {{intval($row->harga) * intval($row->qty)}}</td>
                        <td><button data-id="{{$row->id_keranjang}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </section>
</div>
@endsection
