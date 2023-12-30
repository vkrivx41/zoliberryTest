<div class="personal-data-contents">
    <div class="left-part">
        <div class="image">
            <img src="<?= '/images/Profiles/Authors/'.$this->data['image'] ?>" alt="No image found.">
        </div>
        <div class="info">
            <div class="usernames"><?= $this->data['username'] ?? 'Manager'?></div>
            <div class="email"><?= $this->data['email'] ?? ''?></div>
            <div class="phone"><?= $this->data['phone'] ?? ''?></div>
        </div>
    </div>
    <div class="right-part">
        <div class="header"><?= $this->done ? "Successfully updated your personal data.": "Update your personal info."?></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            <div>
                <input type="text" name="phone" placeholder="Enter your phone number.">
            </div>
            <div>
                <label for="profile">Profile</label>
                <input type="file" name="image">
            </div>
            <div>
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
    <div class="errors-part">
        <?php if (count($this->params) > 1 && ! $this->done): ?>
            <div class="error on" style="display: flex;">
                <?= $this->email ? "Your email must be valid." : ''?>
                <?= $this->phone ? "Your phone-number must be more than 10 characters long." : ''?>
                <?= $this->type ? "The image format must be valid jpg, png, or jpeg." : ''?>
                <?= $this->size ? "The image size must be less than 10MBs." : ''?>
                <?= $this->error ? "Some errors occurred uploading your image." : ''?>
                <?= $this->upload ? "Some errors occurred uploading your data." : ''?>
                <?= $this->demo ? "Some errors occurred updating your demo info." : ''?>
            </div>
        <?php endif; ?>
    </div>
</div>