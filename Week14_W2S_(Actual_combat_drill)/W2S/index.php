<!DOCTYPE html>
<html lang="zh-tw">

<?php

require("header.php");

// https://www.w3schools.com/php/php_mysql_select.asp
echo "<div style='overflow-x:auto;'><table style='border: solid 1px black;'>";
echo "<tr><th>user_no</th><th>id</th><th>passwd</th><th>name</th><th>group</th><th>a</th><th>b</th><th>c</th><th>d</th><th>e</th><th>join_date</th><th>modify_date</th></tr>";

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
        // 可以透過key值存取Array或是再把它用foreach展開逐項存取

        echo "<tr>";

        foreach ($row as $column) {
            echo "<td>$column</td>";
        }

        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table></div>";

echo "admin:" . password_hash("admin", PASSWORD_DEFAULT) . "<br>";
echo "seed:" . password_hash("seed", PASSWORD_DEFAULT) . "<br>";
echo "user3:" . password_hash("user3", PASSWORD_DEFAULT) . "<br>";

?>

<form action="./updateAllPWD.php">
    <input type="submit" value="更新明文密碼為密文">
</form>

</html>