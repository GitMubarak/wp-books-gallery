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
			esc_html__('Get Help', WBG_TXT_DOMAIN),
			esc_html__('Get Help', WBG_TXT_DOMAIN),
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
			'name'                	=> __('Books'),
			'singular_name'       	=> __('Book'),
			'menu_name'           	=> __('WBG Books'),
			'parent_item_colon'   	=> __('Parent Book'),
			'all_items'           	=> __('All Books'),
			'view_item'           	=> __('View Book'),
			'add_new_item'        	=> __('Add New Book'),
			'add_new'             	=> __('Add New'),
			'edit_item'           	=> __('Edit Book'),
			'update_item'         	=> __('Update Book'),
			'search_items'        	=> __('Search Book'),
			'not_found'           	=> __('Not Found'),
			'not_found_in_trash'  	=> __('Not found in Trash')
		);
		$args = array(
			'label'               	=> __('books'),
			'description'         	=> __('Description For Books'),
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
			'search_items' 		=>  __('Search Book Categories'),
			'all_items' 		=> __('All Book Categories'),
			'parent_item' 		=> __('Parent Book Category'),
			'parent_item_colon'	=> __('Parent Book Category:'),
			'edit_item' 		=> __('Edit Book Category'),
			'update_item' 		=> __('Update Book Category'),
			'add_new_item' 		=> __('Add New Book Category'),
			'new_item_name' 	=> __('New Book Category Name'),
			'menu_name' 		=> __('Book Categories'),
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
			'Book Details',
			array($this, WBG_PRFX . 'book_details_content'),
			'books',
			'normal',
			'high'
		);
	}

	function wbg_book_details_content()
	{
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field(basename(__FILE__), 'event_fields');
		$wbg_author 		= get_post_meta($post->ID, 'wbg_author', true);
		$wbg_download_link 	= get_post_meta($post->ID, 'wbg_download_link', true);
		$wbg_publisher 		= get_post_meta($post->ID, 'wbg_publisher', true);
		$wbg_published_on 	= get_post_meta($post->ID, 'wbg_published_on', true);
		$wbg_isbn 			= get_post_meta($post->ID, 'wbg_isbn', true);
		$wbg_pages 			= get_post_meta($post->ID, 'wbg_pages', true);
		$wbg_country 		= get_post_meta($post->ID, 'wbg_country', true);
		$wbg_language 		= get_post_meta($post->ID, 'wbg_language', true);
		$wbg_dimension 		= get_post_meta($post->ID, 'wbg_dimension', true);
		$wbg_filesize 		= get_post_meta($post->ID, 'wbg_filesize', true);
		$wbg_status 		= get_post_meta($post->ID, 'wbg_status', true);
?>
<table class="form-table">
    <tr class="wbg_author">
        <th scope="row">
            <label for="wbg_author"><?php esc_html_e('Author:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_author" value="<?php echo esc_attr($wbg_author); ?>" class="regular-text">
        </td>
    </tr>
    <tr class="wbg_publisher">
        <th scope="row">
            <label for="wbg_publisher"><?php esc_html_e('Publisher:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_publisher" value="<?php echo esc_attr($wbg_publisher); ?>"
                class="regular-text">
        </td>
    </tr>
    <tr class="wbg_published_on">
        <th scope="row">
            <label for="wbg_published_on"><?php esc_html_e('Published On:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_published_on" id="wbg_published_on"
                value="<?php echo esc_attr($wbg_published_on); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_isbn">
        <th scope="row">
            <label for="wbg_isbn"><?php esc_html_e('ISBN:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_isbn" value="<?php echo esc_attr($wbg_isbn); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_pages">
        <th scope="row">
            <label for="wbg_pages"><?php esc_html_e('Pages:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_pages" value="<?php echo esc_attr($wbg_pages); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_country">
        <th scope="row">
            <label for="wbg_country"><?php esc_html_e('Country:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_country" value="<?php echo esc_attr($wbg_country); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_language">
        <th scope="row">
            <label for="wbg_language"><?php esc_html_e('Language:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_language" value="<?php echo esc_attr($wbg_language); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_dimension">
        <th scope="row">
            <label for="wbg_dimension"><?php esc_html_e('Dimension:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_dimension" value="<?php echo esc_attr($wbg_dimension); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_download_link">
        <th scope="row">
            <label for="wbg_download_link"><?php esc_html_e('External Url:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_download_link" value="<?php echo esc_attr($wbg_download_link); ?>"
                class="widefat">
        </td>
    </tr>
    <tr class="wbg_filesize">
        <th scope="row">
            <label for="wbg_filesize"><?php esc_html_e('File Size:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_filesize" value="<?php echo esc_attr($wbg_filesize); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_status">
        <th scope="row">
            <label for="wbg_status"><?php esc_html_e('Status:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <select name="wbg_status" class="small-text">
                <option value="active" <?php if ('active' == esc_attr($wbg_status)) echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ('inactive' == esc_attr($wbg_status)) echo 'selected'; ?>>Inactive
                </option>
            </select>
        </td>
    </tr>
</table>
<?php
	}

	/**
	 * Save the metabox data
	 */
	function wbg_save_book_meta($post_id)
	{
		global $post;

		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if (!isset($_POST['wbg_author']) || !wp_verify_nonce($_POST['event_fields'], basename(__FILE__))) {
			return $post_id;
		}

		$events_meta['wbg_author'] 			= (!empty($_POST['wbg_author']) && (sanitize_text_field($_POST['wbg_author']) != '')) ? sanitize_text_field($_POST['wbg_author']) : '';
		$events_meta['wbg_download_link'] 	= (!empty($_POST['wbg_download_link']) && (sanitize_text_field($_POST['wbg_download_link']) != '')) ? sanitize_text_field($_POST['wbg_download_link']) : '';
		$events_meta['wbg_publisher'] 		= (!empty($_POST['wbg_publisher']) && (sanitize_text_field($_POST['wbg_publisher']) != '')) ? sanitize_text_field($_POST['wbg_publisher']) : '';
		$events_meta['wbg_published_on'] 	= (!empty($_POST['wbg_published_on']) && (sanitize_text_field($_POST['wbg_published_on']) != '')) ? sanitize_text_field($_POST['wbg_published_on']) : '';
		$events_meta['wbg_isbn'] 			= (!empty($_POST['wbg_isbn']) && (sanitize_text_field($_POST['wbg_isbn']) != '')) ? sanitize_text_field($_POST['wbg_isbn']) : '';
		$events_meta['wbg_pages'] 			= (!empty($_POST['wbg_pages']) && (sanitize_text_field($_POST['wbg_pages']) != '')) ? sanitize_text_field($_POST['wbg_pages']) : '';
		$events_meta['wbg_country'] 		= (!empty($_POST['wbg_country']) && (sanitize_text_field($_POST['wbg_country']) != '')) ? sanitize_text_field($_POST['wbg_country']) : '';
		$events_meta['wbg_language'] 		= (!empty($_POST['wbg_language']) && (sanitize_text_field($_POST['wbg_language']) != '')) ? sanitize_text_field($_POST['wbg_language']) : '';
		$events_meta['wbg_dimension'] 		= (!empty($_POST['wbg_dimension']) && (sanitize_text_field($_POST['wbg_dimension']) != '')) ? sanitize_text_field($_POST['wbg_dimension']) : '';
		$events_meta['wbg_filesize'] 		= (!empty($_POST['wbg_filesize']) && (sanitize_text_field($_POST['wbg_filesize']) != '')) ? sanitize_text_field($_POST['wbg_filesize']) : '';
		$events_meta['wbg_status'] 			= (!empty($_POST['wbg_status']) && (sanitize_text_field($_POST['wbg_status']) != '')) ? sanitize_text_field($_POST['wbg_status']) : '';

		foreach ($events_meta as $key => $value) :
			if ('revision' === $post->post_type) {
				return;
			}
			if (get_post_meta($post_id, $key, false)) {
				update_post_meta($post_id, $key, $value);
			} else {
				add_post_meta($post_id, $key, $value);
			}
			if (!$value) {
				delete_post_meta($post_id, $key);
			}
		endforeach;
	}

	function wbg_general_settings() {
		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'general-settings.php';
	}

	function wbg_details_settings() {
		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'details-settings.php';
	}

	function wbg_search_panel_settings() {
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$tab = isset ( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;

		require_once WBG_PATH . 'admin/view/' . $this->wbg_assets_prefix . 'search-settings.php';
	}

	function wbg_get_help() {
		?>
		<div id="poststuff" class="wrap">
			<div class="postbox">
				<div style="padding:20px;">
					<h3>For any help or query please visit us:</h3>
					<a href="<?php echo esc_url('http://plugin.hossnimubarak.com/wp-books-gallery/'); ?>" class="button button-primary" target="_blank"><?php esc_attr_e('Support & Live Chat', WBG_TXT_DOMAIN); ?></a>
				</div>
			</div>
		</div>
		<?php
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
}
?>