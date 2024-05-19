<?php
session_start();
?>
<?php
echo "<style>
.paginat {
    padding-top:20px;
    display: flex;
    justify-content: center;
    list-style: none;
}

.paginat li {
    margin-right: 5px;
}

.paginat li a {
    color: #434343;
    background-color: white;
    border: 1px solid #ccc;
    padding: 5px 10px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.paginat li a:hover {
    background-color: red;
}

.paginat .active a {
    background-color: red;
    color: white;
    border: 1px solid red;
}
</style>";

echo "<section class='bg-light'>";
echo "<ul class='paginat'>";

if ($page > 1) {
    echo "<li><a href='{$page_url}' title='Переход к первой странице'>";
    echo "Первая";
    echo "</a></li>";
}

$total_pages = ceil($total_rows / $records_per_page);

$range = 2;

$initial_num = max(1, $page - $range);
$condition_limit_num = min($total_pages, $page + $range);


for ($x = $initial_num; $x <= $condition_limit_num; $x++) {
    if ($x == $page) {
        echo "<li class='active'><a href='#'>$x <span class='sr-only'></span></a></li>";
    } else {
        echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
    }
}

if ($page < $total_pages) {
    echo "<li><a href='{$page_url}page={$total_pages}' title='Переход к последней странице'>";
    echo "Последняя";
    echo "</a></li>";
}

echo "</ul>";
echo "</section>";
?>