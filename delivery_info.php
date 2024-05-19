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
    <style>
        @media (max-width: 479.98px) {
            .max-title {
                font-size: 40px !important;
            }
        }
    </style>
</head>

<body>
    <?php include_once "components/header.php"; ?>
    <section id="delivery" class="bg-light">
        <div class="container-xxl">
            <h1 class="max-title">Условия доставки цветов курьером в Коломне</h1>
            <div class="dostavka">
                <p>«Цветочная феерия» — это цветочный магазин в Коломне, который выполнит доставку вашего заказа до
                    дверей
                    получателя и передаст букет лично в руки. У нас работает штат доброжелательных и пунктуальных
                    курьеров, готовых доставить цветы в любой район города. Мы подарим не только цветочную композицию,
                    но и искреннюю улыбку, и хорошее настроение.</p>
                <h2 class="min-title">Прием заказов</h2>
                <div class="row">
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d1.svg" class="img-fluid">
                        <div class="items-title">Круглосуточно</div>
                        <p>
                            Принимаем заказы в Коломне на доставку цветов круглый год: без перерывов и выходных.
                            Доставка вечером, ночью или утром — абсолютно бесплатно!
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d2.svg" class="img-fluid">
                        <div class="items-title">Любым удобным способом</div>
                        <p>
                            Онлайн или по звонку в контакт-центр
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d3.svg" class="img-fluid">
                        <div class="items-title">Удобная оплата</div>
                        <p>
                            Принимаем наличные, оплату по карте, через Сбербанк-онлайн.
                        </p>
                    </div>
                </div>
                <h2 class="min-title">Доставка</h2>
                <div class="row">
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d4.svg" class="img-fluid">
                        <div class="items-title">До дверей</div>
                        <p>
                            Наш курьер передаст букет лично в руки адресата, подарок не потеряется.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d5.svg" class="img-fluid">
                        <div class="items-title">Самовывоз</div>
                        <p>
                            Вы можете забрать цветы из нашего магазина, если хотите лично поздравить.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                        <img src="images/icons/d6.svg" class="img-fluid">
                        <div class="items-title">Информирование</div>
                        <p>
                            О статусе выполнения заказа можно узнать по СМС, электронной почте, в личном кабинете или по
                            звонку в «Цветоманию».
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>