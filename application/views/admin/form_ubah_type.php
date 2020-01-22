<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Ubah Data Tyoe</h1>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_type" id="" value="<?= $type['id_type']; ?>">
            <div class="form-group">
                <label for="">kode Type</label>
                <input type="text" name="kode_type" class="form-control" value="<?= $type['kode_type']; ?>">
                <?= form_error('kode_type', '<div class="text-small text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <label for="">Nama Type</label>
                <input type="text" name="nama_type" class="form-control" value="<?= $type['nama_type']; ?>">
                <?= form_error('nama_type', '<div class="text-small text-danger">', '</div>') ?>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
</div>
</form>
</section>
</div>