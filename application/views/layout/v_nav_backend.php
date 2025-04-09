<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('admin') ?>" class="brand-link bg-info">
		<i class="fas fa-store ml-3 text-white"></i>
		<span class="brand-text font-weight-light ml-2 text-white">Admin</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/profile/no-pic.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block text-dark"><?= $this->session->userdata('nama_user') ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview"
				role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('admin') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == "") ? 'active' : '' ?>">
						<i class="nav-icon fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<li class="nav-header">MASTER DATA</li>

				<?php if ($this->session->userdata('username') == 'superadmin'): ?>
					<li class="nav-item">
						<a href="<?= base_url('kategori') ?>"
							class="nav-link <?= ($this->uri->segment(1) == 'kategori') ? 'active' : '' ?>">
							<i class="nav-icon fas fa-tag"></i>
							<p>Kategori</p>
						</a>
					</li>
				<?php endif; ?>

				<li class="nav-item">
					<a href="<?= base_url('barang') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'barang') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-box"></i>
						<p>Barang</p>
					</a>
				</li>

				<li class="nav-header">TRANSAKSI</li>

				<li class="nav-item">
					<a href="<?= base_url('Offline') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'Offline') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-store"></i>
						<p>Offline</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('admin/pesanan_masuk') ?>"
						class="nav-link <?= ($this->uri->segment(2) == 'pesanan_masuk') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>Pesanan Masuk</p>
					</a>
				</li>

				<li class="nav-header">PENGATURAN</li>

				<li class="nav-item">
					<a href="<?= base_url('gambarbarang') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'gambarbarang') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-images"></i>
						<p>Gambar Preview</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?= base_url('laporan') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'laporan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-file-alt"></i>
						<p>Laporan</p>
					</a>
				</li>

				<?php if ($this->session->userdata('username') == 'superadmin'): ?>
					<li class="nav-item">
						<a href="<?= base_url('rekening') ?>"
							class="nav-link <?= ($this->uri->segment(1) == 'rekening') ? 'active' : '' ?>">
							<i class="nav-icon fas fa-credit-card"></i>
							<p>Rekening</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?= base_url('admin/setting') ?>"
							class="nav-link <?= ($this->uri->segment(2) == 'setting') ? 'active' : '' ?>">
							<i class="nav-icon fas fa-cog"></i>
							<p>Setting</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?= base_url('user') ?>"
							class="nav-link <?= ($this->uri->segment(1) == 'user') ? 'active' : '' ?>">
							<i class="nav-icon fas fa-user-cog"></i>
							<p>User</p>
						</a>
					</li>
				<?php endif; ?>

				<li class="nav-item">
					<a href="<?= base_url('pelanggan') ?>"
						class="nav-link <?= ($this->uri->segment(1) == 'pelanggan') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>Pelanggan</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
						<li class="breadcrumb-item active"><?= $title ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="row">