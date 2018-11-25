<?php
//require "connectDb.php";

function getUserId($email)
{
    global $pdo;
    $sql = 'SELECT * FROM customers WHERE email = :email';
    $checkEmail = $pdo->prepare($sql);
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $dataCheckEmail = $checkEmail->fetch(PDO::FETCH_ASSOC);

    if ($dataCheckEmail === null) {
        return null;
    }
    return $dataCheckEmail['id'];
}

function addUser($userName, $email, $phone)
{
    global $pdo;
    $sql = 'INSERT INTO customers (username, email, phone) VALUES (:username, :email, :phone)';
    $prepareCustomers = $pdo->prepare($sql);
    $prepareCustomers->bindParam(':username', $userName);
    $prepareCustomers->bindParam(':email', $email);
    $prepareCustomers->bindParam(':phone', $phone);
    $prepareCustomers->execute();
    return getUserId($email);
}

function addOrder($userId, $address, $details)
{
    global $pdo;
    $sql = 'INSERT INTO orders(customer_id, address, details) VALUES (:customer_id, :address, :details)';
    $prepareOrders = $pdo->prepare($sql);
    $prepareOrders->bindParam(':address', $address);
    $prepareOrders->bindParam(':details', $details);
    $prepareOrders->bindParam(':customer_id', $userId);
    $prepareOrders->execute();
}

function getConnect($db, $username, $password)
{
    global $pdo;
    $dsn = "mysql:host=localhost;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET Names "utf8"');
}



if (empty($_POST['email'])) {
    return;
}
// подключение к БД
getConnect('burger', 'root', 'root');

$userName = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
$email = $_POST['email'];
$street = htmlspecialchars($_POST['street'], ENT_QUOTES, 'UTF-8');
$home = $_POST['home'];
$part = $_POST['part'];
$flat = $_POST['appt'];
$floor = $_POST['floor'];
$details = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

$address = "Ул." . $street . ",Дом " . $home . ",Корпус " . $part . ", Квартира " . $flat . ",Этаж " . $floor;

$email = trim($email);
$email = strtolower($email);

$userId = getUserId($email);
if ($userId === null) {
    $userId = addUser($userName, $email, $phone); //addUser()

}
addOrder($userId, $address, $details);

mail($email, 'Заказ на доставку бургеров', 'DarkBeefBurger за 500 рублей');


echo "<p style=\"text-align: center;\">Заказ произведен!</p>";

