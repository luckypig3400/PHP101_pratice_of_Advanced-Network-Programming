<!DOCTYPE html>
<html lang="zh-tw">

<?php
require("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walktoschool";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM user_info");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        echo "編號:" . $row["user_no"] . "的使用者原始密碼為:" . $row["passwd"] . "<br>";


        
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

echo "admin:" . password_hash("admin", PASSWORD_DEFAULT) . "<br>";
echo "seed:" . password_hash("seed", PASSWORD_DEFAULT) . "<br>";
echo "user3:" . password_hash("user3", PASSWORD_DEFAULT) . "<br>";

?>

</html>