@extends('sistema.layout.index')

@section('title', 'Dashboard')

@section('contenido')


                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bienvenido al sistema</div>

                                                <tt>
                                                    <img name="tiempo" width="25px" height="25px"> 
     
                                                    <tt id="txtsaludo"></tt> <br>
                                                </tt>
                                               
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ Auth::user()->name }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                           <!--  <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Estado de recursos</div>
                                           <!--  <div class="h5 mb-0 font-weight-bold text-gray-800">Cant: 200

                                            </div> -->
                                            <tt>
                                                Productos: {{$catP}}
                                                <br>
                                                Blancos: {{$catRD}}
                                                <br>
                                                R_Huesped:{{$catRH}}
                                            </tt>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                                           <!--  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total de ventas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                               <!--  <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div> -->
                                                <tt>
                                                    Productos: {{$sumaVentaP}} <br>
                                                    R_Huesped: {{$sumaVentaRH}}

                                                </tt>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Horario</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            
                                            {{$fecha}}<br>
                                            {{$hora}}

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
<!-- 
                    <div class="row">

                        
                        <div class="col-12">
                          
                              
                                <div class="card-body">
                               
                                        
                                   <div id="grafica"></div>
                    
                                 
                                </div>
                           
                        </div>

                     
                    </div> -->


  <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ultimos inventarios productivos</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-body table-responsive p-0" style="height: 200px; ">
                                       <table class="table table-hover table-head-fixed text-nowrap">
                                           <thead>
                                               <tr>
                                                   <th>Fecha alta</th>
                                                   <th>Producto</th>
                                                   <th>C_I</th>
                                                   <th>E</th>
                                                   <th>S</th>
                                                   <th>V</th>
                                                   <th>T</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            @foreach($tablaInvP as $RinvP)
                                               <tr>
                                                   <td>{{$RinvP->fecha_alta}}</td>
                                                   <td>{{$RinvP->productos->nombre}}</td>
                                                   <td>{{$RinvP->cantidad_inicial}}</td>
                                                   <td>{{$RinvP->entrada}}</td>
                                                   <td>{{$RinvP->salida}}</td>
                                                   <td>{{$RinvP->venta}}</td>
                                                   <td><span class="badge badge-success ">{{$RinvP->total}}</span></td>
                                               </tr>
                                            @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ultimos inventarios de huespedes</h6>
                                </div>
                                <div class="card-body">
                                     <div class="card-body table-responsive p-0" style="height: 200px;">
                                       <table class="table table-hover table-head-fixed text-nowrap">
                                           <thead>
                                               <tr>
                                                   <th>Fecha alta</th>
                                                   <th>Producto</th>
                                                   <th>C_I</th>
                                                   <th>E</th>
                                                   <th>S</th>
                                                   <th>V</th>
                                                   <th>T</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tr>
                                                @foreach($tablaInvH as $invH)
                                                   <td>{{$invH->fecha_alta}}</td>
                                                   <td>{{$invH->recursos_h->nombre}}</td>
                                                   <td>{{$invH->cantidad_inicial}}</td>
                                                   <td>{{$invH->entrada}}</td>
                                                   <td>{{$invH->salida}}</td>
                                                   <td>{{$invH->venta}}</td>
                                                   <td><span class="badge badge-success ">{{$invH->total_disponible}}</span></td>
                                               </tr>
                                               @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                            </div>

                           

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ultimos inventarios de blancos</h6>
                                </div>
                                <div class="card-body">
                                      <div class="card-body table-responsive p-0" style="height: 200px;">
                                       <table class="table table-hover table-head-fixed text-nowrap">
                                           <thead>
                                               <tr>
                                                   <th>Fecha_alta</th>
                                                   <th>Recurso</th>
                                                   <th>C_I</th>
                                                   <th>E</th>
                                                   <th>S</th>
                                                   <th>D</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            @foreach($tablaInvB as $invB)
                                               <tr>
                                                   <td>{{$invB->fecha_alta}}</td>
                                                   <td>{{$invB->RecursosDep->nombre}}</td>
                                                   <td>{{$invB->cantidad_inicial}}</td>
                                                   <td>{{$invB->entrada}}</td>
                                                   <td>{{$invB->salida}}</td>
                                                   <td><span class="badge badge-success ">{{$invB->total_disponible}}</span></td>
                                               </tr>
                                               @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ultimos inventarios de lavanderia</h6>
                                </div>
                                <div class="card-body">
                                      <div class="card-body table-responsive p-0" style="height: 200px;">
                                       <table class="table table-hover table-head-fixed text-nowrap">
                                           <thead>
                                               <tr>
                                                   <th>Fecha alta</th>
                                                   <th>Producto</th>
                                                   <th>C_I</th>
                                                   <th>E</th>
                                                   <th>S</th>
                                                   <th>D</th>
                                                 <!--   <th>Total</th> -->
                                               </tr>
                                           </thead>
                                           <tbody>
                                            @foreach($tablaInvL as $invL)
                                               <tr>
                                                   <td>{{$invL->fecha_alta}}</td>
                                                   <td>{{$invL->recursosLav->nombre}}</td>
                                                   <td>{{$invL->cantidad_inicial}}</td>
                                                   <td>{{$invL->entrada}}</td>
                                                   <td>{{$invL->salida}}</td>
                                                   <td><span class="badge badge-success ">{{$invL->cat_disponible}}</span></td>
                                                   <!-- <td>15</td> -->
                                               </tr>
                                            @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                            </div>

                        </div>
                    </div>


@endsection


@push('js')


<script type="text/javascript">
    
    //code graficar

var GraficaInvP = <?php echo json_encode($GraficaInvP) ?>;


    Highcharts.chart('grafica', {
        //ttulo
        title:{
            text:'Inventario productos'
        },

        subtitle:{
            text:'Graficacion de inventarios durante el año'
        },

        xAxis:{
            categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
        },

        yAxis:{
            title:{
                text:'Nuevos registros'
            }
        },

        legend:{
            layout:'vertical',
            align:'center',
            verticalAlign:'middle'
        },

        plotOptions:{
            series:{
                allowPointSelect:true

                }
        },

        series:[{
        name:'Nuevos registros',
        data:GraficaInvP
        }],

        responsive:{
            rules:[
                {
                    condition:{
                          maxWidth:5,
                    },
                    chartOptions:{
                        legend:{
                            layout:'horizontal',
                            align:'center',
                            verticalAlign:'bottom'
                        }
                    }
                }
              
            ]
        },

    });



</script>



@endpush