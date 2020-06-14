<?php
global $wpdb;

// Gallery Settings
$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbg_gallary_sorting        = isset( $wbgGeneralSettings['wbg_gallary_sorting'] ) ? $wbgGeneralSettings['wbg_gallary_sorting'] : 'title';
$wbgGalleryColumn           = ( $wbgGeneralSettings['wbg_gallary_column'] != '' ) ? $wbgGeneralSettings['wbg_gallary_column'] : 3;
$wbgTitleLength             = ( $wbgGeneralSettings['wbg_title_length'] != '' ) ? $wbgGeneralSettings['wbg_title_length'] : 4;
$wbgDetailsExternal         = ( $wbgGeneralSettings['wbg_details_is_external'] == 1 ) ? ' target="_blank"' : '';
$wbg_display_category       = isset( $wbgGeneralSettings['wbg_display_category'] ) ? $wbgGeneralSettings['wbg_display_category'] : '1';
$wbgCatLbl                  = ( $wbgGeneralSettings['wbg_cat_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_cat_label_txt'] : '';
$wbg_display_author         = isset( $wbgGeneralSettings['wbg_display_author'] ) ? $wbgGeneralSettings['wbg_display_author'] : '1';
$wbgAuthorLbl               = ( $wbgGeneralSettings['wbg_author_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_author_label_txt'] : '';
$wbg_display_description    = isset( $wbgGeneralSettings['wbg_display_description'] ) ? $wbgGeneralSettings['wbg_display_description'] : '1';
$wbg_description_length     = isset( $wbgGeneralSettings['wbg_description_length'] ) ? $wbgGeneralSettings['wbg_description_length'] : 20;
$wbg_display_buynow         = isset( $wbgGeneralSettings['wbg_display_buynow'] ) ? $wbgGeneralSettings['wbg_display_buynow'] : '1';
$wbg_buynow_btn_txt         = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : 'Button';
$wbg_display_search_panel   = isset( $wbgGeneralSettings['wbg_display_search_panel'] ) ? $wbgGeneralSettings['wbg_display_search_panel'] : '';

// Search Panel Settings
$wbgSearchSettings            = stripslashes_deep( unserialize( get_option('wbg_search_settings') ) );
$wbg_display_search_panel     = isset( $wbgSearchSettings['wbg_display_search_panel'] ) ? $wbgSearchSettings['wbg_display_search_panel'] : '1';
$wbg_display_search_title     = isset( $wbgSearchSettings['wbg_display_search_title'] ) ? $wbgSearchSettings['wbg_display_search_title'] : '1';
$wbg_display_search_category  = isset( $wbgSearchSettings['wbg_display_search_category'] ) ? $wbgSearchSettings['wbg_display_search_category'] : '1';
$wbg_display_search_author    = isset( $wbgSearchSettings['wbg_display_search_author'] ) ? $wbgSearchSettings['wbg_display_search_author'] : '1';
$wbg_display_search_publisher = isset( $wbgSearchSettings['wbg_display_search_publisher'] ) ? $wbgSearchSettings['wbg_display_search_publisher'] : '1';

// Shortcoded Options
$wbgCategory          = isset( $attr['category'] ) ? $attr['category'] : '';
$wbgDisplay           = isset( $attr['display'] ) ? $attr['display'] : '';
$wbgPagination        = isset( $attr['pagination'] ) ? $attr['pagination'] : false;
$wbgPaged             = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

// Main Query
$wbgBooksArr = array(
  'post_type'   => 'books',
  'post_status' => 'publish',
  'order'       => 'ASC',
  'orderby'     => $wbg_gallary_sorting,
  //'meta_key'    => $wbg_gallary_sorting,
  'meta_query'  => array(
                          array(
                            'key'     => 'wbg_status',
                            'value'   => 'active',
                            'compare' => '='
                          ),
                    ),
);

// If display params found in shortcode
if( $wbgDisplay != '' ) {
  $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}

// If Pagination found in shortcode
if( $wbgPagination == 'true' ) {
  $wbgBooksArr['paged'] = $wbgPaged;
}

// Sorting Operation
if( ( 'title' !== $wbg_gallary_sorting ) && ( 'date' !== $wbg_gallary_sorting ) ) {
  $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}

// If Categor params found in shortcode
if( $wbgCategory != '' ) {
  $wbgBooksArr['tax_query'] = array(
    array(
      'taxonomy' => 'book_category',
      'field' => 'name',
      'terms' => $wbgCategory
    )
  );
}

// Search Query
$wbg_title_s = ( isset( $_POST['wbg_title_s'] ) && ( sanitize_text_field( $_POST['wbg_title_s'] ) != '' ) ) ? sanitize_text_field( $_POST['wbg_title_s'] ) : '';
if( '' != $wbg_title_s ) {
  $wbgBooksArr['s'] = $wbg_title_s;
}

$wbg_book_category = ( isset( $_POST['wbg_category_s'] ) && filter_var( $_POST['wbg_category_s'], FILTER_SANITIZE_STRING ) ) ? $_POST['wbg_category_s'] : '';
if( '' != $wbg_book_category ) {
  $wbgBooksArr['tax_query'] = array(
                                      array(
                                        'taxonomy' => 'book_category',
                                        'field' => 'name',
                                        'terms' => $wbg_book_category
                                      )
                              );
}

$wbg_author_s = ( isset( $_POST['wbg_author_s'] ) && filter_var( $_POST['wbg_author_s'], FILTER_SANITIZE_STRING ) ) ? $_POST['wbg_author_s'] : '';
if( '' != $wbg_author_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_author',
                                        'value'   => $wbg_author_s,
                                        'compare' => '='
                                      )
                                  );
}

$wbg_publisher_s = ( isset( $_POST['wbg_publisher_s'] ) && filter_var( $_POST['wbg_publisher_s'], FILTER_SANITIZE_STRING ) ) ? $_POST['wbg_publisher_s'] : '';
if( '' != $wbg_publisher_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_publisher',
                                        'value'   => $wbg_publisher_s,
                                        'compare' => '='
                                      )
                                  );
}

/*
* Search Operation
*/
if( '1' === $wbg_display_search_panel ) {
  $wbg_book_categories  = get_terms( array( 'taxonomy' => 'book_category', 'hide_empty' => true, ) );
  if( isset( $_POST['wbg_category_s'] ) && ( '' !== $_POST['wbg_category_s'] ) ) {
    $wbg_authors_by_cat = "SELECT DISTINCT pm.meta_value
                          FROM $wpdb->posts p
                          LEFT JOIN $wpdb->term_relationships rel ON rel.object_id = p.ID
                          LEFT JOIN $wpdb->term_taxonomy tax ON tax.term_taxonomy_id = rel.term_taxonomy_id
                          LEFT JOIN $wpdb->terms t ON t.term_id = tax.term_id
                          LEFT JOIN $wpdb->postmeta pm ON pm.post_id = p.ID
                          WHERE post_status = 'publish'
                          AND post_type = 'books'
                          AND t.name = '". $_POST['wbg_category_s'] . "'
                          AND tax.taxonomy = 'book_category'
                          AND pm.meta_key = 'wbg_author'";
    $wbg_authors  = $wpdb->get_results( $wbg_authors_by_cat, ARRAY_A );
  } else {
    $wbg_authors  = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_author' and p.post_type = 'books'", ARRAY_A );
  }
  // echo '<pre>';
  // print_r( $wbg_authors );
  ?>
  <form action="" method="POST" id="wbg-search-form">
  <?php if(function_exists('wp_nonce_field')) { wp_nonce_field('wbg_nonce_field'); } ?>
    <div class="wrap wbg-search-container">
      <?php
      if( '1' === $wbg_display_search_title ) {
        ?>
        <div class="wbg-search-item">
          <input type="text" name="wbg_title_s" placeholder="<?php esc_attr_e('Book Name', WBG_TXT_DOMAIN); ?>" value="<?php echo esc_attr( $wbg_title_s ); ?>">
        </div>
        <?php
      }
      
      if( '1' === $wbg_display_search_category ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_category_s" name="wbg_category_s">
              <option value=""><?php esc_html_e('All Category', WBG_TXT_DOMAIN); ?></option>
              <?php
              foreach( $wbg_book_categories as $book_category) { ?>
                <option value="<?php echo esc_attr( $book_category->name ); ?>" <?php echo ( $wbg_book_category == $book_category->name ) ? "Selected" : "" ; ?> ><?php echo esc_html( $book_category->name ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php
      }

      if( '1' === $wbg_display_search_author ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_author_s" name="wbg_author_s">
              <option value=""><?php esc_html_e('All Author', WBG_TXT_DOMAIN); ?></option>
              <?php
              foreach( $wbg_authors as $author ) { ?>
                <option value="<?php echo esc_attr( $author['meta_value'] ); ?>" <?php echo ( $wbg_author_s == $author['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $author['meta_value'] ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php
      }

      if( '1' === $wbg_display_search_publisher ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_publisher_s" name="wbg_publisher_s">
              <option value=""><?php esc_html_e('All Publisher', WBG_TXT_DOMAIN); ?></option>
              <?php
              $wbg_publishers = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_publisher' and p.post_type = 'books'", ARRAY_A );
              foreach( $wbg_publishers as $publisher ) { ?>
                <option value="<?php echo esc_attr( $publisher['meta_value'] ); ?>" <?php echo ( $wbg_publisher_s == $publisher['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $publisher['meta_value'] ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php
      }
      ?>

      <div class="wbg-search-item">
        <input type="submit" name="submit" class="button submit-btn" value="<?php esc_attr_e('Seach Books', WBG_TXT_DOMAIN); ?>" />
      </div>

    </div>
  </form>
  <?php
}

wp_reset_query();
$wbgBooks = new WP_Query( $wbgBooksArr );
?>

<div class="wbg-main-wrapper <?php echo esc_attr('wbg-product-column-' . $wbgGalleryColumn); ?>">
    <?php 
    while( $wbgBooks->have_posts() ) :
      $wbgBooks->the_post();
      global $post; 
      ?>
      <div class="wbg-item">
        <a href="<?php echo get_the_permalink( $post->ID ); ?>" <?php printf( '%s', $wbgDetailsExternal ); ?>>
          <?php
            if( has_post_thumbnail() ) {
              the_post_thumbnail();
            } else { ?>
              <img src="<?php echo esc_attr( WBG_ASSETS . 'img/noimage.jpg' ); ?>" alt="No Image Available">
            <?php
            }
          ?>
          <?php echo wp_trim_words( get_the_title(), $wbgTitleLength, '...' ); ?>
        </a>
        <?php if( '1' === $wbg_display_description ) { ?>
          <div class="wbg-description-content">
            <?php echo wp_trim_words( get_the_content(), $wbg_description_length, '...' ); ?>
        </div>
        <?php } ?>
        <?php if( '1' === $wbg_display_category ) { ?>
          <span>
              <?php echo esc_html( $wbgCatLbl ); ?>
              <?php
                $wbgCategory = wp_get_post_terms($post->ID, 'book_category', array('fields' => 'all'));
                echo $wbgCategory[0]->name;
              ?>
          </span>
        <?php } ?>
        <?php if( '1' === $wbg_display_author ) { ?>
          <span>
              <?php echo esc_html( $wbgAuthorLbl ); ?>
              <?php
              $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
              echo (!empty($wbgAuthor)) ? $wbgAuthor : '';
              ?>
          </span>
        <?php } ?>
        <?php if( '1' === $wbg_display_buynow ) { ?>
          <?php
            $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
            if ( ! empty( $wbgLink ) ) {
              ?>
              <a href="<?php echo esc_url( $wbgLink ); ?>" class="button wbg-btn"><?php echo esc_html( $wbg_buynow_btn_txt ); ?></a>
              <?php
            }
          ?>
        <?php } ?>
      </div>
    <?php endwhile; ?>
</div>
<?php 
if( $wbgPagination == 'true' ) { 
  ?>
  <div class="wbg-pagination">
      <?php
      $wbgTotalPages = $wbgBooks->max_num_pages;

      if ($wbgTotalPages > 1) {

        $wbgCurrentPage = max(1, get_query_var('paged'));

        echo paginate_links(array(
          'base'      => get_pagenum_link(1) . '%_%',
          'format'    => '/page/%#%',
          'current'   => $wbgCurrentPage,
          'total'     => $wbgTotalPages,
          'prev_text' => __('« '),
          'next_text' => __(' »'),
        ));
      }
      wp_reset_postdata();
      ?>
  </div>
  <?php 
} 
?>