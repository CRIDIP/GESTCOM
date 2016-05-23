<?php
require "../application/classe.php";
?>
<!DOCTYPE html>
<html>
<head>
    <!-- BEGIN META SECTION -->
    <meta charset="utf-8">
    <title>Themes Lab - Creative Laborator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <link rel="shortcut icon" href="<?= $constante->getUrl(array('images/')); ?>favicon.png">
    <!-- END META SECTION -->
    <!-- BEGIN MANDATORY STYLE -->
    <link href="<?= $constante->getUrl(array('css/')); ?>style.css" rel="stylesheet">
    <link href="<?= $constante->getUrl(array('css/')); ?>ui.css" rel="stylesheet">
    <!-- END  MANDATORY STYLE -->
</head>
<body class="coming-soon coming-map">
<div class="map-container">
    <div id="map"></div>
</div>
<div class="coming-container">
    <!-- BEGIN LOGIN BOX -->
    <!-- Social Links -->
    <!--<nav class="social-nav">
        <ul>
            <li><a href="#"><img src="assets/images/social/icon-facebook.png" alt="facebook"/></a></li>
            <li><a href="#"><img src="assets/images/social/icon-twitter.png" alt="twitter"/></a></li>
            <li><a href="#"><img src="assets/images/social/icon-google.png" alt="google"/></a></li>
            <li><a href="#"><img src="assets/images/social/icon-dribbble.png" alt="dribbble"/></a></li>
            <li><a href="#"><img src="assets/images/social/icon-linkedin.png" alt="facebook"/></a></li>
            <li><a href="#"><img src="assets/images/social/icon-pinterest.png" alt="linkedin" /></a></li>
        </ul>
    </nav>-->
    <!-- Site Logo -->
    <div id="logo"><img src="<?= $constante->getUrl(array('images/')); ?>logo/logo-white.png" alt="logo"></div>
    <!-- Main Navigation -->
    <nav class="main-nav">
        <ul>
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    <!-- Home Page -->
    <div class="row">
        <div class="col-md-6">
            <section class="content show" id="home">
                <h1>Welcome</h1>
                <h5>Our new site is coming soon!</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate arcu sit amet sem venenatis dictum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eu massa sed orci interdum lobortis. Vivamus rutrum.</p>
                <p><a href="#about">More info &#187;</a></p>
            </section>
            <!-- About Page -->
            <section class="content hide" id="about">
                <h1>About</h1>
                <h5>Here's a little about what we're up to.</h5>
                <p>Nullam quis arcu a elit feugiat congue nec non orci. Pellentesque feugiat bibendum placerat. Nullam eu massa in ipsum varius laoreet. Ut tristique pretium egestas. Sed sed velit dolor. Nam rhoncus euismod lorem, id placerat ipsum placerat nec. Mauris ut eros a ligula tristique lacinia non blandit metus. Sed vitae velit lorem, et scelerisque diam.</p>
                <p><a href="#">Follow our updates on Twitter</a></p>
            </section>
            <!-- Contact Page -->
            <section class="content hide" id="contact">
                <h1>Contact</h1>
                <h5>Get in touch.</h5>
                <p>Email: <a href="#">info@avenir.com</a><br />
                    Phone: 123.456.7890<br />
                </p>
                <p>123 East Main<br />
                    New York, NY 12345
                </p>
            </section>
        </div>
        <div class="col-md-6">
            <div id="countdown-1">00 weeks 00 days <br> 00:00:00</div>
        </div>
    </div>
</div>
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- BEGIN MANDATORY SCRIPTS -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-1.11.1.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>gsap/main-gsap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>countdown/jquery.countdown.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true"></script> <!-- Google Maps -->
<script src="https://google-maps-utility-library-v3.googlecode.com/svn-history/r391/trunk/markerwithlabel/src/markerwithlabel.js"></script>
<script src="<?= $constante->getUrl(array('plugins/')); ?>google-maps/gmaps.min.js"></script>  <!-- Google Maps Easy -->
<script src="<?= $constante->getUrl(array('plugins/')); ?>backstretch/backstretch.min.js"></script>
<script src="<?= $constante->getUrl(array('js/')); ?>pages/coming_soon.js"></script>
<script type="text/javascript">
    $('#countdown-1').countdown('2016/05/09 15:00:00', function(event) {
        $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
    });
</script>
</body>
</html>