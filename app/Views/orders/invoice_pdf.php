<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Order #<?= $order['id'] ?></title>
    <style>
        body { font-family: sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { text-align: center; margin-bottom: 30px; }
        .details { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>INVOICE</h2>
            <p>Order #<?= $order['id'] ?></p>
        </div>
        
        <div class="details">
            <p><strong>Tanggal Order:</strong> <?= date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $order['product_name'] ?></td>
                    <td>Rp <?= number_format($order['product_price']) ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td>Rp <?= number_format($order['total_price']) ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Grand Total</th>
                    <th>Rp <?= number_format($order['total_price']) ?></th>
                </tr>
            </tfoot>
        </table>
        
        <div style="margin-top: 50px; text-align: center;">
            <p>Terima kasih atas pembelian Anda!</p>
        </div>
    </div>
</body>
</html>
