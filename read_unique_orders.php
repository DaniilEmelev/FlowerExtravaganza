<?php
session_start();

if (!isset ($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include_once "config/database.php";

$database = new Database();
$db = $database->getConnection();

if (isset ($_SESSION['id'])) {
    $user = new User($db);
    $user->id = $_SESSION['id'];
    $user->readOne();
}

include_once "objects/unique_order.php";

$order = new UniqueOrder($db);

$stmt = $order->readAll();

if ($stmt) {
    $num = $stmt->rowCount();
    if ($num > 0) {
        echo "<div class='container'>";
        echo "<div class='row'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<div class='col-md-6 col-lg-4'>";
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Уникальный заказ</h5>";
            echo "<p class='card-text'>Телефон: {$phone}</p>";
            echo "<p class='card-text'>Пожелания: {$wishes}</p>";
            echo "<p class='card-text'>Создан: {$created_at}</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<p class='text-muted'>У вас пока нет уникальных заказов.</p>";
        echo "</div>";
    }
} else {
    echo "Ошибка: Не удалось получить список уникальных заказов.";
}
?>