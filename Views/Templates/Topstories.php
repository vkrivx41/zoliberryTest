
<div class="top-stories">
    <div class="stories-slider">
        
        <?php foreach ($this->top ?? [] as $top): ?>
            <?php
                $title = str_replace(" ", "_", $top['title']);
            ?>
            <div class="top-story" href="<?= "/Article?title={$title}&id={$top['id']}" ?>">
                <a href="<?= "/Article?title={$title}&id={$top['id']}" ?>">
                    <div class="wrapper"></div>
                </a>
                <div class="image">
                    <a class="image-link">
                        <img src="<?= "/images/Articles/".$top['tag']."/".$top['one_image'] ?>" alt="No image available.">
                    </a>
                </div>
                <div class="title">
                    <a class="title-link" href="<?= "/Article?title={$title}&id={$top['id']}" ?>">
                        <?= $top['title'] ?>
                    </a>
                </div>
                <div class='description'>
                    <div class="tag">
                        <?= $_ENV['WEBSITE_NAME']." ".$top['tag'] ?>
                    </div>
                </div>
                <div class="date">
                    <span class="fa fa-date"></span>
                    <span class="date-element">
                        <?= $this->resolveDate($top['created_at']) ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>