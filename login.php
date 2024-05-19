<?php
session_start();
ob_start(); // Начинаем буферизацию вывода
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
</head>

<body>
    <?php include_once "components/header.php" ?>
    <section id="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="max-title">Вход</h2>
                    <?php
                    include_once "config/database.php";
                    include_once "objects/user.php";

                    $database = new Database();
                    $db = $database->getConnection();

                    $user = new User($db);

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $email = $_POST["email"] ?? '';
                        $password = $_POST["password"] ?? '';
                    
                        if (!empty ($email) && !empty ($password)) {
                            if ($user->check_user_credentials($email, $password)) {
                                $role = $user->get_user_role($email);
                                $_SESSION['role'] = $role;

                                $_SESSION['id'] = $user->id;

                                // Проверяем роль пользователя и перенаправляем на соответствующую страницу
                                if ($role == 1) {
                                    // Пользователь
                                    header("Location: profile.php");
                                    exit;
                                } elseif ($role == 2) {
                                    // Администратор
                                    header("Location: admin_profile.php");
                                    exit;
                                }
                            } else {
                                // Учетные данные неверны, выводим сообщение об ошибке
                                echo '<div class="alert alert-danger">Неверный email или пароль.</div>';
                            }
                        } else {
                            // Если одно или оба поля не заполнены, выведите соответствующее сообщение об ошибке
                            echo '<div class="alert alert-danger">Пожалуйста, введите email и пароль.</div>';
                        }
                    }


                    ob_end_flush();
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-acc btn btn-danger">Войти</button>
                            <div class="form-text">Если вы еще не <a href="registr.php"
                                    class="registr-link">зарегистрированы</a>, то вам нужно это сделать.</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require_once "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>