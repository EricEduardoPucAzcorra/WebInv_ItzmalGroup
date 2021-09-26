<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inv_GroupItzmal</title>

    <link rel="shortcut icon" href="{{asset('images/corte.ico')}}">

    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
          .password-icon {
        float: right;
        position: relative;
        margin: -30px 20px 0 0;
        cursor: pointer;

        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <br><br><br><br>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center">
                                
                                <img src="{{asset('images/img.png')}}" style="margin-left: 10%;" width="100%" height="100%">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido Inicia session!</h1>
                                    </div>
                                    <form class="user" method="post" action="{{route('login')}}">
                                        {{-- agregamos el token --}}

                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter user..." name="username">
                                        </div>
                                        <div class="form-group">
                                            <!-- <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password"> -->

                                                <input type="password" name="password" class="form-control password1 form-control-user "  placeholder="Password" />
                                                <span class="fa fa-fw fa-eye password-icon show-password"></span>
                                       

                                        </div>
                                     
                                                   {!! $errors->first('Credenciales', '<div class="alert alert-danger" >:message</div>')!!}
       
                                    
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Acceder
                                        </button>
                                        <hr>
                                       
                                    </form>
                                  
                                    <div class="text-center" >
                                        <p class="small" href="forgot-password.html">Al iniciar seras admitido en el sistema de inventarios de:</p>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="https://grupoizamal.com/">ItmalGroup</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="template/js/sb-admin-2.min.js"></script>

    <!-- //icon mostrar contraseña -->

    <script type="text/javascript">
        
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.password1');
                password2 = document.querySelector('.password2');

                if ( password1.type === "text" ) {
                    password1.type = "password"
                    password2.type = "password"
                    showPassword.classList.remove('fa-eye-slash');
                } else {
                    password1.type = "text"
                    password2.type = "text"
                    showPassword.classList.toggle("fa-eye-slash");
                }

            })

        });


    </script>

</body>

</html>