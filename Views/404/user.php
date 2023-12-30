
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Page not found</title>

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
    <h1 class="not_found">
        <?php
            echo $this->message ?? "Page not found.";
        ?>
        <a href="/">
            "Go back to Home"
        </a>
    </h1>
</div>

<?php require_once  "./../Views/Templates/Footer.php" ?>
</body>

<style>
    .posts_container{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

    }
    .not_found{
        background: var(--body-bg-color);
        padding: 20px;
        display: flex;
        border-radius: 3px;
        align-items: center;
        flex-direction: column;
        font-size: 3vw;
        color: var(--nav-bg-color);
    }

    .not_found > a{
        text-decoration: none;
        font-size: 3.1vw;
        color: var(--nav-bg-color);
        padding: 10px 0;
    }

    .not_found > a:hover{
        opacity: .8;
    }

    @media screen and (max-width: 500px) {
        .not_found{
            width: 100%;
            margin: 100px;
        }
    }
</style>