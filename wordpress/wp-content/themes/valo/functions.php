<?php
if( ! defined('VALO_THEME_BASE_URL' ) ) 	 { 	define( 'VALO_THEME_BASE_URL', get_template_directory_uri()); }
if( ! defined('VALO_OPTIONS_FRAMEWORK' ) ) 	 { 	define( 'VALO_OPTIONS_FRAMEWORK', get_template_directory().'/admin/' ); }
if( ! defined('VALO_OPTIONS_FRAMEWORK_URI' ) ){	define( 'VALO_OPTIONS_FRAMEWORK_URI',  VALO_THEME_BASE_URL. '/admin/'); }
if( ! defined('VALO_OPTIONS_PREFIXED' ) ){    define('VALO_OPTIONS_PREFIXED' ,'valo_');}
require_once( VALO_OPTIONS_FRAMEWORK.'options-framework.php' );
require_once( 'includes/metabox-options.php' );
require_once( 'includes/register-widget.php' );
require_once( 'includes/class-breadcrumb.php' );

if ( ! isset( $content_width ) ) $content_width = 946;
/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */


function valo_setup(){
$lang = VALO_THEME_BASE_URL. '/languages';
load_theme_textdomain('valo', $lang);
add_theme_support( 'post-thumbnails' ); 
$args = array();
//add_theme_support( 'custom-header', $args );
add_theme_support( 'custom-background', $args );
add_theme_support( 'automatic-feed-links' );
add_theme_support('nav_menus');
register_nav_menus( array('primary' => __( 'Primary Menu', 'valo' ),'footer' => __( 'Footer Menu', 'valo' )));
add_editor_style("editor-style.css");

add_image_size( 'blog-list', 600, 999999 , true);  
add_image_size( 'sidebar-posts', 60, 45 , true); 
}
// valo_setup
add_action( 'after_setup_theme', 'valo_setup' );

function valo_of_get_options($default = false) {
	
	$optionsframework_settings = get_option(VALO_OPTIONS_PREFIXED.'optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options) ) {
		return $options;
	} else {
		return $default;
	}
}

global $valo_options;
$valo_options = valo_of_get_options();

function valo_options_array($name){
	global $valo_options;
	if(isset($valo_options[$name]))
	return $valo_options[$name];
	else
	return "";
}
// set default options
function valo_on_switch_theme(){
global $valo_options;
 $optionsframework_settings = get_option( VALO_OPTIONS_PREFIXED.'optionsframework' );
 if(!get_option($optionsframework_settings['id'])){
 $config = array();
 $output = array();
 $location = apply_filters( 'options_framework_location', array('admin-options.php') );
	        if ( $optionsfile = locate_template( $location ) ) {
	            $maybe_options = require_once $optionsfile;
	            if ( is_array( $maybe_options ) ) {
					$options = $maybe_options;
	            } else if ( function_exists( 'optionsframework_options' ) ) {
					$options = optionsframework_options();
				}
	        }
	    $options = apply_filters( 'of_options', $options );
		$config  =  $options;
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
		add_option($optionsframework_settings['id'],$output);
}
$valo_options = valo_of_get_options();
}
add_action( 'after_setup_theme', 'valo_on_switch_theme' );
add_action('after_switch_theme', 'valo_on_switch_theme');

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'valo_optionsframework_custom_scripts');

function valo_optionsframework_custom_scripts() { 

}


add_filter('options_framework_location','valo_options_framework_location_override');

function valo_options_framework_location_override() {
	return array('/includes/admin-options.php');
}


/* 
 * Change the menu title name and slug
 */
 
 
function valo_optionscheck_options_menu_params( $menu ) {
	
	$menu['page_title'] = __( 'Valo Options', 'valo');
	$menu['menu_title'] = __( 'Valo Options', 'valo');
	$menu['menu_slug'] = 'valo-options';
	return $menu;
}

add_filter( 'optionsframework_menu', 'valo_optionscheck_options_menu_params' );


function valo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'valo' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'valo_wp_title', 10, 2 );

add_action( 'wp_head', 'valo_favicon' );

	function valo_favicon()
	{
	    $url =  valo_options_array('favicon');
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}



  function valo_custom_scripts(){
    global $post;
    wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-easing', VALO_THEME_BASE_URL.'/js/jquery.easing.1.3.js', false, '', false );
	if ( is_singular() ){
	wp_enqueue_script( 'comment-reply' );}
	wp_enqueue_script('valo-default', VALO_THEME_BASE_URL.'/js/valo.js', false, '', false );
 }
 function valo_custom_style(){
    global $post;

	wp_enqueue_style('main', VALO_THEME_BASE_URL.'/style.css', false, '', false);
	 if ( valo_options_array('skin') ){$skin = valo_options_array('skin');}else{$skin=0;}
    wp_enqueue_style( 'skin', VALO_THEME_BASE_URL.'/styles/skin'.$skin.'/skin.css', false, '', false );
	 wp_enqueue_style( 'custom', VALO_THEME_BASE_URL.'/styles/custom-style.php', false, '', false );
 }
   
	
   if (!is_admin()) {
   add_action('wp_print_scripts', 'valo_custom_scripts');
   add_action('wp_print_styles', 'valo_custom_style');
  }

  
/*
*  page navigation
*
*/
function valo_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => '<< ',
    'next_text' => ' >>'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<p class="page_navi">'.paginate_links($pagination).'</p>'; 
	}else
	{
	
	return '<p class="page_navi">'.paginate_links($pagination).'</p>';
	}
}

//// get breadcrumb wrapper and slider

   function valo_get_breadcrumb(){
   global $post;
   $show_breadcrumb = "";
   $top_slider = "";
   if(isset($post->ID) && is_numeric($post->ID)){
    $show_breadcrumb = get_post_meta( $post->ID, '_valo_show_breadcrumb', true );
	}
	if($show_breadcrumb == 1 || $show_breadcrumb==""){
	echo  '<div class="row-fluid">
<div class="nav-molu">
<div class="container">';
 new valo_breadcrumb;
echo '</div></div></div>';
	}

	
   }
   
   
   function valo_get_slider(){
   	
    wp_register_style( 'camera_css', VALO_THEME_BASE_URL.'/styles/camera.css', false, '', false );
	wp_enqueue_style('camera_css');
	wp_register_script( 'camera', VALO_THEME_BASE_URL.'/js/camera.min.js', false, '', false );
	wp_enqueue_script('camera');
	
	echo '<div class="banner"><div class="camera_wrap camera_azure_skin" id="camera_wrap_banner">';
	 for($i=1;$i<=5;$i++){

	 $title = valo_options_array('valo_slide_title_'.$i);
	 $text  = valo_options_array('valo_slide_text_'.$i);
	 $image = valo_options_array('valo_slide_image_'.$i);
	 $link  = valo_options_array('valo_slide_link_'.$i);
	 
	if($image !=""){
	
	if($link!=""){$title = '<a href="'.esc_url($link).'">'.$title.'</a>';}
	echo '<div data-thumb="'.$image.'" data-src="'.$image.'">
                <div class="camera_caption fadeFromBottom">
				<div class="slide-title">'.$title.'</div><p>'.$text.'</p></div>
            </div>';
			}


	}
		echo '</div></div><!--banner-->';

	
	
   }
   //// Get header social network icon list 
   
   function valo_get_social_network($args){
   $return = "";
   if(is_array($args)){
   $return = '<ul class="follow">';
   foreach($args as $social){
   $social_link = valo_options_array('social_'.$social);
   if($social_link!=""){
    $return .=  '<li><a href="'.$social_link.'" target="_blank" title="'.ucwords(str_replace("_"," ",$social)).'"><img src="'.VALO_THEME_BASE_URL.'/images/social/'.$social.'.png" /></a></li>';
	}
   }
   $return .= '</ul>';
   }
   return $return;
   }
   // Get sidebar
   function valo_get_sidebar($sidebar){
 
if(is_active_sidebar($sidebar)){
   dynamic_sidebar($sidebar);
}
else{
dynamic_sidebar(1) ;

}

   }
   
   //// Custom comments list
   
   function valo_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
	 
	 <div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
			<div class="comment-info">
			<div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
      <div class="comment-author vcard">
        
			<span class="fnfn"><?php printf(__('%s </cite><span class="says">says:</span>','valo'), get_comment_author_link()) ;?></span>
								<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','valo'), get_comment_date(), get_comment_time()) ;?></a>
<?php edit_comment_link(__('(Edit)','valo'),'  ','') ;?></span>
				<span class="comment-meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">-#<?php echo $depth?></a>				</span>

      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','valo') ;?></em>
         <br />
      <?php endif; ?>

     

      <?php comment_text() ;?>
</div>
   
     </div>
<?php
        }