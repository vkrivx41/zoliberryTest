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
    <link rel="stylesheet" href="/sass/AuthorStats.css">
</head>
<body>
<?php require_once "./../Views/Templates/Dashboard/AuthorsNav.php" ?>

<div class="body-container">
    <?php require_once "./../Views/Templates/Dashboard/AuthorsBodyNav.php" ?>
    <div class="body-contents">
       <div class="stats_contents">
           <div class="header">
               <div class="start">
                   From: <?= $this->start ?>
               </div>
               <div class="end">
                   To: <?= $this->end ?>
               </div>
           </div>
           <div class="author_stats">
           <div class="heading">
                   <div class="views">Views</div>
               </div>
               <?= count($this->data)?>
               <?php foreach($this->data ?? [] as $article): ?>
               <div class="article">
                    <div class="title">
                        <?= $article['title'] ?? "" ?>
                    </div>
                    <div class="date">
                        <?= $article['created_at'] ?? "" ?>
                    </div>
                    <div class="views">
                        <?= $article['views'] ?? "0" ?>
                    </div>
               </div>
               <?php endforeach; ?>
           </div>
       </div>
    </div>
</div>
</body>
</html>
