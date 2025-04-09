<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 3 | <?= $title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url() ?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style>
		body {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			height: 100vh;
		}

		.login-box {
			margin-top: 5%;
			max-width: 400px;
		}

		.card {
			border-radius: 15px;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
			border: none;
		}

		.login-card-body {
			padding: 2.5rem;
			border-radius: 15px;
		}

		.login-logo {
			margin-bottom: 1.5rem;
		}

		.login-logo b {
			color: white;
			font-size: 2rem;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
		}

		.input-group {
			margin-bottom: 1.5rem !important;
		}

		.form-control {
			border-radius: 8px;
			padding: 12px;
			height: auto;
		}

		.input-group-text {
			border-radius: 8px;
			background-color: #f8f9fa;
		}

		.btn {
			padding: 12px;
			border-radius: 8px;
			font-weight: 600;
		}
	</style>
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<b class="text-dark">Admin Panel</b>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<h4 class="text-center mb-4">Sign In</h4>

				<?php

				echo validation_errors('<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

				if ($this->session->flashdata('error')) {
					echo '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-ban"></i> Alert!</h5>';
					echo $this->session->flashdata('error');
					echo '</div>';
				}

				if ($this->session->flashdata('pesan')) {
					echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i> Sukses!</h5>';
					echo $this->session->flashdata('pesan');
					echo '</div>';
				}

				echo form_open('auth/login_user')
					?>
				<div class="input-group">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-block">Website</a>
					</div>
					<!-- /.col -->
					<div class="col-6">
						<button type="submit" class="btn btn-primary btn-block">Login</button>
					</div>
					<!-- /.col -->
				</div>
				<?php echo form_close() ?>




			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>

</body>

</html>