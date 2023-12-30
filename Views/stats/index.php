<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authors Stats</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">
    <link rel="stylesheet" href="/sass/Stats.css">

</head>
<body>

    <div class="nav-bar">
        <?php if($this->sender == "Manager"): ?>
            <?php require "./../Views/Templates/Dashboard/Topnav.php" ?>
        <?php else:?>
            <?php require "./../Views/Templates/Dashboard/ModeratorsNav.php" ?>
        <?php endif; ?>
    </div>
    <div class="body-container">
        <div class="body-nav">
            <?php if($this->sender == "Manager"): ?>
                <?php require "./../Views/Templates/Dashboard/ManagerSecondNav.php" ?>
            <?php else: ?>
                <?php require "./../Views/Templates/Dashboard/ModeratorsBodyNav.php" ?>
            <?php endif; ?>
        </div>
        <div class="body-contents">
            <div class="stats_nav">
                <div class="manage">
                <?php if($this->sender == "Manager"): ?>
                    <a href="/Dashboard/Manage/Authors">Manage Authors</a>
                <?php else: ?>
                    <a href="/Dashboard/Moderator/Authors">Manage Authors</a>
                <?php endif; ?>
                </div>
                <div class="info">
                    <div class="count">
                        <?= count($this->data ?? [])?>
                    </div>
                    <div class="text">
                        Authors
                    </div>
                </div>
            </div>
            <div class="authors_stats_container">
                <?php foreach ($this->data ?? [] as $stats): ?>
                    <div class="stats">
                        <div class="username">
                            <?= $stats['username'] ?? "Unknown"?>
                        </div>
                        <div class="articles">
                            <?= $stats['articles'] ?? "0"?> Articles
                        </div>
                        <div class="views">
                            <?= $stats['views'] ?? "O"?> Views
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>