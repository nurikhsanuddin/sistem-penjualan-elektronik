<style>
	.card {
		border: 0px !important;
	}
</style>



<div class="card card-solid" style="height: 100%;">
	<div class="card-body pb-0">
		<div class="row">
			<?php foreach ($barang as $key => $value) { ?>
				<div class="col-sm-4">
					<?php
					echo form_open('offline/add');
					echo form_hidden('id', $value->id_barang);
					echo form_hidden('qty', 1);
					echo form_hidden('price', $value->harga);
					echo form_hidden('name', htmlspecialchars($value->nama_barang));
					echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
					?>
					<div class="card" style="height: 100%;">
						<div class="card-header text-muted border-bottom-0 d-flex">
							<div class="h5"><b class="font-weight-bold"><?= $value->nama_barang ?></b></div>
							<div class="ml-3"><span>Kategori : <?= $value->nama_kategori ?></span></div>
						</div>
						<div class="card-body pt-0">
							<div class="row" style="height: 250px;">
								<div class="col-12 text-center">
									<img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" class="img-fluid"
										style="max-width: 100%; max-height: 250px;">
								</div>
							</div>
						</div>
						<div class="card-footer mt-2 bg-white">
							<div class="row">
								<div class="col-sm-6">
									<div class="text-left">
										<h4><span class="badge">Rp. <?= number_format($value->harga, 0) ?></span></h4>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="text-right">
										<a href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>"
											class="btn btn-sm btn-dark">
											<i class="fas fa-eye"></i>
										</a>
										<button type="submit" class="btn btn-sm btn-success swalDefaultSuccess">
											<i class="fas fa-cart-plus"> Keranjang</i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			<?php } ?>

		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php

				if ($this->session->flashdata('pesan')) {
					echo '<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-check"></i>';
					echo $this->session->flashdata('pesan');
					echo '</h5>
</div>';
				}
				?>
			</div>
			<div class="col-sm-12">
				<?php echo form_open('offline/update'); ?>

				<table class="table" cellpadding="6" cellspacing="1" style="width:100%">

					<tr>
						<th width="100px">QTY</th>
						<th>Nama Barang</th>
						<th style="text-align:right">Harga</th>
						<th style="text-align:right">Sub-Total</th>
						<th style="text-align:center">Berat</th>
						<th class="text-center">Action</th>
					</tr>

					<?php $i = 1; ?>

					<?php
					$tot_berat = 0;
					foreach ($this->cart->contents() as $items) {
						$barang = $this->m_home->detail_barang($items['id']);
						$berat = $items['qty'] * $barang->berat;

						$tot_berat = $tot_berat + $berat;
						?>
						<tr>
							<td>
								<?php
								echo form_input(array(
									'name' => $i . '[qty]',
									'value' => $items['qty'],
									'maxlength' => '3',
									'min' => '0',
									'size' => '5',
									'type' => 'number',
									'class' => 'form-control'
								));
								?>
							</td>
							<td><?php echo $items['name']; ?></td>
							<td style="text-align:right">Rp. <?php echo number_format($items['price'], 0); ?></td>
							<td style="text-align:right">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
							<td class="text-center"><?= $berat ?> Gr</td>
							<td class="text-center">
								<a href="<?= base_url('offline/delete/' . $items['rowid']) ?>"
									class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</td>
						</tr>

						<?php $i++; ?>

					<?php } ?>

					<tr>
						<td class="right">
							<h3>Total :</h3>
						</td>
						<td class="right">
							<h3>Rp. <?php echo number_format($this->cart->total(), 0); ?></h3>
						</td>
						<th>Total Berat : <?= $tot_berat ?> Gr</th>
						<td></td>
						<td></td>
						<td></td>
					</tr>

				</table>

				<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Update Cart</button>
				<a href="<?= base_url('offline/clear') ?>" class="btn btn-danger btn-flat"><i class="fa fa-recycle"></i>
					Clear Cart</a>
				<a href="<?= base_url('offline/cekout') ?>" class="btn btn-success btn-flat"><i
						class="fa fa-check-square"></i> Check Out</a>
				<?php echo form_close(); ?>
				<br>

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
			timer: 8000
		});

		$('.swalDefaultSuccess').click(function () {
			Toast.fire({
				icon: 'success',
				title: 'Barang Berhasil Ditambahkan Ke Keranjang !!!'
			})
		});
	});
</script>