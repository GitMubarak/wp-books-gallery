<?php
global $wpdb;

$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbg_gallary_sorting        = isset( $wbgGeneralSettings['wbg_gallary_sorting'] ) ? $wbgGeneralSettings['wbg_gallary_sorting'] : 'name';

$wbgCategory =  isset($attr['category']) ? $attr['category'] : '';
$wbgDisplay = isset($attr['display']) ? $attr['display'] : '';
$wbgPagination = isset($attr['pagination']) ? $attr['pagination'] : false;
$wbgPaged = (get_query_var('paged')) ? get_query_var('paged') : 1;

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

if ($wbgDisplay != '') {
  $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}

if( ( 'title' !== $wbg_gallary_sorting ) && ( 'date' !== $wbg_gallary_sorting ) ) {
  $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}

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


if( $wbgPagination == 'true' ) {
  $wbgBooksArr['paged'] = $wbgPaged;
}
//echo '<pre>';
//print_r($wbgBooksArr);
wp_reset_query();
$wbgBooks = new WP_Query($wbgBooksArr);

$wbgGalleryColumn           = ( $wbgGeneralSettings['wbg_gallary_column'] != '' ) ? $wbgGeneralSettings['wbg_gallary_column'] : 4;
$wbgTitleLength             = ( $wbgGeneralSettings['wbg_title_length'] != '' ) ? $wbgGeneralSettings['wbg_title_length'] : 4;
$wbgDetailsExternal         = ( $wbgGeneralSettings['wbg_details_is_external'] == 1 ) ? ' target="_blank"' : '';
$wbg_display_category       = isset( $wbgGeneralSettings['wbg_display_category'] ) ? $wbgGeneralSettings['wbg_display_category'] : '1';
$wbgCatLbl                  = ( $wbgGeneralSettings['wbg_cat_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_cat_label_txt'] : '';
$wbg_display_author         = isset( $wbgGeneralSettings['wbg_display_author'] ) ? $wbgGeneralSettings['wbg_display_author'] : '1';
$wbgAuthorLbl               = ( $wbgGeneralSettings['wbg_author_label_txt'] != '' ) ? $wbgGeneralSettings['wbg_author_label_txt'] : '';
$wbg_display_description    = isset( $wbgGeneralSettings['wbg_display_description'] ) ? $wbgGeneralSettings['wbg_display_description'] : '';
$wbg_display_buynow         = isset( $wbgGeneralSettings['wbg_display_buynow'] ) ? $wbgGeneralSettings['wbg_display_buynow'] : '1';
$wbg_buynow_btn_txt         = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : 'Button';
?>

<div class="wrap wbg-search-form-container">
    <form action="" method="POST" id="wbg-search-form">
        <table class="wbg-search-form-table"> 
            <?php if(function_exists('wp_nonce_field')) { wp_nonce_field('wbg_nonce_field'); } ?>
            <tbody>
              <tr>
                <td>
                    <input type="text" name="wbg_title_s" placeholder="Book Name" value="<?php echo esc_attr( $wbg_title_s ); ?>">
                </td>
                <td>
                    <select id="wbg_category_s" name="wbg_category_s">
                        <option value="">All Category</option>
                        <?php
                        $wbg_book_categories = get_terms( array( 'taxonomy' => 'book_category', 'hide_empty' => true, ) );
                        foreach( $wbg_book_categories as $book_category) { ?>
                          <option value="<?php echo esc_attr( $book_category->name ); ?>" <?php echo ( $wbg_book_category == $book_category->name ) ? "Selected" : "" ; ?> ><?php echo esc_html( $book_category->name ); ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select id="wbg_author_s" name="wbg_author_s">
                        <option value="">All Author</option>
                        <?php
                        $wbg_authors = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_author' and p.post_type = 'books'", ARRAY_A );
                        foreach( $wbg_authors as $author ) { ?>
                          <option value="<?php echo esc_attr( $author['meta_value'] ); ?>" <?php echo ( $wbg_author_s == $author['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $author['meta_value'] ); ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select id="wbg_publisher_s" name="wbg_publisher_s">
                        <option value="">All Publisher</option>
                        <?php
                        $wbg_publishers = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_publisher' and p.post_type = 'books'", ARRAY_A );
                        foreach( $wbg_publishers as $publisher ) { ?>
                          <option value="<?php echo esc_attr( $publisher['meta_value'] ); ?>" <?php echo ( $wbg_publisher_s == $publisher['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $publisher['meta_value'] ); ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                  <input type="submit" name="submit" class="button submit-btn" value="Seach Books" />
                </td>
              </tr>
            </tbody>
        </table>
    </form>
</div>

<div class="wbg-main-wrapper <?php echo esc_attr('wbg-product-column-' . $wbgGalleryColumn); ?>">
    <?php 
    while ($wbgBooks->have_posts()) : $wbgBooks->the_post();
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
            <?php echo wp_trim_words( get_the_content(), 20, '...' ); ?>
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
                $wbgLink2 = $wbgLink;
            } else {
                $wbgLink2 = "#";
            }
          ?>
          <a href="<?php echo esc_url( $wbgLink2 ); ?>" class="button wbg-btn"><?php echo esc_html( $wbg_buynow_btn_txt ); ?></a>
        <?php } ?>
      </div>
    <?php endwhile; ?>
</div>
<?php if($wbgPagination == 'true') { ?>
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
<?php } ?>