<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Cajas <?= " CUADRE-" .  $_SESSION["cuandre_caja"]; ?></li>
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
                        <button type="button" id="btnmodalnuevaaperturacaja" class="btn btn-primary btn-sm"
                            data-toggle="modal" data-target="#modal-nueva-apertura-caja"><i class="fas fa-plus"></i>
                            Apertura</button>
                        <button type="button" id="btnmodalgasto" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#modal-nuevo-gasto"><i class="fas fa-plus"></i>
                            Gasto</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table style="width: 100%" id="tablaCuadreCajas"
                            class="table table-bordered table-hover dt-responsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ruta</th>
                                    <th>Usuario</th>
                                    <th>Fecha Inicial</th>
                                    <th>Fecha Final</th>
                                    <th>Monto Inicial</th>
                                    <th>Monto Final</th>
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


<div class="modal fade" id="modal-nueva-apertura-caja">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Apertura de Caja</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="hidden" id="cuc_Id" />
                    <input type="text" id="cuc_MontoInicial" class="form-control form-control-lg"
                        placeholder="Ingresar Monto Inicial">
                </div>
                <!--<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                    </div>
                    <input id="aperturacajanombre" type="text" class="form-control form-control-lg"
                        placeholder="Ingresar Nombre">
                </div>
                <div class="input-group mb-3 selectrutaActivo" style="display:none;">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
                    </div>
                    <select id="aperturacajaActivo" class="form-control form-control-lg">
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </div>-->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="button" class="btn btn-primary btn-guardar-aperturacaja">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-nuevo-gasto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Nuevo Gasto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3 selectrutaActivo">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
                    </div>
                    <select id="gas_Tipo" class="form-control form-control-lg">
                        <option value="0">Seleccione: </option>
                        <option value="Gasolina">Gasolina</option>
                        <option value="Almuerzo">Almuerzo</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="text" id="gas_Monto" class="form-control form-control-lg" placeholder="Ingresar Monto">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="button" class="btn btn-primary btn-guardar-gasto">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->