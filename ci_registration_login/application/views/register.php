<!-- VIEW -->
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login or Register</title>
		<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/register.css">
	</head>
	<body>
		<div id="wrapper">
			<div class="border" id="login">
				<h3>Login</h3>
				<?php
				if(isset($this->session->userdata['error_login']))
				{
					echo "<div class='col-md-11 alert alert-danger' id='error_login'>" . $this->session->userdata['error_login'] . "</div>";
					$this->session->unset_userdata('error_login');
				}
				?>
				<form action="user/process_login" method="post">
					<div class="row">
						<div class="col-md-2"><label for="login_email">Email:</label></div>
						<div class="col-md-5"><input type="text" name="email" id="login_email"></div>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="login_password">Password:</label></div>
						<div class="col-md-5"><input type="password" name="password" id="login_password"></div>
					</div>
					<input type="submit" value="Log In" class="btn btn-primary">
				</form>
			</div> <!-- close login div-->
			<div class="border" id="register">
				<h3>Register</h3>
				<?php 
				if(isset($this->session->userdata['error_main']))
				{
					echo "<div class='col-md-11 alert alert-danger' id='error_main'>" . $this->session->userdata['error_main'] . "</div>";
					unset($this->session->userdata['error_main']);
				}
				?>
				</p>
				<form action="user/process_register" method="post">
					<div class="row">
						<div class="col-md-2"><label for="first_name">*First Name:</label></div>
						<div class="col-md-5"><input type="text" name="first_name" id="first_name"></div>
						<?php 
						if(isset($this->session->userdata['error_first_name']))
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_first_name'>" . $this->session->userdata['error_first_name'] . "</div>";
							$this->session->unset_userdata('error_first_name');
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="last_name">*Last Name:</label></div>
						<div class="col-md-5"><input type="text" name="last_name" id="last_name"></div>
						<?php 
						if(isset($this->session->userdata['error_last_name']))
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_last_name'>" . $this->session->userdata['error_last_name'] . "</div>";
							$this->session->unset_userdata('error_last_name');
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="email">*Email:</label></div>
						<div class="col-md-5"><input type="text" name="email" id="email"></div>
						<?php 
						if(isset($this->session->userdata['error_email']))
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_email'>" . $this->session->userdata['error_email'] . "</div>";
							$this->session->unset_userdata('error_email');
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="password">*Password:</label></div>
						<div class="col-md-5"><input type="password" name="password" id="password"></div>
						<?php 
						if(isset($this->session->userdata['error_password']))
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_password'>" . $this->session->userdata['error_password'] . "</div>";
							$this->session->unset_userdata('error_password');
						}
						?>
					</div>
					<input type="submit" value="Register" class="btn btn-primary">
				</form>
			</div> <!-- close register div-->
		</div> <!-- close wrapper div-->
	</body>
</html>