<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->findAll();

        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $validationRules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'max_size[image,2048]|is_image[image]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageFile = $this->request->getFile('image');
        $imageName = null;
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads', $imageName);
        }

        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName
        ]);

        return redirect()->to('/products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);

        return view('products/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'max_size[image,2048]|is_image[image]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $product = $this->productModel->find($id);
        $imageFile = $this->request->getFile('image');
        
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads', $imageName);
            // Delete old image if exists
            if ($product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
                unlink(FCPATH . 'uploads/' . $product['image']);
            }
        } else {
            $imageName = $product['image'];
        }

        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName
        ]);

        return redirect()->to('/products')->with('success', 'Produk berhasil diupdate.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if ($product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
            unlink(FCPATH . 'uploads/' . $product['image']);
        }
        $this->productModel->delete($id);

        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus.');
    }
}