<?php
session_start();
?>
<?php

// получаем ID редактируемого товара
$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";
include_once "config/core.php";
include_once "objects/user.php";

$database = new Database();
$db = $database->getConnection();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['id'])) {
    $user = new User($db);
    $user->id = $_SESSION['id'];
    $user->readOne();
}

if (!$user->hasAdminRole($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$product = new Product($db);
$category = new Category($db);
$product->id = $id;
$product->readOne();
$page_title = "Обновление товара";
?>
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
<?php include_once "components/header.php" ?>
<section id="create_product" class="bg-light py-4">
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
                        <button class="profile-btn btn btn-danger" onclick="location.href='logout.php'">Выйти</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php
                if ($_POST) {
                    $product->name = $_POST["name"];
                    $product->price = $_POST["price"];
                    $product->description = $_POST["description"];
                    $product->category_id = $_POST["category_id"];
                    if ($product->update()) {
                        echo "<div class='alert alert-success alert-dismissable'>";
                        echo "Товар был обновлён.";
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-danger alert-dismissable'>";
                        echo "Невозможно обновить товар.";
                        echo "</div>";
                    }
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Редактирование товара</h2>

                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
                            <div class="form-group mb-3">
                                <label for="name">Название</label>
                                <input type="text" name="name" id="name" value="<?= $product->name; ?>"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="price">Цена</label>
                                <input type="text" name="price" id="price" value="<?= $product->price; ?>"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Описание</label>
                                <textarea name="description" id="description"
                                    class="form-control"><?= $product->description; ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id">Категория</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option selected disabled value="">Выберите категорию</option>
                                    <?php
                                    $stmt = $category->read();
                                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $category_id = $row_category["id"];
                                        $category_name = $row_category["name"];
                                        if ($product->category_id == $category_id) {
                                            echo "<option value='$category_id' selected>$category_name</option>";
                                        } else {
                                            echo "<option value='$category_id'>$category_name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group text-center mt-3">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once "components/footer.php" ?>