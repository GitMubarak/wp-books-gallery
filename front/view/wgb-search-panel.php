<?php
$wbg_book_categories  = get_terms( array( 'taxonomy' => 'book_category', 'hide_empty' => true, 'order' => $wbg_display_category_order ) );
if ( '' !== $wbg_category_s ) {
  $wbg_authors_by_cat = "SELECT DISTINCT pm.meta_value
                        FROM $wpdb->posts p
                        LEFT JOIN $wpdb->term_relationships rel ON rel.object_id = p.ID
                        LEFT JOIN $wpdb->term_taxonomy tax ON tax.term_taxonomy_id = rel.term_taxonomy_id
                        LEFT JOIN $wpdb->terms t ON t.term_id = tax.term_id
                        LEFT JOIN $wpdb->postmeta pm ON pm.post_id = p.ID
                        WHERE post_status = 'publish'
                        AND post_type = 'books'
                        AND t.name = '". $wbg_category_s. "'
                        AND tax.taxonomy = 'book_category'
                        AND pm.meta_key = 'wbg_author'
                        ORDER BY pm.meta_value {$wbg_display_author_order}";
  $wbg_authors  = $wpdb->get_results( $wbg_authors_by_cat, ARRAY_A );
} else {
  $wbg_authors  = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_author' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_author_order}", ARRAY_A );
}
?>
<form method="GET" action="<?php echo get_permalink($post->ID); ?>" id="wbg-search-form">
  <?php //if(function_exists('wp_nonce_field')) { wp_nonce_field('wbg_nonce_field'); } ?>
  <div class="wrap wbg-search-container">
    <?php
    if( '1' === $wbg_display_search_title ) {
      ?>
      <div class="wbg-search-item">
        <input type="text" name="wbg_title_s" placeholder="<?php esc_attr_e('Book Name', WBG_TXT_DOMAIN); ?>" value="<?php echo esc_attr( $wbg_title_s ); ?>">
      </div>
      <?php
    }

    // Year Started
    if ( $wbg_display_search_year ) {
        ?>
        <div class="wbg-search-item">
            <select id="wbg_published_on_s" name="wbg_published_on_s">
                <option value=""><?php esc_html_e('All Years', WBG_TXT_DOMAIN); ?></option>
                <?php
                $wbg_years = $wpdb->get_results( "SELECT DISTINCT YEAR(meta_value) year FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_published_on' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_year_order}", ARRAY_A );
                foreach( $wbg_years as $year ) { ?>
                    <option value="<?php echo esc_attr( $year['year'] ); ?>" <?php echo ( $wbg_published_on_s == $year['year'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $year['year'] ); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php
    }

    // Language Started
    if ( $wbg_display_search_language ) {
        ?>
        <div class="wbg-search-item">
            <select id="wbg_language_s" name="wbg_language_s">
                <option value=""><?php esc_html_e('All Languages', WBG_TXT_DOMAIN); ?></option>
                <?php
                $wbg_languages = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_language' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_language_order}", ARRAY_A );
                foreach( $wbg_languages as $lang ) { ?>
                    <option value="<?php echo esc_attr( $lang['meta_value'] ); ?>" <?php echo ( $wbg_language_s == $lang['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $lang['meta_value'] ); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php
    }
    // Categories Started
    if( '1' === $wbg_display_search_category ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_category_s" name="wbg_category_s">
              <option value=""><?php esc_html_e('All Categories', WBG_TXT_DOMAIN); ?></option>
              <?php
              foreach( $wbg_book_categories as $book_category) { ?>
                <option value="<?php echo esc_attr( $book_category->name ); ?>" <?php echo ( $wbg_category_s == $book_category->name ) ? "Selected" : "" ; ?> ><?php echo esc_html( $book_category->name ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php
    }

    // Authors Started
    if( '1' === $wbg_display_search_author ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_author_s" name="wbg_author_s">
              <option value=""><?php esc_html_e('All Authors', WBG_TXT_DOMAIN); ?></option>
              <?php
              foreach( $wbg_authors as $author ) { ?>
                <option value="<?php echo esc_attr( $author['meta_value'] ); ?>" <?php echo ( $wbg_author_s == $author['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $author['meta_value'] ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php  
    }

    // Publishers Started
    if( '1' === $wbg_display_search_publisher ) {
        ?>
        <div class="wbg-search-item">
          <select id="wbg_publisher_s" name="wbg_publisher_s">
              <option value=""><?php esc_html_e('All Publishers', WBG_TXT_DOMAIN); ?></option>
              <?php
              $wbg_publishers = $wpdb->get_results( "SELECT DISTINCT meta_value FROM $wpdb->postmeta pm, $wpdb->posts p WHERE meta_key = 'wbg_publisher' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_publisher_order}", ARRAY_A );
              foreach( $wbg_publishers as $publisher ) { ?>
                <option value="<?php echo esc_attr( $publisher['meta_value'] ); ?>" <?php echo ( $wbg_publisher_s == $publisher['meta_value'] ) ? "Selected" : "" ; ?> ><?php echo esc_html( $publisher['meta_value'] ); ?></option>
              <?php } ?>
          </select>
        </div>
        <?php
    }
    
    // ISBN Started
    if( $wbg_display_search_isbn ) {
      ?>
      <div class="wbg-search-item">
          <input type="text" name="wbg_isbn_s" placeholder="<?php esc_attr_e('ISBN', WBG_TXT_DOMAIN); ?>" value="<?php echo esc_attr( $wbg_isbn_s ); ?>">
      </div>
      <?php
    }
    ?>
    <div class="wbg-search-item">
        <input type="submit" class="button submit-btn" value="<?php echo esc_attr( $wbg_search_btn_txt ); ?>">
    </div>

  </div>
</form>