<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Danh sách sản phẩm</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>views</th>
            <th>
                <a href="/product/add">Add</a>
            </th>
        </tr>

        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->name ?></td>
                <td>
                    <img src="images/<?= $product->image ?>" width="123" />
                </td>
                <td><?= $product->price ?></td>
                <td><?= $product->views ?></td>
                <td>
                    <a href="/product-edit?id=<?= $product->id ?>">Edit</a>
                    <a href="/product/delete?id=<?= $product->id ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>