<div class="stories-grid">
    <?php foreach ($this->data ?? [] as $data): ?>
        <?php
            $title = str_replace(" ", "_", $data['title']);
        ?>
        <div class="story" href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
            <a href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
                <div class="wrapper"></div>
            </a>
            <div class="image">
                <a class="image-link">
                    <img src="<?= "/images/Articles/".$data['tag']."/".$data['one_image'] ?>" alt="No image available.">
                </a>
            </div>
            <div class="title">
                <a class="title-link" href="<?= "/Article?title={$title}&id={$data['id']}" ?>">
                    <?= $data['title'] ?>
                </a>
            </div>
            <div class='description'>
                <div class="tag">
                    <?= $_ENV['WEBSITE_NAME']." ".$data['tag'] ?>
                </div>
            </div>
            <div class="date">
                <span class="fa fa-date"></span>
                <span class="date-element">
                        <?= $this->resolveDate($data['created_at']) ?>
                    </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>