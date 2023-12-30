
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/News.css">

    <script src="./../js/Toggler.js" defer></script>
    <script src="./../js/TopStoriesFetcher.js" type="module"></script>
</head>

<body>
    <?php  require_once  "./../Views/Templates/Navbar.php"?>
    <br>
    <?php  require_once  "./../Views/Templates/TagAndDate.php"?>

    <div class="posts_container">
        <?php require './../Views/Templates/Topstories.php' ?>
        <?php require './../Views/Templates/Storiesgrid.php' ?>
        <?php require  "./../Views/Templates/Mobileview.php" ?>
    </div>

    <?php  require_once  "./../Views/Templates/Footer.php"?>
</body>
