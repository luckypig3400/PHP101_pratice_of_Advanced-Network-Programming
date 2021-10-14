<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login--Cookie Ver</title>
    <link rel="stylesheet" href="../general_style.css">
    <script src="./js_and_css/week3_input_limiter.js"></script>
    <!-- https://www.w3schools.com/js/js_whereto.asp -->
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Login--Cookie Ver</h1>
        </div>
        <form action="./cookie_register.php" method="POST" id="lf" name="loginForm" onsubmit="validateForm();">
            <div class="row">
                <div class="col-25">
                    <label for="acc">請輸入帳號:</label>
                </div>
                <div class="col-50">
                    <input type="text" name="account" id="acc" placeholder="Your Account" maxlength="10" minlength="4">
                    <!-- https://www.w3schools.com/tags/att_input_minlength.asp -->
                    <!-- https://www.w3schools.com/tags/att_input_maxlength.asp -->
                </div>
                <div class="col-25">
                    <input type="submit" value="登入">
                </div>
            </div>
        </form>

        <div class="row">
            <br><br><br>
            <form action="../index.php">
                <input type="submit" value="回首頁">
            </form>
        </div>
    </div>
</body>

</html>