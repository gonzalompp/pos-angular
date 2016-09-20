<style>
  .resultado_arqueo .mostrar {
    display: inline;
    color: red;
  }
  
  .resultado_arqueo .esconder {
    display: none;
  }
  
  .gris {
    background: rgba(128, 128, 128, 0.15);
  }
</style>

<div ng-include src="'AngularViews/LayoutComponents/Header'"></div>

<div class="content">   
	<div ng-include src="'AngularViews/LayoutComponents/Menu'"></div>
    
	<div class="row">
    <div class="col-md-6">
                    <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Últimos 10 Arqueos de caja</b></h3>
                </div>
                  <div class="box-body">
                    <style>
                      .UltimoArqueoClass
                      {
                        background: #B5F9BE;
                        font-weight: bold;
                      }
                      </style>
                    <table class="table table-bordered">
                    <tbody><tr>
                      <th>ID</th>
                      <th>Fecha de registro</th>
                      <th>Fecha desde</th>
                      <th>Fecha hasta</th>
                    </tr>
                    
                    <tr ng-repeat="arq_item in arqueosanteriores track by $index" class="@{{arq_item.First}}">
                      <td>@{{arq_item.Id}}</td>
                      <td>@{{arq_item.FechaRegistro}}</td>
                      <td>@{{arq_item.FechaDesde}}</td>
                      <td>@{{arq_item.FechaHasta}}</td>
                    </tr>
                   
                  </tbody></table>
                  </div> <!-- body -->
                  </div> <!-- box -->
                  </div> <!-- col -->
                    
		<div class="col-md-6">
      <style>
        .fechapicker
        {
          width:100px;
        }
        
        .horapicker
        {
          width:100px;
        }
        </style>
                    <div class="box box-default">
                  <div class="box-header with-border">
                      <h3 class="box-title"><b>Nuevo Arqueo de caja</b></h3>
                </div>
                  <div class="box-body">
                
          <div>
                <div class="form-group">
                  
                  <div class="row">
                    <div class="col-md-2">
                      <label>Fecha Inicio:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="fechapicker form-control pull-right" id="fechainicio" ng-model="ArqueoFechaInicio"/>
                        </div><!-- /.input group -->
                    </div> <!-- /. col -->
                    
                    
                    <div class="col-md-2">
                      <label>Hora Inicio:</label>
                      <div class="input-group bootstrap-timepicker timepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <input id="horainicio" type="text" class="form-control input-small" ng-model="ArqueoHoraInicio">
                        
                    </div>
                    </div> <!-- /. col -->
                    
                    <div class="col-md-2">
                      
                      </div>
                    
                    <div class="col-md-2">
                      <label>Fecha Término:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="fechapicker form-control pull-right" id="fechatermino"  ng-model="ArqueoFechaTermino" />
                        </div><!-- /.input group -->
                    </div> <!-- /. col -->
                    
                    <div class="col-md-2">
                      <label>Hora Término:</label>
                      <div class="input-group bootstrap-timepicker timepicker">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <input id="horatermino" type="text" class="form-control input-small"  ng-model="ArqueoHoraTermino">
                        
                    </div>
                    </div> <!-- /. col -->
                    
                    <div class="col-md-2">
                      <button style="margin-top: 24px;" type="button" class="btn btn-success" ng-click="cargarValoresArqueo()">Cargar</button>
                    </div>
                  </div>
                  
                    
                  <hr/>
                  
                  <div class="row">
                     <div class="col-xs-6">@{{ arqueosistema.ArqueoFechaInicio }}</div>
                     <div class="col-xs-6">@{{ arqueosistema.ArqueoFechaTermino }}</div>
                  </div>
                  
         <table class="table table-bordered  dataTable" style="text-align: center;">
           <tbody>
               <tr>
                 <td class="gris">

            </td>
            <td class="gris">
             <h4> <br><b>Efectivo</b></h4>
            </td>
            <td class="gris">
             <h4> <br><b>T. Crédito</b></h4>
            </td>
            <td class="gris">
             <h4> <br><b>T. Débito (Redcompra)</b></h4>
            </td>
            <td class="gris">
             <h4> <br><b>Cheque</b></h4>
            </td>
           </tr>
           <tr>
             <td class="gris">
             <h4> <br><b>Registrado en sistema</b></h4>
            </td>
            <td>
             <h5> <br><b>$ @{{ arqueosistema.PagoEfectivo | number:0 }}</b></h5>
            </td>
            <td>
             <h5> <br><b>$ @{{ arqueosistema.PagoCredito | number:0 }}</b></h5>
            </td>
            <td>
             <h5> <br><b>$ @{{ arqueosistema.PagoDebito | number:0 }}</b></h5>
            </td>
            <td>
             <h5> <br><b>$ @{{ arqueosistema.PagoCheque | number:0 }}</b></h5>
            </td>
           </tr>
           <tr class="resultado_arqueo">
             <td class="gris">
             <h4> <br><b>Conteo manual</b></h4>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="arqueoregistrado.PagoEfectivo" type="number" class="form-control ng-pristine ng-untouched ng-valid">
                  </div>
                  <h5> <br><b  class="@{{ PagoEfectivoColor() }}">FALTA: $ @{{ arqueosistema.PagoEfectivo - arqueoregistrado.PagoEfectivo | number:0 }}</b></h5>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="arqueoregistrado.PagoCredito" type="number" class="form-control ng-pristine ng-untouched ng-valid">
                  </div>
                  <h5> <br><b class="@{{ PagoCreditoColor() }}">FALTA: $ @{{ arqueosistema.PagoCredito - arqueoregistrado.PagoCredito | number:0 }}</b></h5>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="arqueoregistrado.PagoDebito" type="number" class="form-control ng-pristine ng-untouched ng-valid">
                  </div>
                  <h5> <br><b class="@{{ PagoDebitoColor() }}">FALTA: $ @{{ arqueosistema.PagoDebito - arqueoregistrado.agoDebito | number:0 }}</b></h5>
            </td>
            <td>
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input ng-model="arqueoregistrado.PagoCheque" type="number" class="form-control ng-pristine ng-untouched ng-valid">
                  </div>
                  <h5> <br><b class="@{{ PagoChequeColor() }}">FALTA: $ @{{ arqueosistema.PagoCheque - arqueoregistrado.PagoCheque | number:0 }}</b></h5>
            </td>
           </tr>
           
         </tbody>
         </table>
         <center>
          <button class="btn btn-success" type="button" ng-click="generarArqueo()">Generar arqueo</button>
         </center>
          
                </div> <!-- body -->
            </div> <!-- box -->
				</div> <!-- col -->
				

	</div> <!-- row -->
</div> <!-- content -->

    <script language="javascript">
        $(function () {
          $('#fechainicio').datepicker({format: 'dd/mm/yyyy'});
          $('#horainicio').timepicker({ defaultTime: '00:00', showMeridian: false});
          
          $('#fechatermino').datepicker({format: 'dd/mm/yyyy'});
          $('#horatermino').timepicker({ defaultTime: '23:59', showMeridian: false});
        });
    </script>
