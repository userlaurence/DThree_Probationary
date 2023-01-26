<div class="single-post-auhor-cntr">
    <div class="single-post-author-meta">
        <div>
            <?php 
                $author_first_name = get_the_author_meta('first_name');
                $author_last_name = get_the_author_meta('last_name');
                $profile_photo = get_the_author_meta("profile_photo", get_the_author_id()); 
            ?>

            <a href="<?php print get_author_posts_url(get_the_author_id())?>">
                <?php print wp_get_attachment_image($profile_photo, "thumbnail", false, array("class" => "author-img"));?>
            </a>
                
            </div>
    </div>
    <div class="single-post-author-details">
        <div>
            <span class="single-post-author-name">
                by <a href="<?php print get_author_posts_url(get_the_author_id())?>"><?php print $author_first_name?> <?php print $author_last_name?></a>
            </span>
            <br> 
            <span class="single-post-author-meta-data">
                <?php print get_the_author_meta('position', get_the_author_id());?>
            </span>
        </div>
        <?php print get_the_date("M d, Y")?>
    </div>
</div>