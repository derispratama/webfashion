<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/jersey">Jersey</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/keranjang">Keranjang <i class="fa fa-cart-plus"></i> <span class="badge bg-danger">5</span></a>
                </li>
                @if(session()->get('name'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{session()->get('name')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">History</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
{{--navbar--}}

<div class="container">
    <section id="banner" class="mt-3">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="silder1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="slider2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/slider/slider1.png') }}" class="d-block w-100" alt="slider3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="liga" class="mt-5">
        <h5 style="font-weight: bold">Pilih Liga</h5>
        <div class="row">
            @foreach($liga as $l)
            <div class="col-3">
                <a href="/jersey/{{$l->id}}">
                    <div class="card card-liga">
                        <div class="card-body" style="display: flex; justify-content: center;align-items: center;">
                            <img src="{{ asset('storage/'.$l->gambar) }}" class="img-fluid img-liga">
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section id="bestproduk" class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h5 style="font-weight: bold">Best Produk</h5>
            <a href="/jersey" class="btn btn-secondary"> <i class="fa fa-eye"></i> Lihat Semua</a>
        </div>

        <div class="row">
            @foreach($produk as $p)
            <div class="col-3">
                <div class="card mt-3">
                    <div class="card-body card-produk">
                        <img src="{{ asset('storage/'.$p->gambar) }}" class="img-fluid img-produk">
                        <span class="nama-produk">{{$p->nama}}</span>
                        <span class="harga-produk">Rp. {{$p->harga}}</span>
                        <a href="/jersey/detail/{{$p->id}}" class="btn btn-secondary btn-sm w-100 mt-2"><i class="fa fa-eye"></i> Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<footer class="mt-5 bg-light w-100" style="height: 50px">
    <div class="d-flex h-100 justify-content-center align-items-center">
        <div class="text-dark">Copyright @2023 - Tugas UAS</div>
    </div>
</footer>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
