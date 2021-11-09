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

        <div class="row">
            <form action="./2.php" method="post">
                <input type="text" name="numA" placeholder="請輸入數值(最多5位數)" maxlength="5"><br><br>
                <input type="text" name="numB" placeholder="請輸入數值(最多5位數)" maxlength="5"><br><br>
                <input type="submit" value="送出比較">
            </form>
        </div>
    </div>
</body>

</html>