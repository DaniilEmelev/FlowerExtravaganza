<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Oplata</title>
</head>

<body>
    <?php include_once "components/header.php"; ?>
    <section id="payment" class="bg-light">
        <div class="container-xxl">
            <h1 class="max-title">Оплата за доставку цветов в Коломне</h1>
            <div class="oplata">
                <div class="oplata-title">
                    Магазин цветов «Цветочная феерия» принимает оплату заказов в Коломне несколькими удобными способами.
                </div>
                <div class="row">
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/o1.svg" class="items-image">
                        <div class="items-title">Банковская карта</div>
                        <p>
                            Принимаем оплату через специальный сервис, который позволяет расплачиваться
                            картами любых банков.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/o2.svg" class="items-image">
                        <div class="items-title">Перевод через Сбербанк</div>
                        <p>
                            Принимаем в качестве оплаты переводы через Сбербанк онлайн по номеру карты или телефона.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/o3.svg" class="items-image" width="86" height="80">
                        <div class="items-title">Оплата наличными</div>
                        <p>
                            Принимаем к оплате наличные различных купюр от рублей - до евро.
                        </p>
                    </div>
                </div>
                <div class="mes">
                    <div>
                        <img src="images/icons/inf.svg">
                    </div>
                    <div class="mes-text">
                        <strong>Важно!</strong> Заказы, сделанные онлайн в ночное время, поступают в обработку только на
                        следующее утро. Поэтому букет будет доставлен по нужно адресу в пределах Коломны на следующий
                        день.
                        <p><strong>Обратите внимание:</strong> На данный момент мы не принимаем онлайн оплату на сайте.
                            Все
                            платежи производятся при получении заказа.</p>
                    </div>
                </div>
                <h2 class="min-title">Оплата и подтверждение заказа</h2>
                <p>Оплата производится в несколько шагов:</p>
                <ol>
                    <li>Выберите понравившиеся букеты и добавьте их в «Корзину».</li>
                    <li>Перейдите в «Корзину», укажите адрес доставки в Коломне и имя получателя.</li>
                    <li>Заполните контактную информацию для связи с вами.</li>
                    <li>Проверьте заказ и стоимость доставки, которая будет автоматически рассчитана после ввода адреса.
                    </li>
                    <li>Выберите опцию оплаты при получении и завершите оформление заказа.</li>
                </ol>
                <p style="padding-bottom:50px">После поступления заказа в обработку, вам перезвонит наш менеджер для подтверждения заказа и
                    возможного
                    уточнения деталей.</p>
            </div>
    </section>
    <?php include_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>