<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends BaseController
{
    protected $productModel;
    protected $orderModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
    }

    public function buy($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->back();
        }

        if ($product['stock'] <= 0) {
            return redirect()->back()->with('error', 'Stock habis');
        }

        $quantity = 1;
        $total = $product['price'] * $quantity;

        $orderId = $this->orderModel->insert([
            'product_id' => $product['id'],
            'quantity' => $quantity,
            'total_price' => $total
        ]);

        $this->productModel->update($id, [
            'stock' => $product['stock'] - 1
        ]);

        return redirect()->to('/invoice/' . $orderId)->with('success', 'Produk berhasil dibeli. Invoice telah dibuat.');
    }

    public function invoice($id)
    {
        $order = $this->orderModel->select('orders.*, products.name as product_name, products.price as product_price')
                                  ->join('products', 'products.id = orders.product_id')
                                  ->find($id);

        if (!$order) {
            return redirect()->to('/products')->with('error', 'Order not found');
        }

        $data['order'] = $order;
        
        $html = view('orders/invoice_pdf', $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("invoice_order_" . $id . ".pdf", ["Attachment" => true]);
    }
}