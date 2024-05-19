<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include_once "config/core.php";

include_once "config/database.php";
include_once "objects/user.php";
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->hasAdminRole($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['id'])) {
    $user->id = $_SESSION['id'];
    $user->readOne();
}

$success_message = "";

if (isset($_POST['save_profile'])) {
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email'])) {
        $success_message = '<div class="alert alert-success">Изменения успешно сохранены!</div>';
    } else {
        $success_message = '<div class="alert alert-danger">Пожалуйста, заполните все обязательные поля.</div>';
    }
}
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
        integrity="sha384-QJHtvGhmr9XOIpI amwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                                        <a class="nav-link-profile" href="admin_profile.php"
                                            style="color:red; border-bottom:2px solid red;">Профиль</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="admin_orders.php">Заказы</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-profile" href="unique_orders.php">Уникальные</a>
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
                <h2 class="text-center" style="font-size:26px">Редактировать профиль</h2>
                <?php echo $success_message; ?>
                <form action="#" method="POST" onsubmit="setTimeout(function(){ location.reload(); }, 2000);">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Имя *</label>
                        <input type="text" id="first_name" name="first_name" class="form-control"
                            value="<?php echo htmlspecialchars($user->name); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Фамилия *</label>
                        <input type="text" id="last_name" name="last_name" class="form-control"
                            value="<?php echo htmlspecialchars($user->surname); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Отчество </label>
                        <input type="text" id="middle_name" name="middle_name" class="form-control"
                            value="<?php echo htmlspecialchars($user->lastname); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="<?php echo htmlspecialchars($user->email); ?>">
                    </div>

                    <div class="text-left">
                        <button type="submit" id="saveButton" class="profile-btn btn btn-danger"
                            name="save_profile">Сохранить
                            изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php require_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_profile'])) {
        // Задаем значения объекта пользователя из формы
        $user->name = $_POST['first_name'];
        $user->surname = $_POST['last_name'];
        $user->lastname = $_POST['middle_name'];
        $user->email = $_POST['email'];

        // Обновляем профиль пользователя
        if ($user->update()) {
            echo '<div class="alert alert-success">Изменения успешно сохранены!</div>';
        } else {
            echo '<div class="alert alert-danger">Ошибка при сохранении изменений.</div>';
        }
    }
    ?>
</body>

</html>