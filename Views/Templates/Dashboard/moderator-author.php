<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage - Authors</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">

    <script type="module" src="/js/AuthorsController.js"></script>
</head>
<body>
    <?php require_once "./../Views/Templates/Dashboard/ModeratorsNav.php" ?>
    <div class="body-container">
    <?php require_once "./../Views/Templates/Dashboard/ModeratorsBodyNav.php"?>
        <div class="body-contents">
            <div class="manage-authors-contents">
                <div class="top-nav">
                    <div class="create-new">
                        <a href="/Dashboard/Moderator/Create/Author">Create new author</a>
                    </div>
                    <div class="count"><?= count($this->data ?? []) ?? 0?></div>
                    <div class="count-text">Active authors</div>
                </div>
                <div class="manage-body">
                    <div class="manage-list">
                        <?php foreach($this->data ?? [] as $key => $data): ?>
                            <div class="author">
                                <div class="id"># <?= ($key + 1) ?? "0"?></div>
                                <div class="info">
                                    <div class="username"><?= $data['username'] ?? "No username"?></div>
                                    <div class="password"><?= $data['password'] ?? "No password"?></div>
                                    <div class="email"><?= $data['email'] ?? "No email"?></div>
                                    <div class="phone"><?= $data['phone'] ?? 'No phone'?></div>
                                </div>
                                
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<style>

    
</style>