<?php
header("Content-type: text/css", true);
/*	
	*	Valo Include css File
	*	---------------------------------------------------------------------
	* 	@version	1.0.6
	* 	@author		Magee
	* 	@link		http://www.mageewp.com
	* 	@copyright	Copyright (c) mageewp.com
	*	---------------------------------------------------------------------
	*/
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

	//// tagline typography
	$tagline_typography = valo_options_array('tagline_typography');
	if ($tagline_typography) { 
	echo '.top span.tagline {font-family: ' . $tagline_typography['face']. '; font-size:'.$tagline_typography['size'] . '; font-style: ' . $tagline_typography['style'] . '; color:'.$tagline_typography['color'].';font-weight:'.$tagline_typography['style'] . '; }';
	}

	
	//// content typography
	$content_typography = valo_options_array('content_typography');
	if ($content_typography) { 
	echo 'div.blog_size .the_content {font-family: ' . $content_typography['face']. '; font-size:'.$content_typography['size'] . '; font-style: ' . $content_typography['style'] . '; color:'.$content_typography['color'].';font-weight:'.$content_typography['style'] . ';}';
	}
	////
	if(is_numeric($content_width)){echo "body div.wapper{width:".$content_width."px;}";}
	
	  $custom_css = valo_options_array('header_code');
  if(isset($custom_css) && $custom_css != ""){echo $custom_css; }