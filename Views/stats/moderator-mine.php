<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/CreateNew.css">
    <link rel="stylesheet" href="/sass/Manage-Personal.css">
    <link rel="stylesheet" href="/sass/Stats.css">
</head>
<body>
<?php require_once "./../Views/Templates/Dashboard/ModeratorsNav.php" ?>

<div class="body-container">
    <?php require_once "./../Views/Templates/Dashboard/ModeratorsBodyNav.php" ?>
    <div class="body-contents">
        <div class="stats_contents">
            <div class="header">
                Your views and articles stats ranging from <?= $this->data['start'] ?> to <?= $this->data['end'] ?>
            </div>
            <div class="stats">
                <div class="articles">
                    <?= $this->data[0]['articles'] ?? "0"?> Articles Uploaded
                </div>
                <div class="views">
                    <?= $this->data[0]['views'] ?? "0"?> Views Combined
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
