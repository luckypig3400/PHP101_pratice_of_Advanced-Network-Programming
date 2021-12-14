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

<body>
    <div class="container" style="text-align: center;">
        <div class="row">
            <h1>空氣品質AQI與PM2.5統計表格</h1>
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
                    echo "<tr><td></td></tr>";
                    ?>
                    <!-- Table row example
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>