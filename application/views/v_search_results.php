<!-- Search results header -->
<div class="search-header bg-white p-3 rounded mb-4 modern-card">
    <h4 class="mb-0">Hasil Pencarian: "<?= $this->input->get('keyword') ?>"</h4>
</div>

<?php if (empty($barang)): ?>
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-search fa-4x text-muted"></i>
        </div>
        <h5>Tidak ada hasil yang ditemukan</h5>
        <p class="text-muted">Coba dengan kata kunci lain atau lihat kategori kami</p>
        <a href="<?= base_url() ?>" class="btn btn-primary modern-btn mt-3">
            Kembali ke Beranda
        </a>
    </div>
<?php else: ?>
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
<?php endif; ?>

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