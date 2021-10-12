<?php
include("config.php");

if (isset($_POST["account"])) {
    if ($_POST["account"] != "") {
        setcookie("account", $_POST["account"], time() + 3600);

        try {
            //建立資料庫連線
            $link = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);

            //檢查資料庫帳號資料是否存在
            $queryCommand = "SELECT * FROM `cookie_login_record` WHERE Account = '" . $_POST["account"] . "'";
            $result = $link->query($queryCommand);
            // 若是Insert, Update, Delete，不是使用query()，而是使用exec()

            $accExist = false;
            foreach ($result as $row) { //檢查帳號使否已經存在
                if ($row["Account"] == $_POST["account"]) { //更新登陸時間與IP
                    $accExist = true;
                    $updateCommand = "UPDATE `cookie_login_record` SET `LastLoginTime` = current_timestamp(), `UTCTime` = UTC_TIMESTAMP(), `IP_Address` = '" . $_SERVER["REMOTE_ADDR"] . "' WHERE `cookie_login_record`.`Account` = '" . $_POST["account"] . "'";
                    $updResult = $link->exec($updateCommand);

                    //從資料庫更新結果抓出IP與時間存放至Cookie
                }
            }

            if (!$accExist) { //新增帳號
                //簡化變數方便串接於SQL指令
                $ip = $_SERVER["REMOTE_ADDR"];
                $acc = $_POST["account"];
                $insertCommand = "INSERT INTO `cookie_login_record` (`Account`, `IP_Address`, `LastLoginTime`, `UTCTime`) VALUES ('$acc', '$ip', current_timestamp(), UTC_TIMESTAMP())";
                $inResult = $link->exec($insertCommand);

                //從資料庫更新結果抓出IP與時間存放至Cookie
            }

            //紀錄登入IP與時間到Cookie
            //紀錄登入時間與寫入資料庫
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //*重要:剛產生的Cookie無法於同頁面讀取，因此需要轉跳頁面
        //header("Location:main.php");
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