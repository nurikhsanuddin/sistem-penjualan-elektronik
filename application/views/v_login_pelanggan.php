<style>
	body {
		background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
		height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0;
		padding: 20px;
	}

	.card {
		background: white;
		border-radius: 20px;
		box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
		border: none;
		max-width: 400px;
		width: 100%;
	}

	.register-card-body {
		padding: 2.5rem;
	}

	.input-group {
		margin-bottom: 1.5rem !important;
	}

	.form-control {
		border-radius: 8px;
		padding: 12px;
		height: auto;
		border: 1px solid #e0e0e0;
	}

	.input-group-text {
		border-radius: 8px;
		background-color: #f8f9fa;
		border: 1px solid #e0e0e0;
	}

	.btn-danger {
		background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
		border: none;
		padding: 12px;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}

	.btn-danger:hover {
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(255, 75, 43, 0.4);
	}

	a {
		color: #FF416C;
		text-decoration: none;
		font-weight: 500;
	}

	a:hover {
		color: #FF4B2B;
	}

	h3 {
		color: #333;
		font-weight: 600;
		margin-bottom: 2rem;
	}
</style>

<div class="card">
	<div class="card-body register-card-body">
		<h3 class="text-center">Welcome Back</h3>
		<?php
		echo validation_errors('<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

		if ($this->session->flashdata('pesan')) {
			echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			echo $this->session->flashdata('pesan');
			echo '</div>';
		}

		if ($this->session->flashdata('error')) {
			echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			echo $this->session->flashdata('error');
			echo '</div>';
		}
		?>

		<form action="<?= base_url('pelanggan/login') ?>" method="post">
			<div class="input-group">
				<input type="email" name="email" value="<?= set_value('email') ?>" class="form-control"
					placeholder="Email">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-envelope"></span>
					</div>
				</div>
			</div>
			<div class="input-group">
				<input type="password" name="password" value="<?= set_value('password') ?>" class="form-control"
					placeholder="Password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<button type="submit" class="btn btn-danger w-100">Sign In</button>
				</div>
			</div>
		</form>

		<div class="text-center mt-4">
			<a href="<?= base_url('pelanggan/register') ?>">Don't have an account? Sign up</a>
		</div>
	</div>
</div>