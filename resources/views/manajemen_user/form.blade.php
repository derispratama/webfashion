@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
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
                    <form action="{{isset($data) ? '/users/'.$data->id : '/users'}}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @if(isset($data))
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="silahkan isi.." value="{{isset($data) ? $data->name : old('name')}}">
                            @error('name')
                            <span class="text-danger" id="name_error">{{$message}}</span>
                            @enderror
                        </div><div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="silahkan isi.." value="{{isset($data) ? $data->email : old('email')}}">
                            @error('email')
                            <span class="text-danger" id="email_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="silahkan isi.." value="{{old('password')}}">
                            @error('password')
                            <span class="text-danger" id="password_error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="silahkan isi.." value="{{old('cpassword')}}">
                            @error('cpassword')
                            <span class="text-danger" id="cpassword_error">{{$message}}</span>
                            @enderror
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

