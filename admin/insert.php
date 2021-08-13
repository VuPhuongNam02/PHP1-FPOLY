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
        <?php include_once "../lib/function.php";
        $user = new xuly();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['submit'])) {

                //validate Size, type Image. Type image: jpg, png, Size<=2Mb
                if (isset($_FILES['image'])) {

                    if ($_FILES['image']['error'] > 0) {
                        echo " <span style='color: red;'> Không được để trống ảnh </span>";
                    } else {
                        $arr = array('jpg', 'png');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_tmp_name = $_FILES['image']['tmp_name'];
                        $file_check = pathinfo($file_name, PATHINFO_EXTENSION);

                        if ($file_size > 2000000) {
                            echo " <span style='color: red;'> Không up ảnh quá Size<=2Mb </span>";
                        } elseif (!in_array($file_check, $arr)) {
                            echo " <span style='color: red;'> Chỉ đc up ảnh dạng jpg và png </span>";
                        } else {
                            move_uploaded_file($file_tmp_name, '../img/' . $file_name);
                        }
                    }
                }

                //validate Price, quantity là số dương
                $error = array();
                if ($_POST['price'] < 0) {
                    $error['price'] = "nhập > 0";
                }
                if ($_POST['quantity'] < 0) {
                    $error['quantity'] = "nhập > 0";
                }

                if (empty($error)) {
                    $user->insert($_POST['product_name'], $_POST['price'], $_POST['quantity'], $file_name, $_POST['description'], $_POST['select']);
                }
            }
        }
        ?>

        <form action="" enctype="multipart/form-data" method="post">

            <label for="">product_name</label>
            <input type="text" name="product_name" class="form-control">

            <label for="">price</label>
            <input type="number" name="price" class="form-control">
            <!-- hiển thị lỗi -->
            <?php if (isset($error['price'])) { ?>
                <span style="color: red;"> <?php echo $error['price'] ?></span>
            <?php } ?><br>

            <label for="">quantity</label>
            <input type="number" name="quantity" class="form-control">
            <!-- hiển thị lỗi -->
            <?php if (isset($error['quantity'])) { ?>
                <span style="color: red;"> <?php echo $error['quantity'] ?></span>
            <?php } ?><br>

            <label for="">image</label>
            <input type="file" name="image" class="form-control">


            <label for="">description</label>
            <input type="text" name="description" class="form-control">

            <label for="">Cat_NAME</label>
            <select class="form-select" name="select" aria-label="Default select example">
                <!-- // Tên danh mục sản phẩm lấy từ database cho vào select box -->
                <?php
                $result = $user->getCate();
                if (!empty($result)) {
                    foreach ($result as $val) {
                ?>
                        <option value="<?php echo $val['cate_id'] ?>"> <?php echo $val['cate_name'] ?> </option>

                <?php }
                } ?>
            </select><br>

            <button type="submit" name="submit" class="btn btn-dark">Insert</button>
        </form>
    </div>
</body>

</html>