<?php
session_start();
?>
<?php

include_once "config/core.php";

include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

require_once "components/header.php";

echo "<section class='bg-light' style='padding-top:50px'>";

echo "<div class='container-xxl'>";

$search_term = isset($_GET["s"]) ? $_GET["s"] : '';

if (!empty($search_term)) {
    $stmt = $product->search($search_term, $from_record_num, $records_per_page);
    $num = $stmt->rowCount();

    $page_url = "search.php?s={$search_term}&";

    // подсчитываем общее количество строк - используется для разбивки на страницы
    $total_rows = $product->countAll_BySearch($search_term);

    // Проверяем, есть ли товары для вывода
    if ($stmt->rowCount() > 0) {
        // Начинаем вывод карточек товаров
        echo "<div class='container'>";
        echo "<div class='row'>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-lg-3 col-md-4 col-sm-6 col-12'>";
            echo "<div class='card border-0'>";
            if (isset($row['image']) && !empty($row['image'])) {
                echo "<a href='#' class='card-photo'><img src='uploads/{$row['image']}' class='card-img-top'></a>";
            } else {
                echo "Изображение не найдено.";
            }
            echo "<div class='card-body bg-light text-start'>";
            echo "<h5 class='card-title' style='font-size:25px; font-weight:700; text-align:left;'>{$row['price']} руб.</h5>";
            echo "<p class='card-text'><a href='#' style='text-decoration:none; color:gray;'>{$row['name']}</a></p>";
            echo "<a href='#' class='btn btn-danger buy-button'>Заказать</a>";
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
} else {
    echo "<p class='text-center'>Введите поисковый запрос для продолжения.</p>";
}

echo "</div>";

include_once "components/prem.php";
echo "</section>";
require_once "components/footer.php";
?>