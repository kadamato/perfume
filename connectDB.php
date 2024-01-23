<?php
$servername = "localhost";
$username = "kadamato";
$password = "123abc";
$database = "perfume_manage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($conn) return $conn;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
