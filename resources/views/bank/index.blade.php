@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Bank</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2',true)

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <a href="/bank/create" class="btn btn-primary mb-2">Tambah Bank</a>
                    <table class="table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Bank</th>
                            <th scope="col">No Rek</th>
                            <th scope="col">Atas Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img style="width: 100%;object-fit:contain; height: 100px;" src="{{asset('storage/'.$row->gambar)}}" alt="gambar" class="img-thumbnail"></td>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->norek}}</td>
                                <td>{{$row->atasnama}}</td>
                                <td>
                                    <a href="/bank/{{$row->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <button data-id="{{$row->id}}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#table').dataTable();

        $(document).on('click','.btn-delete',function (){
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Untuk hapus pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/bank/'+id,
                        method:'delete',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success(data){
                            if(data.status){
                                Swal.fire(
                                    '',
                                    data.msg,
                                    'success'
                                )
                                setTimeout(() => {
                                    window.location.href = '/bank';
                                },1000)
                            }else{
                                Swal.fire(
                                    '',
                                    data.msg,
                                    'warning'
                                )
                            }
                        }
                    });
                }
            })
        });
    </script>
@stop
