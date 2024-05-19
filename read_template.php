<?php
session_start();
?>
<?php

include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 4; // количество записей на странице
$start_from = ($page - 1) * $records_per_page;
$stmt = $product->readAll($start_from, $records_per_page);
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;

// Проверяем, есть ли товары для вывода
if ($stmt->rowCount() > 0) {
    // Начинаем вывод карточек товаров
    echo "<div class='container'>";
    echo "<div class='row'>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Выводим карточку товара
        echo "<div class='col-lg-3 col-md-4 col-sm-6 col-12'>";
        echo "<div class='card border-0'>";
        if (isset($row['image']) && !empty($row['image'])) {
            echo "<a href='read_product.php?id={$row['id']}' class='card-photo'><img src='uploads/{$row['image']}' class='card-img-top'></a>";
        } else {
            echo "Изображение не найдено.";
        }
        echo "<div class='card-body bg-light text-start'>";
        echo "<h5 class='card-title' style='font-size:25px; font-weight:700; text-align:left;'>{$row['price']} руб.</h5>";
        echo "<p class='card-text'><a href='#' style='text-decoration:none; color:gray;'>{$row['name']}</a></p>";
        if ($userRole == 2) {
            echo "<a href='update_product.php?id={$row['id']}' class='btn btn-info left-margin'>";
            echo "<span class='glyphicon glyphicon-edit'></span> Редактировать";
            echo "</a>";

            echo "<form method='post' action='delete_product.php'>";
            echo "<input type='hidden' name='object_id' value='{$row['id']}' />";
            echo "<button type='submit' class='btn btn-primary delete-object'>";
            echo "<span class='glyphicon glyphicon-remove'></span> Удалить";
            echo "</button>";
            echo "</form>";
        }
        echo "<a href='read_product.php?id={$row['id']}' class='btn btn-danger buy-button'>Заказать</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";

    include_once "paging.php";
} else {
    echo "<p>Нет доступных товаров.</p>";
}
?>