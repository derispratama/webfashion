@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Form Bank</h1>
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
                    <form action="{{isset($data) ? '/bank/'.$data->id : '/bank'}}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @if(isset($data))
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">

                        <div class="form-group">
                            <label for="nama">Nama Bank</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="silahkan isi.." value="{{isset($data) ? $data->nama : old('nama')}}">
                            @error('nama')
                                <span class="text-danger" id="nama_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="norek">Norek</label>
                            <input type="text" name="norek" class="form-control" id="norek" placeholder="silahkan isi.." value="{{isset($data) ? $data->norek : old('norek')}}">
                            @error('norek')
                            <span class="text-danger" id="norek_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="atasnama">Atas Nama</label>
                            <input type="text" name="atasnama" class="form-control" id="atasnama" placeholder="silahkan isi.." value="{{isset($data) ? $data->atasnama : old('atasnama')}}">
                            @error('atasnama')
                            <span class="text-danger" id="atasnama_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Image</label>

                            <img src="{{isset($data) ? asset('storage/'.$data->gambar) : ''}}" id="img_gambar" class="mb-3 img-thumbnail {{isset($data) ? '' : 'd-none'}}" style="width: 200px; height: 200px;">

                            <input type="file" name="gambar" class="form-control" id="gambar">
                            <small> * File Upload yang diperbolehkan berektensi JPG,JPEG,PNG,webp</small><br>
                            <small> * Maksimal Upload 2MB</small><br>
                            <span class="text-danger" id="gambar_error"></span>
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

