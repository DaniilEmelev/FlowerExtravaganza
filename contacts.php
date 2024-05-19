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
    <script src="https://api-maps.yandex.ru/2.1/?apikey=bdad3242-e1f8-425f-a2da-dd903d32a1c9&lang=ru_RU"
        type="text/javascript"></script>
    <title>Contacts</title>
    <style>
        @media (max-width: 991.98px) {
            .contpage {
                margin-bottom: 25px;
            }
        }
    </style>
</head>

<body>
    <?php include_once "components/header.php"; ?>
    <section id="contacts" class="bg-light pb-4">
        <div class="container-xxl">
            <h1 class="max-title">Контакты</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-flex flex-column text-left h-100">
                        <div class="contpage w-55 h-100">
                            <div class="item mb-5 mt-3">
                                <div class="cont-title">Круглосуточная доставка</div>
                                <p class="phone">8 (937) 402-22-13</p>
                            </div>
                            <div class="item mb-5">
                                <div class="cont-title">Круглосуточная доставка</div>
                                <p class="contact-city">г. Коломна</p>
                            </div>
                            <div class="item">
                                <div class="cont-title">Электронная почта</div>
                                <p><a class="mail" href="#">kate@loveflowers24.ru</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="map" style="width: 100%; height: 350px;"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<script>
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map", {
            center: [55.095276, 38.765574],
            zoom: 10
        });

        var myPlacemark = new ymaps.Placemark([55.116475, 38.686029], {
            hintContent: 'Наш магазин',
            balloonContent: 'Это наш магазин!'
        });

        myMap.geoObjects.add(myPlacemark);
    }
</script>


</html>