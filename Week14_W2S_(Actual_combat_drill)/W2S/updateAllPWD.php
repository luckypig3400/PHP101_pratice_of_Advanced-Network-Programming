<!DOCTYPE html>
<html lang="zh-tw">

<?php
require("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walktoschool";

echo "admin:" . password_hash("admin", PASSWORD_DEFAULT) . "<br>";
echo "seed:" . password_hash("seed", PASSWORD_DEFAULT) . "<br>";
echo "user3:" . password_hash("user3", PASSWORD_DEFAULT) . "<br>";

?>

</html>