
<div class="mobile-view">
    <?php if (! empty($this->one[0])): ?>
    <div class="mobile-top">
        <a href="<?= "Article?id=". $this->one[0]['id'] ?>">
            <div class="wrapper"></div>
        </a>
        <div class="image">
            <a class="image-link">
                <img src="<?= "images/Articles/". $this->one[0]['tag']."/".$this->one[0]['one_image'] ?>" alt="No image available.">
            </a>
        </div>
        <div class="title">
            <a class="title-link" href="<?= "Article?id=". $this->one[0]['id'] ?>">
                <?= $this->one[0]['title'] ?>
            </a>
        </div>
        <div class='description'>
            <div class="tag">
                <?= $_ENV['WEBSITE_NAME']." ".$this->one[0]['tag'] ?>
            </div>
        </div>
        <div class="date">
            <span class="date-element">
                <?= $this->resolveDate($this->one[0]['created_at']) ?>
            </span>
        </div>
    </div>
    <?php endif;?>
    <div class="three-center-stories">
        <?php foreach ($this->center ?? [] as $center): ?>

            <?php
                    $title = str_replace(" ", "_", $center['title']);    
                ?>

            <div class="story">
            <div class="story-left">
                <div class="image-container">
                    <img src="<?= "images/Articles/". $center['tag']."/".$center['one_image'] ?>" alt="No image found.">
                </div>
            </div>
            <div class="story-right" style="border: 0.09rem solid rgb(0, 0, 1)">
                <div class="title">
                    <a href="<?= "/Article?title={$title}&id={$center['id']}" ?>" class="title-link">
                        <?= $center['title'] ?>
                    </a>
                </div>
                <div class="description">
                    <div class="tag">
                        <?= $_ENV['WEBSITE_NAME']." ".$center['tag'] ?>
                    </div>
                </div>
                <div class="date">
                    <div class="date-element">
                        <?= $this->resolveDate($center['created_at']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="three-bottom-stories">

        <?php foreach ($this->bottom ?? [] as $bottom): ?>
            <?php
                    $title = str_replace(" ", "_", $bottom['title']);    
                ?>

            <div class="story">
            <a href="<?= "/Article?title={$title}&id={$bottom['id']}" ?>">
                <div class="wrapper"></div>
            </a>
            <div class="image">
                <a class="image-link">
                    <img src="<?= "images/Articles/". $bottom['tag']."/".$bottom['one_image'] ?>" alt="No image available.">
                </a>
            </div>
            <div class="title">
                <a class="title-link" href="<?= "/Article?title={$title}&id={$bottom['id']}" ?>">
                    <?= $center['title'] ?>
                </a>
            </div>
            <div class='description'>
                <div class="tag">
                    <?= $_ENV['WEBSITE_NAME']." ".$center['tag'] ?>
                </div>
            </div>
            <div class="date">
                <span class="date-element">
                    <?= $this->resolveDate($bottom['created_at']) ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

