<div class="login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Admin</b>LTE</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Iniciar Sesion</p>

				<form method="post">
					<div class="input-group mb-3">
						<input type="text" name="ingresoUsuario" class="form-control" placeholder="Ingresar Usuario"
							required autocomplete="off">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="ingresoPassword" class="form-control"
							placeholder="Ingresar Contraseña" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Ingresar <i
									class="fas fa-sign-in-alt"></i></button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-card-body -->
		</div>

		<?php
		$ingreso = new ingresoControlador();
		$ingreso->ctrIngresarUsuario();

		?>
	</div>
	<!-- /.login-box -->
</div>