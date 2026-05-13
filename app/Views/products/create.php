<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="m-0">Tambah Produk</h4>
    </div>
    <div class="card-body">
        <?php if(session('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/products/store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Produk <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>">
            </div>

            <div class="mb-3">
                <label>Harga <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control" value="<?= old('price') ?>">
            </div>

            <div class="mb-3">
                <label>Stock <span class="text-danger">*</span></label>
                <input type="number" name="stock" class="form-control" value="<?= old('stock') ?>">
            </div>

            <div class="mb-3">
                <label>Gambar Produk <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?= old('description') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>