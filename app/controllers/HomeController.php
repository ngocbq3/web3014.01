<?php

namespace App\Controllers;

use App\Models\ProductModel;

class HomeController extends Controller
{
    public function index()
    {
        $products = ProductModel::all();
        return $this->view('home.index', ['products' => $products]);
    }
    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("location: /home");
            die;
        }
        $product = ProductModel::find($id);
        if (!$product) {
            header("location: /home");
            die;
        }
        return $this->view('home.show', ['product' => $product]);
    }
}
