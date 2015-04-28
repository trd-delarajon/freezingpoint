<?php
/**
 * The template for displaying all pages.
 * @package WordPress
 **/

get_header(); ?>
<?php 
  $enable_home_page = valo_options_array('enable_home_page');
  if($enable_home_page == 1 && (is_home() || is_front_page())){
  valo_get_slider();
  }else{
   valo_get_breadcrumb();
  }
?>

<div id="post-<?php the_ID(); ?>" <?php post_class("clear"); ?>>

<?php
 if (have_posts()) :	while ( have_posts() ) : the_post();
    $layout = get_post_meta(get_the_ID(), '_valo_single_sidebar', true);
    $show_sidebar  = "";
	switch( $layout){
	case "sidebar_right":
	$content_style = "Showroom_Theme_left";
	$sidebar_style = "Showroom_right";
	$content_top   = "Showroom_top";
	break;
	case "sidebar_left":
	$content_style = "Showroom_Theme_right";
	$sidebar_style = "Showroom_left";
	$content_top   = "Showroom_top";
	break;
	case "sidebar_none":
	$content_style = "Showroom_Theme_full";
	$content_top   = "Showroom_top_full";
	$show_sidebar  = "no";
	break;
	default:
	$content_style = "Showroom_Theme_left";
	$sidebar_style = "Showroom_right";
	$content_top   = "Showroom_top";
	break;
	}
   $enable_home_page = valo_options_array('enable_home_page');
   if($enable_home_page == 1 && (is_home() || is_front_page())){
     get_template_part("content","home");
   }else{
?>
  <div class="<?php echo $content_style;?>">
   <div class="<?php echo $content_top;?>">
    <div class="blog_size">
     <div class="the_content">
<?php the_content();?>
<?php
	wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'valo' ),
				'after'  => '</div>'
			) );
		?>

 </div>
 <?php edit_post_link( __( 'Edit', 'valo' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</div>

<?php 
	echo '<div class="comment-wrapper">';
	comments_template(); 
	echo '</div>';
?>	
</div>
</div>
<?php
}
?>
 <?php if($show_sidebar != "no"){?>
   <div class="<?php echo $sidebar_style?>">
<?php 
if(is_active_sidebar(3)){
   dynamic_sidebar(3);
}
else{
dynamic_sidebar(1) ;
}
  ?>
  </div>
   <?php }?>

<?php endwhile;endif;?>
</div>
<?php get_footer(); ?>