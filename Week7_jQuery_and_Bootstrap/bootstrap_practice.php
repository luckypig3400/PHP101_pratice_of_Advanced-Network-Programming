<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Bootstrap Playground</h1>

    <br>
    <h3>Badges</h3><br>
    <!-- https://getbootstrap.com/docs/5.1/components/badge/ -->
    <button type="button" class="btn btn-primary">
        首頁
    </button>
    <a href="https://tw.yahoo.com/?p=us">
        <button type="button" class="btn btn-info">
            Yahoo通知
            <span class="badge bg-secondary">
                <?php
                echo rand(1, 69);
                ?>
            </span>
        </button>
    </a>
    <button type="button" class="btn btn-outline-info position-relative">
        廣告
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            99+
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>
    <button type="button" class="btn btn-outline-info">
        我的帳號
    </button>
    <button type="button" class="btn btn-danger">
        登出
    </button>
    <br><br><br>

    <h3>Progress Bar</h3>
    <br><br><br>
    <!-- https://getbootstrap.com/docs/5.1/components/progress/ -->
    <div class="progress">
        <?php $progressValue = rand(0, 100); ?>
        <div class="progress-bar bg-danger" role="progressbar" style="width: 
        <?php if ($progressValue <= 60) echo $progressValue;
        else echo "60"; ?>%"></div>
        <div class="progress-bar bg-warning" role="progressbar" style="width: 
            <?php if ($progressValue <= 60) echo "0";
            else if ($progressValue >= 90) echo "30";
            else echo $progressValue - 60; ?>%"></div>
        <div class="progress-bar bg-success" role="progressbar" style="width:
            <?php if ($progressValue >= 90) echo $progressValue - 90; ?>%"></div>
    </div>
    <p>
        Progress Value: <?php echo $progressValue; ?> %
    </p>

</body>

</html>