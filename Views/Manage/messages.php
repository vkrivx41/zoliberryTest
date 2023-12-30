<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage - Messages</title>

    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/Manage-Author.css">
    <link rel="stylesheet" href="/sass/Messages.css">

    <script type="module" src="/js/MessagesController.js"></script>
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
            <div class="manage-authors-contents">
                <div class="top-nav">
                    <div class="count"><?= count($this->data ?? []) ?? 0?></div>
                    <div class="count-text">Messages</div>
                </div>
                <div class="manage-body">
                    <div class="manage-list">
                        <?php foreach($this->data ?? [] as $key => $data): ?>
                            <div class="author">
                                <div class="id"># <?= ($key + 1) ?? "0"?></div>
                                <div class="info">
                                    <div class="item names"><?= $data['sender_name']?></div>
                                    <div class="item mail"><?= $data['sender_email'] ?? "No email"?></div>
                                    <div class="item phone"><?= $data['sender_telephone'] ?? 'No phone'?></div>
                                    <div class="item body"><?= $data['body'] ?? 'No body'?></div>
                                </div>
                                <div class="actions">
                                    <div class="delete">
                                        <a href="#" data-id="<?= $data['id'] ?? null?>">Delete</a>
                                    </div>
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
    .info > .item{
        flex: 1 1 100%;
        color: white;
    }

    .info > .item.body{
        flex: 1 1 500%;
        text-overflow: ellipsis;
    }
    
</style>