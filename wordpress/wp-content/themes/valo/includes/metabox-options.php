<?php

/**
 * Calls the class on the post edit screen.
 */
function valo_call_metaboxClass() {
    new Valo_metaboxClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'valo_call_metaboxClass' );
    add_action( 'load-post-new.php', 'valo_call_metaboxClass' );
}

/** 
 * The Class.
 */
class Valo_metaboxClass {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
            $post_types = array('post', 'page');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'some_meta_box_name'
			,__( 'Valo Metabox Options', 'valo' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'advanced'
			,'high'
		);
            }
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['valo_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['valo_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'valo_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$show_breadcrumb           = sanitize_text_field( $_POST['valo_show_breadcrumb'] );
		$top_slider                = sanitize_text_field( $_POST['valo_top_slider'] );
		$valo_single_sidebar       = sanitize_text_field( $_POST['valo_single_sidebar'] );
		

		// Update the meta field.
		update_post_meta( $post_id, '_valo_show_breadcrumb', $show_breadcrumb );
		update_post_meta( $post_id, '_valo_top_slider', $top_slider );
		update_post_meta( $post_id, '_valo_single_sidebar', $valo_single_sidebar );
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'valo_inner_custom_box', 'valo_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
	    $show_breadcrumb          = get_post_meta( $post->ID, '_valo_show_breadcrumb', true );
		$top_slider               = get_post_meta( $post->ID, '_valo_top_slider', true );
		$valo_single_sidebar      = get_post_meta( $post->ID, '_valo_single_sidebar', true );
		
		$select_y = "";
		$select_n = "";
		$select_r = "";
		$select_l = "";
		if($show_breadcrumb == 1 || $show_breadcrumb == ""){$select_y = 'selected="selected"';}else{$select_n = 'selected="selected"';}
		if($valo_single_sidebar == "sidebar_right"){$select_r = 'selected="selected"';}
		if($valo_single_sidebar == "sidebar_left"){$select_l = 'selected="selected"';}

		// Display the form, using the current value.
		echo '<p class="meta-options"><label for="valo_show_breadcrumb"  style="display: inline-block;width: 150px;">';
		_e( 'Show Breadcrumb :', 'valo' );
		echo '</label> ';
		echo '<select name="valo_show_breadcrumb" id="valo_show_breadcrumb"><option '.$select_y.' value="1">Yes</option><option '.$select_n .' value="0">No</option></select></p>';
		
		//sidebar
		
		echo '<p class="meta-options"><label for="valo_single_sidebar"  style="display: inline-block;width: 150px;">';
		_e( 'Choose Sideber :', 'valo' );
		echo '</label> ';
		echo '<select name="valo_single_sidebar" id="valo_single_sidebar"><option '.$select_r.' value="sidebar_right">Right Sidebar</option><option '.$select_l .' value="sidebar_left">Left Sidebar</option><option value="sidebar_none">None</option></select></p>';
		
	
		
	}
}