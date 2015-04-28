<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

 get_header(); 
 $sidebar = 0;
 $custom_home_layout = 0;
 $enable_home_page = valo_options_array('enable_home_page');
  if($enable_home_page == 1 &&  is_front_page()){
    $custom_home_layout = 1;
    valo_get_slider();
  }

 
?>
<div class="center">
  <div class="Showroom_Theme">
    <?php if (have_posts()) :
	 if($custom_home_layout == 1){
     get_template_part("content","home");
   }else{
    $sidebar = 1;
	while ( have_posts() ) : the_post();
	
	
	?>
    <div id="post-<?php the_ID(); ?>" <?php post_class("blog_list"); ?>>
   <?php get_template_part("content",get_post_format());?>
    </div>
    <?php  endwhile;?>
    <div class="clear"></div>
	
    <div class="pagination">
     <?php valo_native_pagenavi("echo",$wp_query);?>
    </div>
	
	 <?php } else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
	 
	<?php endif; ?>
  </div>
  
  <?php  if($sidebar == 1){ ?>
  <div class="Showroom_right">
    <?php  
   if(is_active_sidebar(4)){
   dynamic_sidebar(4);
}
else{
dynamic_sidebar(1) ;

}
 ?>
  </div>
  <?php }?>
</div>
<?php get_footer(); ?>