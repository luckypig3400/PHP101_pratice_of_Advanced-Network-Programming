<?php
//https://picsum.photos/
$url = "https://picsum.photos/369";
$img = "./img/" . generateRandomString() . ".png";

// https://stackoverflow.com/questions/724391/saving-image-from-php-url
file_put_contents($img, file_get_contents($url));

header("Location:./imageUploader.php");


// https://stackoverflow.com/questions/4356289/php-random-string-generator
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Image Downloader</title>
</head>

<body>
    <h1>Downloading... Please wait for a moment~</h1>
</body>

</html>