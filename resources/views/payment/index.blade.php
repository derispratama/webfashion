@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Payment</h1>
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
                    <table class="table table-bordered" id="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Resi</th>
                            <th scope="col">Bukti Transfer</th>
                            <th scope="col">Detail User</th>
                            <th scope="col">Detail Produk</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->noresi}}</td>
                                <td><a href="{{asset('storage/'.$row->bukti_transfer)}}"><img style="width: 100%;object-fit:contain; height: 100px;" src="{{asset('storage/'.$row->bukti_transfer)}}" alt="bukti_transfer" class="img-thumbnail"></a></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>Nama : {{$row->name}}</span>
                                        <span>Email : {{$row->email}}</span>
                                        <span>No Hp : {{$row->nohp}}</span>
                                        <span>Alamat : {{$row->alamat}}</span>
                                    </div>
                                </td>
                                <td><button class="btn btn-primary btn-sm btn-detail-produk" data-id="{{$row->id}}" data-toggle="modal" data-target="#exampleModal">Detail Produk</button></td>
                                @if($row->status == 1)
                                    <td><span class="badge badge-success">Lunas</span></td>
                                @else
                                    <td><span class="badge badge-danger">Belum Lunas</span></td>
                                @endif
                                <td>{{$row->tglbayar}}</td>
                                <td>
                                    @if($row->status == 0)
                                        <a href="/payment/{{$row->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <button data-id="{{$row->id}}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                                    @endif
                                    <button data-id="{{$row->id}}" data-status="{{$row->status}}" class="btn btn-info btn-sm btn-verifikasi">Verifikasi</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="table-produk">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Gambar</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="text-center">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $('#table').dataTable();

        $(document).on('click','.btn-detail-produk',function(){
           const id = $(this).data('id');
           $.ajax({
               url:'/payment/'+id,
               method:'get',
               processData: false,
               contentType: false,
               dataType: 'json',
               cache: false,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success(data){
                   $('#table-produk tbody').html(data.html);
               }
           });
        });

        $(document).on('click','.btn-verifikasi',function (){
            const id = $(this).data('id');
            const status = $(this).data('status');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Untuk verifikasi pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Verifikasi!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/payment/verifikasi',
                        method:'post',
                        data:{
                            id : id,
                            status : status,
                        },
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
                            }else{
                                Swal.fire(
                                    '',
                                    data.msg,
                                    'warning'
                                )
                            }

                            setTimeout(() => {
                                window.location.href = '/payment';
                            },1000)
                        }
                    });
                }
            })
        });

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
                        url:'/payment/'+id,
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
                            }else{
                                Swal.fire(
                                    '',
                                    data.msg,
                                    'warning'
                                )
                            }
                            setTimeout(() => {
                                window.location.href = '/payment';
                            },1000)
                        }
                    });
                }
            })
        });
    </script>
@stop
