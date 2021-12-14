<!-- https://data.gov.tw/dataset/40448 -->
<!-- https://data.epa.gov.tw/api/v1/aqx_p_432?limit=1000&api_key=9be7b239-557b-4c10-9775-78cadfc555e9&sort=ImportDate%20desc&format=json -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>空氣品質AQI與PM2.5統計表格</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<?php
$dataURL = "https://data.epa.gov.tw/api/v1/aqx_p_432?limit=1000&api_key=9be7b239-557b-4c10-9775-78cadfc555e9&sort=ImportDate%20desc&format=json";

$downloadedJson = file_get_contents($dataURL);
// https://stackoverflow.com/questions/3062324/what-is-curl-in-php
// echo $downloadedJson;

$AQIjsonFile = fopen("./AQI_tw.json", "w") or die("無法存取檔案");
// https://www.w3schools.com/php/php_file_create.asp
fwrite($AQIjsonFile, $downloadedJson);
fclose($AQIjsonFile);

?>

<body>
    <div class="container" style="text-align: center;">
        <div class="row">
            <h1>空氣品質AQI與PM2.5統計表格</h1>
        </div>

        <div class="row">
            <form action="./curl_crawler.php">
                <input type="submit" value="使用Curl抓取資料"><br><br><br>
            </form>
        </div>

        <div class="table-rwd">
            <table>
                <thead>
                    <tr>
                        <th>測站名稱SiteName</th>
                        <th>所屬縣市County</th>
                        <th>空氣品質AQI</th>
                        <th>Pollutant</th>
                        <th>評測狀態Status</th>
                        <th>SO2</th>
                        <th>CO</th>
                        <th>CO_8hr</th>
                        <th>O3</th>
                        <th>O3_8hr</th>
                        <th>PM10</th>
                        <th>PM2</th>
                        <th>NO2</th>
                        <th>NOx</th>
                        <th>NO</th>
                        <th>WindSpeed</th>
                        <th>WindDirec</th>
                        <th>PublishTime</th>
                        <th>PM2.5_AVG</th>
                        <th>PM10_AVG</th>
                        <th>SO2_AVG</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>SiteId</th>
                        <th>ImportDate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jsonFile = "./AQI_tw.json";
                    $jsonData = file_get_contents($jsonFile);

                    // https://www.w3schools.com/Php/func_json_decode.asp
                    $arr = json_decode($jsonData, true);

                    // echo sizeof($arr["records"]) . '<br>' . sizeof($arr);

                    for ($i = 0; $i < sizeof($arr["records"]); $i++) {
                        echo "<tr>";
                        echo "<td>" . $arr["records"][$i]["SiteName"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["County"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["AQI"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["Pollutant"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["Status"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["SO2"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["CO"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["CO_8hr"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["O3"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["O3_8hr"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["PM10"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["PM2.5"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["NO2"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["NOx"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["NO"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["WindSpeed"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["WindDirec"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["PublishTime"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["PM2.5_AVG"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["PM10_AVG"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["SO2_AVG"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["Longitude"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["Latitude"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["SiteId"] . "</td>";
                        echo "<td>" . $arr["records"][$i]["ImportDate"] . "</td>";
                        echo "</tr>";
                    }
                    // print_r($arr);

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>