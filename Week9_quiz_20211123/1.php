<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general_style.css">
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>Bootstrap Quiz</title>
    <script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Week9 Bootstrap控制桿 Quiz 20211123</h1>

        <div class="row">
            <?php
            $rangeBarValue = isset($_POST["rangeBar"]) ? $_POST["rangeBar"] : "";
            ?>
            <form action="1.php" method="POST">
                <input type="range" class="form-range" name="rangeBar" min="1" max="5" step="0.5" <?php if ($rangeBarValue != "") echo "value=\"" . $rangeBarValue . "\""; ?>>
                <input type="submit">
            </form>
        </div>

        <br><br><br>
        <div class="row">
            <h2>接收到的控制桿數值為:</h2>
            <?php
            if ($rangeBarValue != "") {
                echo "<h3>" . $rangeBarValue . "</h3>";
            } else {
                echo "<h3>尚未接收到任何數值</h3>";
            }
            ?>
        </div>
    </div>

</body>

</html>