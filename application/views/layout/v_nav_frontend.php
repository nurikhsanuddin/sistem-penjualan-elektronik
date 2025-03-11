<!-- Navbar -->
<style>
	.container {
		max-width: 70%;
	}
</style>
<nav class="navbar navbar-expand-lg modern-navbar sticky-top">
	<div class="modern-container">
		<!-- Brand logo -->

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
			<i class="fas fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarCollapse">
			<!-- Left navbar links -->
			<a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
				<span class="brand-logo bg-primary text-white rounded-circle p-2 mr-2">
					<i class="fas fa-building"></i>
				</span>
				<span class="font-weight-bold">SCS</span>
			</a>

			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="<?= base_url() ?>" class="nav-link">Home</a>
				</li>

				<?php $kategori = $this->m_home->get_all_data_kategori(); ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Kategori</a>
					<div class="dropdown-menu">
						<?php foreach ($kategori as $value) { ?>
							<a class="dropdown-item" href="<?= base_url('home/kategori/' . $value->id_kategori) ?>">
								<?= $value->nama_kategori ?>
							</a>
						<?php } ?>
					</div>
				</li>

				<li class="nav-item">
					<a href="#" class="nav-link" data-toggle="modal" data-target="#contactModal">Contact</a>
				</li>
			</ul>

			<!-- Search bar -->
			<form class="form-inline mr-auto" action="<?= base_url('home/search') ?>" method="get">
				<div class="input-group">
					<input class="form-control" type="search" placeholder="Cari produk..." name="keyword"
						aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-outline-primary" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-3">
				<li class="nav-item mr-2">
					<?php if ($this->session->userdata('email') == "") { ?>
						<a class="btn btn-sm btn-outline-primary" href="<?= base_url('pelanggan/login') ?>">
							<i class="fas fa-user mr-1"></i> Login/Register
						</a>
					<?php } else { ?>
						<div class="dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
								<span class="mr-2"><?= $this->session->userdata('nama_pelanggan') ?></span>
								<img src="<?= base_url('assets/foto/no-pic.png') ?>" alt="User" class="img-circle"
									width="24">
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item">
									<i class="fas fa-user mr-2"></i> Akun Saya
								</a>
								<div class="dropdown-divider"></div>
								<a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
									<i class="fas fa-shopping-cart mr-2"></i>Pesanan Saya
								</a>
								<div class="dropdown-divider"></div>
								<a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item">
									<i class="fas fa-sign-out-alt mr-2"></i>Log Out
								</a>
							</div>
						</div>
					<?php } ?>
				</li>

				<?php
				$keranjang = $this->cart->contents();
				$jml_item = 0;
				foreach ($keranjang as $key => $value) {
					$jml_item = $jml_item + $value['qty'];
				}
				?>
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="fas fa-shopping-cart"></i>
						<span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<?php if (empty($keranjang)) { ?>
							<a href="#" class="dropdown-item text-center py-3">
								<i class="fas fa-shopping-basket fa-2x mb-2 text-muted"></i>
								<p>Keranjang Belanja Kosong</p>
							</a>
						<?php } else { ?>
							<?php foreach ($keranjang as $key => $value) {
								$barang = $this->m_home->detail_barang($value['id']); ?>
								<a href="<?= base_url('belanja') ?>" class="dropdown-item">
									<div class="media">
										<img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" alt="Product"
											class="img-size-50 mr-3">
										<div class="media-body">
											<h3 class="dropdown-item-title">
												<?= $value['name'] ?>
											</h3>
											<p class="text-sm"><?= $value['qty'] ?> x
												Rp.<?= number_format($value['price'], 0) ?></p>
											<p class="text-sm text-muted">
												<i class="fa fa-calculator"></i>
												Rp.<?= $this->cart->format_number($value['subtotal']); ?>
											</p>
										</div>
									</div>
								</a>
								<div class="dropdown-divider"></div>
							<?php } ?>

							<a href="#" class="dropdown-item">
								<div class="media">
									<div class="media-body text-right">
										<p class="text-sm font-weight-bold">
											Total: Rp.<?= $this->cart->format_number($this->cart->total()); ?>
										</p>
									</div>
								</div>
							</a>

							<div class="dropdown-divider"></div>
							<div class="d-flex">
								<a href="<?= base_url('belanja') ?>"
									class="dropdown-item dropdown-footer text-center flex-fill">View Cart</a>
								<a href="<?= base_url('belanja/cekout') ?>"
									class="dropdown-item dropdown-footer text-center flex-fill">Check Out</a>
							</div>
						<?php } ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contactModalLabel">Contact</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="d-flex align-items-center mb-3">
					<i class="fab fa-whatsapp fa-2x text-success mr-3"></i>
					<p class="mb-0">085156815391</p>
				</div>
				<div class="d-flex align-items-center">
					<i class="far fa-envelope fa-2x text-primary mr-3"></i>
					<p class="mb-0">admin@projectmaster.cloud</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Main content -->
<div class="content">
	<div class="modern-container pt-3">