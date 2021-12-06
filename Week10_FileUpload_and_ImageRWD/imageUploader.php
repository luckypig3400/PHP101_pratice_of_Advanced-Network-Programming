<?php
$target_dir = "./img/";
$target_file = $target_dir . basename($_FILES["uploadImage"]["name"]);
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["imgSubmit"])) {
    $check = getimagesize($_FILES["uploadImage"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image~ " . $check["mime"] . ".";
        $uploadOK = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exist >_<";
    $uploadOK = 0;
}

// Check file size
if ($_FILES["uploadImage"]["size"] > 6969000) {
    echo "Sorry, your file is too large.";
    $uploadOK = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOK == 0) {
    echo "Sorry, your file was not uploaded OAO";
} else { // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $target_file)) {
        echo "<br>The file " . htmlspecialchars(basename($_FILES["uploadImage"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error while uploading your file.";
    }
}

?>

<!DOCTYPE html>
<html>

<!-- https://bbbootstrap.com/snippets/payment-form-three-transfer-options-30514683 -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圖片上傳器與響應式相簿</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid px-0" id="bg-div">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card card0">
                    <div class="d-flex" id="wrapper">
                        <!-- Sidebar -->
                        <div class="bg-light border-right" id="sidebar-wrapper">
                            <div class="sidebar-heading pt-5 pb-4"><strong>圖片上傳器與<br>響應式相簿</strong></div>
                            <div class="list-group list-group-flush">
                                <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item active1">
                                    <div class="list-div my-2">
                                        <div class="fa fa-upload"></div> &nbsp;&nbsp; 上傳相片
                                    </div>
                                </a>
                                <a data-toggle="tab" href="#menu3" id="tab3" class="tabs list-group-item bg-light">
                                    <div class="list-div my-2">
                                        <div class="fa fa-image"></div> &nbsp;&nbsp;&nbsp; 瀏覽相簿 <span id="new-label">NEW</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="row pt-3" id="border-btm">
                                <div class="col-4"> <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                        <div class="bar4"></div>
                                    </button> </div>
                                <div class="col-8">
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 mt-4 text-right">luckyowo@email.com&nbsp;</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 text-right">小額贊助開發者<span class="top-highlight">$ 60&nbsp;</span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="text-center" id="test">喵</div>
                            </div>
                            <div class="tab-content">
                                <div id="menu2" class="tab-pane in active">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="form-card">
                                                <h3 class="mt-0 mb-4 text-center">選擇想要上傳的檔案</h3>
                                                <form enctype="multipart/form-data" method="post" action="./imageUploader.php">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <!-- <input id="uploadImage" name="uploadImage" type="file" class="file"accept=".jpg,.jpeg,.png,.bmp,.gif,.jfif" data-browse-on-zone-click="true"> -->
                                                            <!-- https://stackoverflow.com/questions/4328947/limit-file-format-when-using-input-type-file -->
                                                            <input id="uploadImage" name="uploadImage" type="file" class="file" accept="image/*" data-browse-on-zone-click="true">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"> <input type="submit" value="Upload Image" class="btn btn-success placeicon" name="imgSubmit"> </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-center mb-5" id="below-btn"><a href="#">Auto upload a test image</a></p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu3" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <h3 class="mt-0 mb-4 text-center">瀏覽已上傳相片</h3>
                                            <div class="row justify-content-center">
                                                <div id="qr"> <img src="https://i.imgur.com/DD4Npfw.jpg" width="200px" height="200px"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>