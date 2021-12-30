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

        $hashedPWD = password_hash($row["passwd"], PASSWORD_DEFAULT);

        // https://www.w3schools.com/php/php_mysql_update.asp
        $updateSQLcommand = "UPDATE user_info SET passwd='$hashedPWD' WHERE user_no=" . $row["user_no"];

        // Prepare statement
        $stmt = $conn->prepare($updateSQLcommand);

        // execute the query
        $stmt->execute();

        // echo a message to say the UPDATE succeeded
        echo $stmt->rowCount() . " records UPDATED successfully~!<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>

</html>