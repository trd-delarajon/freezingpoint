<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option(VALO_OPTIONS_PREFIXED.'optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option(VALO_OPTIONS_PREFIXED.'optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Background Defaults
	
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'normal',
		'color' => '#666666' );
      
	  //Tagline Typography Defaults
	$tagline_typography_defaults = array(
		'size' => '13px',
		'face' => 'georgia',
		'style' => 'normal',
		'color' => '#666666' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	 // Skin style data
        $skin_array = array(
                '0' => __('Default', 'valo'),
                '1' => __('Black', 'valo'),
                '2' => __('Steelblue ', 'valo'),
                '3' => __('Mediumseagreen', 'valo'),
                '4' => __('Forestgreen', 'valo'),
				'5' => __('Darkgreen ', 'valo'),
				'6' => __('Cadetblue ', 'valo'),
				'7' => __('Darkslateblue', 'valo'),
				
        );


	


	// If using image radio buttons, define a directory path
	$imagepath =  VALO_THEME_BASE_URL . '/images/';

	$options = array();
/// HEADER
	$options[] = array(
		'name' => __('Header Settings', 'valo'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Upload Logo', 'valo'),
		'desc' => __('Upload a logo image, or enter the URL to an image if its already uploaded. The themes default logo gets applied if the input field is left blank .  Logo Dimension: 300px * 75px (if your logo is larger you might need to modify style.css to align it perfectly).', 'valo'),
		'id' => 'logo',
		'std' =>VALO_THEME_BASE_URL.'/images/logo.png',
		'type' => 'upload');
		
		$options[] = array( 'name' => __('Tagline Typography', 'valo'),
		'desc' => __('Tagline typography (Site description below logo image).', 'valo'),
		'id' => "tagline_typography",
		'std' => $tagline_typography_defaults,
		'type' => 'typography' );
		

    $options[] = array(
		'name' => __('Favicon', 'valo'),
		'desc' => __('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="'.esc_url("http://en.wikipedia.org/wiki/Favicon").' target="_blank">Favicon</a>', 'valo'),
		'id' => 'favicon',
		'type' => 'upload');
	
		
	
		
		$options[] = array(
		'name' => __('Custom CSS', 'valo'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'valo'),
		'id' => 'header_code',
		'std' => 'body{margin:0px;}',
		'type' => 'textarea');
		$options[] = array(
		'name' => __('Facebook url', 'valo'),
		'desc' => __('Your facebook url', 'valo'),
		'id' => 'social_facebook',
		'std' => "",
		'type' => 'text');
		$options[] = array(
		'name' => __('Twitter url', 'valo'),
		'desc' => __('Your Twitter url', 'valo'),
		'id' => 'social_twitter',
		'std' => "",
		'type' => 'text');
		$options[] = array(
		'name' => __('Google plus url', 'valo'),
		'desc' => __('Your Google plus url', 'valo'),
		'id' => 'social_google_plus',
		'std' => "",
		'type' => 'text');
		$options[] = array(
		'name' => __('Youtube url', 'valo'),
		'desc' => __('Your Youtube Url', 'valo'),
		'id' => 'social_youtube',
		'std' => "",
		'type' => 'text');
		$options[] = array(
		'name' => __('Pinterest url', 'valo'),
		'desc' => __('Your Pinterest Url', 'valo'),
		'id' => 'social_pinterest',
		'std' => "",
		'type' => 'text');
		$options[] = array(
		'name' => __('Rss url', 'valo'),
		'desc' => __('Your Rss feed Url', 'valo'),
		'id' => 'social_rss',
		'std' => get_bloginfo('rss2_url'),
		'type' => 'text');
		
	////	BODY
		
		$options[] = array(
		'name' => __('Body Style', 'valo'),
		'type' => 'heading');
		
		 $options[] = array(
                'name' => __('Skin Styles', 'valo'),
                'desc' => __('Choose a skin style.', 'valo'),
                'id' => 'skin',
                'std' => '0',
                'type' => 'select',
                'options' => $skin_array);
		
     
		$options[] = array( 'name' => __('Content Typography', 'valo'),
		'desc' => __('Content typography.', 'valo'),
		'id' => "content_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );
		
		
		
		////HOME PAGE
		$options[] = array(
		'name' => __('Home Page', 'valo'),
		'type' => 'heading');
		
		
		
		$options[] = array(
		'name' => __('Use Custom Home Page Layout', 'valo'),
		'desc' => __('Active custom home page layout ( Use the following configuration instead of the home page content).  The standardized way of creating Static Front Pages: <a href="'.esc_url('http://codex.wordpress.org/Creating_a_Static_Front_Page').'" target="_blank">Creating a Static Front Page</a>', 'valo'),
		'id' => 'enable_home_page',
		'std' => 1,
		'type' => 'checkbox');
		
			
		//HOME PAGE SLIDER
		$options[] = array('name' => __('Top Slideshow', 'valo'),'id' => 'group_title','type' => 'title');
		
		$options[] = array('name' => __('Slide 1', 'valo'),'id' => 'slide_group_start_1','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'valo'),'id' => 'valo_slide_image_1','type' => 'upload','std'=>VALO_THEME_BASE_URL.'/images/valo-banner1.jpg');
		$options[] = array('name' => __('Title', 'valo'),'id' => 'valo_slide_title_1','type' => 'text','std'=>'Title 1');
		$options[] = array('name' => __('Text', 'valo'),'id' => 'valo_slide_text_1','type' => 'textarea','std'=>'Hic modo aliquid, ut infra ius textus amet tincidunt imago sedere involvent opportune. Usque essent omnia spatiosa satis sedeat. Yeah ... Sic. Nunquam tanta esse bonum est.');
		$options[] = array('name' => __('Link', 'valo'),'id' => 'valo_slide_link_1','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_1','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 2', 'valo'),'id' => 'slide_group_start_2','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'valo'),'id' => 'valo_slide_image_2','type' => 'upload','std'=>VALO_THEME_BASE_URL.'/images/valo-banner2.jpg');
		$options[] = array('name' => __('Title', 'valo'),'id' => 'valo_slide_title_2','type' => 'text','std'=>'Title 2');
		$options[] = array('name' => __('Text', 'valo'),'id' => 'valo_slide_text_2','type' => 'textarea','std'=>'Hic modo aliquid, ut infra ius textus amet tincidunt imago sedere involvent opportune. Usque essent omnia spatiosa satis sedeat. Yeah ... Sic. Nunquam tanta esse bonum est.');
		$options[] = array('name' => __('Link', 'valo'),'id' => 'valo_slide_link_2','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_2','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 3', 'valo'),'id' => 'slide_group_start_3','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'valo'),'id' => 'valo_slide_image_3','type' => 'upload','std'=>VALO_THEME_BASE_URL.'/images/valo-banner3.jpg');
		$options[] = array('name' => __('Title', 'valo'),'id' => 'valo_slide_title_3','type' => 'text');
		$options[] = array('name' => __('Text', 'valo'),'id' => 'valo_slide_text_3','type' => 'textarea');
		$options[] = array('name' => __('Link', 'valo'),'id' => 'valo_slide_link_3','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_3','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 4', 'valo'),'id' => 'slide_group_start_4','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'valo'),'id' => 'valo_slide_image_4','type' => 'upload');
		$options[] = array('name' => __('Title', 'valo'),'id' => 'valo_slide_title_4','type' => 'text');
		$options[] = array('name' => __('Text', 'valo'),'id' => 'valo_slide_text_4','type' => 'textarea');
		$options[] = array('name' => __('Link', 'valo'),'id' => 'valo_slide_link_4','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_4','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 5', 'valo'),'id' => 'slide_group_start_5','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'valo'),'id' => 'valo_slide_image_5','type' => 'upload');
		$options[] = array('name' => __('Title', 'valo'),'id' => 'valo_slide_title_5','type' => 'text');
		$options[] = array('name' => __('Text', 'valo'),'id' => 'valo_slide_text_5','type' => 'textarea');
		$options[] = array('name' => __('Link', 'valo'),'id' => 'valo_slide_link_5','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_5','type' => 'end_group');
		
		
		//END HOME PAGE SLIDER
		
		$options[] = array(
		'name' => __('Key Feature Title(Area #1)', 'valo'),
		'id' => 'key_feature_title_1',
		'std' => 'Key Feature #1',
		'type' => 'text');
		$options[] = array(
		'name' => __('Key Feature Image(Area #1)', 'valo'),
		'desc'=>__('Image Dimension: 300px * 300px ','valo'),
		'id' => 'key_feature_image_1',
		'type' => 'upload');
	  $options[] = array(
		'name' => __('Key Feature Link(Area #1)', 'valo'),
		'desc' => __('Learn More Link.', 'valo'),
		'id' => 'key_feature_link_1',
		'std' => 'http://',
		'type' => 'text');

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Key Feature Description(Area #1)', 'valo'),
		'id' => 'key_feature_description_1',
		'type' => 'editor',
		'std' =>'Praesent interdum mollis neque. In egestas nulla eget pede. Integer eu purus sed diam dictum scelerisque. Morbi cursus velit et felis. Maecenas faucibus aliquet erat. In aliquet rhoncus tellus.',
		'settings' => $wp_editor_settings );
  
    
	$options[] = array(
		'name' => __('Key Feature Title(Area #2)', 'valo'),
		'id' => 'key_feature_title_2',
		'std' => 'Key Feature #2',
		'type' => 'text');
		$options[] = array(
		'name' => __('Key Feature Image(Area #2)', 'valo'),
		'id' => 'key_feature_image_2',
		'type' => 'upload');
		
		$options[] = array(
		'name' => __('Key Feature Link(Area #2)', 'valo'),
		'desc' => __('Learn More Link.', 'valo'),
		'id' => 'key_feature_link_2',
		'std' => 'http://',
		'type' => 'text');
	$options[] = array(
		'name' => __('Key Feature Description(Area #2)', 'valo'),
		'id' => 'key_feature_description_2',
		'type' => 'editor',
		'std' =>'Praesent interdum mollis neque. In egestas nulla eget pede. Integer eu purus sed diam dictum scelerisque. Morbi cursus velit et felis. Maecenas faucibus aliquet erat. In aliquet rhoncus tellus.',
		'settings' => $wp_editor_settings );
    
		
		
		$options[] = array(
		'name' => __('Key Feature Title(Area #3)', 'valo'),
		'id' => 'key_feature_title_3',
		'std' => 'Key Feature #3',
		'type' => 'text');
		$options[] = array(
		'name' => __('Key Feature Image(Area #3)', 'valo'),
		'id' => 'key_feature_image_3',
		'type' => 'upload');
     $options[] = array(
		'name' => __('Key Feature Link(Area #3)', 'valo'),
		'desc' => __('Learn More Link.', 'valo'),
		'id' => 'key_feature_link_3',
		'std' => 'http://',
		'type' => 'text');
	$options[] = array(
		'name' => __('Key Feature Description(Area #3)', 'valo'),
		'id' => 'key_feature_description_3',
		'type' => 'editor',
		'std' =>'Praesent interdum mollis neque. In egestas nulla eget pede. Integer eu purus sed diam dictum scelerisque. Morbi cursus velit et felis. Maecenas faucibus aliquet erat. In aliquet rhoncus tellus.',
		'settings' => $wp_editor_settings );
    

	return $options;
}