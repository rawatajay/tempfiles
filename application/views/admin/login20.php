<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
	<div class="logo">JOB <i class="fa fa-briefcase"></i><span style="color:#EF6C00"> HUNTER</span> ADMIN
	</div>
	<!-- start: LOGIN BOX -->
	<div class="box-login">
		<h3>Sign in to your account</h3>
		<p>
			Please enter your name and password to log in.
		</p>
		<form class="form-login" action="#" method="post">
			<div class="errorHandler alert alert-danger no-display">
				<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
			</div>
			<fieldset>
				<div class="form-group ">
					<div class="btn-group jhadmin_buttonGroup" data-toggle="buttons">
					  <label class="btn btn-info active jhadmin_button">
					    <input type="radio" name="options" id="admin" value="" autocomplete="off"> Admin
					  </label>
					  <label class="btn btn-info jhadmin_button">
					    <input type="radio" name="options" id="dataoperator" autocomplete="off"> Data Operator
					  </label>
					</div>
			  	</div>
				<div class="form-group">
					<span class="input-icon">
						<input type="text" class="form-control" name="username" placeholder="Username">
						<i class="fa fa-user"></i> </span>
					<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
					<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
				</div>
				<div class="form-group form-actions">
					<span class="input-icon">
						<input type="password" class="form-control password" name="password" placeholder="Password">
						<i class="fa fa-lock"></i>
						<a class="forgot" href="?box=forgot">
							I forgot my password
						</a> </span>
				</div>
				<div class="form-actions">
					<label for="remember" class="checkbox-inline">
						<input type="checkbox" class="grey remember" id="remember" name="remember">
						Keep me signed in
					</label>
					<button type="submit" class="btn btn-bricky pull-right">
						Login <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>				
			</fieldset>
		</form>
	</div>
	<!-- end: LOGIN BOX -->
	<!-- start: FORGOT BOX -->
	<div class="box-forgot">
		<h3>Forget Password?</h3>
		<p>
			Enter your e-mail address below to reset your password.
		</p>
		<form class="form-forgot">
			<div class="errorHandler alert alert-danger no-display">
				<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
			</div>
			<fieldset>
				<div class="form-group">
					<span class="input-icon">
						<input type="email" class="form-control" name="email" placeholder="Email">
						<i class="fa fa-envelope"></i> </span>
				</div>
				<div class="form-actions">
					<a href="?box=login" class="btn btn-light-grey go-back">
						<i class="fa fa-circle-arrow-left"></i> Back
					</a>
					<button type="submit" class="btn btn-bricky pull-right">
						Submit <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</fieldset>
		</form>
	</div>
	<!-- end: FORGOT BOX -->	
	<!-- start: COPYRIGHT -->
	<div class="copyright">
		<?php echo COPYRIGHT ?>
	</div>
	<!-- end: COPYRIGHT -->
	<script type="text/javascript">
		
	</script>
</div>
		