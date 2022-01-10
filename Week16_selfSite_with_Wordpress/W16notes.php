<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress練習 架設於Docker container內</title>
    <link rel="stylesheet" href="../general_style.css">
</head>

<body>
    <div class="container">
        <h3>練習題 (4選2檢查)</h3>
        <div class="row">
            <p>
                ● 修改(或自行新增設計)網頁最上面的圖片，使美化之。<br>
                ● 修改網頁最下面的資訊，隱藏所有與你網站無關的資訊(例如原有LOGO、版權聲明等)，使資訊個人化。<br>
                ● 於適當處加入一北護資管的廣告(含連結)以上修改，需包含所有頁面(或大部分頁面)<br>
                ● 經營一網站。<br>
            </p>
        </div>

        <h3>Docker筆記</h3>
        <div class="row">
            <p>
                <a href="https://hub.docker.com/r/tomsik68/xampp/">Xampp Docker Image 照著指令pull下來即可</a><br><br>
                <a href="https://github.com/tomsik68/docker-xampp">Xampp Image作者的Github</a><br><br>
                <a href="https://hackmd.io/@titangene/docker-lamp">利用 Dockfile、Docker Compose 建立 LAMP 環境 (PHP、Apache、MySQL)</a><br><br>
                <a href="https://gist.github.com/BFTrick/11294357">Wordpress下載與安裝</a><br><br>
                <b>因為發現還要設定FTP才能順利安裝主題，因此採用下方的Wordpress官方Docker Image</b>
            </p>

            <h4>發現有Wordpress官方提供的Image直接pull下來使用即可</h4>
            <a href="https://hub.docker.com/_/wordpress">Wordpress Docker image</a><br><br>
            <a href="https://docs.docker.com/samples/wordpress/">Wordpress + MySQL設定教學</a><br>連結內含docker-compose.yml的撰寫參考<br><br>

        </div>

    </div>
</body>

</html>