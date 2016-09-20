<!DOCTYPE html>
<html lang="es" ng-app="store">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <title>Index - Mi aplicación ASP.NET MVC</title>
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />
        <link href="Recursos/AdminLTE-2.3.0/bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <link href="Recursos/IonicIcons/ionicons.css" rel="stylesheet"/>

        <link href="Recursos/FontAwesome/css/font-awesome.css" rel="stylesheet"/>

        <!-- daterange picker -->
        <link rel="stylesheet" href="Recursos/AdminLTE-2.3.0/plugins/daterangepicker/daterangepicker-bs3.css">

        <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="Recursos/AdminLTE-2.3.0/plugins/timepicker/bootstrap-timepicker.min.css">
    
    <!-- Bootstrap date Picker -->
    <link rel="stylesheet" href="Recursos/AdminLTE-2.3.0/plugins/datepicker/datepicker3.css">

        <!-- TEMA BOOTSTRAP -->
        <link href="Recursos/AdminLTE-2.3.0/dist/css/AdminLTE.css" rel="stylesheet"/>

        <link href="Recursos/AdminLTE-2.3.0/dist/css/skins/_all-skins.css" rel="stylesheet"/>
        
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


<body class="hold-transition skin-green layout-top-nav">
    <!-- JS ANGULAR -->

    <div class="wrapper">

    <!-- CONTENIDO INICIO -->
    <div class="content-wrapper" style="min-height: 323px;">
        <div class="container-fluid">

            

<div ng-view="">
</div>


        </div>
    </div>
    <!-- CONTENIDO FIN -->


    </div>
    <!-- JS JQUERY -->
    <script src="Recursos/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.js"></script>

    <!-- JS BOOTSTRAP -->
    <script src="Recursos/AdminLTE-2.3.0/bootstrap/js/bootstrap.js"></script>

    <!-- JS SLIMSCROLL -->
    <script src="Recursos/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.js"></script>

    <!-- JS FastClick -->
    <script src="Recursos/AdminLTE-2.3.0/plugins/fastclick/fastclick.js"></script>


    <!-- JS BOOTSTRAP THEME -->
    <script src="Recursos/AdminLTE-2.3.0/dist/js/app.js"></script>


    <!-- ANGULAR -->
    <script src="Recursos/Angular/angular.js"></script>

    <script src="Recursos/Angular/angular-route.js"></script>


    <!-- angular app -->
    
    <script src="Recursos/AngularApp/app.js"></script>
    
    <!-- CONTROLLERS -->
    <script src="Recursos/AngularApp/Controllers/LocalController.js"></script>
    <script src="Recursos/AngularApp/Controllers/LoginController.js"></script>
    <script src="Recursos/AngularApp/Controllers/GarzonController.js"></script>
    <script src="Recursos/AngularApp/Controllers/MesasController.js"></script>
    <script src="Recursos/AngularApp/Controllers/PedidoController.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="Recursos/AdminLTE-2.3.0/plugins/daterangepicker/daterangepicker.js"></script>
    
    <!-- bootstrap time picker -->
    <script src="Recursos/AdminLTE-2.3.0/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    
    <!-- bootstrap datetime picker -->
    <script src="Recursos/AdminLTE-2.3.0/plugins/datepicker/bootstrap-datepicker.js"></script>
    



</body>
    </html>