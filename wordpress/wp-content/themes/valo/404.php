<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package WordPress
 */

get_header(); ?>

<div class="row-fluid">
<div class="nav-molu">
  <div class="container">
    <?php new valo_breadcrumb;?>
  </div>
</div>
<div class="main_content page_404">
  <div class="border-top"></div>
  <div class="title-404 width600">
    <h1>
      <?php _e('Whoops!', 'valo'); ?>
    </h1>
    <h2>
      <?php _e('There is nothing here.', 'valo'); ?>
    </h2>
    <p>
      <?php _e('Perhaps you were given the wrong URL?', 'valo'); ?>
    </p>
  </div>
  <div class="border-top"></div>
  <div class="title-404 width600">
    <p>
      <?php _e('You could try searching for what you want here:', 'valo'); ?>
    </p>
    <div class="search_form">
      <div class="widget_search"><form action="<?php echo esc_url(home_url('/')); ?>" class="searchform" id="searchform" method="get" role="search">
				<div>
					<label for="s" class="screen-reader-text"><?php _e('Search for:', 'valo'); ?></label>
					<input type="text" id="s" name="s" value="">
					<input type="submit" value="Search" id="searchsubmit">
				</div>
			</form><span class="seperator extralight-border"></span></div>
      <div class="clear"></div>
    </div>
    <p>
      <?php _e('Or check the url you typed is spelled correctly.<br>Or go to', 'valo'); ?>
      <a href="<?php echo esc_url(home_url('/')); ?>">
      <?php _e('Homepage', 'valo'); ?>
      </a></p>
  </div>
  <div class="clear"></div>
</div>
<!--main_content-->
<div class="main_content">
  <div class="border-top"></div>
</div>
<!--main_content-->
<?php get_footer(); ?>