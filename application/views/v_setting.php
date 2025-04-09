<div class="col-md-12">
	<!-- general form elements disabled -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Seting Website</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">


			<?php

			if ($this->session->flashdata('pesan')) {
				echo '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i>';
				echo $this->session->flashdata('pesan');
				echo '</h5></div>';
			}

			echo form_open('admin/setting'); ?>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Provinsi</label>
						<select name="provinsi" class="form-control">
							<option value="<?= $setting->provinsi ?>"><?= $setting->provinsi ?></option>
						</select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Kota</label>
						<select name="kota" class="form-control">
							<option value="<?= $setting->lokasi ?>"><?= $setting->lokasi ?></option>
						</select>
						<input type="hidden" name="id_kota" value="<?= $setting->lokasi ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nama Toko</label>
						<input type="text" name="nama_toko" class="form-control" value="<?= $setting->nama_toko ?>"
							required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>No Telpon</label>
						<input type="text" name="no_telpon" value="<?= $setting->no_telpon ?>" class="form-control"
							required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Alamat Toko</label>
				<input type="text" name="alamat_toko" value="<?= $setting->alamat_toko ?>" class="form-control"
					required>
			</div>
			<div class="form-group">
				<a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-sm">Kembali</a>
				<button type="submit" class="btn btn-primary btn-sm">Simpan</button>

			</div>

			<?php echo form_close() ?>



		</div>
	</div>
</div>


<!-- api RAJA ONGKIR -->
<script>
	$(document).ready(function () {
		//masukkan data ke select provinsi
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/provinsi') ?>",
			success: function (hasil_provinsi) {
				$("select[name=provinsi]").html(hasil_provinsi);
				// Set default selected province if exists
				$("select[name=provinsi] option[value='<?= $setting->provinsi ?>']").prop('selected', true);
				// Trigger change to load cities
				if ('<?= $setting->provinsi ?>') {
					var id_provinsi = $("select[name=provinsi] option:selected").attr("id_provinsi");
					getKota(id_provinsi);
				}
			}
		});

		//masukkan data ke select kota
		$("select[name=provinsi]").on("change", function () {
			var id_provinsi = $("option:selected", this).attr("id_provinsi");
			getKota(id_provinsi);
			$("input[name=id_kota]").val(''); // Reset city ID when province changes
		});

		//masukkan id_kota ke input kota
		$("select[name=kota]").on("change", function () {
			var id_kota = $("option:selected", this).attr("id_kota");
			var nama_kota = $("option:selected", this).val();
			$("input[name=id_kota]").val(id_kota);
		});

		function getKota(id_provinsi) {
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/kota') ?>",
				data: 'id_provinsi=' + id_provinsi,
				success: function (hasil_kota) {
					$("select[name=kota]").html(hasil_kota);
					// Set default selected city if exists
					$("select[name=kota] option[value='<?= $setting->lokasi ?>']").prop('selected', true);
				}
			});
		}
	});
</script>