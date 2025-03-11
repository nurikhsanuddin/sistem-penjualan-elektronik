<div class="hero-carousel mb-4">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner rounded">
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?= base_url() ?>assets/slider/slider1.png">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?= base_url() ?>assets/slider/slider2.png">
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

<!-- Category title bar -->
<div class="category-header bg-white p-3 rounded mb-4 modern-card">
	<h4 class="mb-0">Kategori: <?= $kategori->nama_kategori ?></h4>
</div>

<div class="mt-4">
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