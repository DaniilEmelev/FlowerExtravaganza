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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>About</title>
</head>
<style>
    @media (max-width: 991.98px) {
        .adaptiv-text {
            text-align: center;
        }

        .adaptiv-el {
            margin-bottom: 25px;
        }
    }
    @media (max-width: 479.98px) {
            .max-title{
                font-size: 40px !important;
            }
        }

</style>

<body>
    <?php include_once "components/header.php"; ?>
    <section id="about_info" class="bg-light pb-4">
        <div class="container-xxl">
            <h1 class="max-title">О компании – Интернет-магазин «Цветомания»</h1>
            <div class="row">
                <div class="col-lg-6 d-flex flex-column text-left">
                    <p>«Цветочная феерия» - профессиональная служба доставки цветов на дом, в офис и по любому адресу в
                        Москве. С нами вы сможете отправить поздравление близким, знакомым и коллегам, где бы они ни
                        находились.</p>
                    <p>В каталоге вы найдете букеты для любого случая:</p>
                    <ul>
                        <li>день рождения;</li>
                        <li>юбилей;</li>
                        <li>выпускной;</li>
                        <li>свадьба;</li>
                        <li>комплимент любимой девушке.</li>
                    </ul>
                    <p>Возьмем все заботы на себя, а вам останется только выбрать букет, который составили опытные
                        флористы.</p>
                </div>
                <div class="col-lg-6 d-flex flex-column text-left">
                    <div class="row adaptiv-text">
                        <div class="col-lg-6">
                            <div class="item">
                                <div class="about-num">10 лет</div>
                                в доставке цветов
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="item">
                                <div class="about-num">более 50 доставков</div>
                                ежедневно в Коломне
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-5 mt-md-0">
                            <div class="item">
                                <div class="about-num">700 поздравлений</div>
                                уже доставлены
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line">
                Строго контролируем все этапы упаковки и доставки цветочных композиций: от выбора цветов на плантациях у
                надежных поставщиков до сборки букета и доставки его получателю.
            </div>
            <div class="row">
                <div class="col-md-6 adaptiv-el">
                    <img class="img-fluid" src="images/image/about1.jpg">
                </div>
                <div class="col-md-6 d-flex align-items-center  adaptiv-el">
                    <div>
                        <h2 class="text-center">Удобство</h2>
                        <ul class="text-left">
                            <li>Доставка в Коломне – в любое место: где бы ни были вы, где бы ни находились люди,
                                которых
                                вы хотите поздравить, цветы будут вручены.</li>
                            <li>Круглосуточный прием заказов онлайн на сайте или по телефону контакт-центра.</li>
                            <li>Точный расчет стоимости сразу же при заказе.</li>
                            <li>Большой выбор способов оплаты: переводом, по карте, по реквизитам, и пр.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex align-items-center  adaptiv-el">
                    <div>
                        <h2 class="text-center">Надежность</h2>
                        <ul class="text-left">
                            <li>Ваш букет в любой точке Коломны будет одинаково хорош и на 100% свеж.</li>
                            <li>Гарантируем высокое качество: проверяем каждый цветок при сборке композиции.
                            </li>
                            <li>Фотоконтроль: при желании клиента сфотографируем композицию после составления и при
                                доставке с получателем.</li>
                            <li>Персональные данные надежно защищены: мы не разглашаем информацию о клиентах, их
                                покупках, адресах вручения.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 adaptiv-el">
                    <img class="img-fluid" src="images/image/about2.jpg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 adaptiv-el">
                    <img class="img-fluid" src="images/image/about3.jpg">
                </div>
                <div class="col-md-6 d-flex align-items-center  adaptiv-el">
                    <div>
                        <h2 class="text-center">Выгода</h2>
                        <ul class="text-left">
                            <li>Мы регулярно проводим акции, которые помогают заказывать букеты в Москве с
                                максимальной выгодой.</li>
                            <li>Вы экономите время на подбор композиции и хождение по цветочным лавкам: все наши
                                предложения можно посмотреть онлайн за несколько минут, не выходя из дома.</li>
                            <li>Бонусная система для постоянных покупателей.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="line">
                С нашими цветами вы можете быть уверены, что ваши чувства будут переданы максимально точно, поздравления
                будут доставлены вовремя, а свежая композиция будет долгое время радовать получателя.
            </div>
        </div>
    </section>
    <?php include_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>