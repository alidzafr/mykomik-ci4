<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">

            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input name="judul" id="judul" type="text" class="form-control" value="<?= old('judul'); ?>" autofocus>
                </div>

                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input name="penulis" id="penulis" type="text" class="form-control" value="<?= old('penulis'); ?>" autofocus>
                </div>

                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input name="penerbit" id="penerbit" type="text" class="form-control" value="<?= old('penerbit'); ?>" autofocus>
                </div>

                <div class="mb-3">
                    <label for="sampul" class="form-label">Sampul</label>
                    <input name="sampul" id="sampul" type="file" class="form-control" autofocus>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>