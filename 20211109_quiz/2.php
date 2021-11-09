<?php
isset($_POST["numA"]) ? $numA = $_POST["numA"] : $numA = "";
isset($_POST["numB"]) ? $numB = $_POST["numB"] : $numB = "";

if ($numA != "" && $numB != "") {
    if ((int)($numA) - (int)($numB) >= 0) {
        setcookie("diff", (int)($numA) - (int)($numB), time() + 3600);
        header("Location:2.php");
    } else {
        setcookie("diff", "", time() - 696969);
        header("Location:2.php");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>數字比一比</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <h1>20211109課堂小考--數字比較器(Cookie紀錄差異)</h1>

        <?php
        if (isset($_COOKIE["diff"])) {
            echo "<h3>" . $_COOKIE["diff"] . "</h3>";
        }
        ?>

        <div class="row">
            <form action="./1.php" method="post">
                <input type="submit" value="返回1.php">
            </form>
        </div>
    </div>
</body>

</html>