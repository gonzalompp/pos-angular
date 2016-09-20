<!DOCTYPE html>
<html lang="es" ng-app="store">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <title>Index - Mi aplicación ASP.NET MVC</title>
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />
        <link href="{{ URL::asset('Recursos/AdminLTE-2.3.0/bootstrap/css/bootstrap.css') }}" rel="stylesheet"/>

        <link href="{{ URL::asset('Recursos/IonicIcons/ionicons.css') }}" rel="stylesheet"/>

        <link href="{{ URL::asset('Recursos/FontAwesome/css/font-awesome.css') }}" rel="stylesheet"/>


        <!-- TEMA BOOTSTRAP -->
        <link href="{{ URL::asset('Recursos/AdminLTE-2.3.0/dist/css/AdminLTE.css') }}" rel="stylesheet"/>

        <link href="{{ URL::asset('Recursos/AdminLTE-2.3.0/dist/css/skins/_all-skins.css') }}" rel="stylesheet"/>
        
        <style>
            [ng-click],
            [data-ng-click],
            [x-ng-click] {
                cursor: pointer;
            }
        </style>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="Recursos/IE9HACK/html5shiv.min.js"></script>
        <script src="Recursos/IE9HACK/respond.min.js"></script>
    <![endif]-->
    </head>


<body class="hold-transition skin-green layout-top-nav"  onload="window.print()">
    <!-- JS ANGULAR -->

    <div class="wrapper">

    <!-- CONTENIDO INICIO -->
    <div class="content-wrapper" style="min-height: 323px; background-color: white;">
        <div class="container-fluid">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                {{$nombre_empresa}}
                <small class="pull-right">Fecha: {{ date('d/m/Y', strtotime($fecha_pedido)) }}</small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row">
            <div class="col-xs-12">
              <address>
                <strong>{{$nombre_local}}</strong><br>
                {{$direccion}}<br>
                Teléfono: {{$telefono}}<br>
                Email: {{$email}}
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->
          


          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-bordered table-hover dataTable">
                      <thead>
                          <tr>
                              <th>
                                  Producto
                              </th>
                              <th >
                                  $ Unitario
                              </th>
                              <th >
                                  Cantidad
                              </th>
                              <th >
                                  Total
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          
                          @foreach ($items as $item)
                          <tr>
                              <td >
                                {{ $item->nombre_producto }}
                              </td>
                              <td >
                                ${{ number_format($item->precio_unitario,0) }}
                              </td>
                              <td>
                               
                               {{ $item->cantidad }}
                              </td>
                              <td >
                                ${{ number_format(($item->precio_unitario*$item->cantidad),0) }}
                              </td>
                          </tr>
                            
                          @endforeach
                          
                          <tr>
                              <td colspan="4" >
                                <b>Observaciones: </b> {{ $observaciones }}
                              </td>
                          </tr>
                          </tbody>
                  </table>
                  
                  <div>
                <table class="table tabla-totales">
                  <tbody><tr>
                    <th>Subtotal:</th>
                    <td class="ng-binding">${{ number_format($subtotal,0) }}</td>
                  </tr>
                  <tr>
                    <th>Propina sugerida (10%)</th>
                    <td class="ng-binding">${{ number_format($propina,0) }}</td>
                  </tr>
                  <tr>
                    <th>Total con propina:</th>
                    <td class="ng-binding">${{ number_format($total,0) }}</td>
                  </tr>
                </tbody></table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->



        </div>
    </div>
    <!-- CONTENIDO FIN -->


    </div>
    <!-- JS JQUERY -->
    <script src="{{ URL::asset('Recursos/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.js') }}"></script>

    <!-- JS BOOTSTRAP -->
    <script src="{{ URL::asset('Recursos/AdminLTE-2.3.0/bootstrap/js/bootstrap.js') }}"></script>

    <!-- JS SLIMSCROLL -->
    <script src="{{ URL::asset('Recursos/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.js') }}"></script>

    <!-- JS FastClick -->
    <script src="{{ URL::asset('Recursos/AdminLTE-2.3.0/plugins/fastclick/fastclick.js') }}"></script>


    <!-- JS BOOTSTRAP THEME -->
    <script src="{{ URL::asset('Recursos/AdminLTE-2.3.0/dist/js/app.js') }}"></script>


</body>
    </html>