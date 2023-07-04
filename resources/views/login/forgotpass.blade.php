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
                <form action="/update_pass" method="post" id="form">
                    @csrf
                    @method('post')
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 style="font-weight: bold">Forgot Password</h5>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-at"></i></span>
                            <input type="text" class="form-control" name="email" value="{{@old('email')}}" placeholder="example@gmail.com" autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        @error('email')
                        <span class="text-danger" id="email_error">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" id="btn-submit" class="btn btn-secondary w-100">Submit</button>
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
<script>
    $('#btn-submit').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Untuk update password?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    });
</script>
</body>
</html>
