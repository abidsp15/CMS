<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use App\Models\OrderModel;

class ApiController extends ResourceController
{
    protected $format    = 'json';

    public function products()
    {
        $productModel = new ProductModel();
        return $this->respond($productModel->findAll());
    }

    public function product($id = null)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        
        if ($product) {
            return $this->respond($product);
        }
        
        return $this->failNotFound('No product found');
    }

    public function createOrder()
    {
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $rules = [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $productId = $this->request->getVar('product_id');
        $qty = $this->request->getVar('quantity');

        $product = $productModel->find($productId);

        if (!$product) {
            return $this->failNotFound('Product not found');
        }

        if ($product['stock'] < $qty) {
            return $this->fail('Insufficient stock');
        }

        $totalPrice = $product['price'] * $qty;

        $orderModel->save([
            'product_id' => $productId,
            'quantity' => $qty,
            'total_price' => $totalPrice
        ]);

        $productModel->update($productId, [
            'stock' => $product['stock'] - $qty
        ]);

        return $this->respondCreated(['message' => 'Order created successfully', 'total_price' => $totalPrice]);
    }
}
