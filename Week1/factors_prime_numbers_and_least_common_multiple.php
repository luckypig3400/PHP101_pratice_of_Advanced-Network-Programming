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
        <form action="./factors_prime_numbers_and_least_common_multiple.php" method="POST">
            <div class="row">
                <h3>本程式會自動計算A、B兩數的各自的因數、最大公因數、最小公倍數</h3>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="numA">請輸入大於0的數字(A)：</label>
                </div>
                <div class="col-75">
                    <input type="number" id="numA" name="numberA" value="69">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="numB">請輸入大於0的數字(B)：</label>
                </div>
                <div class="col-75">
                    <input type="number" id="numB" name="numberB" value="54">
                </div>
            </div>
            <div class="row">
                <br>
                <input type="submit" value="開始計算">
            </div>
        </form>

        <br><br><br>
        <?php
        //輸出結果參考
        /*3 是質數 因數有：3 / 1 /
        69369 是合數 因數有：69369 / 23123 / 3651 / 1217 / 57 / 19 / 3 / 1 /
        3 與 69369 兩數不互質 公因數有：3 / 1 /
        兩數最大公因數：3
        兩數最小公倍數：69369
        */
        if (isset($_POST['numberA']) && isset($_POST['numberB'])) {
            $a = $_POST['numberA'];
            $b = $_POST['numberB'];

            if ($a == "" || $b == "") {
                echo "<div class=\"row\"><div class=\"error\">有數字尚未輸入，請檢查!</div></div>";
            } else if ((int)$a <= 0 || (int)$b <= 0) {
                echo "<div class=\"row\"><div class=\"error\">輸入的數字小於或等於0 請改為輸入大於的數字喔!</div></div>";
            } else {
                echo "<div class=\"row\"><div class=\"info\">接收到的數字A:$a , 數字B:$b</div></div>";
                echo "<br><div class=\"row\"><div class=\"info\">";

                //以下進行因數運算
                $a_factors = array(1);
                $b_factors = array(1);
                for ($i = 2; $i <= ($a / 2); $i++) {
                    if ($a % $i == 0) {
                        array_push($a_factors, $i);
                    }
                }
                array_push($a_factors, $a);//自己也是因數
                for ($i = 2; $i <= ($b / 2); $i++) {
                    if ($b % $i == 0) {
                        array_push($b_factors, $i);
                    }
                }
                array_push($b_factors, $b);

                if (sizeof($a_factors) == 2) {
                    echo "$a 是質數 因數有:";
                } else echo "$a 是合數 因數有:";
                foreach ($a_factors as $factor) {
                    echo "$factor ";
                }

                if (sizeof($b_factors) == 2) {
                    echo "<br>$b 是質數 因數有:";
                } else echo "<br>$b 是合數 因數有:";
                foreach ($b_factors as $owo) {
                    echo "$owo ";
                }

                echo "</div></div>";
            }
        }
        ?>

    </div>
</body>

</html>