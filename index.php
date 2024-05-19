<?php
session_start();
ob_start();
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";
include_once "config/core.php";
include_once "objects/user.php";
include_once "objects/orders.php";

$database = new Database();
$db = $database->getConnection();
?>
<!doctype html>
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
        integrity="sha384-QJHtvGhmr9XOIpI amwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>Flowers</title>
    <style>
        @media (max-width: 991.98px) {
            .slide-left {
                width: 100%;
            }

            .slide-right {
                display: none !important;
            }

            .slide-btns,
            .about-items {
                display: flex;
                justify-content: center;
            }

            .adaptiv-text,
            .slide-title,
            .slide-text,
            .about-title {
                text-align: center !important;
            }

            .adaptiv-list {
                text-align: left !important;
            }

            .about-items,
            .zakaz-adaptiv {
                margin-bottom: 25px;
            }

        }

        @media (max-width:499.98px) {
            .slide-btns {
                flex-direction: column;
            }

            .slide-btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .max-title {
                font-size: 40px !important;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once "components/header.php"; ?>
    <section class="bg-light" id="slide" style="padding-bottom: 50px;">
        <div class="container-xxl">
            <div class="row slide-max">
                <div class="col-lg-6 slide-left">
                    <h1 class="slide-title">Доставка цветов в г. Коломна</h1>
                    <div class="slide-text">Свежие живые цветы и более 1000 букетов с бесплатной доставкой по всем
                        районам Коломны. В интернет—магазине можно заказать цветочные букеты по низким ценам или выбрать
                        VIP-композиции. Дарите радость круглосуточно вместе с «Цветочной феерией»</div>

                    <div class="slide-btns">
                        <a href="catalog.php" class="btn btn-danger slide-btn">Перейти в каталог</a>
                        <a href="#zakaz" class="btn btn-secondary slide-btn">Купить уникальный букет</a>
                    </div>
                    <div class="prem-text">
                        <div class="row adaptiv-text">
                            <div class="col-md-4">
                                <div class="prem-item">
                                    <h2 class="prem-title">Быстрая доставка</h2>
                                    <div class="prem-desc">В течение 1 часа от заказа до вручения или привезем ко
                                        времени</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="prem-item">
                                    <h2 class="prem-title">Гарантия свежести</h2>
                                    <div class="prem-desc">Исключительно свежие цветы, букет как на сайте</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="prem-item">
                                    <h2 class="prem-title">Уникальные букеты</h2>
                                    <div class="prem-desc">Соберем любую композицию по вашему желанию</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 slide-right">
                    <img src="images/image/slide.png" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <?php include_once "components/prem.php"; ?>
    <section id="catalog" class="bg-light">
        <div class="container-xxl">
            <h2 class="max-title mb-3">Каталог цветов и букетов</h2>
            <div class="row justify-content-center text-center">
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_bukets.php' class='card-photo'><img src="images/image/catalog-buket.jpg"
                                    class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_bukets.php" style="text-decoration:none;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Букеты</h5>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_poschtuchno.php' class='card-photo'><img
                                    src="images/image/catalog-poshtuchno.jpg" class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_poschtuchno.php" style="text-decoration:none; margin-bottom: 20px;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Цветы
                            поштучно</h5>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_korobki.php' class='card-photo'><img src="images/image/catalog-korobka.jpg"
                                    class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_korobki.php" style="text-decoration:none;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Цветы в
                            коробке</h5>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_korzina.php' class='card-photo'><img src="images/image/catalog-korzina.jpg"
                                    class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_korzina.php" style="text-decoration:none;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Корзины с
                            цветами</h5>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_prazdnik.php' class='card-photo'><img
                                    src="images/image/catalog-prazdnik.jpg" class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_prazdnik.php" style="text-decoration:none;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Праздничные
                            букеты</h5>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card" style="border:none; border-radius: 50% !important;">
                        <div class="rounded-circle" style="overflow: hidden; margin-bottom: 20px;">
                            <a href='catalog_podarki.php' class='card-photo'><img src="images/image/catalog-podarki.jpg"
                                    class="card-img-top"></a>
                        </div>
                    </div>
                    <a href="catalog_podarki.php" style="text-decoration:none;">
                        <h5 class="card-title" style="font-size:20px; font-weight:500; text-align:center;">Подарки и
                            игрушки</h5>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="bg-light">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="about-title">Цветы с доставкой в Коломне</h2>
                    <p>«Цветочная феерия» – это не просто цветочный магазин, это мастерская волшебства, где рождаются
                        букеты, дарящие радость. Мы предлагаем огромный выбор потрясающих композиций и свежайших
                        букетов, которые можно заказать с доставкой прямо к двери. Наш сервис основан на четко
                        отлаженной системе сотрудничества:</p>
                    <ul class="adaptiv-list">
                        <li>Мы сотрудничаем с лучшими талантливыми флористами, способными создавать настоящие шедевры из
                            цветов.</li>
                        <li>Наши курьеры оперативно и аккуратно доставляют ваш заказ в указанное место и время.</li>
                        <li>Менеджеры компании всегда готовы принять ваш заказ, предложить консультацию и координировать
                            работу наших специалистов.</li>
                        <li>Каждая наша композиция - это произведение искусства, созданное с любовью и вниманием к
                            деталям.</li>
                        <li>Мы стремимся к тому, чтобы каждый клиент получил не только красивый букет, но и частичку
                            радости и волшебства от нашего сервиса.</li>
                    </ul>
                    <p class="adaptiv-list">Благодаря нашей работе, наши клиенты могут легко и недорого порадовать своих
                        близких, выразить
                        свою любовь и нежность, удивить красотой и создать неповторимую атмосферу праздника.</p>
                    <div class="about-items">
                        <div>
                            <div class="num">1400<span>+</span></div>
                            <div class="about-item-text">Цветов уже на сайте</div>
                        </div>
                        <div>
                            <div class="num">46<span>+</span></div>
                            <div class="about-item-text">Вариантов упаковки цветов</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="images/image/about.jpg" class="about-image img-fluid">
                </div>
            </div>
        </div>
    </section>


    <section id="accrodions" class="bg-light">
        <div class="container-xxl">
            <h2 class="max-title">Всё, что вы хотели спросить про заказ
                цветов в Коломне</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Как заказать цветы с доставкой?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Заказ оформляется по телефону или на
                            сайте, достаточно поместить необходимые
                            товары в корзину и оплатить их. Стоимость
                            будет указана сразу.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Как оплатить заказ цветов с доставкой?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Мы принимаем оплату всеми удобными способами:
                            наличными, по карте, переводом на расчетный
                            счет.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Можно ли анонимно дарить цветы?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Да, конечно. Если нужно, мы не будем просить
                            оставить ваши персональные данные. Нам нужен
                            только адрес, где будут получать букет.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Можно ли купить букет, если его нет на сайте?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Да, у нас есть услуга сборки авторских
                            композиций: вы можете описать, какой букет вам
                            нужен или приложить фото, а мы соберем его в
                            соответствии с вашими пожеланиями или подберем
                            растения по предоставленной фотографии.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Почему цветы стоят так недорого?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Мы работаем с плантациями напрямую, у нас нет
                            наценок перекупщиков, поэтому цены ниже, чем у
                            других доставок, а цветы всегда высокого
                            качества.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Как узнать, что доставка выполнена?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            После доставки заказа на дом мы пришлем вам
                            уведомление, а также пришлем фото с получателем.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Есть ли возможность дополнить цветочную
                            композицию другими подарками?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Да, такая возможность есть. Вы можете не только
                            заказать букет, но также дополнить его
                            воздушными шарами, игрушкой, конфетами и другими
                            сладостями. Также можем добавить к заказу
                            открытку с поздравлением или любым вашим
                            текстом. Укажите весь состав заказа при
                            онлайн-оформлении или во время звонка менеджеру.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            Могу ли я оформить заказ ночью?
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Наши менеджеры и курьеры работают круглосуточно
                            без перерывов и выходных. Оформить заказ можно
                            онлайн или по телефону. Подарок будет доставлен
                            в течение трех часов после оформления или в
                            указанное в заявке время.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Хочу вручить букет лично. Можно ли получить его
                            в вашей компании самостоятельно?
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Получить цветочную композицию можно в нашем
                            магазине самостоятельно. Чтобы не ждать, пока
                            флористы готовят ваш букет, оформите заказ
                            заранее через интернет или позвоните менеджеру.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            Что будет, если получателя не окажется дома?
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            В таком случае мы повторно организуем бесплатную
                            доставку позже или по другому адресу один раз в
                            течение 24 часов. В случае отказа получателя от
                            принятия подарка, вам вернут все деньги за
                            вычетом услуг курьера.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="zakaz" class="bg-light">
        <?php
        $user = new User($db);
        if (isset($_SESSION['id'])) {
            $user->id = $_SESSION['id'];
            $user->readOne();
        }
        $product = new Product($db);
        $category = new Category($db);

        $order = new Order($db);

        if ($_POST) {
            if (!isset($_SESSION['id'])) {
                echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Для оформления заказа <a href='login.php'>авторизуйтесь</a>.";
                echo "</div>";
            } else {
                if (isset($_POST['phone']) && isset($_POST['wishes'])) {
                    $phone = $_POST['phone'];
                    $wishes = $_POST['wishes'];

                    if ($order->createUniqueOrder($phone, $wishes)) {
                        echo "<div class='alert alert-success alert-dismissable'>";
                        echo "Заказ успешно оформлен.";
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-danger alert-dismissable'>";
                        echo "Ошибка при оформлении заказа.";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger alert-dismissable'>";
                    echo "Пожалуйста, заполните все поля.";
                    echo "</div>";
                }
            }
        }
        ?>
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center zakaz-adaptiv">
                    <img src="images/image/form.jpg" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <div class="zakaz-st">Не нашли то, что искали?</div>
                        <h2 class="mb-4" style="font-size: 35px; font-weight: 500;">Соберем уникальный заказ!</h2>
                        <h3 class="mb-4" style="font-size: 20px; font-weight: 500;">Мы свяжемся с вами и создадим
                            индивидуальный состав цветов!</h3>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <input type="tel" name="phone" class="form-control" placeholder="+7(___)___-__-__"
                                    pattern="^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="wishes" class="form-control" rows="7"
                                    placeholder="Расскажите ваши пожелания по составу букета: цвет, размер, тип цветов, дата и время доставки..."
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg" style="width: 100%;">Хочу свой
                                уникальный букет</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "components/footer.php" ?>
    <script src="js/main.js"></script>
    <script>
        window.onload = function () {
            var phoneInput = document.querySelector('input[name="phone"]');

            phoneInput.oninput = function () {
                this.value = this.value.replace(/[^0-9+()\-]/g, '');
            };

            Inputmask({
                mask: "+7(999)999-99-99",
                placeholder: "_",
                showMaskOnHover: false,
                showMaskOnFocus: false,
                onBeforeMask: function (value, opts) {
                    return value;
                },
                onUnMask: function (maskedValue, unmaskedValue, opts) {
                    return unmaskedValue;
                }
            }).mask(phoneInput);
        }
    </script>

</body>

</html>