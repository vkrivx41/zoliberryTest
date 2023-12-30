<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - Page not Found</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Articles.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">

    <script src="/js/ArticlesController.js" type="module"></script>
</head>
<body>
<div class="nav-bar">
    <?php require_once "./../Views/Templates/Dashboard/Topnav.php" ?>
</div>
<div class="body-container">
    <div class="body-nav">
        <?php require_once "./../Views/Templates/Dashboard/ManagerSecondNav.php"?>
    </div>

    <div class="body-contents">
        <h1 class="not_found">
            <?php
            echo $this->message ?? "Page not found.";
            ?>
            <a href="/Dashboard">
                "Go back to Dashboard"
            </a>
        </h1>
    </div>
</div>
</body>
</html>

<style>
    .body-contents{
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