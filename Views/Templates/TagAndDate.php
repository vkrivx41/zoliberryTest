<div class="date-container">
    <div class="tag">
        <?= $this->tag ?? "No tag"?>
    </div>
    <div class="date">
        <?= (new DateTime("today"))->format("D, d M Y") ?? "Today"?>
    </div>
</div>