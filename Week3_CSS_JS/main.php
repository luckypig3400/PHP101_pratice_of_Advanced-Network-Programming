<?php
$acc = isset($_COOKIE["account"]) ? $_COOKIE["account"] : "";
if ($acc != "") {
    //stay at this page
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
    <title>Welcome</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Welcome</h1>
        </div>

        <form action="./logout.php" method="post">
            <div class="row">
                <div class="col-75">
                    <?php
                    echo "Welcom " . $acc;
                    echo "<br>您此次的登入IP:" . $_SERVER["REMOTE_ADDR"];
                    ?>
                </div>
                <div class="col-25">
                    <input type="submit" value="登出">
                </div>
            </div>
            <div class="row">
                <h3>您於本裝置上登入任何帳號的歷史紀錄</h3>
                <?php
                //讀取已紀錄的登入時間與IP
                for ($i = 4; $i >= 0; $i--) { //Up to 5 records
                    $current = "record" . $i;

                    if (isset($_COOKIE["$current"])) { //check if record empty
                        echo $_COOKIE["$current"] . "<br>";
                    }
                }
                ?>
            </div>
        </form>

    </div>
</body>

</html>