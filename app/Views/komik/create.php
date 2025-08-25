<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<form action="/komik/save" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <div>
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul">
    </div>

    <div>
        <label for="penulis">penulis</label>
        <input type="text" name="penulis" id="penulis">
    </div>

    <div>
        <label for="sampul">Sampul</label>
        <input type="file" name="sampul">
    </div>

    <button type="submit">Simpan</button>
</form>
<?= $this->endsection(); ?>