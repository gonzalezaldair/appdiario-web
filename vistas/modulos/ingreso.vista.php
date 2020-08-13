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
						<input type="text" name="ingresoUsuario" class="form-control" placeholder="Ingresar Usuario" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="ingresoPassword" class="form-control" placeholder="Ingresar Contraseña" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember">
								<label for="remember">
									Recordarme
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Ingresar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<!--<div class="social-auth-links text-center mb-3">
					<p>- OR -</p>
					<a href="#" class="btn btn-block btn-primary">
						<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
					</a>
					<a href="#" class="btn btn-block btn-danger">
						<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
					</a>
				</div>-->
				<!-- /.social-auth-links -->

				<!--<p class="mb-1">
					<a href="forgot-password.html">I forgot my password</a>
				</p>
				<p class="mb-0">
					<a href="register.html" class="text-center">Register a new membership</a>
				</p>-->
			</div>
			<!-- /.login-card-body -->
		</div>

          <?php
          $ingreso = new ingresoControlador();
          $ingreso -> ctrIngresarUsuario();

          ?>
	</div>
	<!-- /.login-box -->
</div>