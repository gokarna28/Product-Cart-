<?php
include('submit.php');
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <main class="p-24 w-full flex  h-screen">
        <div class="bg-slate-200 items-center flex  w-full h-full">
            <!-- cart product -->
            <div class="bg-slate-300 p-4 flex flex-col space-y-6 w-3/12 h-full">
                <div class="flex space-x-10">
                    <h2 class="text-2xl font-medium">Cart</h2>
                    <button onclick="clearCart()" class="bg-red-600 text-white px-4 py-2">clear cart</button>
                </div>
                <div id="cart_items"></div>
                <div class="text-2xl font-medium">Total:Rs.<span id="total">0</span></div>
            </div>

            <div class="flex  w-3/4 h-full">
                <!-- fetch product -->
                <div class="flex w-full space-x-4  flex-wrap bg-stone-200 p-4">
                    <?php

                    $sql = "SELECT * FROM products";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="bg-gray-100 h-56">
                                    <div class="w-34 h-32 flex items-center justify-center">
                                        <img src="<?php echo $row['pro_image'] ?>" class="w-full h-full object-cover">
                                    </div>

                                    <p><?php echo $row['pro_name']; ?></p>
                                    <p><?php echo $row['price'] ?></p>
                                    <button data-name="<?php echo $row['pro_name']; ?>" ; data-price="<?php echo $row['price'] ?>" ;
                                        data-image="<?php echo $row['pro_image'] ?>" ; data-id="<?php echo $row['id'] ?>" ;
                                        class="AddtoCart_btn px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white add-to-cart">
                                        Add to Cart</button>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No products";
                        }
                    }
                    ?>

                </div>
                <div class="felx w-1/2 bg-gray-300 h-full p-4">
                    <!-- add product  -->
                    <h2 class="text-4xl font-medium">Add Product</h2>
                    <div class="w-full">
                        <form action="" method="post" enctype="multipart/form-data"
                            class="flex flex-col w-full items-center space-y-6 p-4">
                            <input class="border border-slate-400 w-full px-4 py-2" type="text" name="pro_name"
                                placeholder="Enter product nmae" required>
                            <input class="border border-slate-400 w-full px-4 py-2" type="number" name="price"
                                placeholder="Enter product price" required>
                            <input class="border border-slate-400 w-full px-4 py-2" type="file" name="image">
                            <button name="add_btn" class="hover:bg-blue-700 px-4 py-2 bg-blue-600 text-white"
                                type="submit">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="script.js"></script>
</body>

</html>