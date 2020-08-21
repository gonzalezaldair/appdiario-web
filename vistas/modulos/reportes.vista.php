<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Reportes</li>
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
              <div class="input-group">
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                  <span>
                    <i class="far fa-calendar-alt"></i> Rango de Fecha
                  </span>
                  <i class="fas fa-caret-down"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table style="width: 100%;" class="table table-bordered table-hover dt-responsive" id="tablaReportes">
                <thead>
                  <tr>
                    <th>Prestado</th>
                    <th>Interes</th>
                    <th>Total</th>
                    <th>Abonos</th>
                    <th>Saldo Pendiente</th>
                    <!--<th>Acciones</th>-->
                  </tr>
                </thead>
                <tbody>
                  <?php

                  if(isset($_GET["fechaInicial"]))
                  {
                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];
                  }else{
                    $fechaInicial = null;
                    $fechaFinal = null ;
                  }

                    $reporte = ReportesControlador::ctrReportePrestamosTotal($fechaInicial,$fechaFinal);

                    $total = $reporte["PRESTADO"]+$reporte["INTERES"];
                    $abonos = $total - $reporte["SALDO"];

                    echo '<tr>
                            <td><span class="badge badge-success">$ '.number_format($reporte["PRESTADO"], 2, ",",".").'</span></td>
                            <td><span class="badge badge-warning">$ '.number_format($reporte["INTERES"], 2, ",",".").'</span></td>
                            <td><span class="badge badge-info">$ '.number_format($total, 2, ",",".").'</span></td>
                            <td><span class="badge badge-primary">$ '.number_format($abonos, 2, ",",".").'</span></td>
                            <td><span class="badge badge-danger">$ '.number_format($reporte["SALDO"], 2, ",",".").'</span></td>
                          </tr>';

                   ?>
                </tbody>
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
