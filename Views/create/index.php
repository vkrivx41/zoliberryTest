<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new post</title>
    <link rel="stylesheet" href="./../sass/navbar.css">
    <link rel="stylesheet" href="./../sass/Manager.css">
    <link rel="stylesheet" href="./../sass/CreateNew.css">
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
            <?php require_once "./../Views/Templates/Dashboard/CreateNew.php"?>
        </div>
    </div>
</body>
</html>