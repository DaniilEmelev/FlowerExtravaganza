<?php
session_start();
require_once "config/database.php";
require_once "objects/orders.php";

$database = new Database();
$pdo = $database->getConnection();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['id'])) {
    // Редиректим пользователя на страницу авторизации, если он не авторизован
    header("Location: login.php");
    exit();
}
var_dump($_SESSION['total_amount']);
// Получаем общую сумму заказа из сессии
if (isset($_SESSION['total_amount']) && !empty($_SESSION['total_amount'])) {
    $total_amount = $_SESSION['total_amount'];
} else {
    // В случае, если значение total_amount не установлено в сессии, обработка ошибки
    echo "Ошибка: Не удалось получить значение total_amount из сессии.";
    exit();
}

// Получаем данные из формы
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$delivery_date = $_POST['delivery_date'];
$delivery_time = $_POST['delivery_time'];
$note = $_POST['note'];

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    // Обработка случая, когда пользователь не авторизован
    exit("Пользователь не авторизован.");
}

// Создаем объект класса Order
$order = new Order($pdo);

// Устанавливаем свойства объекта Order
$order->name = $name;
$order->phone = $phone;
$order->address = $address;
$order->delivery_date = $delivery_date;
$order->delivery_time = $delivery_time;
$order->note = $note;
$order->total_amount = $total_amount;
$order->user_id = $user_id;

// Создаем новый заказ
if ($order->create()) {
    // Получаем ID последней вставленной записи
    $order_id = $pdo->lastInsertId();

    // Перебираем товары в корзине и сохраняем их в базу данных
    foreach ($_SESSION['cart'] as $item) {
        $product_name = $item['name'];
        $product_price = $item['price'];
        $product_quantity = $item['quantity'];
        $packaging_price = isset($item['pprice']) ? $item['pprice'] : 0;
        $product_image = isset($item['image']) ? $item['image'] : '';

        // Подготавливаем запрос для добавления товара в заказ
        $sql = "INSERT INTO order_items (order_id, product_name, product_price, packaging_price, product_image, quantity) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($sql);
        // Выполняем запрос
        $stmt->execute([$order_id, $product_name, $product_price, $packaging_price, $product_image, $product_quantity]);
    }

    // Очищаем корзину и значение total_amount из сессии
    unset($_SESSION['cart']);
    unset($_SESSION['total_amount']);

    // Редиректим пользователя на страницу с подтверждением заказа или на другую страницу
    header("Location: orders_history.php");
    exit();
} else {
    // В случае ошибки при создании заказа
    echo "Ошибка: Не удалось создать заказ.";
    exit();
}