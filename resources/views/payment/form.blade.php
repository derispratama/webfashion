@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Form Edit Pembayaran</h1>
@stop
@section('plugins.Sweetalert2',true)
@section('content')
    <div class="row">
        <div class="col-6">
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{isset($data) ? '/payment/'.$data->id : '/payment'}}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="silahkan isi.." value="{{isset($data) ? $data->name : old('name')}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="silahkan isi.." value="{{isset($data) ? $data->email : old('email')}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nohp">No Hp</label>
                            <input type="text" name="nohp" class="form-control" id="nohp" placeholder="silahkan isi.." value="{{isset($data) ? $data->nohp : old('nohp')}}">
                            @error('nohp')
                            <span class="text-danger" id="nohp_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat" placeholder="silahkan isi.." rows="10" cols="10">{{isset($data) ? $data->alamat : old('alamat')}}</textarea>
                            @error('alamat')
                            <span class="text-danger" id="alamat_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bukti_transfer">Bukti Transfer</label>

                            <img src="{{isset($data) ? asset('storage/'.$data->bukti_transfer) : ''}}" id="img_bukti_transfer" class="mb-3 img-thumbnail {{isset($data) ? '' : 'd-none'}}" style="width: 200px; height: 200px;">

                            <input type="file" name="bukti_transfer" class="form-control" id="bukti_transfer">
                            <small> * File Upload yang diperbolehkan berektensi JPG,JPEG,PNG,webp</small><br>
                            <small> * Maksimal Upload 2MB</small><br>
                            <span class="text-danger" id="bukti_transfer_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right" id="btn-submit">Save <i class="fa fa-save"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
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
@stop

