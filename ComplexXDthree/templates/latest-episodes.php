<div class="custom-vid-cntr">
    <div class="custom-vid-col" id="video-cntr">

        <?php $first_show = get_field("shows");?>
        
        <?php if( isset($first_show[0]['youtube_link'])):?>
        <iframe src="<?php print $first_show[0]['youtube_link']?>"  frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        <?php endif?>
    </div>
    <div class="custom-playlist-col">
        <div class="custom-playlist-border upper-border"></div>

        <div class="custom-playlist-cntr">

            <div class="custom-playlist-loop">

                <?php $i = 0?>
                <?php if( have_rows('shows') ):?>
                <?php while ( have_rows('shows') ) : the_row(); ?>

                    <a href="#" class="custom-playlist-vid dthree-custom-play"
                        data-iframe-src="<?php the_sub_field("youtube_link")?>">
                        <div class="vid-thumbnail">
                            <?php print wp_get_attachment_image(get_sub_field("thumbnail"), "medium", false, array("class" => "img-fluid img-pogi"));?>
                        </div>
                        <div class="vid-details">
                            <h5><?php the_sub_field("subtitle")?></h5>
                            <h4><?php the_sub_field("title")?></h4>
                        </div>
                    </a>

                    <?php if($i == 0 ):?>
                    <span class="cun-text">COMING UP NEXT</span>
                    <?php endif?>

                <?php $i++?>
                <?php endwhile?>
                <?php endif?>

            </div>
        </div>

        <div class="custom-playlist-border lower-border">
            <a href="#">EXPLORE ALL SHOWS <img src="<?php img_dir()?>right-angle-white.svg" alt=""
                    class="pl-link-icon"></a>
        </div>
    </div>
</div>