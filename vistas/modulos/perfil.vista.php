<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Perfil</li>
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
              <button type="button" id="btn-nuevo-perfil" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nuevo Perfil
              </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%;" id="tablaperfil" class="table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Accion</th>
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




<div class="modal fade" id="modal-nuevo-perfil">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Nuevo Perfil</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input type="text" class="form-control form-control-lg" placeholder="Ingresar Codigo" id="per_Codigo" readonly>
          <input type="hidden" class="form-control form-control-lg" id="per_Id">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
          </div>
          <input type="text" class="form-control form-control-lg" placeholder="Ingresar Nombre" id="per_Nombre">
        </div>
        <div class="input-group mb-3 selectrutaActivo">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
          </div>
          <select id="per_Activo" class="form-control form-control-lg">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btnguardar-datos-perfil">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-permisos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Asignar Permisos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php  $modulos = UsuariosControlador::ctrModulosPermisos();
              echo '<input type="hidden" id="modulos" class="modulos" value="'.htmlspecialchars (json_encode($modulos)).'">';
         ?>
        <table style="width: 100%;" id="tablapermisosperfil" class="table table-borderles table-hover table-sm text-center">
          <thead>
            <tr>
              <th>Modulo</th>
              <th><input type="checkbox" class="checkall" name="CrearAll" value="crear"> Crear</th>
              <th><input type="checkbox" class="checkall" name="LeerAll" value="leer"> Leer</th>
              <th><input type="checkbox" class="checkall" name="ActualizarAll" value="actualizar"> Actualizar</th>
              <th><input type="checkbox" class="checkall" name="BorrarAll" value="eliminar"> Borrar</th>
            </tr>
          </thead>
          <tbody id="bodytabpermisos">
            <?php
              /*$i=1;
              foreach ($modulos as $key => $value) {
                echo '<tr>
                        <td class="numero">'.$value["mod_Nombre"].'</td>
                        <td><input id="'.$value["Crear"].'_Crear" type="checkbox" name="Crear_'.$i.'" value="'.$value["Crear"].'"></td>
                        <td><input id="'.$value["Leer"].'_Actualizar" type="checkbox" name="Actualizar_'.$i.'" value="'.$value["Leer"].'"></td>
                        <td><input id="'.$value["Actualizar"].'_Leer" type="checkbox" name="Leer_'.$i.'" value="'.$value["Actualizar"].'"></td>
                        <td><input id="'.$value["Eliminar"].'_Borrar" type="checkbox" name="Borrar_'.$i.'" value="'.$value["Eliminar"].'"></td>
                      </tr>';
                      $i++;
              }*/
             ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-guardar-permisosperfil">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->