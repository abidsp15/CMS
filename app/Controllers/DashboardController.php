<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $data['total_products'] = $productModel->countAllResults();
        $data['total_orders'] = $orderModel->countAllResults();
        
        // Sum total price from orders
        $db = \Config\Database::connect();
        $query = $db->query('SELECT SUM(total_price) as revenue FROM orders');
        $row = $query->getRow();
        $data['total_revenue'] = $row->revenue ?? 0;

        return view('dashboard/index', $data);
    }
}
