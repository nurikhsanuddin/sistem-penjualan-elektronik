<style>
	body {
		background-image: linear-gradient(to right top, #e33d3d, #ee005c, #eb0085, #d300b7, #9612eb);
		margin-top: 200px;
	}
</style>
<div class="row mt-5 justify-content-center">
	<div class="card rounded" style="width: 400px;">
		<div class="card-body register-card-body mt-2">
			<h3 class="login-box-msg">Register Pelanggan Baru</h3>

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
			<div class="input-group mb-3">
				<input type="text" name="nama_pelanggan" value="<?= set_value('nama_pelanggan') ?>" class="form-control" placeholder="Nama Pelanggan">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user"></span>
					</div>
				</div>
			</div>

			<div class="input-group mb-3">
				<input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Email">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-envelope"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" name="ulangi_password" value="<?= set_value('ulangi_password') ?>" class="form-control" placeholder="Retype password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			<div class="row">

				<!-- /.col -->
				<div class="col-12 mt-2 mb-3">
					<button type="submit" class="btn btn-danger w-100">Register</button>
				</div>
				<!-- /.col -->
			</div>
			<?php echo form_close() ?>


			<a href="<?= base_url('pelanggan/login') ?>" class="text-center">Saya Sudah Punya Akun...!</a>
		</div>
		<!-- /.form-box -->
	</div>
</div>