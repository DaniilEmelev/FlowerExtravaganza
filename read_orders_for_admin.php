<style>
    @media (max-width: 780px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            display: block;
            width: 100%;
            overflow-y: hidden;
            margin: 0 auto;
        }

        .table tbody,
        .table tr,
        .table td,
        .table th {
            display: block;
        }

        .table td,
        .table th {
            width: 100%;
            text-align: center;
        }

        .table thead {
            display: none;
        }
    }
</style>




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

$order = new Order($db);



$stmt = $order->readAll();

if ($stmt) {
    $num = $stmt->rowCount();

    if ($num > 0) {
        echo "<div class='container table-container'>";
        echo "<div class='accordion' id='ordersAccordion'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $status_query = "SELECT order_status FROM order_status WHERE id = ?";
            $status_stmt = $db->prepare($status_query);
            $status_stmt->bindParam(1, $order_status);
            $status_stmt->execute();
            $status_row = $status_stmt->fetch(PDO::FETCH_ASSOC);
            $status_name = $status_row['order_status'];

            $order_item = new OrderItem($db);
            $order_item->order_id = $id;
            $stmt_items = $order_item->readAllByOrderId();

            echo "<div class='accordion-item'>";
            echo "<h2 class='accordion-header' id='heading{$id}'>";
            echo "<button class='accordion-button collapsed bg-light' type='button' data-bs-toggle='collapse' data-bs-target='#collapse{$id}' aria-expanded='false' aria-controls='collapse{$id}' data-bs-parent='#ordersAccordion'>";
            echo "Заказ №{$order_number}; Статус заказа: {$status_name}";
            echo "</button>";
            echo "</h2>";
            echo "<div id='collapse{$id}' class='accordion-collapse collapse' aria-labelledby='heading{$id}' data-bs-parent='#ordersAccordion'>";
            echo "<div class='accordion-body'>";


            echo "<table class='table mx-auto mt-3'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th>Название товара</th>";
            echo "<th>Цена товара</th>";
            echo "<th>Количество</th>";
            echo "<th>Цена за упаковку</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody style='text-align:center; vertical-align: middle;' >";
            while ($row_item = $stmt_items->fetch(PDO::FETCH_ASSOC)) {
                extract($row_item);
                echo "<tr>";
                if (isset($row_item['product_image']) && !empty($row_item['product_image'])) {
                    echo "<td><img src='{$row_item['product_image']}' alt='Product Image' style='max-width: 100px;'></td>";
                } else {
                    echo "<td>Изображение не найдено.</td>";
                }
                echo "<td>{$product_name}</td>";
                echo "<td>{$product_price} руб.</td>";
                echo "<td>{$quantity} шт.</td>";
                echo "<td>{$packaging_price} руб.</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<p><strong>Дата заказа:</strong> {$created_at}</p>";
            echo "<p><strong>Адрес доставки:</strong> {$address}</p>";
            echo "<p><strong>Номер телефона:</strong> {$phone}</p>";
            echo "<p><strong>Дата доставки:</strong> {$delivery_date}</p>";
            echo "<p><strong>Время доставки:</strong> {$delivery_time}</p>";
            if (!empty($note)) {
                echo "<p><strong>Примечания к заказу:</strong> {$note}</p>";
            }
            echo "<p><strong>Итоговая сумма заказа:</strong> {$total_amount} руб.</p>";

            echo "<form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='order_id' value='{$id}'>";
            echo "<div class='mb-3'>";
            echo "<label for='statusSelect' class='form-label'><strong>Изменить статус заказа:</strong></label>";
            echo "<select class='form-select' id='statusSelect' name='status'>";
            $status_query = "SELECT id, order_status FROM order_status";
            $status_stmt = $db->prepare($status_query);
            $status_stmt->execute();
            while ($status_row = $status_stmt->fetch(PDO::FETCH_ASSOC)) {
                $status_id = $status_row['id'];
                $status_name = $status_row['order_status'];
                echo "<option value='$status_id'>$status_name</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<button type='submit' name='update_status' class='btn btn-primary'>Обновить статус</button>";

            echo "</form>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<p>У вас пока нет заказов.</p>";
        echo "</div>";
    }
} else {
    echo "Ошибка: Не удалось получить список заказов пользователя.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status_id = $_POST['status'];

    $order->id = $order_id;
    $order->order_status = $new_status_id;

    $order->updateStatus();
}

?>