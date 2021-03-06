<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Ruta</li>
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
              <button type="button" id="btnmodalnuevaruta" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-nueva-ruta"><i class="fas fa-plus"></i> Nueva Ruta</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%" id="tablarutas" class="table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cobro</th>
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



<div class="modal fade" id="modal-nueva-ruta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nueva Ruta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input type="text" id="rutaCodigo" class="form-control form-control-lg" placeholder="Ingresar Codigo" readonly>
          <input type="hidden" id="rutaId">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
          </div>
          <input id="rutaNombre" type="text" class="form-control form-control-lg" placeholder="Ingresar Nombre">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
          </div>
          <select id="rutaCobro" class="form-control form-control-lg">
          </select>
        </div>
        <div class="input-group mb-3 selectrutaActivo" style="display:none;">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
          </div>
          <select id="rutaActivo" class="form-control form-control-lg">
            <option value="0">Inactivo</option>
            <option value="1">Activo</option>
          </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-guardar-ruta">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
