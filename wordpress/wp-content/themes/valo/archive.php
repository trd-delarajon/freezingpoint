<?php
/**
 * The archive template file.
 *
 * @package WordPress
 */

get_header(); ?>
<div class="center">
  <div class="Showroom_Theme">
    <?php if (have_posts()) :
	while ( have_posts() ) : the_post();?>
    <div id="post-<?php the_ID(); ?>" <?php post_class("blog_list"); ?>>
   <?php get_template_part("content",get_post_format());?>
    </div>
    <?php endwhile;?>
    <div class="clear"></div>
    <div class="pagination">
     <?php valo_native_pagenavi("echo",$wp_query);?>
    </div>
	 <?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
  </div>
  <div class="Showroom_right">
    <?php 
   if(is_active_sidebar(5)){
   dynamic_sidebar(5);
}
else{
dynamic_sidebar(1) ;

}
?>
  </div>
</div>
<?php get_footer(); ?>