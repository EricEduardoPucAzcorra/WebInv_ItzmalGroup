<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('images/corte.ico')}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- script para vue js javascript -->
    <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>

       <!-- Custom styles for this page -->
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">

  <!--   datePickerCss -->
    <link rel="stylesheet" type="text/css" href="{{asset('date/datepicker/css/bootstrap-datepicker.min.css')}}">
    <script type="text/javascript" src="{{asset('js/datepickerLeg.js')}}"></script>

<!--     highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
 <!--    chart js  -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.js" integrity="sha512-a+uzkcbI/MyXYDayp12Y28mqzeAlzdKZRaJfhpyU8326w+oGqfqA3B73CMNl77D0N11FLOe8ZeHURAf6mnO8Jg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--  css del buscador -->

<link rel="stylesheet" type="text/css" href="{{asset('css/buscador.css')}}">

<script  src="{{asset('js/jquery.dataTables.min.js')}}"></script>


<!-- token -->
  <meta name="token" id="token" value="{{ csrf_token() }}">
  <!-- despues en cada archivo javascript debemos definir los codigos correspondientes para leer el token -->

 <!--  para ocultar cache de vue js -->
   <style type="text/css">
            [v-cloak] > * { display:none; }
            [v-cloak]::before { content: "Cargando interfaz..."; }
    </style>

  <!--   para los iconos de password -->

    <style type="text/css">
          .password-icon {
        float: right;
        position: relative;
        margin: -30px 20px 0 0;
        cursor: pointer;

        }
    </style>
 
</head>

<body id="page-top" onload="mostrarSaludo()"  >

   
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- menu -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('index')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <img class="rounded-circle" src="{{asset('images/corte.ico')}}" width="50px" height="50px">
                </div>
                <div class="sidebar-brand-text mx-3">Itzmal<sup>Group</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{url('index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Recursos materiales
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Almacenes</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ajustes de almacenes</h6>
                        <a class="collapse-item" href="{{route('almacens_productos')}}">Almacenes de productos</a>
                        <a class="collapse-item" href="{{route('almacens_huepedes')}}">Almacenes R. huespedes</a>
                        <a class="collapse-item" href="{{route('almacens_Departamentales')}}">Almacenes R. blancos</a>
                         <a class="collapse-item" href="{{route('almacens_lavanderia')}}">Almacenes R. lavanderia</a>
                    </div>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link" href="{{route('categorias')}}">
                    <i class="fas fa-list-ol"></i>
                    <span>Categorias</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-cart-plus"></i>
                    <span>Recursos empresarial</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Material en almacenes</h6>
                        <a class="collapse-item" href="{{route('productos')}}">Productos</a>
                        <a class="collapse-item" href="{{route('recursosHuesped')}}">Recursos de huespedes</a>
                        <a class="collapse-item" href="{{route('recursosBlancos')}}">Recursos blancos</a>
                        <a class="collapse-item" href="{{route('recursosLavanderia')}}">Recursos de lavanderia</a>
                    </div>
                </div>
            </li>


            <!-- Heading -->
            <div class="sidebar-heading">
                Operaciones
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Inventarios</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventario de recursos</h6>
                        <a class="collapse-item" href="{{route('inv_products')}}">Inv-productos</a>
                        <a class="collapse-item" href="{{route('inv_R_Huesped')}}">Inv-Recursos Huespedes</a>
                        <a class="collapse-item" href="{{route('inv_R_Blancos')}}">Inv-Recursos Blancos</a>
                        <a class="collapse-item" href="{{route('inv_R_lavanderia')}}">Inv-Recursos Lavanderia</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{asset('pdf/Manual_WebInvItzmalGroup.pdf')}}">
                    <!-- <i class="fas fa-tasks"></i> -->
                    <i class="fas fa-file-pdf"></i>
                    <span>Acerca de</span></a>
            </li>

         

             <!-- Heading -->
            <div class="sidebar-heading">
                Ajustes Usuario
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('perfil/'.Auth::user()->id)}}">
                   <i class="fas fa-user"></i>
                    <span>Perfil</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('Email/create')}}">
                   <i class="fas fa-envelope-square"></i>
                    <span>Enviar reporte</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

 
        </ul>
        <!-- End of menu -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- nav superior -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar Sitio"
                                aria-label="Search" aria-describedby="basic-addon2" id="input-search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                         <!-- Emails -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="{{route('Email/create')}}" id="messagesDropdown" role="button"
                               >
                                <i class="fas fa-envelope fa-fw"></i>
                            
                            </a>
                        
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                       <!--  puedo implemenetar un php dentro de la vista para capturar valoress -->

                         @php

                           $iduser= Auth::user()->id;

                           $usuario= App\Models\User::find($iduser);

                         @endphp


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                                @if(Auth::user()->avatar=""){
                                    <img class="img-profile rounded-circle"
                                    src="{{asset('template/img/undraw_profile.svg')}}">
                                @else
                                    <img class="img-profile rounded-circle"
                                    src="{{Storage::url($usuario->avatar)}}">
                                @endif
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" 
                                href="{{url('perfil/'.Auth::user()->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                               <!--  <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>




                </nav>
                <!-- End of nav superior -->



                <!-- contenido -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <p class="h3 mb-0 " style="font-size: 22px;">@yield('title')</p>
                   <!--      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                   <!--  <p>{{asset('Storage::u')}}</p> -->
<!--     buscador interno -->         
     <div class="content-search">
        <div class="content-table">
                <table id="table">
                    <thead>
                        <tr>
                            <td></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            <td style=""><a href="{{route('productos')}}" class="a" >Productos</a></td>
                        </tr>
                        
                        <tr>
                            <td><a href="{{route('recursosHuesped')}}" class="a">Recursos Huespedes</a></td>
                        </tr>
                        
                        <tr>
                            <td><a href="{{route('recursosBlancos')}}" class="a">Recursos Blancos</a></td>
                        </tr>
                        
                        <tr>
                            <td><a href="{{route('recursosLavanderia')}}" class="a">Recursos Lavanderia</a></td>
                        </tr>

                        <tr>
                            <td><a href="{{route('almacens_productos')}}" class="a">Almacen Productos</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('almacens_huepedes')}}" class="a">Almacen Huespedes</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('almacens_Departamentales')}}" class="a">Almacen Blancos</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('almacens_lavanderia')}}" class="a">Almacen Lavanderia</a></td>
                        </tr>


                        <tr>
                            <td><a href="{{route('categorias')}}" class="a">Categorias</a></td>
                        </tr>

                        <tr>
                            <td><a href="{{route('inv_products')}}" class="a">Inventario Productos</a></td>
                        </tr>

                        <tr>
                            <td><a href="{{route('inv_R_Huesped')}}" class="a">Inventario R_Huespedes</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('inv_R_Blancos')}}" class="a">Inventario R_Blancos</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('inv_R_lavanderia')}}" class="a">Inventario R_Lavanderia</a></td>
                        </tr>
                         
                         <tr>
                            <td><a href="{{url('manual')}}" class="a">Acerca de..</a></td>
                        </tr>

                        <tr>
                            <td><a href="{{url('perfil/'.Auth::user()->id)}}" class="a">Perfil</a></td>
                        </tr>

                        <tr>
                            <td><a href="{{url('index')}}" class="a">Dashboard</a></td>
                        </tr>
                         
                         <tr>
                            <td><a href="{{url('Email/create')}}" class="a">Mensajes</a></td>
                        </tr>
                         
                         <tr>
                            <td><a href="{{url('Email-history')}}" class="a">Lista de mensajes</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
                    

                    @yield('contenido')


                </div>
                <!-- / fin del contenido-->



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Grúpo Izamal 2021 <a href="https://grupoizamal.com/">Visitanos!</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal para cerrar session-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ Auth::user()->name }} Estas seguro que quieres salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                
                   <!--  <i class="fas fa-info"></i> -->

                   <center><img src="{{asset('images/informacion.png')}}" width="20%" height="20%;"></center>
                   <br>
                <center>Seleccione "Salir" si desea cerrar el sistema</center>

                </div>
                <div class="modal-footer">


                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('salir')}}" method="POST">  
                        @csrf
                        <button  class="btn btn-primary" type="submit">
                        Salir
                        </button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <!-- stack que permite incriptar script en diferentes vistas para js -->
    @stack('js')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>

    <script src="{{asset('template/js/demo/chart-pie-demo.js')}}"></script>

        <!-- Page level plugins -->
    <script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

       <!-- Page level custom scripts -->
    <script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>

<!--     datePicker js -->
    <script type="text/javascript" src="{{asset('date/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
        $('.Piker').datepicker({
            format: "yyyy-mm-dd"
        });
    </script>

    <!-- bs-custom-file-input -->
    <script src="{{asset('template/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    </script>

    <!-- SALUDOOO -->
    <script type="text/javascript">
      
      function mostrarSaludo(){
     
      fecha = new Date(); 
      hora = fecha.getHours();
     
      if(hora >= 0 && hora < 12){
        texto = "Buenos Días";
        imagen = "{{asset('images/sol.png')}}";
      }
     
      if(hora >= 12 && hora < 18){
        texto = "Buenas Tardes";
        imagen = "{{asset('images/sol.png')}}";
      }
     
      if(hora >= 18 && hora < 24){
        texto = "Buenas Noches";
        imagen = "{{asset('images/luna.png')}}";
      }
     
      document.images["tiempo"].src = imagen;
     
      document.getElementById('txtsaludo').innerHTML = texto;
     
    }

    </script>

<!--  datepicker -->

    <script type="text/javascript">
    $('.js-date').datepicker({
      'language' : 'es',
      format: "yyyy-mm-dd"
    });

    $('.js-date_o').datepicker({
      format: "yyyy-mm-dd"
    });


    </script>

<!--    fin de datepicker -->

      <script type="text/javascript">
        
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.password1');
                password2 = document.querySelector('.password2');
                password3 = document.querySelector('.password3');

                if ( password1.type === "text" ) {
                    password1.type = "password"
                    password2.type = "password"
                    password3.type = "password"
                    showPassword.classList.remove('fa-eye-slash');
                } else {
                    password1.type = "text"
                    password2.type = "text"
                     password3.type = "text"
                    showPassword.classList.toggle("fa-eye-slash");
                }

            })

        });


    </script>
   

    <script  src="{{asset('js/buscador.js')}}"></script>

</body>

</html>