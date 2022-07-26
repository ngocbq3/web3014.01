<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends Controller
{
    public function add()
    {
        $arr = [
            'name' => 'Test 1211',
            'image' => "Test11.jpg",
            'cate_id' => 7,
            'price' => 61000,
            'short_desc' => 'Mô tả ngắn test update',
            'detail' => 'Nội dung chi tiết test update'
        ];

        // $product = new ProductModel;
        // $product->insert($arr);
        // ProductModel::find(111)->update($arr);

        $products = ProductModel::where('price', '>', 90000)->get();
        echo "<pre>";
        var_dump($products);
    }
}
