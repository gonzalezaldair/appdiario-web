<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Prestamos</li>
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
              <button type="button" id="btnmodalnuevoprestamo" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-nuevo-prestamo"><i class="fas fa-plus"></i> Nuevo Prestamo</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%;" id="tablaPrestamos" class="table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cliente</th>
                  <th>Forma Pago</th>
                  <th>Interes</th>
                  <th>Prestado</th>
                  <th>Total</th>
                  <th>Cuotas</th>
                  <th>Observaciones</th>
                  <th>Cobrador</th>
                  <th>Saldo</th>
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



<div class="modal fade" id="modal-nuevo-prestamo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Nuevo Prestamo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3 input-codigo">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input id="prestamoId" type="text" class="form-control form-control-lg" placeholder="Ingresar Codigo" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
          </div>
          <select id="prestamoFormaPago" class="form-control form-control-lg">
          </select>
        </div>
        <!--<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <select class="form-control form-control-lg">
            <option>option 1</option>
            <option>option 2</option>
            <option>option 3</option>
            <option>option 4</option>
            <option>option 5</option>
          </select>
        </div>-->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <input type="text" id="prestamoCliente" class="form-control form-control-lg validarNumero" placeholder="Ingresar Cedula o Telefono">
        </div>
        <div id="livesearchPersonaPrestamos"></div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input id="prestamoMontoPrestado" type="text" class="form-control form-control-lg validarNumero" placeholder="Ingresar Suma">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-percent"></i></span>
          </div>
          <input id="prestamoInteres" type="text" class="form-control form-control-lg validarNumero" placeholder="Ingresar Interes">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
          </div>
          <input id="prestamoCuotas" type="text" class="form-control form-control-lg validarNumero" placeholder="Ingresar Cuotas">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-comments"></i></span>
          </div>
          <textarea id="prestamoObservaciones" class="form-control" placeholder="Ingresar Observaciones"></textarea>
        </div>
        <div id="errorPrestamos" class="text-danger"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-guardar-prestamo">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-nuevo-abono">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">Nuevo Abono</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
          </div>
          <input id="prestamoabonoid" type="text" class="form-control form-control-lg" placeholder="Id Prestamo" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-coins"></i></span>
          </div>
          <input id="prestamosabonoSuma" type="text" class="form-control form-control-lg validarNumero" placeholder="Ingresar Suma">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input id="prestamosabonosaldo" type="text" class="form-control form-control-lg" placeholder="Ingresar Saldo" readonly>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-guardar-abono">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
