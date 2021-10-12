<?php
$acc = isset($_COOKIE["account"]) ? $_COOKIE["account"] : "";
if ($acc != "") {
    //讀取已紀錄的登入時間與IP

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
                    ?>
                </div>
                <div class="col-25">
                    <input type="submit" value="登出">
                </div>
            </div>
        </form>

    </div>
</body>

</html>