<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Footer</title>
    <style>
        @media (max-width: 991.98px) {
            .col-md-3 {
                text-align: center;
                justify-content: center;
                display: grid;
                margin-top: 20px;
            }

            .col-md-6 {
                text-align: center;
            }

            .footer-pay {
                justify-content: center;
            }

            .lic {
                text-align: center;
                display: contents;
            }

            .footer-reg-log {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container-xxl" style="padding-top: 50px;">
        <section id="footer">
            <div class="row">
                <div class="col-md-3">
                    <a href="#"><img src="images/image/logo1 копия.png" class="img-fluid" width="200" height="54"></a>
                    <p class="footer-title">Мы доставляем цветы и подарки бесплатно и круглосуточно в Коломне</p>
                    <div class="d-flex footer-reg-log"><a class="login" href="login.php">Вход/</a><a class="login" href="registr.php">
                            Регистрация</a></div>
                </div>
                <div class="col-md-3 d-grid justify-content-center">
                    <h3 class="widget-title">Навигация</h3>
                    <nav class="navbar navbar-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about_info.php">О компании</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog.php">Каталог</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="delivery_info.php">Доставка</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="payment_info.php">Оплата</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contacts.php">Контакты</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h3 class="widget-title">Каталог товаров</h3>
                    <nav class="navbar navbar-light d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_bukets.php">Букеты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_poschtuchno.php">Цветы поштучно</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_korobki.php">Цветы в коробке</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_korzina.php">Корзины с цветами</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_prazdnik.php">Праздничные букеты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_podarki.php">Подарки и игрушки</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h3 class="widget-title">Контакты</h3>
                    <a class="nav-link-phone" href="#">8 (937) 402-22-13</a>
                    <div class="time">Режим работы - круглосуточно</div>
                    <a class="mail" href="#">kate@loveflowers24.ru</a>
                    <div class="adres">Адрес: г. Коломна, ул. Центральная, 9</div>
                    <div class="soc">
                        <a class="soc-icon" href="#"><img src="images/icons/vk.svg" width="30" height="30"
                                class="img-fluid"></a>
                        <a class="soc-icon" href="#"><img src="images/icons/ws.svg" width="30" height="30"
                                class="img-fluid"></a>
                        <a class="soc-icon" href="#"><img src="images/icons/tl.svg" width="30" height="30"
                                class="img-fluid"></a>
                    </div>
                    <div class="footer-payments">Способы оплаты:</div>
                    <div class="footer-pay">
                        <img class="img-fluid" src="images/icons/mastercard.svg">
                        <img class="img-fluid" src="images/icons/visa.svg">
                        <img class="img-fluid" src="images/icons/mir.svg">
                        <img class="img-fluid" src="images/icons/sber.svg">
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-md-6">
                    <div class="lic">© <a href="#">Доставка цветов в Коломне «Цветочная феерия»,</a> 2024</div>
                </div>
                <div class="col-md-6">
                    <a href="#" class="poly">Политика конфиденциальности</a>
                </div>
            </div>
        </section>
    </div>
</body>

</html>