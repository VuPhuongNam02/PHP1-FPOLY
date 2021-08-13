<?php include_once "../config/config.php" ?>


<?php

class xuly extends database
{

    //lấy và hiển thị sản phẩm
    public function getData()
    {
        $data = null;
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //xóa sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE product_id = '$id'";
        $result = $this->conn->query($sql);
        header('location:table.php');
    }

    //thêm sản phẩm
    public function insert($product_name, $price, $quantity, $image, $description, $cate_id)
    {
        $sql = "INSERT INTO products (product_name,price,quantity,image,description,cate_id)
                VALUES ('$product_name','$price','$quantity','$image','$description','$cate_id')";
        $result = $this->conn->query($sql);
        header('location:table.php');
    }


    //lấy và hiển thị danh mục
    public function getCate()
    {
        $data = null;
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //hiển thị danh mục theo id của product
    public function getCateId($id)
    {
        $data = null;
        $sql = "SELECT * FROM categories
                JOIN products ON products.cate_id = categories.cate_id
                WHERE products.product_id = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }


    //sửa sản phẩm
    public function update($id, $product_name, $price, $quantity, $image, $description, $cate_id)
    {
        $sql  = "UPDATE products SET product_name = '$product_name',
                                  price = '$price',
                                  quantity = '$quantity',
                                image = '$image',
                                description = '$description',
                                cate_id = '$cate_id'
                            WHERE product_id = '$id'";

        $result = $this->conn->query($sql);
        header('location:table.php');
    }
}


?>