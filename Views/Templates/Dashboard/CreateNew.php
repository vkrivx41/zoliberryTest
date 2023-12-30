
<style>
    .error{
        background: black;
    }

    .error > div{
        background: red;
        display: flex;
        padding: 10px 12px;
        border-radius: 4px;
    }

    .err.done{
        background: green;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">
    <div class="post_creator_container_div">
        <div class="rules">
            <div class="title">
                <div class="error">
                    <?= $this->category ? "<div class='err'>Please choose your articles category.</div>" : ""?>
                    <?= $this->type ? "<div class='err'>All your images must be off the correct type jpg, png, or jpeg.</div>" : ""?>
                    <?= $this->error ? "<div class='err'>There was an error uploading your images.</div>" : ""?>
                    <?= $this->image_one ? "<div class='err'>The article's image is mandatory.</div>" : ""?>
                    <?= $this->size ? "<div class='err'>The image's size must not be greater than</div>".$_ENV['IMAGE_SIZE'] : ""?>
                    <?= $this->text ? "<div class='err'>Paragraph one is mandatory, it can not be empty.</div>": ""?>
                    <?= $this->title ? "<div class='err'>The title must be at least 1 character long and not greater than ".$_ENV['TITLE_COUNT']." characters.</div>" : ""?>
                    <?= $this->one_text ? "<div class='err'>Paragraph one must be at least 1 character long and not greater than ".number_format($_ENV['PARA_COUNT'])." characters</div>>" : ""?>
                    <?= $this->two_text ? "<div class='err'>Paragraph two must be at least 1 character long and not greater than ".number_format($_ENV['PARA_COUNT'])." characters</div>>" : ""?>
                    <?= $this->three_text ? "<div class='err'>Paragraph three must be at least 1 character long and not greater than ".number_format($_ENV['PARA_COUNT'])." characters</div>>" : ""?>
                    <?= $this->four_text ? "<div class='err'>Paragraph four must be at least 1 character long and not greater than ".number_format($_ENV['PARA_COUNT'])." characters</div>>" : ""?>
                    <?= $this->five_text ? "<div class='err'>Paragraph five must be at least 1 character long and not greater than ".number_format($_ENV['PARA_COUNT'])." characters</div>>" : ""?>
                    <?= $this->image_up ? "<div class='err'>There was an error storing your images</div>" : "" ?>
                    <?= $this->upload ? "<div class='err'>There was an error uploading your images</div>" : "" ?>
                    <?= $this->limit ? "<div class='err done'>The maximum limit of the articles number per day has reached you cannot upload anymore articles on this category.</div>" : "" ?>
                    <?= $this->done ? "<div class='err done'>Article uploaded successfully</div>" : "" ?>


                </div>

            </div>
            <div class="rules_drop">
                <div class="rule">The different
                    category to choose between.
                </div>
                <div class="rule">The first paragraph's images is mandatory to be put.</div>
                <div class="rule">You can include as many as 5 paragraphs but the first paragraph is mandatory.</div>
                <div class="rule">Your phrases must be briefly explained as to reduce the consumption of the memory.
                </div>
                <div class="rule">Every paragraph of the post can contain an images for itself.</div>
            </div>
        </div>
        <div class="category">
            <div class="title">
                Choose the type of category for your post.
            </div>
            <div class="category_drop">
                <div class="category_choice">

                    <select name="category" id="">
                        <option value="News">News</option>
                        <option value="Music">Music</option>
                        <option value="Sports">Sports</option>
                        <option value="Lifestyle">Lifestyle</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-  ->
    <div class="post_creator_container_div">
        <div class="title_input_container">
            <div class="title">Enter the title of your article</div>
            <textarea name="title" id="" cols="30" rows="2"></textarea>
        </div>
        <hr>
        <div class="paragraph_one_input_container">
            <div class="title">Paragraph 1 - Mandatory</div>
            <input type="file" name="image_one" id="image">
            <textarea name="paragraph_one_text" cols="30" rows="10"></textarea>
        </div>

    </div>

    <hr>

    <div class="post_creator_container_div">
        <div class="paragraph_one_input_container">
            <div class="title">Paragraph 2 - Optional</div>
            <input type="file" name="image_two" id="image">
            <textarea name="paragraph_two_text" cols="30" rows="10"></textarea>
        </div>

    </div>

    <hr>

    <div class="post_creator_container_div">
        <div class="paragraph_one_input_container">
            <div class="title">Paragraph 3 - Optional</div>
            <input type="file" name="image_three" id="image">
            <textarea name="paragraph_three_text" cols="30" rows="10"></textarea>
        </div>
    </div>

    <hr>
    <div class="post_creator_container_div">
        <div class="paragraph_one_input_container">
            <div class="title">Paragraph 4 - Optional</div>
            <input type="file" name="image_four" id="image">
            <textarea name="paragraph_four_text" cols="30" rows="10"></textarea>
        </div>
    </div>
    <hr>
    <div class="post_creator_container_div">
        <div class="paragraph_one_input_container">
            <div class="title">Paragraph 5 - Optional</div>
            <input type="file" name="image_five" id="image">
            <textarea name="paragraph_five_text" cols="30" rows="10"></textarea>
        </div>
    </div>
    <div class="post_creator_container_div">
        <div class="submit_container">
            <button type="submit" class="uploadBtn">Upload</button>
        </div>
    </div>
</form>