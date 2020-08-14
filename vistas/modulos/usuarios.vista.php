<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Usuarios</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <button type="button" id="btnmodalnuevousuario" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevo-usuario"><i class="fas fa-plus"></i> Nuevo Usuario</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%;" id="tablausuario" class="table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Celular</th>
                  <th>Direccion</th>
                  <th>Ruta</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



<div class="modal fade" id="modal-nuevo-usuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cuerpo-modal">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <input type="hidden" id="usuarioId">
          <input id="usuarioCedula" type="text" class="form-control form-control-lg" placeholder="Ingresar Cedula">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input id="usuarioUsuario" type="text" class="form-control form-control-lg" placeholder="Ingresar Usuario">
        </div>
        <div class="input-group mb-3 divusuarioPassword">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
          <input id="usuarioPassword" type="password" class="form-control form-control-lg" placeholder="Ingresar Contraseña" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
          </div>
          <input id="usuarioNombre" type="text" class="form-control form-control-lg" placeholder="Ingresar Nombre">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
          </div>
          <input id="usuarioCelular" type="text" class="form-control form-control-lg" placeholder="Ingresar Celular">
        </div>
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="usuarioCorreo" type="email" class="form-control form-control-lg" placeholder="Ingresar Correo">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
          </div>
          <input id="usuarioDireccion" type="text" class="form-control form-control-lg" placeholder="Ingresar Direccion">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
          </div>
          <select id="usuarioRUTA" class="form-control form-control-lg">
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-users"></i></span>
          </div>
          <select id="usuarioPERFIL" class="form-control form-control-lg"></select>
        </div>
        <div class="input-group mb-3 selectrutaActivo">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
          </div>
          <select id="usuarioActivo" class="form-control form-control-lg">
            <option value="0">Inactivo</option>
            <option value="1">Activo</option>
          </select>
        </div>
        <div id="errorUsuario" class="text-danger"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-guardar-usuario">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-permisos-usuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Administrar Accesos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table style="width: 100%;" id="tablapermisosusuario" class="table table-borderless table-hover table-sm text-center">
          <thead>
            <tr>
              <th>Modulo</th>
              <th>Crear</th>
              <th>Actualizar</th>
              <th>Leer</th>
              <th>Borrar</th>
            </tr>
          </thead>
          <tbody id="bodytabpermisos">
            <?php
              /*$modulos = UsuariosControlador::ctrModulosPermisos();
              $i=1;
              foreach ($modulos as $key => $value) {
                echo '<tr>
                        <td class="numero">'.$value["mod_Nombre"].'</td>
                        <td><input id="'.$value["mod_Nombre"].'_Crear" type="checkbox" name="Crear_'.$i.'" value="'.$value["Crear"].'"></td>
                        <td><input id="'.$value["mod_Nombre"].'_Actualizar" type="checkbox" name="Actualizar_'.$i.'" value="'.$value["Actualizar"].'"></td>
                        <td><input id="'.$value["mod_Nombre"].'_Leer" type="checkbox" name="Leer_'.$i.'" value="'.$value["Leer"].'"></td>
                        <td><input id="'.$value["mod_Nombre"].'_Borrar" type="checkbox" name="Borrar_'.$i.'" value="'.$value["Borrar"].'"></td>
                      </tr>';
                      $i++;
              }*/
             ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
