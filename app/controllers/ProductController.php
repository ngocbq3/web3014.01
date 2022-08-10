<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function add()
    {
        $categories = CategoryModel::all();
        return $this->view('admin.products.add', ['categories' => $categories]);
    }
    public function edit()
    {
        $id = $_GET['id'];
        $categories = CategoryModel::all();
        $product = ProductModel::find($id);
        return $this->view('admin.products.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }
    //Thêm mới dữ liệu
    public function save()
    {
        $request = $_POST;

        //Validate
        $errors = [];
        if ($request['name'] == "") {
            $errors['name'] = "Bạn cần nhập tên";
        }
        if ($request['cate_id'] == '0') {
            $errors['cate_id'] = "Bạn chưa chọn danh mục";
        }
        if ($request['price'] < 0) {
            $errors['price'] = "Giá phải là số dương";
        }
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = $file['name'];
            //Lấy ra phần mở rộng của file
            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            //Kiểm tra file không file ảnh
            if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
                $errors['image'] = "Bạn phải chọn file ảnh";
            }
        } else {
            $image = '';
        }
        // $a = array_filter($errors);
        // var_dump($a);
        // exit;
        if (!array_filter($errors)) {
            $request['image'] = $image;
            $product = new ProductModel;
            $product->insert($request);
            //upload ảnh
            if ($file['size'] > 0) {
                move_uploaded_file($file['tmp_name'], 'images/' . $image);
            }
            // echo "<pre>";
            // var_dump($request);

            header("location: /product-show");
            exit();
        }

        $categories = CategoryModel::all();
        return $this->view(
            'admin.products.add',
            [
                'categories' => $categories,
                'errors' => $errors,
                'request' => $request
            ]
        );
    }

    public function store()
    {
        $request = $_POST;
        // var_dump($request);
        // die;
        //Validate
        $errors = [];
        if ($request['name'] == "") {
            $errors['name'] = "Bạn cần nhập tên";
        }
        if ($request['cate_id'] == '0') {
            $errors['cate_id'] = "Bạn chưa chọn danh mục";
        }
        if ($request['price'] < 0) {
            $errors['price'] = "Giá phải là số dương";
        }
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = $file['name'];
            $request['image'] = $image;
            //Lấy ra phần mở rộng của file
            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            //Kiểm tra file không file ảnh
            if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
                $errors['image'] = "Bạn phải chọn file ảnh";
            }
        }
        // $a = array_filter($errors);
        // var_dump($a);
        // exit;
        if (!array_filter($errors)) {

            $product = ProductModel::find($request['id']);
            $product->update($request);
            //upload ảnh
            if ($file['size'] > 0) {
                move_uploaded_file($file['tmp_name'], 'images/' . $image);
            }
            // echo "<pre>";
            // var_dump($request);

            header("location: /product-show");
            exit();
        }

        $categories = CategoryModel::all();
        $product = ProductModel::find($request['id']);
        return $this->view(
            'admin.products.edit',
            [
                'categories' => $categories,
                'errors' => $errors,
                'request' => $request,
                'product' => $product
            ]
        );
    }

    public function show()
    {
        $products = ProductModel::all();
        return $this->view('admin.products.show', ['products' => $products]);
    }

    public function delete()
    {
        $id = $_GET['id'] ?? '';
        if (empty($id)) {
            header("location: /product-show");
            exit();
        }
        $product = new ProductModel;
        $product->destroy($id);
        header("location: /product-show");
        exit();
    }
}
