<?php 
include_once("userloggedin.php")
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Product - Love Fruit &amp; Veg</title>
    <meta name="description" content="Our team and LF&amp;V will always be on hand to provide you with fresh fruit and veg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">Love Fruit &amp; Veg</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-2">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index-1.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="shopping-cart.php">My Basket</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="catalog-page.php">products</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about-us-1.php">About Us</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us-1.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page product-page">
        <section class="clean-block clean-product dark" style="background-image: url(&quot;assets/img/project/background.jpg&quot;);">
            <div class="container">
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6" style="padding: 0px 0px;color: rgb(255,255,255);opacity: 1;"><img style="width: 450px;height: 510px;margin: 0px;color: rgba(255,255,255,0);" src="assets/img/project/6%20-%20Brussel%20Sprouts.jpg"></div>
                            <div class="col-md-6" style="width: 300px;">
                                <form name="add_to_cart" action="cart.php" method="post">
                                    <div class="info">
                                        <h3>Brussel sprouts - Redmere Farms<br></h3> <input type="hidden" value="Brussel sprouts" name="product">
                                        <div class="price">
                                            <h3 style="margin: 0px;width: 20px;">£</h3><input class="bg-white form-control form-control no-border" type="text" style="width: 110px;height: 28px;padding: 0px;margin: -28.7px 18px 20px;font-size: 25px;" value="0.85" name="price" readonly="">
                                            <button
                                                class="btn btn-primary" type="submit" style="margin: 0px 0px ;" name="add_to_cart"><i class="icon-basket"></i>Add to Cart</button><input class="bg-white form-control form-control no-border" type="hidden" style="width: 110px;" value="item code:"
                                                    readonly=""><input class="bg-white form-control form-control no-border" type="hidden" style="width: 110px;" value="6" name="item_code" readonly=""></div>
                                        <p style="margin: 0px 0px 2px;">Enter quantity</p><input class="form-control quantity-input" type="number" value="1" name="qty">
                                        <div class="summary">
                                            <p style="margin: 0px;">500g bundle</p>
                                            <br>
                                            <p style="margin: 0px;">Vendor - Redmere Farms</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="product-info"></div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
