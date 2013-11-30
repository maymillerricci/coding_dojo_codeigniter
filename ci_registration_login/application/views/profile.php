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
			<a href="<?= base_url() ?>user/process_logout">Log Out</a>
			<div class="border">
				<h4>Welcome, <?= $this->session->userdata['user_session']->first_name ?>!</h4>
				<h4>User Information:</h4>
				<p>First Name: <?= $this->session->userdata['user_session']->first_name ?></p>
				<p>Last Name: <?= $this->session->userdata['user_session']->last_name ?></p>
				<p>Email: <?= $this->session->userdata['user_session']->email ?></p>
				<?php $registered = date('F d, Y - g:i:s a', strtotime($this->session->userdata['user_session']->created_at)) ?>
				<p>Registered: <?= $registered ?></p>
			</div>
		</div>
	</body>
</html>