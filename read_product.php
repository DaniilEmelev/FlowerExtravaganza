<?php
session_start();

$authorized = isset($_SESSION['id']);

if (!$authorized) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        integrity="sha384-QJHtvGhmr9XOIpIamwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Product</title>
</head>

<body>
    <?php include_once "components/header.php" ?>
    <section id="product" class="bg-light">
        <div class="container-xxl">
            <?php
            include_once "config/database.php";
            include_once "objects/product.php";
            include_once "objects/category.php";

            $database = new Database();
            $db = $database->getConnection();


            $product = new Product($db);

            $product->id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");
            $id = $product->id;
            $product->readOne();
            ?>
            <h2 class="max-title">
                <?= $product->name ?>
            </h2>
            <div class="products d-flex justify-content-center align-items-stretch">
                <div class="col-md-6 mb-3">
                    <div class="product-left">
                        <div class="card" style="border:none;">
                            <img src='uploads/<?php echo $product->image ?>' class="card-img-top" width="600"
                                height="600">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 align-items-stretch">
                    <div class="product-right">
                        <p class="price" data-base-price="<?= $product->price ?>">
                            <?= $product->price ?> руб.
                        </p>

                        <h4 class="utitle">Упаковка</h4>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_1">
                                <input id="uk_radio_1" type="radio" name="uk_radio" value="0" checked>
                                Без упаковки (0 руб.)
                            </label>
                        </div>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_2">
                                <input id="uk_radio_2" type="radio" name="uk_radio" value="50">
                                Атласная лента (50 руб.)
                            </label>
                        </div>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_3">
                                <input id="uk_radio_3" type="radio" name="uk_radio" value="100">
                                Пленка (100 руб.)
                            </label>
                        </div>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_4">
                                <input id="uk_radio_4" type="radio" name="uk_radio" value="200">
                                Крафт (200 руб.)
                            </label>
                        </div>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_5">
                                <input id="uk_radio_5" type="radio" name="uk_radio" value="150">
                                Сетка (150 руб.)
                            </label>
                        </div>
                        <div class="uk-margin-small-top">
                            <label class="d-flex align-items-center" for="uk_radio_6">
                                <input id="uk_radio_6" type="radio" name="uk_radio" value="200">
                                Пленка матовая (200 руб.)
                            </label>
                        </div>

                        <div class="quantity-input">
                            <button class="quantity-btn minus">-</button>
                            <input type="number" class="quantity" value="1">
                            <button class="quantity-btn plus">+</button>
                            <button class="btn btn-danger order-btn">Заказать</button>
                        </div>

                        <div class="gar">
                            <img src="images/icons/garantia-kachestva.svg" width="88" height="60">
                            <div class="gar-right">
                                <div class="gar-title">Внимание!</div>
                                <div class="gar-text">Цена указана за 1 шт.</div>
                            </div>
                        </div>


                        <div class="payments">
                            <span style="color: #B9B9B9; font-size: 12px;">Простая оплата:</span>
                            <img src="images/icons/mastercard.svg" width="37" height="25">
                            <img src="images/icons/visa.svg" width="37" height="25">
                            <img src="images/icons/mir.svg" width="37" height="25">
                            <img src="images/icons/sber.svg" width="40" height="25">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once "components/footer.php" ?>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('.order-btn').on('click', function () {
                var productName = $('.max-title').text().trim();
                var productImage = $('.card-img-top').attr('src');
                var productPrice = parseFloat($('.price').attr('data-base-price'));
                var packagingName = $('input[name="uk_radio"]:checked').next().text();
                var packagingPrice = parseFloat($('input[name="uk_radio"]:checked').val());
                var quantity = parseInt($('.quantity').val());

                var productData = {
                    name: productName,
                    image: productImage,
                    price: productPrice,
                    pprice: packagingPrice,
                    quantity: quantity
                };

                $.ajax({
                    url: 'objects/Cart.php',
                    method: 'POST',
                    data: { action: 'add', productData: productData },
                    success: function (response) {
                        window.location.href = 'basket.php';
                    },
                    error: function (xhr, status, error) {
                        console.error('Произошла ошибка при добавлении товара в корзину');
                    }
                });
            });
        });
    </script>


</body>

</html>