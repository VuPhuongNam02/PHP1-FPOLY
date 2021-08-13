<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <a href="insert.php" onclick="return confirm('bạn có muốn thêm')" class="btn btn-success">Thêm</a>
        <table class="table table-dark">
            <thead>
                <th>product_id</th>
                <th>product_name</th>
                <th>price</th>
                <th>quantity</th>
                <th>image</th>
                <th>description</th>
                <th>cate_id</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php include_once "../lib/function.php";
                $user = new xuly();
                //xóa
                if (!isset($_GET['id']) || $_GET['id'] == null) {
                } else {
                    $id = $_GET['id'];
                    $user->delete($id);
                }




                $result = $user->getData();
                if (!empty($result)) {
                    foreach ($result as $val) {
                ?>
                        <tr>
                            <td> <?= $val['product_id'] ?> </td>
                            <td> <?= $val['product_name'] ?> </td>
                            <td> <?= $val['price'] ?> </td>
                            <td> <?= $val['quantity'] ?> </td>
                            <td> <img src="../img/<?= $val['image'] ?>" width="150px"> </td>
                            <td> <?= $val['description'] ?> </td>
                            <td> <?= $val['cate_id'] ?> </td>
                            <td><a href="update.php?id=<?= $val['product_id'] ?>" onclick="return confirm('bạn có muốn sửa')" class="btn btn-warning">sửa</a></td>
                            <td><a href="?id=<?= $val['product_id'] ?>" onclick="return confirm('bạn có muốn xóa')" class="btn btn-danger">xóa</a></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

