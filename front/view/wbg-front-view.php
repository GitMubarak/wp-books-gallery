<?php
global $wpdb, $post;

// Gallery Settings Content
$wbgGeneralSettings           = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbgGalleryColumn             = ( $wbgGeneralSettings['wbg_gallary_column'] != '' ) ? $wbgGeneralSettings['wbg_gallary_column'] : 3;
$wbg_book_cover_width         = isset( $wbgGeneralSettings['wbg_book_cover_width'] ) ? $wbgGeneralSettings['wbg_book_cover_width'] : 'default';
$wbg_gallary_column_mobile    = isset( $wbgGeneralSettings['wbg_gallary_column_mobile'] ) ? $wbgGeneralSettings['wbg_gallary_column_mobile'] : 1;
$wbg_gallary_sorting          = isset( $wbgGeneralSettings['wbg_gallary_sorting'] ) ? $wbgGeneralSettings['wbg_gallary_sorting'] : 'title';
$wbgTitleLength               = ( $wbgGeneralSettings['wbg_title_length'] != '' ) ? $wbgGeneralSettings['wbg_title_length'] : 4;
$wbgDetailsExternal           = ( $wbgGeneralSettings['wbg_details_is_external'] == 1 ) ? ' target="_blank"' : '';
$wbg_display_details_page     = isset( $wbgGeneralSettings['wbg_display_details_page'] ) ? $wbgGeneralSettings['wbg_display_details_page'] : '1';
$wbg_display_category         = isset( $wbgGeneralSettings['wbg_display_category'] ) ? $wbgGeneralSettings['wbg_display_category'] : '1';
$wbgCatLbl                    = ( $wbgGeneralSettings['wbg_cat_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_cat_label_txt'] : '';
$wbg_display_author           = isset( $wbgGeneralSettings['wbg_display_author'] ) ? $wbgGeneralSettings['wbg_display_author'] : '1';
$wbgAuthorLbl                 = ( $wbgGeneralSettings['wbg_author_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_author_label_txt'] : '';
$wbg_display_description      = isset( $wbgGeneralSettings['wbg_display_description'] ) ? $wbgGeneralSettings['wbg_display_description'] : '1';
$wbg_description_length       = isset( $wbgGeneralSettings['wbg_description_length'] ) ? $wbgGeneralSettings['wbg_description_length'] : 20;
$wbg_display_buynow           = isset( $wbgGeneralSettings['wbg_display_buynow'] ) ? $wbgGeneralSettings['wbg_display_buynow'] : '1';
$wbg_buynow_btn_txt           = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : 'Button';
$wbg_books_order              = isset( $wbgGeneralSettings['wbg_books_order'] ) ? $wbgGeneralSettings['wbg_books_order'] : 'ASC';

// Gallery Settings Styling
$wbgGeneralStyling            = stripslashes_deep( unserialize( get_option('wbg_general_styles') ) );
$wbg_download_btn_color       = isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be';
$wbg_download_btn_font_color    = isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF';

// Search Panel Settings
$wbgSearchSettings            = stripslashes_deep( unserialize( get_option('wbg_search_settings') ) );
$wbg_display_search_panel     = isset( $wbgSearchSettings['wbg_display_search_panel'] ) ? $wbgSearchSettings['wbg_display_search_panel'] : '1';
$wbg_display_search_title     = isset( $wbgSearchSettings['wbg_display_search_title'] ) ? $wbgSearchSettings['wbg_display_search_title'] : '1';
$wbg_display_search_category  = isset( $wbgSearchSettings['wbg_display_search_category'] ) ? $wbgSearchSettings['wbg_display_search_category'] : '1';
$wbg_display_search_author    = isset( $wbgSearchSettings['wbg_display_search_author'] ) ? $wbgSearchSettings['wbg_display_search_author'] : '1';
$wbg_display_search_publisher = isset( $wbgSearchSettings['wbg_display_search_publisher'] ) ? $wbgSearchSettings['wbg_display_search_publisher'] : '1';
$wbg_search_btn_txt           = isset( $wbgSearchSettings['wbg_search_btn_txt'] ) ? $wbgSearchSettings['wbg_search_btn_txt'] : 'Search Books';
$wbg_display_category_order   = isset( $wbgSearchSettings['wbg_display_category_order'] ) ? $wbgSearchSettings['wbg_display_category_order'] : 'asc';
$wbg_display_author_order     = isset( $wbgSearchSettings['wbg_display_author_order'] ) ? $wbgSearchSettings['wbg_display_author_order'] : 'asc';
$wbg_display_publisher_order  = isset( $wbgSearchSettings['wbg_display_publisher_order'] ) ? $wbgSearchSettings['wbg_display_publisher_order'] : 'asc';
$wbg_display_search_year      = isset( $wbgSearchSettings['wbg_display_search_year'] ) ? $wbgSearchSettings['wbg_display_search_year'] : '1';
$wbg_display_year_order       = isset( $wbgSearchSettings['wbg_display_year_order'] ) ? $wbgSearchSettings['wbg_display_year_order'] : 'asc';
$wbg_display_search_language  = isset( $wbgSearchSettings['wbg_display_search_language'] ) ? $wbgSearchSettings['wbg_display_search_language'] : 1;
$wbg_display_language_order   = isset( $wbgSearchSettings['wbg_display_language_order'] ) ? $wbgSearchSettings['wbg_display_language_order'] : 'asc';
$wbg_display_search_isbn      = isset( $wbgSearchSettings['wbg_display_search_isbn'] ) ? $wbgSearchSettings['wbg_display_search_isbn'] : 1;

// Search Panel Settings Styles
$wbgSearchStyles              = stripslashes_deep( unserialize( get_option('wbg_search_styles') ) );
$wbg_btn_color                = isset( $wbgSearchStyles['wbg_btn_color'] ) ? $wbgSearchStyles['wbg_btn_color'] : '#0274be';
$wbg_btn_border_color         = isset( $wbgSearchStyles['wbg_btn_border_color'] ) ? $wbgSearchStyles['wbg_btn_border_color'] : '#317081';
$wbg_btn_font_color           = isset( $wbgSearchStyles['wbg_btn_font_color'] ) ? $wbgSearchStyles['wbg_btn_font_color'] : '#FFFFFF';
?>

<style type="text/css">
  .wbg-search-container .wbg-search-item .submit-btn {
    background: <?php echo esc_html( $wbg_btn_color ); ?>;
    box-shadow: 0 3px 0px 0.5px <?php echo esc_html( $wbg_btn_border_color ); ?>;
    color: <?php echo esc_html( $wbg_btn_font_color ); ?>;
  }
  .wbg-main-wrapper .wbg-item img {
    width: <?php echo ( 'full' === $wbg_book_cover_width ) ? '100%' : 'auto'; ?> !important;
    height: <?php echo ( 'full' === $wbg_book_cover_width ) ? 'auto' : '150px'; ?> !important;
  }
  .wbg-main-wrapper .wbg-item a.wbg-btn {
    background: <?php esc_html_e( $wbg_download_btn_color ); ?> !important;
    color: <?php esc_html_e( $wbg_download_btn_font_color ); ?> !important;
  }
</style>

<?php
// Shortcoded Options
$wbgCategory        = isset( $attr['category'] ) ? $attr['category'] : '';
$wbgDisplay         = isset( $attr['display'] ) ? $attr['display'] : '';
$wbgPagination      = isset( $attr['pagination'] ) ? $attr['pagination'] : false;

// Search Items
$wbgPaged           = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$wbg_title_s        =  get_query_var('wbg_title_s', '');
$wbg_category_s     =  get_query_var('wbg_category_s', '');
$wbg_author_s       =  get_query_var('wbg_author_s', '');
$wbg_publisher_s    =  get_query_var('wbg_publisher_s', '');
$wbg_published_on_s =  get_query_var('wbg_published_on_s', '');
$wbg_language_s     =  get_query_var('wbg_language_s', '');
$wbg_isbn_s         =  get_query_var('wbg_isbn_s', '');

// Main Query Arguments
$wbgBooksArr = array(
  'post_type'   => 'books',
  'post_status' => 'publish',
  'order'       => $wbg_books_order,
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

// If Category params found in shortcode
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
if ( '' != $wbg_title_s ) {
  $wbgBooksArr['s'] = $wbg_title_s;
}

if( '' !== $wbg_category_s ) {
  $wbgBooksArr['tax_query'] = array(
                                      array(
                                        'taxonomy' => 'book_category',
                                        'field' => 'name',
                                        'terms' => $wbg_category_s
                                      )
                              );
}

if( '' != $wbg_author_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_author',
                                        'value'   => $wbg_author_s,
                                        'compare' => '='
                                      )
                                  );
}

if( '' != $wbg_publisher_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_publisher',
                                        'value'   => $wbg_publisher_s,
                                        'compare' => '='
                                      )
                                  );
}

if( '' != $wbg_isbn_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_isbn',
                                        'value'   => $wbg_isbn_s,
                                        'compare' => '='
                                      )
                                  );
}

if( '' != $wbg_language_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_language',
                                        'value'   => $wbg_language_s,
                                        'compare' => '='
                                      )
                                  );
}

if( '' != $wbg_published_on_s ) {
  $wbgBooksArr['meta_query'] = array(
                                      array(
                                        'key'     => 'wbg_published_on',
                                        'value'   => $wbg_published_on_s,
                                        'compare' => 'LIKE'
                                      )
                                  );
}

/*
* Search Panel Started
*/
if ( '1' === $wbg_display_search_panel ) {
  include WBG_PATH . 'front/view/wgb-search-panel.php';
}

// Perform query and assign it to wp_query
$wbgBooks = new WP_Query( $wbgBooksArr );

if ( $wbgBooks->have_posts() ) { 
  ?>

  <h2 class="wbg-total-books-title"><?php printf('Total <strong>%d</strong> Books Found!', $wbgBooks->found_posts); ?></h2>

  <div class="wbg-main-wrapper <?php echo esc_attr( 'wbg-product-column-' . $wbgGalleryColumn ); ?> <?php echo esc_attr( 'wbg-product-column-mobile-' . $wbg_gallary_column_mobile ); ?>">
      <?php
        while( $wbgBooks->have_posts() ) {
          $wbgBooks->the_post();
          ?>
          <div class="wbg-item">
            <?php
            if ( '1' === $wbg_display_details_page ) {
              $wbgDetailsHref = get_the_permalink( $post->ID );
            } else {
              $wbgDetailsHref = '#';
              $wbgDetailsExternal = '';
            }
            ?>
            <a href="<?php echo esc_url( $wbgDetailsHref ); ?>" <?php printf( '%s', $wbgDetailsExternal ); ?>>
              <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail();
                } else { ?>
                  <img src="<?php echo esc_attr( WBG_ASSETS . 'img/noimage.jpg' ); ?>" alt="No Image Available">
                <?php
                }
              ?>
              <?php echo wp_trim_words( get_the_title(), $wbgTitleLength, '...' ); ?>
            </a>
            <?php if( '1' == $wbg_display_description ) { ?>
              <?php if( ! empty( get_the_content() ) ) { ?>
                <div class="wbg-description-content">
                  <?php echo wp_trim_words( get_the_content(), $wbg_description_length, '...' ); ?>
                </div>
              <?php } ?>
            <?php } ?>
            <?php if( '1' == $wbg_display_category ) { ?>
              <span>
                  <?php echo esc_html( $wbgCatLbl ); ?>
                  <?php
                  $wbgCatArray = array();
                  $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array('fields' => 'all') );
                  foreach( $wbgCategory as $cat) {
                      $wbgCatArray[] = $cat->name . '';
                  }
                  echo implode( ', ', $wbgCatArray );
                  ?>
              </span>
            <?php } ?>
            <?php if( '1' == $wbg_display_author ) { ?>
              <span>
                  <?php echo esc_html( $wbgAuthorLbl ); ?>
                  <?php
                  $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
                  echo (!empty($wbgAuthor)) ? $wbgAuthor : '';
                  ?>
              </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_buynow ) { ?>
              <?php
                $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
                if ( $wbgLink !== '' ) {
                  if ( $wbg_buynow_btn_txt !== '' ) {
                  ?>
                    <a href="<?php echo esc_url( $wbgLink ); ?>" class="button wbg-btn"><?php echo esc_html( $wbg_buynow_btn_txt ); ?></a>
                  <?php
                  }
                }
              ?>
            <?php } ?>
          </div>
          <?php 
        }
      ?>
  </div>
  <?php 
  if( $wbgPagination == 'true' ) { 
    ?>
    <div class="wbg-pagination">
        <?php
        $wbgTotalPages = $wbgBooks->max_num_pages;

        if ( $wbgTotalPages > 1 ) {

          $wbgPaginateBig = 999999999; // need an unlikely integer
          $wbgPaginateArgs = array(
              'base' => str_replace( $wbgPaginateBig, '%#%', esc_url( get_pagenum_link( $wbgPaginateBig ) ) ),
              'format' => '?page=%#%',
              'total' => $wbgTotalPages,
              'current' => max( 1, get_query_var( 'paged') ),
              'end_size' => 1,
              'mid_size' => 2,
              'prev_text' => __('« '),
              'next_text' => __(' »'),
              'type' => 'list',
          );
          echo paginate_links( $wbgPaginateArgs );
        }
        ?>
    </div>
    <?php 
  }
} else {
  ?><p class="wbg-no-books-found"><?php _e('No books found.', WBG_TXT_DOMAIN); ?></p><?php
}

wp_reset_postdata();
?>