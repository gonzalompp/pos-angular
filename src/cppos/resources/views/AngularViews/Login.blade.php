<div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>CP</b>Pos</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingresar al sistema</p>

<div class="form-group has-feedback">
              <input class="form-control" type="text" ng-model="usuario">
              <span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
            <!-- <input type="email" class="form-control" placeholder="Nombre de usuario"> -->
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input class="form-control"  type="password"  ng-model="clave">
                <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
            <!-- <input type="password" class="form-control" placeholder="Clave"> -->
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox" style="text-align: right;">
                <label>
                  <input class="checkbox" data-val="true" data-val-required="The ¿Recordar cuenta? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true"><input name="RememberMe" type="hidden" value="false">
                    Recordar usuario
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button  ng-click="Login()" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div><!-- /.col -->
          </div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
