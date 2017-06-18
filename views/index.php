<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Billplz for Ecwid</title>
        <link rel="stylesheet" href="views/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
        <link rel="stylesheet" href="views/assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="views/assets/css/Carousel-Hero.css">
        <link rel="stylesheet" href="views/assets/css/Pretty-Footer.css">
        <link rel="stylesheet" href="views/assets/css/Pretty-Registration-Form.css">
        <link rel="stylesheet" href="views/assets/css/styles.css">
        <link rel="stylesheet" href="views/assets/css/Tabbed-Panel1.css">
    </head>

    <body>
        <div class="carousel slide" data-ride="carousel" id="carousel-1">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="jumbotron hero-nature carousel-hero">
                        <h1 class="hero-title">Billplz for Ecwid</h1>
                        <p class="hero-subtitle">Accept Payment using Billplz for Ecwid</p>
                        <p><a class="btn btn-primary btn-lg hero-button" role="button" href="http://fb.com/billplzplugin">Learn more</a></p>
                    </div>
                </div>
                <div class="item">
                    <div class="jumbotron hero-technology carousel-hero">
                        <h1 class="hero-title">Maintained by Billplz Plugin/Module/Extension</h1>
                        <p class="hero-subtitle">This project is developed and maintained by Billplz Plugin/Modle/Extension. Any inquiry can be made to our Facebook page!</p>
                        <p><a class="btn btn-primary btn-lg hero-button" role="button" href="http://fb.com/billplzplugin">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div><a class="left carousel-control" href="#carousel-1" role="button" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i><span class="sr-only">Previous</span></a>
                <a class="right carousel-control" href="#carousel-1" role="button" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i><span class="sr-only">Next</span></a>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-1" data-slide-to="1"></li>
            </ol>
        </div>
        <div class="row register-form">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal custom-form">
                    <h1>Register Account</h1>
                    <p>Please Input Your API Secret Key, X Signature Key and Collection ID. You are required to take note the information provided after the Register Account</p>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="name-input-field">API Secret Key</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" id="api_secret_key">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="name-input-field">X Signature Key</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" id="x_signature">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="name-input-field">Collection ID</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" id="collection_id">
                        </div>
                    </div>
                    <button class="btn btn-default submit-button" type="button" id="registeraccount">REGISTER ACCOUNT</button>
                    <p>Status Message: <span id="status_message" style="color: red;">Please Insert Your API Secret Key, X Signature Key and Collection ID to continue</span></p>
                    <hr>
                    <p id="api_login_id_display" style="display: none;">API Login ID: <span id="api_login_id" style="color: red;"></span></p>
                    <p id="transaction_key_display" style="display: none;">Transaction Key: <span id="transaction_key" style="color: red;"></span></p>
                    <p id="md5_hash_display" style="display: none;">MD5 Hash Value: <span id="md5_hash_value" style="color: red;"></span></p>
                    <p id="transaction_type_display" style="display: none;">Transaction Type: <span style="color: red;">Authorize and Capture</span></p>
                    <p id="endpoint_url_display" style="display: none;">Endpoint URL: <span id="endpoint_url" style="color: red;"></span></p>
                </form>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-md-4 col-sm-6 footer-navigation">
                    <h3><a href="#">Billplz <span>Plugin/Module/Extension </span></a></h3>
                    <p class="links"><strong> </strong><a href="http://wanzul.net/donate">Make A Donation!</a><strong> </strong></p>
                    <p class="company-name">Wanzul Hosting Enterprise: PC0012291-H</p>
                </div>
                <div class="col-md-4 col-sm-6 footer-contacts">
                    <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                        <p><span class="new-line-span">Bayan Lepas</span> Penang, Malaysia</p>
                    </div>
                    <div><i class="fa fa-phone footer-contacts-icon"></i>
                        <p class="footer-center-info email text-left"> +6014 - 535 6443</p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="#" target="_blank">wan@wanzul-hosting.com</a></p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 footer-about">
                    <h4>About the company</h4>
                    <p>We dedicated to help Malaysian's to start an online business! Tell your friends and start doing online business now! </p>
                    <div class="social-links social-icons"><a href="http://fb.com/billplzplugin"><i class="fa fa-facebook"></i></a><a href="http://github.com/wzul"><i class="fa fa-github"></i></a></div>
                </div>
            </div>
        </footer>
        <script src="views/assets/js/jquery.min.js"></script>
        <script src="views/assets/js/user_script.js"></script>
        <script src="views/assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>