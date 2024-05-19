<?php
session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI amwp811yT5cNv3zAUrcJE2Y8qkHGv1dHRG7NOYi6p1N69qFbs"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include_once "components/header.php" ?>
    <section id="registration">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="max-title">Регистрация</h2>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if(empty($_POST["first_name"]) || empty($_POST["last_name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
                            echo '<div class="alert alert-danger">Пожалуйста, заполните все обязательные поля.</div>';
                        } else {
                            include_once "process_registration.php";
                        }
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Имя *</label>
                            <input type="text" id="first_name" name="first_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия *</label>
                            <input type="text" id="last_name" name="last_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Отчество </label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль *</label>
                            <input type="password" id="password" name="password" autocomplete="off" class="form-control">
                            <div class="form-text">Пароль должен содержать не менее 6 символов и состоять из латинских букв.</div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-acc btn btn-danger">Зарегистрироваться</button>
                            <div class="form-text">Если вы уже зарегистрированы, то вы можете <a href="login.php" class="login-link" >войти</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require_once "components/footer.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
