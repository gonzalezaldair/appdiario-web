<?php
$item = null;
$valor = null;

$Rutas = RutasControlador::ctrMostrarRutas($item, $valor);
$clientes = ClientesControlador::ctrMostrarClientes($item, $valor);
$prestamos = PrestamosControlador::ctrMostrarPrestamos($item, $valor);
$PrestamosTablaInicio = PrestamosControlador::ctrdatatableprestamos($_SESSION["usuario_Id"]);
$usuario = UsuariosControlador::ctrMostrarUsuarios($item, $valor);
$Abonos = AbonosControlador::ctrMostrarAbonos($item, $valor);
 ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tablero</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Tablero</li>
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
      <div class="col-6 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Usuarios</span>
            <span class="info-box-number">
              <?php echo count($usuario); ?>
              <!--<small>%</small>-->
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-6 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-road"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Rutas</span>
            <span class="info-box-number"><?php echo count($Rutas); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-6 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Prestamos</span>
            <span class="info-box-number"><?php echo count($prestamos); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-6 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Clientes</span>
            <span class="info-box-number"><?php echo count($clientes); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Últimos Prestamos Realizados</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Prestamo ID</th>
                    <th>Cliente</th>
                    <th>Suma</th>
                    <th>Usuario</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if (is_array($PrestamosTablaInicio) && count($PrestamosTablaInicio) > 0) {
                      $numrow = (count($PrestamosTablaInicio) > 7) ? 7 :  count($PrestamosTablaInicio);
                     for ($i=0; $i < $numrow; $i++) {
                      echo '<tr>
                      <td><a href="#">'.$PrestamosTablaInicio[$i]["pre_Id"].'</a></td>
                      <td>'.$PrestamosTablaInicio[$i]["cli_Nombre"].'</td>
                      <td>$ '.number_format($PrestamosTablaInicio[$i]["pre_MontoPrestado"], 2, ",",".").'</td>
                      <td>'.$PrestamosTablaInicio[$i]["usu_Nombre"].'</td>
                      </tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
           <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>-->
            <a href="prestamos" class="btn btn-sm btn-secondary float-right">Ver Todos Los Prestamos</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-4">
        <!-- PRODUCT LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Últimos Abonos</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <?php
                  if (is_array($Abonos) && count($Abonos) > 0) {
                    $numrow = (count($Abonos) > 6) ? 6 :  count($Abonos);
                   for ($i=0; $i < $numrow; $i++) {
                    $monto =number_format($Abonos[$i]["abo_Monto"], 2, ",",".");
                    echo '<li class="item">
                            <div class="product-img">
                              <img src="vistas/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                              <a href="javascript:void(0)" class="product-title">'.$Abonos[$i]["abo_Fecha"].'
                              <span class="badge badge-warning float-right">$ '.$monto.'</span></a>
                              <span class="product-description">
                              '.$Abonos[$i]["abo_Fecha"].'
                              </span>
                            </div>
                          </li>';
                  }
                }


                  ?>
                  <!--<li class="item">
                    <div class="product-img">
                      <img src="vistas/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">PlayStation 4
                        <span class="badge badge-success float-right">$399</span></a>
                        <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                      </div>
                    </li>-->
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="abonos" class="uppercase">Ver Abonos</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </div>
<!-- /.content -->