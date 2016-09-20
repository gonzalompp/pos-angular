  <style>
    a .info-box 
    { 
      color: black;
    }
    
    .info-box {
      min-height: 56px;
    }
    
    .info-box-icon {
      height: 56px;
      font-size: 28px;
      line-height: 59px;
    }
  </style>
  
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <a href="#/local">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-home"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">@{{session.NombreEmpresa}}</span>
          <span class="info-box-text">@{{session.NombreLocal}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
      </a>
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <a href="#/garzon">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Garzon</span>
          <span class="info-box-text">@{{session.NombreGarzon}}</span>
          
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
      </a>
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <a href="#/mesas">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-cutlery"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Mesas</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
      </a>
    </div><!-- /.col -->
    
    <div class="col-md-3 col-sm-6 col-xs-12">
      <a href="{{url('/Desconectar')}}">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-power-off"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Usuario</span>
          <span class="info-box-text">@{{session.NombreUsuario}}</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
      </a>
    </div><!-- /.col -->
    
  </div>