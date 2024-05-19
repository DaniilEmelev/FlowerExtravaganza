<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include_once "config/core.php";
include_once "config/database.php";
include_once "objects/user.php";
include_once "objects/orders.php";
include_once "objects/order_item.php";

$database = new Database();
$db = $database->getConnection();

if (isset($_SESSION['id'])) {
    $user = new User($db);
    $user->id = $_SESSION['id'];
    $user->readOne();
}

if (!$user->hasAdminRole($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI amwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Авторизация</title>
    <style>
        @media (max-width: 780px) {
            .navbar-nav {
                text-align: center;
                flex-wrap: wrap;
            }

            .navbar-nav .nav-item {
                flex: 0 0 100%;
                margin-bottom: 10px;
            }

            .profile-right-menu {
                flex-direction: column;
                align-items: center;
            }

            .user-name {
                margin-bottom: 10px;
                border-right: none !important;
                padding-right: 0 !important;
                margin-right: 0 !important;
            }

            .profile-btn {
                margin-left: 0;
                margin-right: 0;
            }

            @media(max-width: 1000px) {
                .profile-left-menu {
                    display: flex;
                    justify-content: center;
                }
            }
        }

        @media(max-width: 1000px) {
            .profile-left-menu {
                display: flex;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <?php include_once "components/header.php" ?>
    <section id="profile" class="bg-light">
        <div class="container">
            <h2 class="max-title">Мой аккаунт</h2>
            <div class="profile-menu">
                <div class="row w-100">
                    <div class="col-lg-6">
                        <div class="profile-left-menu">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <ul class="navbar-nav flex-row">
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="admin_profile.php">Профиль</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="admin_orders.php">Заказы</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="unique_orders.php"
                                            style="color:red; border-bottom:2px solid red;">Уникальные</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="create_product.php">Создание</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="profile-right-menu d-flex justify-content-center justify-content-lg-end">
                            <? echo '<div class="user-name">' . $user->name . ' ' . $user->surname . ' ' . $user->lastname . '</div>'; ?>
                            <button class="profile-btn btn btn-danger"
                                onclick="location.href='logout.php'">Выйти</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-form">
                <h2 class="text-center" style="font-size:26px">Список всех уникальных заказов</h2>
                <?php require_once "read_unique_orders.php"; ?>
            </div>
        </div>
    </section>
    <?php require_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>