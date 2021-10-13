<?php
session_id("wow-cool-i-can-set-uniqueID");
//要設定session_id需在啟動session前設定
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Test(Public)</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <h1>Session Playground--Public</h1>

        <div class="row">
            <h3>Session Counter(所有人共用)</h3>
            <?php

            if (!isset($_SESSION["counter"]))
                $_SESSION["counter"] = 1;
            else
                $_SESSION["counter"]++;

            echo "Session ID: " . session_id() . "<br>";
            echo "Counter(public): " . $_SESSION["counter"];
            ?>
        </div>

        <div class="row">
            <form action="./destroy_session.php">
                <div class="col-50">
                    <h3>刪除所有Session</h3>
                </div>
                <div class="col-50">
                    <input type="submit" value="刪除Session">
                </div>
            </form>
        </div>

        <div class="row">
            <br><br><br>
            <form action="../index.php">
                <input type="submit" value="回首頁">
            </form>
        </div>
    </div>
</body>

</html>