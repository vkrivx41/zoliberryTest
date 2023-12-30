<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Personal-info</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">
    <link rel="stylesheet" href="/sass/Manage-Personal.css">
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
            <div class="personal-data-contents">
                <div class="left-part">
                    <div class="image">
                        <img src="<?= '/images/Profiles/Manager/'.$this->manager[0]['image'] ?>" alt="No image found.">
                    </div>
                    <div class="info">
                        <div class="usernames"><?= $this->manager['username'] ?? 'Manager'?></div>
                        <div class="email"><?= $this->manager['email'] ?? ''?></div>
                        <div class="phone"><?= $this->manager[0]['phone'] ?? ''?></div>
                    </div>
                </div>
                <div class="right-part">
                    <div class="header">Update your personal info.</div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <input type="text" name="username" placeholder="Enter your username">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Enter your email">
                        </div>
                        <div>
                            <input type="text" name="phone" placeholder="Enter your phone number.">
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                        <div>
                            <input type="password" name="re-password" placeholder="Re-Enter your password.">
                        </div>
                        <div>
                            <label for="profile">Profile</label>
                            <input type="file" name="profile">
                        </div>
                        <div>
                            <input type="submit" value="Update">
                        </div>
                    </form>
                </div>

                <div class="errors-part">
                    <?php if (count($this->params) > 1): ?>
                    <div class="error on">
                        <?= $this->name ? "Your username must be more than 6 characters long." : ''?>
                        <?= $this->email ? "Your email must be valid." : ''?>
                        <?= $this->phone ? "Your phone-number must be more than 10 characters long." : ''?>
                        <?= $this->password ? "Your password must be more than 7 characters long." : ''?>
                        <?= $this->rePassword ? "Your password must be the same as the first one." : ''?>
                        <?= $this->type ? "The image format must be valid jpg, png, or jpeg." : ''?>
                        <?= $this->size ? "The image size must be less than 10MBs." : ''?>
                        <?= $this->error ? "Some errors occurred uploading your image." : ''?>
                        <?= $this->upload ? "Some errors occurred uploading your data." : ''?>
                        <?= $this->data ? "Some errors occurred updating your personal info." : ''?>
                        <?= $this->demo ? "Some errors occurred updating your demo info." : ''?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<style>
    .error{
        display: flex;
    }
    .errors-part > .error.on{
        display: flex;
    }

    .errors-part > .error.off{
        display: none;
    }

</style>