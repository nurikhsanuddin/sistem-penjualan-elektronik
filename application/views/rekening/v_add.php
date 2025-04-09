<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Rekening</h3>
            <div class="card-tools">
                <a href="<?= base_url('rekening') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php echo form_open('rekening/add') ?>
            <div class="form-group">
                <label>Nama Bank</label>
                <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank"
                    value="<?= set_value('nama_bank') ?>">
                <?php echo form_error('nama_bank', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label>No Rekening</label>
                <input type="text" name="no_rek" class="form-control" placeholder="No Rekening"
                    value="<?= set_value('no_rek') ?>">
                <?php echo form_error('no_rek', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label>Atas Nama</label>
                <input type="text" name="atas_nama" class="form-control" placeholder="Atas Nama"
                    value="<?= set_value('atas_nama') ?>">
                <?php echo form_error('atas_nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-success">Reset</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>