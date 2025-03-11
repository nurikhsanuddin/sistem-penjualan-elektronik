<div class="row">
	<div class="col-sm-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">No Rekening Toko</h3>
			</div>
			<div class="card-body">

				<p>Silahkan Transfer Uang Ke No Rekening Di Bawah Ini Sebesar :
				<h1 class="text-primary">Rp. <?= number_format($pesanan->total_bayar, 0) ?>.-</h1>
				</p><br>
				<table class="table">
					<tr>
						<th>Bank</th>
						<th>No Rekening</th>
						<th>Atas Nama</th>
					</tr>
					<?php foreach ($rekening as $key => $value) { ?>
						<tr>
							<td><?= $value->nama_bank ?></td>
							<td><?= $value->no_rek ?></td>
							<td><?= $value->atas_nama ?></td>
						</tr>
					<?php } ?>

				</table>

			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Upload Bukti Pembayaran</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<?php
			echo form_open_multipart('pesanan_saya/bayar/' . $pesanan->id_transaksi);
			?>
			<div class="card-body">
				<?php
				// Display error messages if any
				if (isset($error_upload)) {
					echo '<div class="alert alert-danger">' . $error_upload . '</div>';
				}
				?>
				<?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

				<div class="form-group">
					<label>Atas Nama</label>
					<input name="atas_nama" class="form-control" placeholder="Atas Nama"
						value="<?= set_value('atas_nama') ?>" required>
				</div>
				<div class="form-group">
					<label>Nama Bank</label>
					<input name="nama_bank" class="form-control" placeholder="Nama Bank"
						value="<?= set_value('nama_bank') ?>" required>
				</div>
				<div class="form-group">
					<label>No Rekening</label>
					<input name="no_rek" class="form-control" placeholder="No Rekening"
						value="<?= set_value('no_rek') ?>" required>
					<small class="text-muted">Hanya masukkan angka tanpa spasi atau karakter khusus</small>
				</div>

				<div class="form-group">
					<label for="exampleInputFile">Bukti Bayar</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="bukti_bayar" id="preview_gambar" class="custom-file-input" required
								accept="image/*">
							<label class="custom-file-label" for="preview_gambar">Pilih file</label>
						</div>
					</div>
					<small class="text-muted">Format: jpg, jpeg, png, gif (max 5MB)</small>
				</div>

				<div class="form-group">
					<div class="text-center">
						<img id="gambar_load" src="<?= base_url('assets/no-image.png') ?>" alt="Preview"
							style="max-height: 200px; max-width: 100%; margin-top: 10px;">
					</div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
				<a href="<?= base_url('pesanan_saya') ?>" class="btn btn-success">Back</a>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>

<script>
	// Script to show image preview before upload
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#gambar_load').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).ready(function () {
		$("#preview_gambar").change(function () {
			readURL(this);
		});

		// Update custom file label with filename
		$('.custom-file-input').on('change', function () {
			let fileName = $(this).val().split('\\').pop();
			$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});
	});
</script>