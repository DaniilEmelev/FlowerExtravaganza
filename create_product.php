<?php session_start(); ?>
<?php
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include_once "config/core.php";
include_once "objects/user.php";

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
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

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
                                    <a class="nav-link-profile" href="admin_profile.php">Профиль</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-profile" href="admin_orders.php">Заказы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-profile" href="unique_orders.php">Уникальные</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-profile" href="create_product.php"
                                        style="color:red; border-bottom:2px solid red;">Создание</a>
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
                    $image = !empty($_FILES["image"]["name"])
                        ? sha1_file($_FILES["image"]["tmp_name"]) . "-" . basename($_FILES["image"]["name"]) : "";
                    $product->image = $image;

                    if ($product->create()) {
                        echo '<div class="alert alert-success">Товар был успешно создан.</div>';
                        echo $product->uploadPhoto($product->image);
                    } else {
                        echo '<div class="alert alert-danger">Невозможно создать товар.</div>';
                    }
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Создание товара</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label for="name">Название</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="price">Цена</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Описание</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category_id">Категория</label>
                                <?php
                                $stmt = $category->read();
                                echo "<select class='form-control' name='category_id' required>";
                                echo "<option value='' disabled selected>Выбрать категорию...</option>";
                                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row_category);
                                    echo "<option value='{$id}'>{$name}</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="form-group mb-4">
                                <label for="image">Изображение</label>
                                <input type="file" name="image" id="image" class="form-control-file" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Создать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once "components/footer.php" ?>