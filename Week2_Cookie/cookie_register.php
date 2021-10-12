<?php
if (isset($_POST["account"])) {
    if ($_POST["account"] != "") {
        setcookie("account", $_POST["account"], time() + 3600);
        //檢查資料庫帳號資料是否存在
        //紀錄登入IP與時間到Cookie
        //紀錄登入時間與寫入資料庫


        //*重要:剛產生的Cookie無法於同頁面讀取
        header("Location:main.php");
    } else {
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Register</title>
</head>

<body>

</body>

</html>