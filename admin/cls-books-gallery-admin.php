<?php

/**
 *	Admin Parent Class
 */
class WBG_Admin 
{
	private $wbg_version;
	private $wbg_assets_prefix;

	function __construct($version)
	{
		$this->wbg_version = $version;
		$this->wbg_assets_prefix = substr(WBG_PRFX, 0, -1) . '-';
	}

	/**
	 *	Loading admin menu
	 */
	function wbg_admin_menu()
	{
		$wbg_cpt_menu = 'edit.php?post_type=books';
		add_submenu_page(
			$wbg_cpt_menu,
			esc_html__('Gallery Settings', WBG_TXT_DOMAIN),
			esc_html__('Gallery Settings', WBG_TXT_DOMAIN),
			'manage_options',
			'wbg-general-settings',
			array($this, WBG_PRFX . 'general_settings')
		);

		add_submenu_page(
			$wbg_cpt_menu,
			esc_html__('Book Detail Settings', WBG_TXT_DOMAIN),
			esc_html__('Book Detail Settings', WBG_TXT_DOMAIN),
			'manage_options',
			'wbg-details-settings',
			array($this, WBG_PRFX . 'details_settings')
		);

		add_submenu_page(
			$wbg_cpt_menu,
			esc_html__('Search Panel Settings', WBG_TXT_DOMAIN),
			esc_html__('Search Panel Settings', WBG_TXT_DOMAIN),
			'manage_options',
			'wbg-search-panel-settings',
			array($this, WBG_PRFX . 'search_panel_settings')
		);

		add_submenu_page(
			$wbg_cpt_menu,
			__('Help & Usage', WBG_TXT_DOMAIN),
			__('Help & Usage', WBG_TXT_DOMAIN),
			'manage_options',
			'wbg-get-help',
			array( $this, WBG_PRFX . 'get_help' )
		);
	}

	/**
	 *	Loading admin panel assets
	 */
	function wbg_enqueue_assets() {

		wp_enqueue_style(
			$this->wbg_assets_prefix . 'admin-style',
			WBG_ASSETS . 'css/' . $this->wbg_assets_prefix . 'admin-style.css',
			array(),
			$this->wbg_version,
			FALSE
		);

		// You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
		wp_register_style('jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('jquery-ui');

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		if (!wp_script_is('jquery')) {
			wp_enqueue_script('jquery');
		}

		// Load the datepicker script (pre-registered in WordPress).
		wp_enqueue_script('jquery-ui-datepicker');

		wp_enqueue_script(
			$this->wbg_assets_prefix . 'admin-script',
			WBG_ASSETS . 'js/' . $this->wbg_assets_prefix . 'admin-script.js',
			array('jquery'),
			$this->wbg_version,
			TRUE
		);
	}

	function wbg_custom_post_type() {
		$labels = array(
			'name'                	=> __('Books', WBG_TXT_DOMAIN),
			'singular_name'       	=> __('Book', WBG_TXT_DOMAIN),
			'menu_name'           	=> __('WBG Books', WBG_TXT_DOMAIN),
			'parent_item_colon'   	=> __('Parent Book', WBG_TXT_DOMAIN),
			'all_items'           	=> __('All Books', WBG_TXT_DOMAIN),
			'view_item'           	=> __('View Book', WBG_TXT_DOMAIN),
			'add_new_item'        	=> __('Add New Book', WBG_TXT_DOMAIN),
			'add_new'             	=> __('Add New', WBG_TXT_DOMAIN),
			'edit_item'           	=> __('Edit Book', WBG_TXT_DOMAIN),
			'update_item'         	=> __('Update Book', WBG_TXT_DOMAIN),
			'search_items'        	=> __('Search Book', WBG_TXT_DOMAIN),
			'not_found'           	=> __('Not Found', WBG_TXT_DOMAIN),
			'not_found_in_trash'  	=> __('Not found in Trash', WBG_TXT_DOMAIN)
		);
		$args = array(
			'label'               	=> __('books', WBG_TXT_DOMAIN),
			'description'         	=> __('Description For Books', WBG_TXT_DOMAIN),
			'labels'              	=> $labels,
			'supports'            	=> array('title', 'editor', 'thumbnail'),
			'public'              	=> true,
			'hierarchical'        	=> true,
			'show_ui'             	=> true,
			'show_in_menu'        	=> true,
			'show_in_nav_menus'   	=> true,
			'show_in_admin_bar'   	=> true,
			'has_archive'         	=> true,
        	'has_category'         	=> true, 
			'can_export'          	=> true,
			'exclude_from_search' 	=> false,
			'yarpp_support'       	=> true,
			//'taxonomies' 	      	=> array('post_tag'),
			'publicly_queryable'  	=> true,
			'capability_type'       => 'post',
			'menu_icon'           	=> 'dashicons-book',
			'query_var' 		  	=> true,
			'taxonomies'  			=> array( 'category', 'post_tag' ),
        	'rewrite'				=> array('slug' => 'books'),
		);
		register_post_type('books', $args);
	}

	function wbg_taxonomy_for_books() {
		$labels = array(
			'name' 				=> _x('Book Categories', 'taxonomy general name'),
			'singular_name' 	=> _x('Book Category', 'taxonomy singular name'),
			'search_items' 		=> __('Search Book Categories'),
			'all_items' 		=> __('All Book Categories'),
			'parent_item' 		=> __('Parent Book Category'),
			'parent_item_colon'	=> __('Parent Book Category:'),
			'edit_item' 		=> __('Edit Book Category'),
			'update_item' 		=> __('Update Book Category'),
			'add_new_item' 		=> __('Add New Book Category'),
			'new_item_name' 	=> __('New Book Category Name'),
			'menu_name' 		=> __('Book Categories', WBG_TXT_DOMAIN),
		);

		register_taxonomy('book_category', array('books'), array(
			'hierarchical' 		=> true,
			'labels' 			=> $labels,
			'show_ui' 			=> true,
			'show_admin_column' => true,
			'query_var' 		=> true,
			'rewrite' 			=> array('slug' => 'book-category'),
		));
	}

	function wbg_book_details_metaboxes() {
		add_meta_box(
			'wbg_book_details_link',
			__('Book Information', WBG_TXT_DOMAIN),
			array($this, WBG_PRFX . 'book_details_content'),
			'books',
			'normal',
			'high'
		);
	}

	function wbg_book_details_content() {

		global $post;

		// Nonce field to validate form request came from current site
		wp_nonce_field( basename(__FILE__), 'wbg_books_fields' );

		$wbg_author 		= get_post_meta( $post->ID, 'wbg_author', true );
		$wbg_download_link 	= get_post_meta( $post->ID, 'wbg_download_link', true );
		$wbg_publisher 		= get_post_meta( $post->ID, 'wbg_publisher', true );
		$wbg_published_on 	= get_post_meta( $post->ID, 'wbg_published_on', true );
		$wbg_isbn 			= get_post_meta( $post->ID, 'wbg_isbn', true );
		$wbg_pages 			= get_post_meta( $post->ID, 'wbg_pages', true );
		$wbg_country 		= get_post_meta( $post->ID, 'wbg_country', true );
		$wbg_language 		= get_post_meta( $post->ID, 'wbg_language', true );
		$wbg_dimension 		= get_post_meta( $post->ID, 'wbg_dimension', true );
		$wbg_filesize 		= get_post_meta( $post->ID, 'wbg_filesize', true );
		$wbg_status 		= get_post_meta( $post->ID, 'wbg_status', true );

		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'book-information.php';
	
	}

	/**
	 * Save books information meta data
	 */
	function wbg_save_book_meta( $post_id ) {

		global $post;

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( ! isset( $_POST['wbg_author'] ) || ! wp_verify_nonce( $_POST['wbg_books_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}

		$wbg_books_meta['wbg_author'] 			= (!empty($_POST['wbg_author']) && (sanitize_text_field($_POST['wbg_author']) != '')) ? sanitize_text_field($_POST['wbg_author']) : '';
		$wbg_books_meta['wbg_download_link'] 	= (!empty($_POST['wbg_download_link']) && (sanitize_text_field($_POST['wbg_download_link']) != '')) ? sanitize_text_field($_POST['wbg_download_link']) : '';
		$wbg_books_meta['wbg_publisher'] 		= (!empty($_POST['wbg_publisher']) && (sanitize_text_field($_POST['wbg_publisher']) != '')) ? sanitize_text_field($_POST['wbg_publisher']) : '';
		$wbg_books_meta['wbg_published_on'] 	= (!empty($_POST['wbg_published_on']) && (sanitize_text_field($_POST['wbg_published_on']) != '')) ? sanitize_text_field($_POST['wbg_published_on']) : '';
		$wbg_books_meta['wbg_isbn'] 			= (!empty($_POST['wbg_isbn']) && (sanitize_text_field($_POST['wbg_isbn']) != '')) ? sanitize_text_field($_POST['wbg_isbn']) : '';
		$wbg_books_meta['wbg_pages'] 			= (!empty($_POST['wbg_pages']) && (sanitize_text_field($_POST['wbg_pages']) != '')) ? sanitize_text_field($_POST['wbg_pages']) : '';
		$wbg_books_meta['wbg_country'] 			= (!empty($_POST['wbg_country']) && (sanitize_text_field($_POST['wbg_country']) != '')) ? sanitize_text_field($_POST['wbg_country']) : '';
		$wbg_books_meta['wbg_language'] 		= (!empty($_POST['wbg_language']) && (sanitize_text_field($_POST['wbg_language']) != '')) ? sanitize_text_field($_POST['wbg_language']) : '';
		$wbg_books_meta['wbg_dimension'] 		= (!empty($_POST['wbg_dimension']) && (sanitize_text_field($_POST['wbg_dimension']) != '')) ? sanitize_text_field($_POST['wbg_dimension']) : '';
		$wbg_books_meta['wbg_filesize'] 		= (!empty($_POST['wbg_filesize']) && (sanitize_text_field($_POST['wbg_filesize']) != '')) ? sanitize_text_field($_POST['wbg_filesize']) : '';
		$wbg_books_meta['wbg_status'] 			= (!empty($_POST['wbg_status']) && (sanitize_text_field($_POST['wbg_status']) != '')) ? sanitize_text_field($_POST['wbg_status']) : '';

		foreach ( $wbg_books_meta as $key => $value ) {
			if ( 'revision' === $post->post_type ) {
				return;
			}
			if ( get_post_meta( $post_id, $key, false ) ) {
				update_post_meta( $post_id, $key, $value );
			} else {
				add_post_meta( $post_id, $key, $value );
			}
			if ( ! $value ) {
				delete_post_meta( $post_id, $key );
			}
		}
	}

	function wbg_general_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;
		
		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'general-settings.php';
	}

	function wbg_details_settings() {
		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'details-settings.php';
	}

	function wbg_search_panel_settings() {
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;

		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'search-settings.php';
	}

	function wbg_get_help() {
		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'help-usage.php';
	}

	function wbg_display_notification($type, $msg) { 
		?>
		<div class="wbg-alert <?php printf('%s', $type); ?>">
			<span class="wbg-closebtn">&times;</span>
			<strong><?php esc_html_e( ucfirst( $type ), WBG_TXT_DOMAIN); ?>!</strong>
			<?php esc_html_e( $msg, WBG_TXT_DOMAIN ); ?>
		</div>
		<?php 
	}

	function wbg_admin_sidebar() {
		?>
		<div class="hmacs-admin-sidebar" style="width: 277px; float: left; margin-top: 5px;">
			<div class="postbox">
				<h3 class="hndle"><span>Support / Bug / Customization</span></h3>
				<div class="inside centered">
					<p>Please feel free to let us know if you have any bugs to report. Your report / suggestion can make the plugin awesome!</p>
					<p style="margin-bottom: 1px! important;"><a href="http://hossnimubarak.com/#hossnimubarak-contact" target="_blank" class="button button-primary">Get Support</a></p>
				</div>
			</div>
			<div class="postbox">
				<h3 class="hndle"><span>Buy us a coffee</span></h3>
				<div class="inside centered">
					<p>If you like the plugin, would you like to support the advancement of this plugin?</p>
					<p style="margin-bottom: 1px! important;"><a href='https://www.paypal.me/mhmrajib' class="button button-primary" target="_blank">Donate</a></p>
				</div>
			</div>

			<div class="postbox">
				<h3 class="hndle"><span>Join HM Plugin on facebook</span></h3>
				<div class="inside centered">
					<iframe src="//www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/hmplugin&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:220px;" allowTransparency="true"></iframe>
				</div>
			</div>

			<div class="postbox">
				<h3 class="hndle"><span>Follow HM Plugin on twitter</span></h3>
				<div class="inside centered">
					<a href="https://twitter.com/hmplugin" target="_blank" class="button button-secondary">Follow @hmplugin<span class="dashicons dashicons-twitter" style="position: relative; top: 3px; margin-left: 3px; color: #0fb9da;"></span></a>
				</div>
			</div>
		</div> 
		<?php
	}
}
?>