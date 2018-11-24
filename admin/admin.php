<?php
// подключение к БД  функцию
//try
//{
//    $dsn = 'mysql:host=localhost;dbname=burger;charset=utf8';
//    $pdo = new PDO($dsn, 'root', 'root');
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $pdo->exec('SET Names "utf8"');
//} catch (PDOException $e) {
//    $output = 'Невозможно подключиться к серверу баз данных';
//    include 'output.html.php';
//    exit();
//}
function getConnect($db, $username, $password)
{
    global $pdo;
    $dsn = "mysql:host=localhost;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET Names "utf8"');
}

getConnect('burger', 'root', 'root');

function getInfoAboutOrders()
{
    global $pdo;
    $sql = 'SELECT customers.username, orders.address, orders.details FROM customers
            LEFT JOIN orders ON customers.id = orders.customer_id';
    $infoAboutOrders = $pdo->prepare($sql);
    $infoAboutOrders->execute();
    $dataAboutOrders = $infoAboutOrders->fetchAll(PDO::FETCH_ASSOC);

    echo "<table style='border: 2px solid #000000;border-collapse: collapse; margin-bottom: 10px;'>";
    echo "<th style='border: 1px solid #000000; padding: 3px; text-align: center;'>Заказчик</th>";
    echo "<th style='border: 1px solid #000000; padding: 3px; text-align: center;'>Адрес</th>";
    echo "<th style='border: 1px solid #000000; padding: 3px; text-align: center;'>Детали заказа</th>";
    foreach ($dataAboutOrders as $value) {
        echo "<tr>";
        echo "<td style='border: 1px solid #000000; padding: 3px; text-align: center;'>" . $value['username'] . "</td>";
        echo "<td style='border: 1px solid #000000; padding: 3px; text-align: center;'>" . $value['address'] . "</td>";
        echo "<td style='border: 1px solid #000000; padding: 3px; text-align: center;'>" . $value['details'] . "</td>";
        echo "<tr>";
    }
    echo "</table";
}
getInfoAboutOrders();