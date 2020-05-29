<?php
$wbgCategory =  isset($attr['category']) ? $attr['category'] : '';
$wbgDisplay = isset($attr['display']) ? $attr['display'] : '';
$wbgPagination = isset($attr['pagination']) ? $attr['pagination'] : false;
$wbgPaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wbgBooksArr = array(
  'post_type' => 'books',
  'post_status' => 'publish',
  'order' => 'DESC',
  'meta_query' => array(
    array(
      'key' => 'wbg_status',
      'value' => 'active',
      'compare' => '='
    )
  ),
);
if ($wbgDisplay != '') {
  $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}
if ($wbgCategory != '') {
  $wbgBooksArr['tax_query'] = array(
    array(
      'taxonomy' => 'book_category',
      'field' => 'name',
      'terms' => $wbgCategory
    )
  );
}
if ($wbgPagination == 'true') {
  $wbgBooksArr['paged'] = $wbgPaged;
}
wp_reset_query();
$wbgBooks = new WP_Query($wbgBooksArr);

$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
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
              <img src="img_snow.jpg" alt="Snow">
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
<?php if ($wbgPagination == 'true') { ?>
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