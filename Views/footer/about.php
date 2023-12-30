
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/News.css">
    <link rel="stylesheet" href="/sass/FooterElements.css">

    <script src="./../js/Toggler.js" defer></script>
    <script src="./../js/TopStoriesFetcher.js" type="module"></script>
</head>

<body>
    <?php  require_once  "./../Views/Templates/Navbar.php"?>

    <div class="posts_container">
        <div class="header">
            <h1>About Us</h1>
        </div>
        <div class="contents">
            <div class="about_intro">
                <p>
                    Zolibery is an online working newsletter dedicating to fulfill your concerns on a daily basis, It is comprised of professional journalists and a group of analysts taking time to give your updates on what your love the most.
                </p>
                <p>
                    Our newsletter works 24/7 to never let your leave behind the times and lose comfort. Our articles and contents are highly reviewed before being uploaded to avoid racism, discrimination, and other online misbehaviours.
                </p>
                <p>
                    Our articles are based on:
                </p>
            </div>
            <div class="categories">
                <ul>
                    <li><a href="/News">News</a></li>
                    <li><a href="/Sports">Sports</a></li>
                    <li><a href="/Music">Music</a></li>
                    <li><a href="/Lifestyle">Lifestyle</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php require_once  "./../Views/Templates/Footer.php" ?>
</body>
</html>