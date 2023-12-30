<?php
    $article = $this->article ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit article</title>
    <link rel="stylesheet" href="/sass/navbar.css">
    <link rel="stylesheet" href="/sass/Manager.css">
    <link rel="stylesheet" href="/sass/CreateNew.css">
</head>
<body>
    <div class="nav-bar">
    <?php if($this->sender == "Manager"): ?>
        <?php require "./../Views/Templates/Dashboard/Topnav.php" ?>
    <?php else:?>
        <?php require "./../Views/Templates/Dashboard/ModeratorsNav.php" ?>
    <?php endif; ?>
    </div>
    <div class="body-container">
        <div class="body-nav">
            <?php if($this->sender == "Manager"): ?>
                <?php require "./../Views/Templates/Dashboard/ManagerSecondNav.php" ?>
            <?php else: ?>
                <?php require "./../Views/Templates/Dashboard/ModeratorsBodyNav.php" ?>
             <?php endif; ?>
        </div>
        <div class="body-contents">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="post_creator_container_div">
                <div class="rules">
                    <div class="title">
                        <div class="error" style="color: red; font-weight: bold; font-size: 24px;">
                            <?php if($this->error == 'done'): ?>
                                <div class="error" style="color: green;">Update successfully</div>
                            <?php elseif ($this->error == null): ?>
                                <div></div>
                            <?php else: ?>
                                <div class="error" style="color: red;">
                                    <?= $this->error ?>
                                </div>
                            <?php endif; ?>
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
                    <textarea name="title" id="" cols="30" rows="2">
                        <?= trim($article['title'] )?>
                    </textarea>
                </div>
                <hr>
                <div class="paragraph_one_input_container">
                    <div class="title">Paragraph 1 - Mandatory</div>
                    <input type="file" name="image_one" id="image">
                    <textarea name="paragraph_one_text" cols="30" rows="10">
                        <?= trim($article['one_text'] )?>
                    </textarea>
                </div>

            </div>

            <hr>

            <div class="post_creator_container_div">
                <div class="paragraph_one_input_container">
                    <div class="title">Paragraph 2 - Optional</div>
                    <input type="file" name="image_two" id="image">
                    <textarea name="paragraph_two_text" cols="30" rows="10">
                        <?= trim($article['two_text'] )?>
                    </textarea>
                </div>

            </div>

            <hr>

            <div class="post_creator_container_div">
                <div class="paragraph_one_input_container">
                    <div class="title">Paragraph 3 - Optional</div>
                    <input type="file" name="image_three" id="image">
                    <textarea name="paragraph_three_text" cols="30" rows="10">
                        <?= trim($article['three_text'] )?>
                    </textarea>
                </div>
            </div>

            <hr>
            <div class="post_creator_container_div">
                <div class="paragraph_one_input_container">
                    <div class="title">Paragraph 4 - Optional</div>
                    <input type="file" name="image_four" id="image">
                    <textarea name="paragraph_four_text" cols="30" rows="10">
                        <?= trim($article['four_text'] )?>
                    </textarea>
                </div>
            </div>
            <hr>
            <div class="post_creator_container_div">
                <div class="paragraph_one_input_container">
                    <div class="title">Paragraph 5 - Optional</div>
                    <input type="file" name="image_five" id="image">
                    <textarea name="paragraph_five_text" cols="30" rows="10">
                        <?= trim($article['five_text'] )?>
                    </textarea>
                </div>
            </div>
            <div class="post_creator_container_div">
                <div class="submit_container">
                    <button type="submit" class="uploadBtn">Edit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>