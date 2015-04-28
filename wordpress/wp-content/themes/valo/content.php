<?php
/**
 * Posts loop
 *
 * @package WordPress
 */
   $comments = get_comments_number(get_the_ID());
   $comment_unit = $comments <= 1?__("Comment","valo"):__("Comments","valo");
   $comment_str = $comments." ".$comment_unit;
	?>
<div class="post_date"><?php echo get_the_time("M");echo " ";echo get_the_time("dS"); ?><p style="font-weight:bold"><?php echo get_the_time("Y");?></p></div>
  <h2 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
  
    <?php
if ( !is_singular() && has_post_thumbnail() && ! post_password_required()) { 
         //  $feat_image = wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()), 'blog-list');
         // if($feat_image){
		  echo "<div class='blog_banner'><a href='".get_permalink()."'>";
		      the_post_thumbnail('blog-list');
				echo "</a></div>";
			//	}
} 
  ?>
  <div class="blog_size">
  <div class="the_content">
<?php if ( is_singular()) : ?>
<?php the_content();
 wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'valo' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
 
echo '<div class="clear"></div>';

?>
<?php else: // is_single() ?>
<?php the_excerpt();?>
<?php endif;?>
  <?php if ( !is_singular()) : ?>
  <div class="continue"><a href="<?php the_permalink();?>"><?php _e("Continue Reading >>","valo");?></a>  </div>
  <div class="Pgotos_center">
  <div class="Comments"><a href="<?php the_permalink();?>#comment"><?php echo $comment_str;?></a></div>
  </div>
  <?php endif;?>
  </div></div>
  <?php
   if ( is_singular()) :
  echo '<div class="comment-wrapper">';
comments_template(); 
echo '</div>';
endif;
