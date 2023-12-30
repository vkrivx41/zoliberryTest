<?php

    $is_manager = false;


    $data = $this->returnUsernameOrEmail($this->data['author']);
    $position= $this->resolvePosition($this->data['author']);
    

    $username = $data['username'];
    $email = $data['email'];
    $phone = $data['phone'];

    $twitter = $data['twitter'];

    $img = "";
    $directory = "images/Profiles/".$position."/".$username;

    if ($position === "Manager"){
        $directory = "images/Profiles/Manager/profile";
        $is_manager = true;
    }

    if (file_exists($directory.".png")){
        $img = $directory.".png";
    }

    if (file_exists($directory.".jpg")){
        $img = $directory.".jpg";
    }

    if (file_exists($directory.".jpeg")){
        $img = $directory.".jpeg";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?? "" ?></title>
    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Home.css">
    <link rel="stylesheet" href="/sass/Mobile.css">
    <link rel="stylesheet" href="/sass/Link.css">
    <link rel="stylesheet" href="/sass/LinkMobiles.css">
    <script src="/js/Toggler.js" defer></script>
    <script src="/js/Share.js" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta charset="UTF-8">
    <meta property="og:url"  content="https://www.your-domain.com/your-page.html" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Your Website Title" />
    <meta property="og:description"  content="Your description" />

</head>
<body>

<!--FaceBook Script-->
<div id="fb-root"></div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="DpKMJJDk"></script>
<!--End script-->

<?php require "./../Views/Templates/Navbar.php" ?>

<div class="link-contents">
    <?php require "./../Views/Templates/Sidebar.php"?>
    <?php
        $full_link = $_ENV['FULL_WEBSITE_NAME']."".$_SERVER['REQUEST_URI'];
    ?>
    <div class="link-wrapper">
        <div class="paragraph one">
            <div class="header">
                <div class="description">
                    <div class="tag">
                        <a href="<?= "/". $this->data['tag'] ?>">
                            <?= $_ENV['WEBSITE_NAME']." ".$this->data['tag']?>
                        </a>
                    </div>
                    <div class="date">
                        <div class="share_links">
                            <div class="whatsapp_button" style="color: white; font-weight: 550;">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <a class="facebook_button" style="color: white; font-weight: 550;">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a class="twitter_button" style="color: white; font-weight: 550;">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </div>
                        <div class="date_element">
                            <?= $this->resolveDate($this->data['created_at']) ?>
                        </div>
                    </div>
                </div>
                <div class="title">
                    <?= $this->data['title']?>
                </div>
            </div>
            <div class="body">
                <div class="image">
                    <img src="<?= "/images/Articles/".$this->data['tag']."/".$this->data['one_image'] ?>" alt="">

                    <div class="logo">
                        <img src="/images/logo/logo.png" alt="No logo found.">
                    </div>
                    <div class="tag">
                        <a href="<?= "/". $this->data['tag']?>">
                            <?= $this->data['tag']?>
                        </a>
                    </div>
                    <div class="title" style="color: white">
                        <?= $this->data['title']?>
                    </div>
                </div>
                <div class="description">
                    <?= $this->data['one_text'] ?? ""?>
                </div>
            </div>
        </div>
        <div class="paragraph two">
            <div class="body">
                <?php if ($this->data['two_image']): ?>
                    <img src="<?= "images/Articles/".$this->data['tag']."/".$this->data['two_image'] ?>" alt="">
                <?php endif; ?>
                <div class="description">
                    <?= $this->data['two_text']?>
                </div>
            </div>
        </div>
        <div class="paragraph three">
            <div class="body">
                <?php if ($this->data['three_image']): ?>
                    <img src="<?= "images/Articles/".$this->data['tag']."/".$this->data['three_image'] ?>" alt="">
                <?php endif; ?>
                <div class="description">
                    <?= $this->data['three_text']?>
                </div>
            </div>
        </div>
        <div class="paragraph four">
            <div class="body">
                <?php if ($this->data['four_image']): ?>
                    <img src="<?= "images/Articles/".$this->data['tag']."/".$this->data['four_image'] ?>" alt="">
                <?php endif; ?>
                <div class="description">
                    <?= $this->data['four_text']?>
                </div>
            </div>
        </div>
        <div class="paragraph five">
            <div class="body">
                <?php if ($this->data['five_image']): ?>
                    <img src="<?= "images/Articles/".$this->data['tag']."/".$this->data['five_image'] ?>" alt="">
                <?php endif; ?>
                <div class="description">
                    <?= $this->data['five_text']?>

                    <!-- whatsapp follow -->
                    <div class="whatsapp_follow">
                        <div class="logo">
                            <a href="https://whatsapp.com/channel/0029VaDZQNlBfxo4gL0I721s">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            
                        </div>
                        <div class="link">
                            <a href="https://whatsapp.com/channel/0029VaDZQNlBfxo4gL0I721s">
                                Follow our whatsapp channel
                            </a>
                        </div>
                    </div>

                    <!-- authors details -->
                    <div class="authors-details">
                        <div class="annotation">
                            <h4>About the author</h4>
                        </div>
                        <div class="description">
                            <?php if($is_manager): ?>
                                <div class="updated_by">Uploaded by the manager</div>
                            <?php else: ?>
                                <div class="left-part">
                                    <?php if ($img): ?>
                                    <div class="image">
                                        <img src="<?= $img ?>" alt="No image found.">
                                    </div>
                                    <?php else: ?>
                                        <div class="image">
                                            <img src="/images/logo/logo.png" style="object-fit: fill;" alt="No image found.">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="right-part">
                                    <div class="names">
                                        <a href="<?=  "/authors?name=".$username ?>">
                                            <?= $username?>
                                        </a>
                                    </div>
                                    <div class="email">
                                        <?= $email?>
                                        <!--  -->
                                        |
                                        <i class="fa-brands fa-x-twitter"></i>
                                        <a href="https://twitter.com/<?= $twitter ?>"><?= $twitter?></a>
                                    </div>
                                    
                                    <div class="phone">
                                        <?= $phone?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mobile-popular-header" style="margin: 50px 0;">
            <div class="text">
                Suggested Articles
            </div>
        </div>
        <div class="mobile_popular_posts">
            <?php foreach($this->popular ?? [] as $data): ?>
                <?php
                    $title = str_replace(" ", "_", $data['title']);
                ?>

                <div class="popular">
                    <a href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
                        <div class="wrapper"></div>
                    </a>
                    <div class="image">
                        <a class="image-link">
                            <img src="<?= "images/Articles/".$data['tag']."/".$data['one_image'] ?>" alt="No image available.">
                        </a>
                    </div>
                    <div class="title">
                        <a class="title-link" href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
                            <?= $data['title']?>
                        </a>
                    </div>
                    <div class="description">
                        <div class="tag">
                            <?= $_ENV['WEBSITE_NAME']. " ".$data['tag']?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php require "./../Views/Templates/Footer.php"?>
</body>
</html>
