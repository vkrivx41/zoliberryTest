
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/News.css">
    <link rel="stylesheet" href="/sass/FooterELements.css">

    <script src="./../js/Toggler.js" defer></script>
    <script src="./../js/TopStoriesFetcher.js" type="module"></script>
</head>

<body>
    <?php  require_once  "./../Views/Templates/Navbar.php"?>

    <div class="posts_container">
        <div class="header">
            <h1>Contact Us</h1>
        </div>
        <div class="contents">
            <div class="error">
                <?=  $this->store ? "There was an error sending your message." : "" ?>
            </div>
            <div class="error">
                <?= $this->done ? "Your message is successfully delivered." : "" ?>
            </div>
            <form action="" method="post">
                <div class="feed">
                    <div class="error">
                        <?= $this->names ? "Names can't be empty  or much longer." : "" ?>
                    </div>
                    <input type="text" name="names" id="" placeholder="Please enter your names.">
                </div>
                <div class="feed">
                    <div class="error">
                        <?= $this->email ? "Email must be valid." : "" ?>
                    </div>
                    <input type="email" name="email" id="" placeholder="Please enter your email.">
                </div>
                <div class="feed">
                     <div class="error">
                        <?= $this->phone ? "Phone number must be valid." : "" ?>
                    </div>
                    <input type="text" name="phone" id="" placeholder="Please enter your phone.">
                </div>
                <div class="feed">
                     <div class="error">
                        <?= $this->message ? "Your message can't be empty  or much longer." : "" ?>
                    </div>
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Your message goes here. Max(30 words)"></textarea>
                </div>
                <div class="feed">
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    <?php  require_once  "./../Views/Templates/Footer.php"?>
</body>
