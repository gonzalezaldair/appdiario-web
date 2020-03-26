<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Clientes</li>
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
              <button type="button" id="btn-modal-nuevo-cliente" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevo-cliente"><i class="fas fa-plus"></i> Nuevo Cliente</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%" id="tablaclientes" class="table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                  <th>Cedula</th>
                  <th>Nombres</th>
                  <th>Direccion</th>
                  <th>Correo</th>
                  <th>Ruta</th>
                  <th>Cobro</th>
                  <th>Activo</th>
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


<div class="modal fade" id="modal-nuevo-cliente" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Nuevo Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="hidden" name="clienteid" id="clienteid">
          <input type="text" id="clienteCedula" name="clienteCedula" class="form-control form-control-lg" placeholder="Ingresar Cedula">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="text" id="clienteNombre" name="clienteNombre" class="form-control form-control-lg" placeholder="Ingresar Nombre y Apellido">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="text" id="clienteCelular" class="form-control form-control-lg" placeholder="Ingresar Celular">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="text" id="clienteDireccion" class="form-control form-control-lg" placeholder="Ingresar Direccion">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="text" id="clienteCorreo" class="form-control form-control-lg" placeholder="Ingresar Correo">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <select id="clienteRUTA" class="form-control form-control-lg">
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <select id="clienteDiaCobro" class="form-control form-control-lg">
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <select id="clienteActivo" class="form-control form-control-lg">
            <option value="0">Inactivo</option>
            <option value="1">Activo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <!--<button type="button" class="btn btn-primary">Guardar</button>-->
        <button class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="modal-nuevo-prestamo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">Nuevo Prestamo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="idPrestamo" type="hidden" class="form-control form-control-lg" placeholder="Ingresar Codigo" readonly>
          <input id="clientePrestamo" type="text" class="form-control form-control-lg" placeholder="Ingresar Codigo" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <select id="comboformapago" class="form-control form-control-lg">
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="sumaPrestamo" type="text" class="form-control form-control-lg" placeholder="Ingresar Suma">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="interesPrestamo" type="text" class="form-control form-control-lg" placeholder="Ingresar Interes">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="cuotasPrestamo" type="text" class="form-control form-control-lg" placeholder="Ingresar Cuotas">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <textarea id="observacionesPrestamo" class="form-control" placeholder="Ingresar Observaciones"></textarea>
        </div>
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
