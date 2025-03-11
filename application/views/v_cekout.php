<!-- Main content -->
<div class="invoice p-3 mb-3 mt-5">
	<!-- title row -->
	<div class="row">
		<div class="col-12">
			<h4>
				<i class="fas fa-shopping-cart"></i> Checkout
				<small class="float-right">Date: <?= date('d-m-Y') ?></small>
			</h4>
		</div>
		<!-- /.col -->
	</div>
	<!-- info row -->

	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-12 table-responsive">
			<div class="card shadow-sm mb-4">
				<div class="card-header bg-primary text-white">
					<h5 class="mb-0">Daftar Pesanan</h5>
				</div>
				<div class="card-body p-0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Qty</th>
								<th width="150px" class="text-center">Harga</th>
								<th>Mutu</th>
								<th class="text-center">Total Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$tot_berat = 0;
							foreach ($this->cart->contents() as $items) {
								$barang = $this->m_home->detail_barang($items['id']);
								$berat = $items['qty'] * $barang->berat;

								$tot_berat = $tot_berat + $berat;
								?>
								<tr>
									<td class="align-middle"><?php echo $items['qty']; ?></td>
									<td class="text-center align-middle">Rp.
										<?php echo number_format($items['price'], 0); ?>
									</td>
									<td class="align-middle"><?php echo $items['name']; ?></td>
									<td class="text-center align-middle">Rp.
										<?php echo number_format($items['subtotal'], 0); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<?php
	echo validation_errors('<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
	?>
	<?php
	echo form_open('belanja/cekout');
	$no_order = date('Ymd') . strtoupper(random_string('alnum', 8));
	?>
	<div class="row">
		<!-- accepted payments column -->
		<div class="col-md-7">
			<div class="card shadow-sm mb-4">
				<div class="card-header bg-primary text-white">
					<h5 class="mb-0">Informasi Pengiriman</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Penerima <span class="text-danger">*</span></label>
								<input name="nama_penerima" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>HP Penerima <span class="text-danger">*</span></label>
								<input name="hp_penerima" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Provinsi <span class="text-danger">*</span></label>
								<select name="provinsi" class="form-control select2" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Kota/Kabupaten <span class="text-danger">*</span></label>
								<select name="kota" class="form-control select2" required></select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Alamat Lengkap <span class="text-danger">*</span></label>
						<textarea name="alamat" class="form-control" rows="3" required></textarea>
					</div>

					<div class="form-group">
						<label>Kode POS <span class="text-danger">*</span></label>
						<input name="kode_pos" class="form-control" required>
					</div>

					<div class="card bg-light mt-4">
						<div class="card-header">
							<h6 class="mb-0">Pilih Jasa Pengiriman</h6>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Pilih Expedisi <span class="text-danger">*</span></label>
										<select name="expedisi" class="form-control" required>
											<!-- Expedisi options will be loaded via AJAX -->
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Pilih Paket <span class="text-danger">*</span></label>
										<select name="paket" class="form-control" required>
											<option value="">-- Pilih Paket --</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-md-5">
			<div class="card shadow-sm mb-4">
				<div class="card-header bg-primary text-white">
					<h5 class="mb-0">Ringkasan Pesanan</h5>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<td>Subtotal Produk</td>
							<td class="text-right">Rp. <?php echo number_format($this->cart->total(), 0); ?></td>
						</tr>
						<tr>
							<td>Berat Total</td>
							<td class="text-right"><?= $tot_berat ?> Gram</td>
						</tr>
						<tr>
							<td>Ongkos Kirim</td>
							<td class="text-right"><span id="ongkir">Rp. 0</span></td>
						</tr>
						<tr class="bg-light">
							<th>Total Pembayaran</th>
							<th class="text-right"><span id="total_bayar">Rp.
									<?php echo number_format($this->cart->total(), 0); ?></span></th>
						</tr>
					</table>

					<!-- Simpan Transaksi -->
					<input name="no_order" value="<?= $no_order ?>" hidden>
					<input name="estimasi" hidden>
					<input name="ongkir" hidden>
					<input name="grand_total" value="<?= $this->cart->total() ?>" hidden>
					<input name="total_bayar" hidden>
					<!-- end Simpan Transaksi -->

					<!-- Simpan Rinci Transaksi -->
					<?php
					$i = 1;
					foreach ($this->cart->contents() as $items) {
						echo form_hidden('qty' . $i++, $items['qty']);
					}
					?>
					<!-- end Simpan Rinci Transaksi -->

					<div class="d-flex justify-content-between mt-4">
						<a href="<?= base_url('belanja') ?>" class="btn btn-secondary">
							<i class="fas fa-arrow-left mr-1"></i> Kembali
						</a>
						<button type="submit" class="btn btn-success">
							<i class="fas fa-check mr-1"></i> Selesaikan Pesanan
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<?php echo form_close() ?>
</div>

<!-- Add Select2 CSS and JS if not already included in your template -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
	rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	$(document).ready(function () {
		// Make sure select2 is loaded before initializing
		if ($.fn.select2) {
			// Initialize select2
			$('.select2').select2({
				theme: 'bootstrap4',
				width: '100%'
			});
		} else {
			console.error('Select2 is not loaded');
		}

		// Fetch province data on page load with error handling
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/provinsi') ?>",
			dataType: "html",
			success: function (hasil_provinsi) {
				$("select[name=provinsi]").html(hasil_provinsi);
			},
			error: function (xhr, status, error) {
				console.error("Error loading provinces:", error);
				$("select[name=provinsi]").html("<option value=''>Error loading provinces</option>");
			}
		});

		// Fetch expedisi data on page load
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/expedisi') ?>",
			dataType: "html",
			success: function (hasil_expedisi) {
				$("select[name=expedisi]").html(hasil_expedisi);
			},
			error: function (xhr, status, error) {
				console.error("Error loading expedisi:", error);
				$("select[name=expedisi]").html("<option value=''>Error loading expedisi</option>");
			}
		});

		// Fetch city data on province selection
		$("select[name=provinsi]").on("change", function () {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/kota') ?>",
				data: 'id_provinsi=' + id_provinsi_terpilih,
				dataType: "html",
				beforeSend: function () {
					$("select[name=kota]").html("<option value=''>Loading...</option>");
				},
				success: function (hasil_kota) {
					$("select[name=kota]").html(hasil_kota);
				},
				error: function (xhr, status, error) {
					console.error("Error loading cities:", error);
					$("select[name=kota]").html("<option value=''>Error loading cities</option>");
				}
			});
		});

		// Fetch shipping cost on city and expedition selection
		$("select[name=kota]").on("change", function () {
			getShippingCost();
		});

		$("select[name=expedisi]").on("change", function () {
			getShippingCost();
		});

		// Get shipping cost function
		function getShippingCost() {
			var id_kota_tujuan = $("option:selected", $("select[name=kota]")).attr("id_kota");
			var expedisi = $("select[name=expedisi]").val();
			var berat = <?= $tot_berat ?>;

			if (id_kota_tujuan && expedisi) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('rajaongkir/paket') ?>",
					data: {
						id_kota_asal: '<?= isset($lokasi->id_kota) ? $lokasi->id_kota : 1 ?>',
						id_kota_tujuan: id_kota_tujuan,
						berat: berat,
						expedisi: expedisi
					},
					dataType: "html",
					beforeSend: function () {
						$("select[name=paket]").html("<option value=''>Loading...</option>");
					},
					success: function (hasil_paket) {
						$("select[name=paket]").html(hasil_paket);
					},
					error: function (xhr, status, error) {
						console.error("Error loading packages:", error);
						$("select[name=paket]").html("<option value=''>Error loading packages</option>");
					}
				});
			}
		}

		// Calculate total payment on shipping package selection
		$("select[name=paket]").on("change", function () {
			// Get shipping cost and estimated time
			var ongkir = $("option:selected", this).attr("data-ongkir");
			var estimasi = $("option:selected", this).attr("data-estimasi");

			$("#ongkir").html("Rp. " + formatNumber(ongkir));
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(estimasi);

			// Calculate total payment
			var grand_total = <?= $this->cart->total() ?>;
			var total_bayar = parseInt(grand_total) + parseInt(ongkir);

			$("#total_bayar").html("Rp. " + formatNumber(total_bayar));
			$("input[name=total_bayar]").val(total_bayar);
		});

		// Format number to Indonesian Rupiah format
		function formatNumber(number) {
			return new Intl.NumberFormat('id-ID').format(number);
		}
	});
</script>