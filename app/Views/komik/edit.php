<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">

            <form action="/komik/update/<?= $komik['id']; ?>" method="post">
                <input type="hidden" name="_method" value="PUT">

                <?= csrf_field(); ?>

                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input name="judul" id="judul" type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" value="<?= $komik['judul']; ?>" autofocus>
                    <div class="invalid-feedback"><?= ($validation->getError('judul')); ?></div>
                </div>

                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input name="penulis" id="penulis" type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" value="<?= $komik['penulis']; ?>">
                    <div class="invalid-feedback"><?= ($validation->getError('penulis')); ?></div>
                </div>

                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input name="penerbit" id="penerbit" type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" value="<?= $komik['penerbit']; ?>">
                    <div class="invalid-feedback"><?= ($validation->getError('penerbit')); ?></div>
                </div>

                <div class="mb-3">
                    <label for="sampul" class="form-label">Sampul</label>
                    <input name="sampul" id="sampul" type="file" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" autofocus>
                    <div class="invalid-feedback"><?= ($validation->getError('sampul')); ?></div>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>