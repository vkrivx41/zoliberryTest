
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/News.css">
    <link rel="stylesheet" href="/sass/FooterELements.css">

    <script src="./../js/Toggler.js" defer></script>
    <script src="./../js/TopStoriesFetcher.js" type="module"></script>
</head>

<body>
    <?php  require_once  "./../Views/Templates/Navbar.php"?>

    <div class="posts_container">
        <div class="header">
            <h1>Terms and Conditions</h1>
        </div>
        <div class="contents">
            <div class="advert_header">
                Our terms and conditions relies on protecting our published texts, images, and videos not to be used by anyone.
                If you would like to use or have any of them feel free to contact us.
                <p>
                    You can contact us here:
                </p>
            </div>
            <div class="advert_contacts">
            <div class="phone">
                    <div class="key">Contact page: </div>
                    <div class="value">
                        <a href="/contactus">Contact us</a>
                    </div>
                </div>
                <div class="phone">
                    <div class="key">Phone: </div>
                    <div class="value">
                        <?= $_ENV['WEBSITE_PHONE'] ?? "+250782987183" ?>
                    </div>
                </div>
                <div class="email">
                    <div class="key">Email:</div>
                    <div class="value">
                        <?= $_ENV['WEBSITE_EMAIL'] ?? "ads.zolibery@gmail.com" ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php  require_once  "./../Views/Templates/Footer.php"?>
</body>
</html>