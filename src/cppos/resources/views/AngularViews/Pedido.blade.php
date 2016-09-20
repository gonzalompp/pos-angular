<style>
    .info-box-contenido {
        vertical-align: middle;
        padding:5px;
        padding-top: 20px;
        text-align: center;
    }

    .btn-producto {
        margin:0px;
    }

    .tabla-totales {
        text-align: right;
    }

    .btn-subtotales {
        border-color:white;
    }

    .input-cantidad {
        width:30px;
    }

</style>
<style>
    .icono-mesa {
        font-size:70px;
    }

   /* // 1: Mesa / 2: Retiro en local / 3: Despacho a domicilio */

    .pedidotipo-mesa, .pedidotipo-mesa-activa, .pedidotipo-retiro, .pedidotipo-despacho {
        color: white;
        font-size:14px;
        padding: 10px;
        margin-top: -2px;
    }

    .pedidotipo-mesa {
        background-color: #B8DDC2;
    }

    .pedidotipo-mesa-activa {
        background-color: #00a65a;
    }

    .pedidotipo-retiro {
        background-color: #0050A6;
    }

    .pedidotipo-despacho {
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


<div class="row" style="margin-top: 10px;">
    
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                  <span  class="badge @{{pedido.TipoPedido==0 && 'pedidotipo-mesa' }} @{{pedido.TipoPedido==1 && 'pedidotipo-mesa-activa' }} @{{pedido.TipoPedido==2 && 'pedidotipo-despacho' }} @{{pedido.TipoPedido==3 && 'pedidotipo-retiro' }} "><b>@{{pedido.TipoPedidoNombre}} #@{{pedido.IdPedido}}</b></span>
                  <h3 class="box-title">
                      <button ng-click="abreDataCliente()" type="button" class="btn btn-default"><i class="fa fa-user"></i> Cliente: <b>@{{pedido.NombrePersonaRetira}}</b> / <b><i class="fa fa-map-marker"></i> @{{pedido.DespachoDireccion}}</b></button>
                  </h3>
                  
            </div>
              <div class="box-body">
                  <style>

                  </style>
                  <!-- DATOS COMPRAS -->
                  <div style="overflow: auto; height: 250px;">
                  <table class="table table-bordered table-hover dataTable">
                      <thead>
                          <tr>
                              <th>
                                  Producto
                              </th>
                              <th style="width: 100px;">
                                  $ Unitario
                              </th>
                              <th style="width: 100px;">
                                  Cantidad
                              </th>
                              <th style="width: 100px;">
                                  Total
                              </th>
                              <th style="width: 40px;">
                                 
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr ng-repeat="producto_venta in pedido.productos_venta | filter:{ Eliminado: 0 } track by $index">
                              <td>
                                @{{producto_venta.Nombre}}
                              </td>
                              <td>
                                $@{{producto_venta.PrecioUnitario | number:0}}
                              </td>
                              <td>
                               
                                  <button ng-click="cantidadDisminuir(producto_venta)" type="button" class="btn btn-default btn-xs"><i class="fa fa-minus-circle"></i></button>
                                   <input ng-model="producto_venta.Cantidad" class="input-cantidad" type="number" />
                                  <button ng-click="cantidadAumentar(producto_venta)" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i></button>

                              </td>
                              <td>
                                $@{{producto_venta.PrecioUnitario*producto_venta.Cantidad | number:0}}
                              </td>
                              <td>
                                <button class="btn btn-danger btn-xs" type="button"  ng-click="eliminarItem(producto_venta)"><i class="fa fa-trash"></i></button>  
                              </td>
                          </tr>
                      </tbody>
                  </table>
                  </div>

                  <!-- TOTALES -->

                  <div class="table-responsive">
                <table class="table tabla-totales">
                  <tbody>
                    <tr>
                    <th>Subtotal:</th>
                    <td>$@{{ getSubTotal() | number:0}}</td>
                  </tr>
                  <tr>
                    <th>Propina sugerida (10%)</th>
                    <td>$@{{ getPropina() | number:0}}</td>
                  </tr>
                  <tr>
                    <th>Total con propina:</th>
                    <td>$@{{ getTotal() | number:0}}</td>
                  </tr>
                  <tr>
                    <th>Observaciones:</th>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="2"><textarea ng-model="pedido.Observaciones" style="width: 100%; height: 50px;"></textarea></td>
                    </tr>
                </tbody></table>
              </div>
                      <a style="margin-bottom: 10px;" class="btn btn-success col-md-12 btn-subtotales" ng-click="confirmarPedido(producto)"><i class="fa fa-thumbs-o-up"></i> Confirmar</a>
                      <a ng-click="abreDescuentos()" type="button" class="btn btn-default col-md-12 btn-subtotales"><i class="fa fa-minus-square"></i> Descuento</a>
                      <a  ng-click="eliminarPedido()" class="btn btn-default col-md-4 btn-subtotales"><i class="fa fa-trash"></i> Eliminar</a>
                      <button ng-click="imprimirPedido()" class="btn btn-default col-md-4 btn-subtotales"><i class="fa fa-print"></i> Imprimir</button>
                      <a ng-click="clickPagar()" class="btn btn-info col-md-4 btn-subtotales"><i class="fa fa-money"></i> <b>Pagar</b></a>



              </div><!-- /.box-body -->
            </div>
    </div>
    <div class="col-md-6">
      <!-- DESCUENTOS -->
      <div  style="display: @{{descuentosShow}}">
        <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Descuentos</b></h3>
                </div>
                  <div class="box-body">
                    <div class="row" style="margin: 20px;">
          
          
          
          
         <table class="table table-bordered  dataTable"   style="text-align: center;">
           <tr>
            <td>
             <h3> Descuento por <br/><b>Valor</b></h3>
            </td>
            <td>
             <h3> Descuento por <br/><b>Porcentaje</b></h3>
            </td>
           </tr>
           <tr>
            <td colspan="2">
              <h4>Subtotal actual:<b> $@{{ getSubTotal() | number:0}}</b></h4>
            </td>
           </tr>
           <tr>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="descuentoValor" type="number" class="form-control">
                  </div>
            </td>
            <td>
              <div class="input-group">
                    <input ng-model="descuentoPorcentaje" type="number" class="form-control">
                    <span class="input-group-addon"><b>%</b></span>
                  </div>
            </td>
           </tr>
           <tr>
            <td>
             <h4> Descuento de <br/><b>$@{{ getTempTotalDescValor() | number:0}}</b></h4>
            </td>
            <td>
             <h4> Descuento de <br/><b>$@{{ getTempTotalDescPorcent() | number:0}}</b></h4>
            </td>
           </tr>
           <tr>
            <td>
             <h4> Subtotal Final <br/><b>$@{{ getTempSubTotalDescValor() | number:0}}</b></h4>
            </td>
            <td>
             <h4> Subtotal Final<br/><b>$@{{ getTempSubTotalDescPorcent() | number:0}}</b></h4>
            </td>
           </tr>
           <tr>
            <td>
             <button ng-click="AplicarDescuentoValor()" class="btn btn-success">Aplicar descuento</button>
            </td>
            <td>
             <button ng-click="AplicarDescuentoPorcent()" class="btn btn-success">Aplicar descuento</button>
            </td>
           </tr>
         </table>
          
          
          
          
          <center style="margin-top:15px;">
            <button style="margin-left: 30px;" ng-click="cancelarDescuento()" type="button" class="btn btn-xl btn-warning">Cancelar descuento</button>
          </center>
          
          
          
          
          
          
          
          
        </div>
                  </div> <!-- body -->
                  </div> <!-- box -->
      </div>
      
      <!-- DATA CLIENTE -->
      <div  style="display: @{{dataClienteShow}}">
        <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Datos cliente</b></h3>
                </div>
                  <div class="box-body">
         <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input ng-model="pedido.NombrePersonaRetira" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Teléfono</label>
                      <input ng-model="pedido.DespachoTelefono" type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Comuna</label>
                      <input ng-model="pedido.DespachoComuna" type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Dirección</label>
                      <input ng-model="pedido.DespachoDireccion" type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                  <br/>
                  <center>
                    <button ng-click="abreProductos()" class="btn btn-warning" type="button">Volver a productos</button>
                  </center>
                  </div> <!-- body -->
                  </div> <!-- box -->
      </div>
      
      <div  style="display: @{{productosShow}}">
            <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Productos</b></h3>
                </div>
                  <div class="box-body">
                      <a 
                          ng-repeat="producto in productos track by $index" 
                          class="btn btn-app col-md-3 btn-producto @{{producto.Tipo==0 && 'bg-yellow' }} @{{producto.Tipo==1 && 'bg-blue' }} @{{producto.Tipo==2 && 'bg-aqua' }}" 
                          ng-click="itemClick(producto)"
                          >
                        <label>@{{producto.Nombre}}<span ng-show="producto.Tipo == 2"><br />$@{{producto.PrecioUnitario}}</span></label>
                      </a>
                </div>
            </div> <!-- fin box -->
            </div>
            
            <div  style="display: @{{pagoShow}}">
            <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Pagar cuenta</b></h3>
                </div>
                  <div class="box-body">
                
          
         <table class="table table-bordered  dataTable"   style="text-align: center;">
           <tr>
            <td>
             <h4> <br/><b>Efectivo</b></h4>
            </td>
            <td>
             <h4> <br/><b>T. Crédito</b></h4>
            </td>
            <td>
             <h4> <br/><b>T. Débito (Redcompra)</b></h4>
            </td>
            <td>
             <h4> <br/><b>Cheque</b></h4>
            </td>
           </tr>
           <tr>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="PagoEfectivo" type="number" class="form-control">
                  </div>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="PagoCredito" type="number" class="form-control">
                  </div>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="PagoDebito" type="number" class="form-control">
                  </div>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="PagoCheque" type="number" class="form-control">
                  </div>
            </td>
           </tr>
           <tr>
             <td colspan="4">
               <h3>Suma de pagos: $@{{ getSumaPagos() | number:0}}</h3>
             </td>
             </tr>
             
         </table>
          
          
          
          <center style="margin-top:15px;">
            <button ng-click="pagarPedido()" type="button" class="btn btn-xl btn-success">Pagar cuenta</button>
            <button style="margin-left: 30px;" ng-click="abreProductos()" type="button" class="btn btn-xl btn-warning">Cancelar pago</button>
          </center>
                </div>
            </div> <!-- fin box -->
            </div>
            
            
    </div> <!-- fin col -->
</div>
    </div>
