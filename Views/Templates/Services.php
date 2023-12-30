<div class="web-services">
    <div class="welcome">
        WELCOME TO <?= strtoupper($_ENV['WEBSITE_NAME']) ?? "ZOLIBERRY" ?>
    </div>
    <div class="search">
        <form action="" method="post">
            <input type="search" name="home_search" id="search" placeholder="Search for an article.">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <div class="date">
        <b>
            <?= (new DateTime("today"))->format("D, d M Y") ?>
        </b>
    </div>
</div>