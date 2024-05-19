<?php
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <section id="prem" class="bg-light" style="padding-bottom: 50px">
        <div class="container-xxl">
            <h2 class="max-title text-center">Преимущества</h2>
            <div class="row">
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="prem-card d-flex flex-column align-items-center h-100">
                        <div class="prem-icon"><img src="images/icons/prem1.svg"></div>
                        <div class="prem-card-text text-start">
                            <div class="prem-card-title">Гарантии</div>
                            <ul class="markers">
                                <li><span>Только свежие цветы высокого качества</span></li>
                                <li><span>Букет как на фото на сайте</span></li>
                                <li><span>Сборка букета профессиональными флористами</span></li>
                                <li><span>Фото перед доставкой</span></li>
                                <li><span>Информирование о статусе заказа</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="prem-card d-flex flex-column align-items-center h-100">
                        <div class="prem-icon"><img src="images/icons/prem2.svg"></div>
                        <div class="prem-card-text text-start">
                            <div class="prem-card-title">Сервис</div>
                            <ul class="markers">
                                <li><span>Оформление заказа за 1 минуту</span></li>
                                <li><span>Бесплатная упаковка</span></li>
                                <li><span>Быстрые курьеры</span></li>
                                <li><span>Бесплатно и точно ко времени</span></li>
                                <li><span>В любое время дня и ночи</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>

</html>