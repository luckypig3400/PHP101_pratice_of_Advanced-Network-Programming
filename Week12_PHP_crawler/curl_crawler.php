<?php
// 建立CURL連線
$ch = curl_init();
// 設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, "https://tw.yahoo.com/");
curl_setopt($ch, CURLOPT_HEADER, false);
//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 執行
$output = curl_exec($ch);
// 關閉CURL連線
curl_close($ch)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用Curl爬取資料</title>
</head>
<body>
    
</body>
</html>