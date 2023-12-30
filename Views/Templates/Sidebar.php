<div class="sidebar">
    <div class="articles-list">
        <?php foreach ($this->popular ?? [] as $data): ?>
            <?php
            $title = str_replace(" ", "_", $data['title']);
            ?>
            <div class="article">
                <div class="leftpart">
                    <img src="<?= "images/Articles/".$data['tag']."/".$data['one_image'] ?>" alt="No image found">
                </div>
                <div class="rightpart">
                    <div class="title">
                        <a href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
                            <?= $data['title'] ?>
                        </a>
                    </div>
                    <div class="description">
                        <div class="tag">
                            <a href="<?= "/". $data['tag'] ?>">
                                <?= $_ENV['WEBSITE_NAME']." ".$data['tag'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>