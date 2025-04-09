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

	.login-box-msg {
		color: #333;
		font-size: 1.5rem;
		font-weight: 600;
		margin-bottom: 2rem;
		text-align: center;
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
		display: block;
		text-align: center;
		margin-top: 1rem;
	}

	a:hover {
		color: #FF4B2B;
	}

	.alert {
		border-radius: 8px;
		margin-bottom: 1.5rem;
	}
</style>

<div class="card">
	<div class="card-body register-card-body">
		<h3 class="login-box-msg">Create Account</h3>

		<?php
		echo validation_errors('<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');
		if ($this->session->flashdata('pesan')) {
			echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>';
			echo $this->session->flashdata('pesan');
			echo '</div>';
		}

		echo form_open('pelanggan/register'); ?>
		<div class="input-group">
			<input type="text" name="nama_pelanggan" value="<?= set_value('nama_pelanggan') ?>" class="form-control"
				placeholder="Full Name">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-user"></span>
				</div>
			</div>
		</div>

		<div class="input-group">
			<input type="email" name="email" value="<?= set_value('email') ?>" class="form-control"
				placeholder="Email Address">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-envelope"></span>
				</div>
			</div>
		</div>

		<div class="input-group">
			<input type="password" name="password" value="<?= set_value('password') ?>" class="form-control"
				placeholder="Create Password">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
		</div>

		<div class="input-group">
			<input type="password" name="ulangi_password" value="<?= set_value('ulangi_password') ?>"
				class="form-control" placeholder="Confirm Password">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<button type="submit" class="btn btn-danger w-100">Create Account</button>
			</div>
		</div>
		<?php echo form_close() ?>

		<a href="<?= base_url('pelanggan/login') ?>">Already have an account? Sign in</a>
	</div>
</div>