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
                            <div class="sidebar-heading pt-5 pb-4"><strong>PAY WITH</strong></div>
                            <div class="list-group list-group-flush"> <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item bg-light">
                                    <div class="list-div my-2">
                                        <div class="fa fa-home"></div> &nbsp;&nbsp; Bank
                                    </div>
                                </a> <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item active1">
                                    <div class="list-div my-2">
                                        <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Card
                                    </div>
                                </a> <a data-toggle="tab" href="#menu3" id="tab3" class="tabs list-group-item bg-light">
                                    <div class="list-div my-2">
                                        <div class="fa fa-qrcode"></div> &nbsp;&nbsp;&nbsp; Visa QR <span id="new-label">NEW</span>
                                    </div>
                                </a> </div>
                        </div> <!-- Page Content -->
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
                                            <p class="mb-0 mr-4 mt-4 text-right">customer@email.com</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-right">
                                        <div class="col-12">
                                            <p class="mb-0 mr-4 text-right">Pay <span class="top-highlight">$ 100</span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="text-center" id="test">Pay</div>
                            </div>
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="form-card">
                                                <h3 class="mt-0 mb-4 text-center">Enter bank details to pay</h3>
                                                <form onsubmit="event.preventDefault()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group"> <input type="text" id="bk_nm" placeholder="BBB Bank"> <label>BANK NAME</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group"> <input type="text" name="ben_nm" id="ben-nm" placeholder="John Smith"> <label>BENEFICIARY NAME</label> </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group"> <input type="text" name="scode" placeholder="ABCDAB1S" class="placeicon" minlength="8" maxlength="11"> <label>SWIFT CODE</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"> <input type="submit" value="Pay $ 100" class="btn btn-success placeicon"> </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-center mb-5" id="below-btn"><a href="#">Use a test card</a></p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane in active">
                                    <div class="row justify-content-center">
                                        <div class="col-11">
                                            <div class="form-card">
                                                <h3 class="mt-0 mb-4 text-center">Enter your card details to pay</h3>
                                                <form onsubmit="event.preventDefault()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group"> <input type="text" id="cr_no" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19"> <label>CARD NUMBER</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="input-group"> <input type="text" name="exp" id="exp" placeholder="MM/YY" minlength="5" maxlength="5"> <label>CARD EXPIRY</label> </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group"> <input type="password" name="cvcpwd" placeholder="&#9679;&#9679;&#9679;" class="placeicon" minlength="3" maxlength="3"> <label>CVV</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"> <input type="submit" value="Pay $ 100" class="btn btn-success placeicon"> </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-center mb-5" id="below-btn"><a href="#">Use a test card</a></p>
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
                                            <h3 class="mt-0 mb-4 text-center">Scan the QR code to pay</h3>
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