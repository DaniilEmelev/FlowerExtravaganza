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
    <style>
        @media (max-width: 991.98px) {
            #adaptive {
                display: flex;
            }

            #top,
            #header,
            .top-icons {
                display: none !important;
            }
        }

        @media (max-width: 479.98px) {
            #adaptive {
                display: none;
            }
        }

        @media (min-width: 479.98px) {
            #adaptive-phone {
                display: none;
            }
        }

        @media (min-width: 992px) {
            #adaptive {
                display: none;
            }
        }
    </style>
</head>

<body>
    <section id="adaptive-phone">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="index.php" class="adaptive-link"><img height="100" class="w-100 logo-img"
                        src="images/image/logo1 копия.png"></a>
            </div>
        </div>
        <div class="row d-flex justify-content-between align-items-center w-100">
            <div class="col d-flex justify-content-center">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <div class="container-xxl">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
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
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col d-flex justify-content-center adaptiv-phone">
                <a href="#"><img class="phone-svg" src="images/icons/phone.svg"></a>
            </div>
            <div class="col d-flex justify-content-center">
                <?php if (isset($_SESSION['role'])): ?>
                    <?php if ($_SESSION['role'] == 1): ?>
                        <a class="nav-link-user" href="profile.php"><img class="user-svg" src="images/icons/user.svg"></a>
                    <?php elseif ($_SESSION['role'] == 2): ?>
                        <a class="nav-link-user" href="admin_profile.php"><img class="user-svg" src="images/icons/user.svg"></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="nav-link-user" href="login.php"><img class="user-svg" src="images/icons/user.svg"></a>
                <?php endif; ?>

            </div>
            <div class="col d-flex justify-content-center">
                <a class="nav-link-user" href="basket.php"><img class="user-svg" src="images/icons/korzina.svg"></a>
            </div>
        </div>
    </section>
    <section id="adaptive">
        <div class="row d-flex justify-content-between align-items-center w-100">
            <div class="col d-flex justify-content-center">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <div class="container-xxl">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
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
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col d-flex justify-content-center adaptiv-phone">
                <a href="#"><img class="phone-svg" src="images/icons/phone.svg"></a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="index.php" class="adaptive-link"><img height="60" class="w-19 logo-img"
                        src="images/image/logo1 копия.png"></a>
            </div>
            <div class="col d-flex justify-content-center">
                <?php if (isset($_SESSION['role'])): ?>
                    <?php if ($_SESSION['role'] == 1): ?>
                        <a class="nav-link-user" href="profile.php"><img class="user-svg" src="images/icons/user.svg"></a>
                    <?php elseif ($_SESSION['role'] == 2): ?>
                        <a class="nav-link-user" href="admin_profile.php"><img class="user-svg" src="images/icons/user.svg"></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="nav-link-user" href="login.php"><img class="user-svg" src="images/icons/user.svg"></a>
                <?php endif; ?>

            </div>
            <div class="col d-flex justify-content-center">
                <a class="nav-link-user" href="basket.php"><img class="user-svg" src="images/icons/korzina.svg"></a>
            </div>
        </div>
    </section>

    <div class="container-xxl">
        <section id="top" class="bg-white d-block">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-xxl">
                    <div class="collapse navbar-collapse" id="navbarNav">
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
                    </div>
                    <div class="d-flex top-icons">
                        <?php if (isset($_SESSION['role'])): ?>
                            <?php if ($_SESSION['role'] == 1): ?>
                                <a class="nav-link-user" href="profile.php"><img class="user-svg"
                                        src="images/icons/user.svg"></a>
                            <?php elseif ($_SESSION['role'] == 2): ?>
                                <a class="nav-link-user" href="admin_profile.php"><img class="user-svg"
                                        src="images/icons/user.svg"></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="nav-link-user" href="login.php"><img class="user-svg" src="images/icons/user.svg"></a>
                        <?php endif; ?>

                        <a class="nav-link-user" href="basket.php"><img class="user-svg"
                                src="images/icons/korzina.svg"></a>
                    </div>

                </div>
            </nav>
        </section>
    </div>
    <header id="header" class="bg-light">
        <div class="container-xxl header-con">
            <div class="logo">
                <a href="index.php"><img width="300" height="85" class="img-fluid logo-img"
                        src="images/image/logo1 копия.png"></a>
            </div>
            <div class="city d-grid">
                Бесплатная доставка цветов <br>в Коломне
            </div>
            <?php
            $search_term = isset($_GET['s']) ? $_GET['s'] : '';

            echo "<form role='search' action='search.php' method='GET' style='width: 35%;'>";
            echo "<div class='input-group mb-3' style='border-bottom: 1px solid #d8d8d8;'>";
            echo "<input type='text' class='form-control' placeholder='Поиск букетов и подарков' aria-label='Search' name='s' value='" . htmlspecialchars($search_term) . "' style='border: none !important; background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;'>";
            echo "<button class='btn btn-primary' type='submit' style='border: none; background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;'><img src='images/icons/loupe.svg' width='18px'></button>";
            echo "</div>";
            echo "</form>";
            ?>


            <div class="header-phone">
                <span class="sp-phone">Телефон</span>
                <ul class="user-and-phone navbar-nav">
                    <li class="nav-item-right"><img class="phone-svg" src="images/icons/phone.svg"></li>
                    <li class="nav-item-right"><a class="nav-link-phone" href="#">8 (937) 402-22-13</a></li>
                </ul>
                <div class="time">РЕЖИМ РАБОТЫ - КРУГЛОСУТОЧНО</div>
            </div>
        </div>
    </header>

    <div id="menu" class="bg-light">
        <div class="container-xxl">
            <nav class="navbar navbar-expand-lg navbar-light menu">
                <div class="container-xxl">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_bukets.php">БУКЕТЫ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_poschtuchno.php">ЦВЕТЫ ПОШТУЧНО</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_korobki.php">ЦВЕТЫ В КОРОБКЕ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_korzina.php">КОРЗИНЫ С ЦВЕТАМИ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_prazdnik.php">ПРАЗДНИЧНЫЕ БУКЕТЫ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="catalog_podarki.php">ПОДАРКИ И ИГРУШКИ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>