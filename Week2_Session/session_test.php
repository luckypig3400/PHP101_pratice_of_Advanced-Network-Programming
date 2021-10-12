<?php
session_start();

$_SESSION["SessionName"] = "test"; //讀取或寫入Session

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Test</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <h1>Session Playground</h1>

        <div class="row">
            <h3>基礎讀取與刪除Session</h3>
            <?php
            echo "SessionName刪除前的值:" . $_SESSION["SessionName"];

            //刪除Session
            unset($_SESSION["SessionName"]);
            //session_unset();

            echo "<br>SessionName刪除後的值:" . $_SESSION["SessionName"];
            ?>
        </div>

        <div class="row">
            <h3>Session Counter(每個使用者獨自擁有)</h3>
            <?php
            if (!isset($_SESSION["counter"]))
                $_SESSION["counter"] = 1;
            else
                $_SESSION["counter"]++;

            echo "Session ID:" . session_id() . "<br>";
            echo "Counter(Personal):" . $_SESSION["counter"];
            ?>
        </div>

        <div class="row">
            <h3>Session Counter(所有人共用)</h3>
            <form action="./session_test_public.php">
                <div class="col-75">
                    因為要設定Session ID 需在一個頁面啟動Session前去做設定，所以寫在新頁面
                </div>
                <div class="col-25">
                    <input type="submit" value="點我前往">
                </div>
            </form>
        </div>
    </div>
</body>

</html>