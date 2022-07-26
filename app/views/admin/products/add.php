<?php
if (isset($request)) {
    extract($request);
}
?>
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

        Tên sản phẩm: <input type="text" name="name" value="<?= $name ?? '' ?>">
        <?php if (isset($errors['name'])) : ?>
            <span style="color: red;">
                <?= $errors['name'] ?>
            </span>
        <?php endif ?>
        <br>
        Ảnh đại diện: <input type="file" name="image">
        <?php if (isset($errors['image'])) : ?>
            <span style="color: red;">
                <?= $errors['image'] ?>
            </span>
        <?php endif ?>
        <br>
        Danh mục:
        <select name="cate_id">
            <option value="0">Chọn danh mục</option>
            <?php foreach ($categories as $cate) : ?>
                <option value="<?= $cate->id ?>" <?= isset($cate_id) ? ($cate_id == $cate->id) ? 'selected' : '' : '' ?>>
                    <?= $cate->cate_name ?>
                </option>
            <?php endforeach ?>
        </select>
        <?php if (isset($errors['cate_id'])) : ?>
            <span style="color: red;">
                <?= $errors['cate_id'] ?>
            </span>
        <?php endif ?>
        <br>

        Giá: <input type="number" name="price" value="<?= $price ?? '' ?>">
        <?php if (isset($errors['price'])) : ?>
            <span style="color: red;">
                <?= $errors['price'] ?>
            </span>
        <?php endif ?>
        <br>

        Mô tả ngắn
        <br>
        <textarea name="short_desc" cols="100" rows="5"><?= $short_desc ?? '' ?></textarea>
        <br>

        Nội dung <br>
        <textarea name="detail" cols="100" rows="10"><?= $detail ?? '' ?></textarea>
        <br>

        <button type="submit">Lưu</button>
    </form>
</body>

</html>