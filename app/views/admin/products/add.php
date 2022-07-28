<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
</head>

<body>
    <form action="/product/add" method="post" enctype="multipart/form-data">

        Tên sản phẩm: <input type="text" name="name">
        <br>
        Ảnh đại diện: <input type="file" name="image">
        <br>
        Danh mục:
        <select name="cate_id">
            <option value="0">Chọn danh mục</option>
            <?php foreach ($categories as $cate) : ?>
                <option value="<?= $cate->id ?>">
                    <?= $cate->cate_name ?>
                </option>
            <?php endforeach ?>
        </select>
        <br>

        Giá: <input type="number" name="price" id="">
        <br>

        Mô tả ngắn
        <br>
        <textarea name="short_desc" cols="100" rows="5"></textarea>
        <br>

        Nội dung <br>
        <textarea name="detail" cols="100" rows="10"></textarea>
        <br>

        <button type="submit">Lưu</button>
    </form>
</body>

</html>