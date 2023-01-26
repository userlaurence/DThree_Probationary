<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 * permission test
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}


 
function dthree_scripts() {
	//jquery
	wp_enqueue_script("jquery"); 
	add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

    //custom script
    wp_register_script(
        'dthree-scripts',
        get_stylesheet_directory_uri() . '/js/script.js',
        false,
        NULL,
        true);
	wp_register_style('dthree-styles-theme',get_stylesheet_directory_uri().'/css/theme.css');
    wp_register_style('dthree-theme-slick',get_stylesheet_directory_uri().'/vendor/slick-1.8.1/slick/slick.css', '', '1.0.1');
	wp_register_style('dthree-theme-slick-theme',get_stylesheet_directory_uri().'/vendor/slick-1.8.1/slick/slick-theme.css', '', '1.0.1');
	wp_register_script('dthree-slick-js',get_stylesheet_directory_uri().'/vendor/slick-1.8.1/slick/slick.min.js');
	wp_register_script('lau-tooltip-html',get_stylesheet_directory_uri().'/tooltip.html');
	wp_enqueue_style('lau-tooltip-html');
	wp_enqueue_style('dthree-theme-slick');
	wp_enqueue_style('dthree-theme-slick-theme');
	wp_enqueue_script( 'dthree-slick-js');
    wp_enqueue_script('dthree-scripts');
    wp_enqueue_style('dthree-styles-theme');

	
}
add_action( 'wp_enqueue_scripts', 'dthree_scripts' );



//OPTIMIZE FONT LOADING
add_filter( 'elementor_pro/custom_fonts/font_display', function( $current_value, $font_family, $data ) {
	return 'swap';
}, 10, 3 );

//Remove Google Fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

//Remove Font Awesome
add_action( 'elementor/frontend/after_register_styles',function() {
	foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
		wp_deregister_style( 'elementor-icons-fa-' . $style );
	}
	wp_deregister_style( 'elementor-icons-shared-0-css' );
	wp_deregister_style( 'elementor-icons-css' );
	wp_deregister_style( 'font-awesome-5-all-css' );
	wp_deregister_style( 'font-awesome-4-all-css' );
	

}, 20 );


add_theme_support( 'post-thumbnails' );

//support svg
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


function theme_dir() {
	print get_template_directory_uri();
}

function img_dir() {
	print get_stylesheet_directory_uri() . "/img/";
}

// templates

function latest_episodes() {
	ob_start();
	get_template_part("templates/latest-episodes"); 
	return ob_get_clean();
}

add_shortcode("latest_episodes", "latest_episodes");

function shows_slider() {
	ob_start();
	get_template_part("templates/shows-slider"); 
	return ob_get_clean();
}

add_shortcode("shows_slider", "shows_slider");


function dthree_author_socmed() {
	ob_start();
	get_template_part("templates/author-socmed"); 
	return ob_get_clean();
}
add_shortcode("dthree_author_socmed", "dthree_author_socmed");

function dthree_single_post_author_meta() {
	ob_start();
	get_template_part("templates/single-post-author-meta"); 
	return ob_get_clean();
} 
add_shortcode("dthree_single_post_author_meta", "dthree_single_post_author_meta");


function dthree_author_joined_date() {
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$joined_date = get_the_author_meta( 'user_registered', $author->ID );
	$joined_date = date("F Y", strtotime($joined_date));
	$author_posts = count_user_posts($author->ID);

	return "<p>Joined  <strong>$joined_date | $author_posts</strong> posts</p>";
	
}
add_shortcode("dthree_author_joined_date", "dthree_author_joined_date");


function dthree_powered_by() {
	$icon_id = get_field("powered_by_icon");
	$label = get_field("powered_by_label");
	if ($icon_id) { 
		return "<span class='powered-by'>$label  ".wp_get_attachment_image($icon_id, "thumbnail", false, array("class" => "powered-by-icon"))."</span>";
	} else {
		return false;
	}
}
add_shortcode("dthree_powered_by", "dthree_powered_by");

function dthree_article_format() {
	if( get_field("is_video") ) {
		return "<span class='loop-icon'><img src='/wp-content/uploads/2022/11/flag-play-desktop.svg' /></span>";
	} else if (get_field("is_external_link")) {
		return "<span class='loop-icon dthree-external-link' url='".get_field("external_link")."'><img src='/wp-content/uploads/2022/11/flag-external-desktop.svg' /></span>";
	} else {
		return false;
	}

}
add_shortcode("dthree_article_format", "dthree_article_format");



function dthree_trending_tags() {
	?><?php
	$args = array(
		'posts_per_page' => 1,
		'post_type' => 'post',
		'orderby'           => 'meta_value_num',
		'meta_key'          => 'views',
	);
	$loop = new WP_Query( $args );
  ?>


<?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php  
 	$posttags = get_the_tags();
	if ($posttags) {
	foreach($posttags as $tag) {
		print '<a href="/tag/' . $tag->slug . '/">' . $tag->name . '</a>'; 
	}
	}

?>
<?php endwhile; endif; wp_reset_postdata();?>

<?php
}
add_shortcode("dthree_trending_tags", "dthree_trending_tags");



function category_first_post( $query ) {
	$query->set( 'posts_per_page', 1 );
}
add_action( 'elementor/query/category_first_post', 'category_first_post' );


function offset_1( $query ) {
	$query->set( 'offset', 1 );
}
add_action( 'elementor/query/offset_1', 'offset_1' );


function top_stories( $query ) {
	$query->set( 'orderby', 'meta_value_num');
	$query->set( 'meta_key', 'views' );
}
add_action( 'elementor/query/top_stories', 'top_stories' );


// function external_link_filter() {
//     // your code goes here
// 	if(is_single()) {
// 		var_dump(get_field("is_external_link"));
// 		if ( get_field("is_external_link") ) {
// 			wp_redirect(get_field("external_link"));
// 			exit;
// 		}
// 	}
// }
// add_action( "template_redirect", "external_link_filter" );