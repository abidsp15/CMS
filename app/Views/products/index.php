<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="m-0">List Produk</h4>
        <a href="/products/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped datatable" width="100%">
            <thead class="table-dark">
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                    <td>
                        <?php if($product['image']): ?>
                            <img src="/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-thumbnail" width="80">
                        <?php else: ?>
                            <span class="text-muted">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $product['name'] ?></td>
                    <td>Rp <?= number_format($product['price']) ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                        <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" onclick="confirmDelete(<?= $product['id'] ?>)" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></a>
                        <a href="/buy/<?= $product['id'] ?>" class="btn btn-success btn-sm" title="Buy"><i class="fas fa-shopping-cart"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data produk ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/products/delete/" + id;
        }
    })
}
</script>
<?= $this->endSection() ?>