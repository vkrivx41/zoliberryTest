<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new moderator</title>
    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/CreateNew.css">
    <link rel="stylesheet" href="/sass/Create-Author.css">
</head>
<body>
<div class="nav-bar">
    <?php require_once "./../Views/Templates/Dashboard/Topnav.php" ?>
</div>
<div class="body-container">
    <div class="body-nav">
        <?php require_once "./../Views/Templates/Dashboard/ManagerSecondNav.php" ?>
    </div>
    <div class="body-contents">
        <div class="header">
            <h3><?= $this->create ? "Moderator created successfully" : (!$this->reName ? "Fill in data for your moderator." : '') ?></h3>
            <h3><?= $this->reName ? "A moderator with that username already exist.": ''?></h3>
        </div>
        <div class="form">
            <form action="" method="post">
                <div>
                    <div class="error <?= $this->name ? "on" : 'off'?>">
                        Username is supposed to be 8 characters or more.
                    </div>
                    <input type="text" name="username" placeholder="Enter the Moderator's usernames.">
                </div>
                <div>
                    <div class="error <?= $this->twitter ? "on" : 'off'?>">
                        Twitter name is supposed to be 3 characters or more.
                    </div>
                    <input type="text" name="twitter" placeholder="Enter the Moderator's twitter account name, start with @.">
                </div>
                <div>
                    <div class="error <?= $this->password ? "on" : 'off'?>">
                        Password is supposed to be 8 characters or more.
                    </div>
                    <input type="password" name="password" placeholder="Enter the Moderator's password.">
                </div>
                <div>
                    <div class="error <?= $this->rePassword ? "on" : 'off'?>">
                        Password is supposed to the same as the first.
                    </div>
                    <input type="password" name="re-password" placeholder="Re-Enter the Moderator's password.">
                </div>
                <div>
                    <input type="submit" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>