<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Dashboard Statistik</h2>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-white-50 mb-1">Total Produk</h6>
                        <h2 class="mb-0"><?= $total_products ?></h2>
                    </div>
                    <i class="fas fa-box fa-3x opacity-50"></i>
                </div>
            </div>
            <a href="/products" class="card-footer text-white d-flex justify-content-between align-items-center bg-primary border-0" style="filter: brightness(0.9);">
                <span>Lihat Details</span>
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-white-50 mb-1">Total Orders</h6>
                        <h2 class="mb-0"><?= $total_orders ?></h2>
                    </div>
                    <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer text-white d-flex justify-content-between align-items-center bg-success border-0" style="filter: brightness(0.9);">
                <span>Total transaksi berhasil</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase text-white-50 mb-1">Total Pendapatan</h6>
                        <h2 class="mb-0">Rp <?= number_format($total_revenue) ?></h2>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer text-white d-flex justify-content-between align-items-center bg-info border-0" style="filter: brightness(0.9);">
                <span>Akumulasi pendapatan</span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
