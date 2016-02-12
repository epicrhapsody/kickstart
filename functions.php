<?php

// xxxxxxxxxx Load jQuery in Footer xxxxxxxxxx
if (!is_admin())
    add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);

function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    $googleScript = 'http'. ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js';
    wp_register_script('jquery', $googleScript, false, '1.11.1', true);
    wp_enqueue_script('jquery');
}


// xxxxxxxxxx Custom Login Logo xxxxxxxxxx
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/tile.png);
            background-size: 100% auto;
            background-position: center center;
            height: 200px;
            width: 200px;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// xxxxxxxxxx Rest API xxxxxxxxxx
wp_enqueue_script( 'wp-api' );


// xxxxxxxxxx HTML Search Form xxxxxxxxxx
add_theme_support( 'html5', array( 'search-form' ) );


// xxxxxxxxxx Post Formats xxxxxxxxxx
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
) );


// xxxxxxxxxx Navigation Menus xxxxxxxxxx
register_nav_menus( array(
	'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
	'secondary'   => __( 'Bottom secondary menu', 'twentyfourteen' ),
) );


// xxxxxxxxxx Responsive Images xxxxxxxxxx
function adjust_image_sizes_attr( $sizes, $size ) {
   $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
   return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'adjust_image_sizes_attr', 10 , 2 );


// xxxxxxxxxx Thumbnails and Image support xxxxxxxxxx
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true );
    add_image_size( '320-thumb', 320, 9999, false );
    add_image_size( '375-thumb', 375, 9999, false );
    add_image_size( '414-thumb', 414, 9999, false );
    add_image_size( '768-thumb', 768, 9999, false );
    add_image_size( '900-thumb', 900, 9999, false );
    add_image_size( '1024-thumb', 1024, 9999, false );
    add_image_size( '1140-thumb', 1140, 9999, false );
}


// xxxxxxxxxx Custom Sidebar xxxxxxxxxx
register_sidebar( array(
	'name' => __( 'Sidebar' ),
	'id' => 'aside',
	'description' => __( 'Sidebar'),
	'before_widget' => '<div>',
	'after_widget'  => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
) );


// xxxxxxxxxx Gallery as List xxxxxxxxxx
remove_shortcode('gallery', 'gallery_shortcode');
function shortcode_gallery($attr) {
  $post = get_post();
  static $instance = 0;
  $instance++;
  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }
  $output = apply_filters('post_gallery', '', $attr);
  if ($output != '') {
    return $output;
  }
  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }
  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 1,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));
  $id = intval($id);
  if ($order === 'RAND') {
    $orderby = 'none';
  }
  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }
  if (empty($attachments)) {
    return '';
  }
  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) {
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    }
    return $output;
  }
  $output = '<ul class="gallery">';
  $i = 0;
  foreach ($attachments as $id => $attachment) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
    $output .= '<li>' . $link;
    if (trim($attachment->post_excerpt)) {
      $output .= '<div class="caption">' . wptexturize($attachment->post_excerpt) . '</div>';
    }
    $output .= '</li>';
  }
  $output .= '</ul>';
  return $output;
}
add_shortcode('gallery', 'shortcode_gallery');


// xxxxxxxxxx Pagination xxxxxxxxxx
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
         echo "<div class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
          if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}


// xxxxxxxxxx Clean up Wordpress xxxxxxxxxx
	add_filter('show_admin_bar', '__return_false');
	add_filter( 'use_default_gallery_style', '__return_false' );
	remove_action( 'wp_head', 'rsd_link' ); 
	remove_action( 'wp_head', 'wlwmanifest_link' ); 
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head');
	remove_action( 'wp_head', 'feed_links_extra', 3);
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	remove_action( 'wp_head', 'rel_canonical');
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}
?>