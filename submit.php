<?php

include('connection.php');

if (isset($_POST['add_btn'])) {

    // Image upload
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "uploads/" . $filename;
    move_uploaded_file($tempname, $folder);

    $name = $_POST['pro_name'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products(pro_name, price, pro_image) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sis", $name, $price, $folder);

        if ($stmt->execute()) {
            echo "<script>alert('successfully product added')</script>";
        } else {
            echo 'failed to add the product';
        }
    }

}