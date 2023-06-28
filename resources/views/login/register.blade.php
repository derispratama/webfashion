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
        body{
            background-image: url("{{asset('assets/football.webp')}}");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-box{
            border-radius: 5px;
        }

        .login-img{
            flex: 2;
        }

        .login-form{
            flex: 1;
        }
    </style>
</head>
<body>
<div class="d-flex w-100">
    <div class="login-box d-flex w-100 vh-100 bg-light">
        <div class="login-img">
            <img src="{{asset('assets/football.webp')}}" alt="" class="w-100 h-100">
        </div>
        <div class="login-form d-flex justify-content-center align-items-center w-full">
            <div class="w-100 p-5">
                <h1 class="text-center mb-5"><span style="font-weight: bold">Jersi</span>Pedia</h1>
                <form action="">
                    <h5 style="font-weight: bold">Register</h5>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        <input type="password" class="form-control" placeholder="Nama Lengkap" autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-at"></i></span>
                        <input type="text" class="form-control" placeholder="example@gmail.com" autocomplete="off" autofocus aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="*****" autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Register</button>

                    <div class="d-flex justify-content-between">
                        <a href="/login">login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
