<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["object_id"])) {

    include_once "config/database.php";
    include_once "objects/product.php";

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    $product->id = $_POST["object_id"];

    if ($product->delete()) {
        header("Location: catalog.php");
    }
    else {
        echo "Невозможно удалить товар";
    }
}
?>