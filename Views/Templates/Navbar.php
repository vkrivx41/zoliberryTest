
<?php
    $address = $this->address ?? null;
?>
<div class="navbar">
    <div class="nav-left">
        <div class="logo-container">
            <a class="logo-items" href="/">
                <div class="item">Z</div>
                <div class="item">O</div>
                <div class="item">L</div>
                <div class="item">I</div>
                <div class="item">B</div>
                <div class="item">E</div>
                <div class="item">R</div>
                <div class="item">R</div>
                <div class="item">Y</div>
                <div class="item" id="red"></div>
            </a>
        </div>
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a class="link" id="Home" href="/">Home</a>
            <a class="link" id="News" href="/News">News
            <span>3</span></a>
            <a class="link" id="Sports" href="/Sports">Sports</a>
            <a class="link" id="Music" href="/Music">Music</a>
            <a class="link" id="Lifestyle" href="/Lifestyle">Lifestyle</a>
            <a class="link" id="Lifestyle" href="/Aboutus">About</a>
            <a class="link" id="Lifestyle" href="/Privacy">Privacy</a>
        </div>
    </div>
    <div class="nav-right">
        <div class="dark-theme-toggler">
            <input type="checkbox" name="" id="">
        </div>
    </div>
</div>


<style>
    .logo-items{
        background: #000;
    }
    .logo-items > #red{
       color: white;
       background: var(--nav-bg-color);
       position: relative;
    }

    .logo-items > #red::after{
        position: absolute;
        content: "";
        left:0;
        width: 7px;
        height: 100%;
        background: red;
    }
</style>
