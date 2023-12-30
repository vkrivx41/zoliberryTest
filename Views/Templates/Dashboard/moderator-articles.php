<?php
    $limit = $this->limit + 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage - Articles</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Articles.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">

    <script src="/js/ArticlesController.js" type="module"></script>
</head>
<body>
    <?php require_once "./../Views/Templates/Dashboard/ModeratorsNav.php" ?>
    <div class="body-container">
        <?php require_once "./../Views/Templates/Dashboard/ModeratorsBodyNav.php" ?>
        <div class="body-contents">
            <div class="manage-articles-contents">
                <div class="error <?= $this->error ? "on": "off"?>">
                    There was an error returning your articles
                </div>
                <div class="top-nav">
                    <div class="create-new">
                        <a href="/Dashboard/Moderator">Create new article</a>
                    </div>
                    <div class="search-element">
                        <form style="display: flex" action="/Dashboard/Moderator/Articles">
                            <input type="search" name="search" id="" placeholder="Enter an article to search for.">
                            <button style="background: white; padding: 0 10px; border-radius: 4px; cursor: pointer">Search</button>
                        </form>

                    </div>
                    <div class="count">
                        <?= count($this->data ?? []) ?? 0?>
                    </div>
                    <div class="count-text">Uploaded articles</div>
                </div>
                <div class="manage-body">
                    <div class="manage-list">
                        <?php
                        foreach ($this->data ?? [] as $key => $value): ?>
                            <div class="article">
                                <div class="id">
                                    <?= ($key + 1)?>
                                </div>
                                <div class="info">
                                    <div class="username">
                                        <?= $this->returnUsernameOrEmail($value['author'])['username'] ?>
                                    </div>
                                    <div class="title">
                                        <?= $value['title']?>
                                    </div>
                                    <div class="date">
                                        <?= $this->resolveDate($value['created_at']) ?>
                                    </div>
                                    <div class="tag">
                                        <?= $value['tag'] ?>
                                    </div>
                                    <div class="email">
                                        <?= $this->returnUsernameOrEmail($value['author'])['email'] ?>
                                    </div>
                                </div>
                                <div class="actions">
                                    <div class="edit">
                                        <a href="/Dashboard/Moderator/Articles/Edit?id=<?= $value['id']?>">E</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="loadmore">
                    <a href="<?= "/Dashboard/Moderator/Articles?limit=".$limit ?>">Load more</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>


<style>
    .error{
        background: red;
        border-radius: 4px;
        color: white;
        padding: 10px;
        width: 100%;
    }

    .error.off{
        display: none;
    }

    .loadmore{
        margin-bottom: 45px;
    }
</style>