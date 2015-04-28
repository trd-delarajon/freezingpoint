<?php
/**
 * @package WordPress
 * @subpackage Valo
 */

// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'valo'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(__('No comment', 'valo'), __('Has one comment', 'valo'), __('% comments', 'valo'));?> <?php printf(__('to &#8220;%s&#8221;', 'valo'), the_title('', '', false)); ?></h3>
<div class="upcomment"><?php _e('You can ','valo'); ?><a id="leaverepond" href="#comments"><?php _e('leave a reply','valo'); ?></a>  <?php _e(' or ','valo'); ?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('Trackback','valo'); ?></a> <?php _e('this post.','valo'); ?></div>
	<ol id="thecomments" class="commentlist">
	<?php wp_list_comments('type=comment&callback=valo_comment');?>
	</ol>

<!-- comments pagenavi Start. -->
	<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
		<div id="commentnavi">
			<span class="pages"><?php _e('Comment pages', 'valo'); ?></span>
			<div id="commentpager">
				<?php echo $comment_pages; ?>
				
			</div>
			<div class="fixed"></div>
		</div>
<?php
		}
	}
?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php //_e('Comments are closed.', 'valo'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>


<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'valo'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<?php comment_form();?>

<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>