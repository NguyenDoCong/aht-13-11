<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="price">Giá:</label><br>
        <input type="text" id="price" name="price"><br>
        <label for="quantity">Số lượng:</label><br>
        <input type="text" id="quantity" name="quantity"><br>
        <input type="submit" name="add" value="Thêm sản phẩm"><br><br>
        <input type="submit" name="display" value="Hiển thị danh sách sản phẩm"><br><br>
        <input type="submit" name="sort" value="Sắp xếp"><br><br>
    </form>

    <form action="" method="get">
        <label for="keyword">Từ khóa:</label><br>
        <input type="text" id="keyword" name="keyword"><br>
        <input type="submit" name="search" value="Tìm kiếm"><br><br>
    </form>
    <?php

    function getProducts()
    {
        $data = file_get_contents('products.json');
        return json_decode($data, true);
    }

    $products = getProducts();

    function saveProducts($products)
    {
        file_put_contents('products.json', json_encode($products));
    }

    $name = "";
    $price = 0;
    $quantity = 0;

    function addProduct($name, $price, $quantity)
    {
        global $products;
        if (!empty($name) && !empty($price) && !empty($quantity) && is_numeric($price) && is_numeric($quantity)) {
            array_push($products, ["name" => $name, "price" => $price, "quantity" => $quantity]);
            saveProducts($products);
        }
        print_r($products);
    }

    function displayProducts($products)
    {
    ?>
        <div>
            <?php
            global $products;

            foreach ($products as $item => $product) : ?>
                <p>
                    <span>
                        <?php echo $product["name"]; ?>
                    </span>
                    <span>
                        <?php echo $product["price"]; ?>
                    </span>
                    <span>
                        <?php echo $product["quantity"]; ?>
                    </span>
                    <span>
                </p>
            <?php endforeach; ?>
        </div>
    <?php
    }

    function searchProduct($products, $keyword)
    {
        global $products; ?>
        <div>
            <?php
            foreach ($products as $item => $product) :
                if (str_contains(strtolower($product['name']), $keyword)): ?>
                    <p>
                        <span>
                            <?php echo $product["name"]; ?>
                        </span>
                        <span>
                            <?php echo $product["price"]; ?>
                        </span>
                        <span>
                            <?php echo $product["quantity"]; ?>
                        </span>
                        <span>
                    </p>
            <?php endif;

            endforeach;
            ?>
        </div>
    <?php
    }

    function sortProductsByName($products)
    {
        global $products;
        function cmp($a, $b)
        {
            return strcmp($a["name"], $b["name"]);
        }

        usort($products, "cmp");    ?>
        <div>
            <?php
            foreach ($products as $item => $product) : ?>
                <p>
                    <span>
                        <?php echo $product["name"]; ?>
                    </span>
                    <span>
                        <?php echo $product["price"]; ?>
                    </span>
                    <span>
                        <?php echo $product["quantity"]; ?>
                    </span>
                    <span>
                </p>
            <?php
            endforeach;
            ?>
        </div>

    <?php

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        global $products;
        if (isset($_POST['add'])) :
            $name = $_POST["name"];
            $price = $_POST["price"];
            $quantity = $_POST["quantity"];
            addProduct($name, $price, $quantity);
        elseif (isset($_POST['display'])) :
            displayProducts($products);
        elseif (isset($_POST['sort'])) :
            sortProductsByName($products);
        endif;
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["keyword"])) :
            $keyword = strtolower($_GET["keyword"]);
            searchProduct($products, $keyword);
        endif;
    }
    ?>

</body>

</html>