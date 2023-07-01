<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>JersiPedia</title>

    <style>
        .card-liga{
            box-shadow: 1px 3px 10px 1px #dddddd;
            border-radius: 10px;
        }

        .img-liga{
            height: 120px
        }

        .card-produk{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .nama-produk{
            font-weight: bold;
        }

        .foto-produk{
            background-color: #dddddd;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
{{--navbar--}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><span style="font-weight: bolder">Jersi</span>Pedia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/jersey">Jersey</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/keranjang">Keranjang <i class="fa fa-cart-plus"></i> <span class="badge bg-danger">5</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cristiano Ronaldo
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">History</a></li>
                        <li><a class="dropdown-item" href="/login">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
{{--navbar--}}

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
                <h5>Rp. {{$produk->harga}}</h5>

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
                    <button type="submit" id="btn-submit" class="btn btn-secondary w-75"><i class="fa fa-cart-arrow-down"></i> Check Out</button>
                </form>
            </div>
        </div>
    </section>
</div>

<footer class="mt-5 bg-light w-100" style="height: 50px;bottom: 0;position: fixed;">
    <div class="d-flex h-100 justify-content-center align-items-center">
        <div class="text-dark">Copyright @2023 - Tugas UAS</div>
    </div>
</footer>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
