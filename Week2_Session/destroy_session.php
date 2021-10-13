<?php
//https://stackoverflow.com/questions/13374850/how-to-destroy-session-id-in-php
session_start();
session_destroy();
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Destroyer</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>已清除所有Session</h1>
        </div>

        <div class="row">
            <h3>回到個人Session測試頁面</h3>
            <form action="./session_test.php">
                <input type="submit" value="點我前往">
            </form>
        </div>

        <div class="row">
            <h3>回到公用Session測試頁面</h3>
            <form action="./session_test_public.php">
                <input type="submit" value="點我前往">
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