<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI amwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Catalog</title>
</head>

<body id="catalog">
    <?php include_once "components/header.php";
    include_once "config/core.php";
    include_once "config/database.php";
    include_once "objects/product.php";
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $stmt = $product->readAll($from_record_num, $records_per_page);
    $userRole = isset ($_SESSION['role']) ? $_SESSION['role'] : 0;
    $page_url = "catalog_bukets.php?";
    $total_rows = $product->countAll();
    ?>
    <section id="cards" class="bg-light" style="padding-top:40px">
        <?php
        include_once "config/database.php";
        include_once "objects/product.php";
        include_once "objects/category.php";
        $database = new Database();
        $db = $database->getConnection();

        $product = new Product($db);

        $page = isset ($_GET['page']) ? $_GET['page'] : 1;
        $records_per_page = 4; // количество записей на странице
        $start_from = ($page - 1) * $records_per_page;

        // Получаем данные о товарах
        $stmt = $product->readAll($start_from, $records_per_page, 5);

        // Проверяем, есть ли товары для вывода
        if ($stmt->rowCount() > 0) {
            // Начинаем вывод карточек товаров
            echo "<div class='container-xxl'>";

            echo "<div class='row'>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Выводим карточку товара
                echo "<div class='col-md-3'>";
                echo "<div class='card' style='width: 18rem; border:none;'>";
                if (isset ($row['image']) && !empty ($row['image'])) {
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

            // Завершаем контейнер для карточек товаров
            echo "</div>";
            echo "</div>";
            include_once "paging.php";
        } else {
            // Если нет товаров, выводим сообщение об отсутствии товаров
            echo "<p>Нет доступных товаров.</p>";
        }
        ?>
        <?php include_once "components/prem.php"; ?>
    </section>
    <?php include_once "components/footer.php"; ?>
</body>

</html>