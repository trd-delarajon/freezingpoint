<?php
/**
 * The template for displaying the footer.
 * @package WordPress

 */

?>
<div class="bottom">
 <div class="Copyright">
      <?php

wp_nav_menu(array('theme_location'=>'footer','depth'=>1,'container'=>'','fallback_cb' =>false,'container_class'=>'main-menu','menu_id'=>'menu-footer','menu_class'=>'footer-nav'));

?> 
 </div>
 <span> <?php printf( __( 'Copyright &copy; %s', 'valo' ), date("Y") ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>, <?php _e("All Rights Reserved.","valo");?>
 
 <?php printf( __( 'Powered by <a href="http://wordpress.org/" target="_blank">%s</a>', 'valo' ), 'WordPress' ); ?>
  
 <?php if( is_home() || is_front_page() ): ?>
	  |	 <?php printf( __( 'Theme : Valo by <a href="%s">Mageewp Themes</a>', 'valo' ), esc_url("http://www.mageewp.com/") ); ?> .
	    <?php endif; ?>
 </span>
 </div>

<?php wp_footer(); ?>
</body>
</html>