<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage - Personal</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/CreateNew.css">
    <link rel="stylesheet" href="/sass/Manage-Personal.css">
</head>
<body>
<?php require_once "./../Views/Templates/Dashboard/AuthorsNav.php" ?>

<div class="body-container">
    <?php require_once "./../Views/Templates/Dashboard/AuthorsBodyNav.php" ?>
    <div class="body-contents">
        <div class="create-contents">
            <?php require_once "./../Views/Templates/Dashboard/author-personal.php"?>
        </div>
    </div>
</div>
</body>
</html>


<style>


</style>