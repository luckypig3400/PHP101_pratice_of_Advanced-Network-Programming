<?php
// setcookie前不可以輸出任何網頁內容(包含header與echo任何字串)
setcookie("CookieName", "test", time() + 3600);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Test</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>餅乾測試</h1>
        </div>

        <form action="./cookie_test.php" method="post">
            <div class="row">
                <div class="col-75">
                    <?php
                    $cookieName = isset($_COOKIE["CookieName"]) ? $_COOKIE["CookieName"] : "null";
                    //取Cookie值 類似$_GET或$_POST的用法
                    echo "名為CookieName的Cookie其值為:" . $cookieName;
                    ?>
                </div>
                <div class="col-25">
                    <?php
                    if ($cookieName == "null") {
                        echo "<input type=\"submit\" value=\"製作餅乾\">";
                    } else {
                        echo "<input type=\"submit\" value=\"吃掉餅乾\">";
                        setcookie("CookieName", "", time() - 696969); //刪除Cookie
                        //時間需比現在早；Value的值已不重要
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>

</html>