<?php
if ($_SESSION["usuario_PERFIL"] <> 1) {
  echo '<script> window.location = "inicio"; </script>';
}

?>

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
            <table style="width: 100%;" class="table table-bordered table-hover dt-responsive"
              id="tablaReportes">
              <thead>
                <tr>
                  <th>S. Inicial - I. Capital</th>
                  <th>Retiros</th>
                  <th>Prestado</th>
                  <th>Interes</th>
                  <th>Gastos</th>
                  <th>Abonos</th>
                  <th>Salo en Caja</th>
                  <!--<th>Acciones</th>-->
                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_GET["fechaInicial"])) {
                  $fechaInicial = $_GET["fechaInicial"];
                  $fechaFinal = $_GET["fechaFinal"];
                } else {
                  $fechaInicial = null;
                  $fechaFinal = null;
                }

                $reporte = ReportesControlador::ctrReportePrestamosTotal($fechaInicial, $fechaFinal);

                $salidas = $reporte["GASTOS"] + $reporte["RETIROS"] + $reporte["AJUSTES"] + $reporte["PRESTAMOS"];
                $entradas = $reporte["SALDO_INICIAL"]  + $reporte["ABONOS"] + $reporte["INYECCION_CAPITAL"];

                $cajaActual = $entradas  - $salidas;
                $abonos = $reporte["ABONOS"];

                echo '<tr>
                            <td><span class="badge badge-primary">$ ' . number_format($reporte["SALDO_INICIAL"] + $reporte["INYECCION_CAPITAL"], 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-danger">$ ' . number_format($reporte["RETIROS"], 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-success">$ ' . number_format($reporte["PRESTAMOS"], 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-warning">$ ' . number_format($reporte["INTERESES"], 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-info">$ ' . number_format($reporte["GASTOS"], 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-primary">$ ' . number_format($abonos, 2, ",", ".") . '</span></td>
                            <td><span class="badge badge-danger">$ ' . number_format($cajaActual, 2, ",", ".") . '</span></td>
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