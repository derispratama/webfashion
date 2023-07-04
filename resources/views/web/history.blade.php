@extends('layouts_web.app')
@section('container')
    <div class="container">
        <section id="bestproduk" class="mt-5">
            <div class="card mb-5 bg-success">
                <div class="card-body text-white">
                    <strong>Silahkan Hubungi Ke Nomor Whatsapp <a href=" https://wa.me/6282115422441" target="_blank" class="text-white">082115422441</a></strong><br>
                    <strong>Customer Service Kami untuk Informasi Lebih Lanjut</strong>
                </div>
            </div>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Resi</th>
                    <th scope="col">Bukti Transfer</th>
                    <th scope="col">Detail User</th>
                    <th scope="col">Detail Produk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Bayar</th>
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
                        <td><button class="btn btn-primary btn-sm btn-detail-produk" data-id="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail Produk</button></td>
                        @if($row->status == 1)
                            <td><span class="badge bg-success">Lunas</span></td>
                        @else
                            <td><span class="badge bg-danger">Belum Lunas</span></td>
                        @endif
                        <td>{{$row->tglbayar}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <script>
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

