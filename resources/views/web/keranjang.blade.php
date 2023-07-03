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
                @php
                    $total = 0;
                @endphp
                @foreach($data as $key => $row)
                    @php
                        $total+= intval($row->harga) * intval($row->qty);
                    @endphp
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
                <tr>
                    <th colspan="5" style="text-align: right">Total Bayar :</th>
                    <th colspan="2" class="text-right">Rp.{{$total}}</th>
                </tr>
                <tr>
                    <th colspan="7" style="text-align: right"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-chevron-right"></i> Checkout</button></th>
                </tr>
            @endif
            </tbody>
        </table>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/checkout" method="post" id="form" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nohp">No Hp</label>
                        <input type="text" name="nohp" class="form-control" id="nohp" placeholder="silahkan isi.." value="{{old('nohp')}}">
                        @error('nohp')
                            <span class="text-danger" id="nohp_error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{old('alamat')}}</textarea>
                        @error('alamat')
                        <span class="text-danger" id="alamat_error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="idbank">Transfer ke Bank</label>
                        <select name="idbank" id="idbank" class="form-control">
                            <option value="">Pilih Bank</option>
                            @foreach($bank as $row)
                                <option value="{{$row->id}}">{{$row->nama.' - '.$row->norek}} <span>({{$row->atasnama}})</span></option>
                            @endforeach
                        </select>
                        @error('idbank')
                        <span class="text-danger" id="idbank_error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="bukti_transfer">Upload Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" class="form-control" id="bukti_transfer" placeholder="silahkan isi.." value="{{old('bukti_transfer')}}">
                        @error('bukti_transfer')
                            <span class="text-danger" id="bukti_transfer_error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#btn-submit').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Untuk tambah data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambahkan!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    });
</script>
@endsection

