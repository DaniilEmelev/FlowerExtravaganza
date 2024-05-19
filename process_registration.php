<?php
session_start();
?>
<?php
include_once "config/database.php";
include_once "objects/user.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->name = $_POST["first_name"];
    $user->surname = $_POST["last_name"];
    $user->lastname = $_POST["middle_name"];
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];

    // Проверка, что все поля заполнены
    if (preg_match('/[а-яА-Я]/u', $user->password)) {
        echo '<div class="alert alert-danger">Пароль не должен содержать русских букв.</div>';
    } else {
        // Проверка минимальной длины пароля
        if(strlen($user->password) < 6) {
            echo '<div class="alert alert-danger">Пароль должен содержать не менее 6 символов.</div>';
        } else {
            // Все поля заполнены и прошли валидацию, можно регистрировать пользователя
            // Создаем пользователя
            if ($user->create()) {
                echo '<div class="alert alert-success">Вы успешно зарегистрировались.</div>';
            } else {
                echo '<div class="alert alert-danger">Не удалось зарегистрировать пользователя.</div>';
            }
        }
    }
}
?>
