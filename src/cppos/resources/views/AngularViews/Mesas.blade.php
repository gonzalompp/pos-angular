<style>
    .icono-mesa {
        font-size:70px;
        padding-top:-30px;
    }

   /* // 1: Mesa / 2: Retiro en local / 3: Despacho a domicilio */

    .pedido_tipo_mesa_vacia,
    .pedido_tipo_mesa,
    .pedido_tipo_retiro,
    .pedido_tipo_despacho
    {
        color: white;
    }

    .pedido_tipo_mesa_vacia {
        background-color: #B8DDC2;
    }

    .pedido_tipo_mesa {
        background-color: #00a65a;
    }

    .pedido_tipo_retiro {
        background-color: #0050A6;
    }

    .pedido_tipo_despacho {
        background-color: #EEBF00;
    }

    .footer-sec {
        text-align:center;
    }

    .btn-footer {
        height:50px;
        font-weight: bold;
        font-size:18px;
    }

</style>
<div ng-include src="'AngularViews/LayoutComponents/Header'"></div>

<div class="content">
    
    
<div ng-include src="'AngularViews/LayoutComponents/Menu'"></div>
    
<div class="row">
    <div class="col-md-12">
<div class="box box-default">
    <div class="box-header with-border">
                  <h2 class="box-title">Mesas</h2>
                </div>
    <div class="box-body">

<!-- href="#/pedido/@{{mesa.IdPedido}}/@{{mesa.IdMesa}}"-->
    <a ng-click="GoPedido(mesa.IdPedido,mesa.IdMesa)"  class="col-lg-2 col-xs-2 col-md-2" ng-repeat="mesa in mesas track by $index">

              <!-- small box -->
              <div class="small-box @{{mesa.TipoPedidoCssClass}}">
                <div class="inner">
                    <div class="row">
                        <h4 class="col-md-6"><b><i class="fa @{{ mesa.TipoPedidoIcono }}"></i> @{{ PedidoNombre(mesa) }}</b></h4>
                        <h4 class="col-md-6"><b class="pull-right">@{{ PedidoNombreDerecha(mesa) }}</b></h4>
                    </div>
                  
                  <p>@{{ PedidoSubNombre(mesa) }}</p>
                </div>
              </div>
            </a>



        </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-md-6 footer-sec">
                <button ng-click="NuevoDespacho()" class="btn col-md-12 btn-footer bg-grey">+ A DOMICILIO</button>
            </div>
            <div class="col-md-6 footer-sec">
                <button ng-click="NuevoRetiro()"  class="btn col-md-12 btn-footer bg-grey">+ RETIRO EN LOCAL</button>
            </div>
        </div>
                
            
    </div>
</div>

    </div>
    </div>
</div>