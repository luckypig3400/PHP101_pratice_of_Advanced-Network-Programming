<?php
// 建立CURL連線
$ch = curl_init();
// 設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, "https://data.epa.gov.tw/api/v1/aqx_p_432?limit=1000&api_key=9be7b239-557b-4c10-9775-78cadfc555e9&sort=ImportDate%20desc&format=json");
curl_setopt($ch, CURLOPT_HEADER, false);
//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 執行
$output = curl_exec($ch);
// 關閉CURL連線
curl_close($ch);

$AQIjsonFile = fopen("./AQI_tw.json","w") or die("無法存取檔案QAQ");
fwrite($AQIjsonFile, $output);
fclose($AQIjsonFile);

header("Location:./pm2dot5_crawler.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用Curl爬取資料</title>
</head>
<body>
    
</body>
</html>