<?php
session_start();
$authorized = isset($_SESSION['id']);
$auth_message = '<div class="alert alert-danger">Чтобы воспользоваться корзиной, пожалуйста, <a class="login-alert" href="login.php">пройдите авторизацию</a>.</div>';
$total_amount = '';
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
    <title>Корзина</title>
    <style>
        @media (max-width: 991.98px) {
            .adaptiv-btn {
                display: flex;
                justify-content: center;
            }
        }

        @media (max-width: 780px) {
            .table-responsive {
                overflow-x: auto;
            }

            .table {
                display: block;
                width: 100%;
                overflow-y: hidden;
                margin: 0 auto;
            }

            .table tbody,
            .table tr,
            .table td,
            .table th {
                display: block;
            }

            .table td,
            .table th {
                width: 100%;
                text-align: center;
            }

            .table thead {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include_once "components/header.php" ?>
    <section id="basket" class="bg-light">
        <div class="container-xxl">
            <h2 class="max-title">Оформление заказа</h2>
            <h3 class="text-center" style="font-size:26px">Мой заказ с доставкой в г. Коломна</h3>
            <?php if ($authorized): ?>
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <div class="table-responsive">
                        <table class="basket-table table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Товар</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Сумма</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: white;">
                                <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
                                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                                        <tr>
                                            <td class="product-remove"><a class="remove" href="#" data-index="<?= $index ?>">×</a></td>

                                            <td class="product-image d-flex justify-content-center"><a href="#"><img
                                                        src="<?= isset($item['image']) ? $item['image'] : '' ?>" class="img-fluid"
                                                        alt="Product Image" style="max-width: 100px; height: auto;"></a></td>
                                            <td class="product-name">
                                                <a href="#">
                                                    <?= isset($item['name']) ? $item['name'] : '' ?>
                                                    <div>Упаковка: +
                                                        <?= isset($item['pprice']) ? $item['pprice'] : 0 ?>
                                                        руб.
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="product-price">
                                                <?= isset($item['price']) ? $item['price'] : '' ?> руб.
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity-input justify-content-center">
                                                    <button class="quantity-btn minus">-</button>
                                                    <input type="number" class="quantity form-control"
                                                        value="<?= isset($item['quantity']) ? $item['quantity'] : 1 ?>">
                                                    <button class="quantity-btn plus">+</button>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <?= isset($item['price']) && isset($item['packaging']['price']) && isset($item['quantity']) ? (($item['price'] + $item['packaging']['price']) * $item['quantity']) : 0 ?>
                                                руб.
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Итоговая сумма заказа:</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount"
                            value="<?= $total_amount ?> руб." readonly>
                    </div>
                    <form id="order_form" action="process_order.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя получателя*:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон получателя*:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес получателя*:</label>
                            <textarea class="form-control" id="address" name="address" rows="1" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="delivery_date" class="form-label">Дата доставки*:</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                                value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="delivery_time" class="form-label">Время доставки*:</label>
                            <input type="text" class="form-control" id="delivery_time" name="delivery_time"
                                placeholder="13:00-15:00" required>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Примечание к заказу:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>

                        <div id="total_amount_display"></div>

                        <input type="hidden" name="total_amount_hidden" id="total_amount_hidden">
                        <div class="adaptiv-btn">
                            <button type="submit" class="basket-btn btn btn-danger">Подтвердить заказ</button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-info">Ваша корзина пока пуста.</div>
                <?php endif; ?>
            <?php else: ?>
                <?= $auth_message ?>
            <?php endif; ?>

        </div>
    </section>
    <?php include_once "components/footer.php" ?>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function () {
            var cart = <?= isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : '[]' ?>;

            function calculateTotalAmount() {
                var totalAmount = 0;
                cart.forEach(function (item) {
                    totalAmount += calculateSubtotal(item);
                });
                return totalAmount;
            }

            function calculateSubtotal(item) {
                var total = (parseInt(item.price) * parseInt(item.quantity)) + parseInt(item.pprice);
                return total;
            }

            function updateTotalAmountInSession(totalAmount) {
                $.ajax({
                    url: 'objects/Cart.php',
                    method: 'POST',
                    data: { action: 'update_total_amount', totalAmount: totalAmount },
                    success: function (response) {
                        console.log('Общая сумма заказа обновлена в сессии:', response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Ошибка при обновлении общей суммы заказа:', error);
                    }
                });
            }

            function updateProductImages() {
                $('.basket-table tbody tr').each(function (index) {
                    var item = cart[index];
                    var imageSrc = item.image;
                    $(this).find('.product-image img').attr('src', imageSrc);
                });
            }

            function updateProductImagesInSession() {
                $.ajax({
                    url: 'objects/Cart.php',
                    method: 'POST',
                    data: { action: 'update_product_images', cart: cart },
                    success: function (response) {
                        console.log('Изображения товаров обновлены в сессии:', response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Ошибка при обновлении изображений товаров:', error);
                    }
                });
            }





            function displayCart() {
                // Обновляем счетчик и сумму для каждого товара
                $('.basket-table tbody tr').each(function (index) {
                    var item = cart[index];
                    var subtotal = calculateSubtotal(item);
                    $(this).find('.product-subtotal').text(subtotal + ' руб.');
                    $(this).find('.quantity').val(item.quantity);

                    // Обновляем атрибут data-index у ссылок на удаление товара
                    $(this).find('.product-remove .remove').attr('data-index', index); // Заменяем item.id на index
                });
                // Обновляем общую сумму заказа
                var totalAmount = calculateTotalAmount();
                $('#total_amount').val(totalAmount + ' руб.');
                $('#total_amount_hidden').val(totalAmount); // Обновляем значение скрытого поля
                updateTotalAmountInSession(totalAmount); // Отправляем обновленную сумму на сервер
            }

            $('.basket-table').on('click', '.quantity-btn.minus', function () {
                var index = $(this).closest('tr').index();
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                    sessionStorage.setItem('cart', JSON.stringify(cart));
                    displayCart();
                }
            });

            $('.basket-table').on('click', '.quantity-btn.plus', function () {
                var index = $(this).closest('tr').index();
                cart[index].quantity++;
                sessionStorage.setItem('cart', JSON.stringify(cart));
                displayCart();
            });

            $('.basket-table').on('change', '.quantity', function () {
                var index = $(this).closest('tr').index();
                var newQuantity = parseInt($(this).val());
                if (!isNaN(newQuantity) && newQuantity > 0) {
                    cart[index].quantity = newQuantity;
                    sessionStorage.setItem('cart', JSON.stringify(cart));
                    displayCart();
                } else {
                    $(this).val(cart[index].quantity);
                }
            });

            $('.basket-table').on('click', '.product-remove .remove', function () {
                var index = $(this).data('index'); // Получаем индекс товара из атрибута data-index
                cart.splice(index, 1); // Удаляем товар из корзины
                // Отправляем запрос на сервер для удаления товара из сессии
                $.ajax({
                    url: 'objects/Cart.php',
                    method: 'POST',
                    data: { action: 'remove', index: index },
                    success: function (response) {
                        console.log('Товар удален из сессии:', response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('Ошибка, товар не был удален:', error);
                    }
                });
                displayCart(); // Обновляем отображение корзины
            });
            // Инициализация при загрузке страницы
            displayCart();
            updateProductImages();
            updateProductImagesInSession();
        });


    </script>

</body>

</html>