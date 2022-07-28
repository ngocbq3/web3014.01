<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function add()
    {
        // $arr = [
        //     'name' => 'Test 1211',
        //     'image' => "Test11.jpg",
        //     'cate_id' => 7,
        //     'price' => 61000,
        //     'short_desc' => 'Mô tả ngắn test update',
        //     'detail' => 'Nội dung chi tiết test update'
        // ];

        // $product = new ProductModel;
        // $product->insert($arr);
        // ProductModel::find(1199)->update($arr);

        // $products = ProductModel::where('price', '>', 90000)->get();
        // echo "<pre>";
        // var_dump($products);

        $categories = CategoryModel::all();

        return $this->view('admin.products.add', ['categories' => $categories]);
    }

    //Thêm mới dữ liệu
    public function save()
    {
        $request = $_POST;

        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = $file['name'];
        } else {
            $image = '';
        }

        $request['image'] = $image;
        $product = new ProductModel;
        $product->insert($request);

        //upload ảnh
        if ($file['size'] > 0) {
            move_uploaded_file($file['tmp_name'], 'images/' . $image);
        }
        // echo "<pre>";
        // var_dump($request);

        header("location: /product/add");
        exit();
    }
}
