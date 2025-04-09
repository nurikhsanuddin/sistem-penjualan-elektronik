<style>
	.card {
		border: 0px !important;
	}
</style>

<!-- Hero section with improved carousel -->
<div class="hero-carousel mb-4">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner rounded shadow">
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?= base_url() ?>assets/slider/slider1.png">
				<div class="carousel-caption d-none d-md-block">
					<h2 class="display-4 font-weight-bold">SENDANG MULYA</h2>
					<p class="lead">Solusi lengkap untuk kebutuhan elektronik rumah tangga Anda</p>
					<a href="#products" class="btn btn-primary btn-lg modern-btn">Lihat Produk</a>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?= base_url() ?>assets/slider/slider2.png">
				<div class="carousel-caption d-none d-md-block">
					<h2 class="display-4 font-weight-bold">Produk Berkualitas</h2>
					<p class="lead">Berbagai pilihan elektronik dengan garansi resmi</p>
					<a href="#products" class="btn btn-primary btn-lg modern-btn">Belanja Sekarang</a>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<!-- Feature boxes -->
<div class="row mb-4">
	<div class="col-md-4 mb-3">
		<div class="modern-card p-4 text-center h-100">
			<div class="feature-icon mb-3">
				<i class="fas fa-shield-alt fa-3x text-primary"></i>
			</div>
			<h4>Garansi Resmi</h4>
			<p class="text-muted">Produk bergaransi resmi dan terpercaya</p>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="modern-card p-4 text-center h-100">
			<div class="feature-icon mb-3">
				<i class="fas fa-truck fa-3x text-primary"></i>
			</div>
			<h4>Pengiriman Cepat</h4>
			<p class="text-muted">Layanan pengiriman ke seluruh Indonesia</p>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="modern-card p-4 text-center h-100">
			<div class="feature-icon mb-3">
				<i class="fas fa-headset fa-3x text-primary"></i>
			</div>
			<h4>Layanan 24/7</h4>
			<p class="text-muted">Dukungan teknis dan customer service 24 jam</p>
		</div>
	</div>
</div>

<!-- Product section -->
<div id="products" class="mb-4">
	<div class="section-header d-flex justify-content-between align-items-center mb-4">
		<h3 class="mb-0">Produk Kami</h3>
		<a href="#" class="text-decoration-none">Lihat Semua <i class="fas fa-arrow-right"></i></a>
	</div>

	<div class="row">
		<?php foreach ($barang as $key => $value) { ?>
			<div class="col-6 col-md-4 col-lg-3 mb-4">
				<?php
				echo form_open('belanja/add');
				echo form_hidden('id', $value->id_barang);
				echo form_hidden('qty', 1);
				echo form_hidden('price', $value->harga);
				echo form_hidden('name', htmlspecialchars($value->nama_barang));
				echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
				?>
				<div class="modern-card product-card h-100">
					<div class="position-relative">
						<div class="product-img-container">
							<img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" class="product-img">
						</div>
						<span class="product-category"><?= $value->nama_kategori ?></span>
					</div>

					<div class="p-3">
						<h5 class="product-title"><?= $value->nama_barang ?></h5>
						<div class="d-flex justify-content-between align-items-center mt-2">
							<span class="product-price">Rp <?= number_format($value->harga, 0) ?></span>
							<div>
								<a href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>"
									class="btn btn-sm btn-outline-secondary modern-btn">
									<i class="fas fa-eye"></i>
								</a>
								<button type="submit" class="btn btn-sm btn-primary modern-btn swalDefaultSuccess ml-1">
									<i class="fas fa-cart-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		<?php } ?>
	</div>
</div>

<!-- Testimonial section -->
<div class="testimonial-section mb-4">
	<div class="section-header mb-4">
		<h3>Apa Kata Pelanggan Kami</h3>
	</div>
	<div class="row">
		<div class="col-md-4 mb-3">
			<div class="modern-card p-4 h-100">
				<div class="d-flex align-items-center mb-3">
					<i class="fas fa-quote-left fa-2x text-primary mr-3"></i>
					<div>
						<h5 class="mb-0">Ahmad Sanjaya</h5>
						<small class="text-muted">Kontraktor</small>
					</div>
				</div>
				<p class="text-muted">"Produk beton dari SENDANG MULYA selalu memenuhi standar kualitas tinggi.
					Pengirimannya juga tepat waktu."</p>
				<div class="text-warning">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<div class="modern-card p-4 h-100">
				<div class="d-flex align-items-center mb-3">
					<i class="fas fa-quote-left fa-2x text-primary mr-3"></i>
					<div>
						<h5 class="mb-0">Budi Santoso</h5>
						<small class="text-muted">Developer</small>
					</div>
				</div>
				<p class="text-muted">"Layanan pelanggan yang responsif dan kualitas produk yang konsisten. Sangat
					direkomendasikan!"</p>
				<div class="text-warning">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star-half-alt"></i>
				</div>
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<div class="modern-card p-4 h-100">
				<div class="d-flex align-items-center mb-3">
					<i class="fas fa-quote-left fa-2x text-primary mr-3"></i>
					<div>
						<h5 class="mb-0">Rina Wijaya</h5>
						<small class="text-muted">Ibu Rumah Tangga</small>
					</div>
				</div>
				<p class="text-muted">"Produk elektronik dari SENDANG MULYA sangat membantu pekerjaan rumah tangga saya.
					Kualitas terjamin dan pelayanan memuaskan."</p>
				<div class="text-warning">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
	$(function () {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		$('.swalDefaultSuccess').click(function () {
			Toast.fire({
				icon: 'success',
				title: 'Barang Berhasil Ditambahkan Ke Keranjang!'
			})
		});
	});
</script>