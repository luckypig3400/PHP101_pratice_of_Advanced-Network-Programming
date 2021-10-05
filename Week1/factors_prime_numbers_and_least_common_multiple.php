<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>因數質數與最小公倍數計算機</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <form action="./factors_prime_numbers_and_least_common_multiple.php">
            <div class="row">
                <h3>本程式會自動計算A、B兩數的各自的因數、最大公因數、最小公倍數</h3>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="numA">請輸入大於0的數字(A)：</label>
                </div>
                <div class="col-75">
                    <input type="number" id="numA" name="numberA" placeholder="69">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="numB">請輸入大於0的數字(B)：</label>
                </div>
                <div class="col-75">
                    <input type="number" id="numB" name="numberB" placeholder="54">
                </div>
            </div>
            <div class="row">
                <br>
                <input type="submit" value="開始計算">
            </div>
        </form>
    </div>
</body>

</html>