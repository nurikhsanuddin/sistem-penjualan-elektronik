<!-- Main content -->
<div class="invoice p-3 mb-3 mt-5">
	<!-- title row -->
	<div class="row">
		<div class="col-12">
			<h4>
				<i class="fas fa-shopping-cart"></i> Cekout.
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Qty</th>
						<th width="150px" class="text-center">Harga</th>
						<th>mutu</th>
						<th class="text-center">Total Harga</th>
						<!-- <th class="text-center">Berat</th> -->
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
							<td><?php echo $items['qty']; ?></td>
							<td class="text-center">Rp. <?php echo number_format($items['price'], 0); ?></td>
							<td><?php echo $items['name']; ?></td>
							<td class="text-center">Rp. <?php echo  number_format($items['subtotal'], 0); ?></td>
							<!-- <td class="text-center"><?= $berat  ?> Gr</td> -->
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<?php
	echo validation_errors('<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
	?>
	<?php
	echo form_open('offline/cekout');
	$no_order = "ADMIN_" . date('Ymd') . strtoupper(random_string('alnum', 8));
	?>
	<div class="row">
		<!-- accepted payments column -->
		<div class="col-sm-8 invoice-col">
			Tujuan :
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Provinsi</label>
						<select name="provinsi" class="form-control"></select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Kota/Kabupaten</label>
						<select name="kota" class="form-control"></select>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<label>Jarak</label>
						<select name="jarak" class="form-control">
							<option>Pilih Jarak</option>
							<option value="dekat">0-20 KM</option>
							<option value="jauh">20-35 KM</option>
						</select>
					</div>
				</div>


				<div class="col-sm-8">
					<div class="form-group">
						<label>Alamat</label>
						<input name="alamat" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Kode POS</label>
						<input name="kode_pos" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nama Penerima</label>
						<input name="nama_penerima" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>HP Penerima</label>
						<input name="hp_penerima" class="form-control" required>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-4">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th style="width:50%">Grand Total:</th>
						<th>Rp. <?php echo number_format($this->cart->total(), 0); ?></th>
					</tr>
					<!-- <tr>
						<th>Berat:</th>
						<th><?= $tot_berat ?> Gr</th>
					</tr> -->
					<tr>
						<th>Ekstra:</th>
						<th><label id="ongkir"></label></th>
					</tr>
					<tr>
						<th>Total Bayar:</th>
						<th><label id="total_bayar"></label></th>
					</tr>
				</table>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

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
	<div class="row no-print">
		<div class="col-12">
			<a href="<?= base_url('offline')  ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali Ke Keranjang</a>
			<button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
				<i class="fas fa-shopping-cart"></i> Proses Cekout
			</button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>




<script>
	$(document).ready(function() {
		// When the distance selection changes
		$("select[name=jarak]").on("change", function() {
			var distance = $(this).val();
			var shippingCost = 0;

			if (distance === "dekat") {
				shippingCost = 0;
			} else if (distance === "jauh") {
				shippingCost = 20000;
			}

			$("#ongkir").text("Rp. " + shippingCost.toLocaleString());

			// Parse grandTotal from the HTML table
			var grandTotalText = $("#grand_total").text().trim();
			var grandTotal = parseInt(<?= $this->cart->total() ?>);

			// Check if grandTotal is a valid number
			if (isNaN(grandTotal)) {
				grandTotal = 0;
			}

			// Calculate totalPayment by adding grandTotal and shippingCost
			var totalPayment = grandTotal + shippingCost;

			// Display totalPayment
			$("#total_bayar").text("Rp. " + totalPayment.toLocaleString());

			// Set the value of 'ongkir' and 'total_bayar' input fields
			$("input[name=ongkir]").val(shippingCost);
			$("input[name=total_bayar]").val(totalPayment);
		});

		// Fetch province data on page load
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/provinsi') ?>",
			success: function(hasil_provinsi) {
				$("select[name=provinsi]").html(hasil_provinsi);
			}
		});

		// Fetch city data on province selection
		$("select[name=provinsi]").on("change", function() {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/kota') ?>",
				data: 'id_provinsi=' + id_provinsi_terpilih,
				success: function(hasil_kota) {
					$("select[name=kota]").html(hasil_kota);
				}
			});
		});
	});
</script>