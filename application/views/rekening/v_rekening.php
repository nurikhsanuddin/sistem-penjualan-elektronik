<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Rekening</h3>
            <div class="card-tools">
                <a href="<?= base_url('rekening/add') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-bordered" id="example2">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($rekening as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $value->nama_bank ?></td>
                            <td><?= $value->no_rek ?></td>
                            <td><?= $value->atas_nama ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('rekening/edit/' . $value->id_rekening) ?>"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete<?= $value->id_rekening ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<?php foreach ($rekening as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id_rekening ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $value->nama_bank ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Yakin Ingin Menghapus Data Ini...?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('rekening/delete/' . $value->id_rekening) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>