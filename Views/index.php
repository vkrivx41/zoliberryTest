
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/News.css">

    <script src="/js/Toggler.js" defer></script>
    <script src="/js/TopStoriesFetcher.js" type="module"></script>
</head>
<body>
    <?php require_once  "./../Views/Templates/Navbar.php" ?>
    <?php require_once "./../Views/Templates/Services.php"?>


    <div class="posts_container">
        <?php require './../Views/Templates/Topstories.php' ?>
        <?php require './../Views/Templates/Storiesgrid.php' ?>
        <?php require  "./../Views/Templates/Mobileview.php" ?>
    </div>

    <footer>
    <div class="left-footer">
        <div class="header" style="color: white;">Find Us here.</div>
        <div class="find-us-link">
            <div class="link">
                <a style="color: white;" href="https://facebook.com/zoliberry">Facebook</a>
            </div>
            <div class="link">
                <a style="color: white;" href="https://instagram.com/zoliberry">Instagram</a>
            </div>
            <div class="link">
                <a style="color: white;" href="https://twitter.com/Zoliberry">Twitter</a>
            </div>
            <div class="link">
                <a style="color: white;" href="https://tiktok.com/@zoliberry">TikTok</a>
            </div>
            <div class="link">
                <a style="color: white;" href="https://threads.net/@zoliberry">Threads</a>
            </div>
        </div>
    </div>
    <div class="center-footer">
        <div style="color: white;" class="header">Explore <?= $_ENV['WEBSITE_NAME'] ?? "ZOLIBERY"?></div>
        <div class="explore-links">
            <div class="link">
                <a style="color: white;" href="/">Home</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/News">News</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/Music">Music</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/Sports">Sports</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/Lifestyle">Lifestyle</a>
            </div>
        </div>
    </div>
    <div class="right-footer">
        <div class="header" style="color: white;">
            Work and Operate with us.
        </div>
        <div class="operation-links">
            <div class="link">
                <a style="color: white;" href="/AdvertiseWithUs">Advertise with us</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/AboutUs">About us</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/ContactUs">Contact us</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/Privacy">Privacy and policy</a>
            </div>
            <div class="link">
                <a  style="color: white;"href="/TermsAndConditions">Terms and Conditions</a>
            </div>
            <div class="link">
                <a style="color: white;" href="/Developers">Developers of <?= $_ENV['WEBSITE_NAME'] ?? "Zoliberry" ?></a>
            </div>
        </div>
    </div>
</footer>
</body>


<style>
    footer{
        background: black;
        color: red;
    }
    footer > div > div> .link{
        border: none;
        border-right: 2px solid white;
    }
</style>
