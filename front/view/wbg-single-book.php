<?php 
/**
 * Template Name: WBG Books Details
 *
 */

get_header(); ?>

<?php
$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbg_buynow_btn_txt         = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : 'Download';

$wbgDetailSettings          = stripslashes_deep( unserialize( get_option('wbg_detail_settings') ) );
$wbgAuthorInfo              = isset( $wbgDetailSettings['wbg_author_info'] ) ? $wbgDetailSettings['wbg_author_info'] : 1;
$wbgAuthorLabel             = ($wbgDetailSettings['wbg_author_label'] != '') ? $wbgDetailSettings['wbg_author_label'] : 'Author';
$wbgDisplayCategory         = isset($wbgDetailSettings['wbg_display_category']) ? $wbgDetailSettings['wbg_display_category'] : 1;
$wbgCategoryLabel           = ($wbgDetailSettings['wbg_category_label'] != '') ? $wbgDetailSettings['wbg_category_label'] : 'Category';
$wbgDisplayPublisher        = isset($wbgDetailSettings['wbg_display_publisher']) ? $wbgDetailSettings['wbg_display_publisher'] : 1;
$wbgPublisherLabel          = ($wbgDetailSettings['wbg_publisher_label'] != '') ? $wbgDetailSettings['wbg_publisher_label'] : 'Publisher';
$wbg_display_publish_date   = isset($wbgDetailSettings['wbg_display_publish_date']) ? $wbgDetailSettings['wbg_display_publish_date'] : 1;
$wbg_publish_date_label     = ($wbgDetailSettings['wbg_publish_date_label'] != '') ? $wbgDetailSettings['wbg_publish_date_label'] : 'Publish';
$wbg_publish_date_format    = isset( $wbgDetailSettings['wbg_publish_date_format'] ) ? $wbgDetailSettings['wbg_publish_date_format'] : 'full';
$wbg_display_isbn           = isset( $wbgDetailSettings['wbg_display_isbn'] ) ? $wbgDetailSettings['wbg_display_isbn'] : '1';
$wbg_isbn_label             = isset( $wbgDetailSettings['wbg_isbn_label'] ) ? $wbgDetailSettings['wbg_isbn_label'] : 'ISBN';
$wbg_display_page           = isset( $wbgDetailSettings['wbg_display_page'] ) ? $wbgDetailSettings['wbg_display_page'] : '1';
$wbg_page_label             = isset( $wbgDetailSettings['wbg_page_label'] ) ? $wbgDetailSettings['wbg_page_label'] : 'Pages';
$wbg_display_country        = isset( $wbgDetailSettings['wbg_display_country'] ) ? $wbgDetailSettings['wbg_display_country'] : '1';
$wbg_country_label          = isset( $wbgDetailSettings['wbg_country_label'] ) ? $wbgDetailSettings['wbg_country_label'] : 'Country';
$wbg_display_language       = isset( $wbgDetailSettings['wbg_display_language'] ) ? $wbgDetailSettings['wbg_display_language'] : '1';
$wbg_language_label         = isset( $wbgDetailSettings['wbg_language_label'] ) ? $wbgDetailSettings['wbg_language_label'] : 'Language';
$wbg_display_dimension      = isset( $wbgDetailSettings['wbg_display_dimension'] ) ? $wbgDetailSettings['wbg_display_dimension'] : '1';
$wbg_dimension_label        = isset( $wbgDetailSettings['wbg_dimension_label'] ) ? $wbgDetailSettings['wbg_dimension_label'] : 'Dimension';
$wbg_display_filesize       = isset( $wbgDetailSettings['wbg_display_filesize'] ) ? $wbgDetailSettings['wbg_display_filesize'] : '1';
$wbg_filesize_label         = isset( $wbgDetailSettings['wbg_filesize_label'] ) ? $wbgDetailSettings['wbg_filesize_label'] : 'File Size';
$wbg_display_download_button    = isset( $wbgDetailSettings['wbg_display_download_button'] ) ? $wbgDetailSettings['wbg_display_download_button'] : '1';
$wbg_display_description    = isset( $wbgDetailSettings['wbg_display_description'] ) ? $wbgDetailSettings['wbg_display_description'] : '1';
$wbg_description_label      = isset( $wbgDetailSettings['wbg_description_label'] ) ? $wbgDetailSettings['wbg_description_label'] : 'Description';
?>

<div class="wbg-details-wrapper">
    <?php 
    if ( have_posts() ) {
        while (have_posts()) { the_post(); ?>

        <div class="wbg-details-image">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('full');
            } else {
            ?>
                <img src="<?php echo esc_attr( WBG_ASSETS . 'img/noimage.jpg' ); ?>" alt="No Image Available">
            <?php } ?>
        </div>
        <div class="wbg-details-summary">
            <h5 class="wbg-details-book-title"><?php the_title(); ?></h5>
            <?php 
            if( 1 == $wbgAuthorInfo ) { 
                ?>
                <span>
                    <b><?php echo esc_html( $wbgAuthorLabel ); ?>:</b>
                    <?php
                    $wbgAuthor = get_post_meta($post->ID, 'wbg_author', true);
                    if (!empty($wbgAuthor)) {
                        echo $wbgAuthor;
                    }
                    ?>
                </span>
                <?php 
            } 
            
            if( 1 == $wbgDisplayCategory ) { 
                ?>
                <span>
                    <b><?php echo esc_html( $wbgCategoryLabel ); ?>:</b>
                    <?php
                    $wbgCatArray = array();
                    $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array('fields' => 'all') );
                    foreach( $wbgCategory as $cat) {
                        $wbgCatArray[] = $cat->name . '';
                    }
                    echo implode( ', ', $wbgCatArray );
                    ?>
                </span>
                <?php 
            } ?>
            <?php if (1 == $wbgDisplayPublisher) { ?>
            <span>
                <b><?php echo esc_html($wbgPublisherLabel); ?>:</b>
                <?php
                            $wbgPublisher = get_post_meta($post->ID, 'wbg_publisher', true);
                            if (!empty($wbgPublisher)) {
                                echo $wbgPublisher;
                            }
                            ?>
            </span>
            <?php } ?>
            <?php if ( 1 == intval( $wbg_display_publish_date ) ) { ?>
            <span>
                <b><?php echo esc_html($wbg_publish_date_label); ?>:</b>
                <?php
                    $wbgPublished = get_post_meta($post->ID, 'wbg_published_on', true);
                    if( ! empty( $wbgPublished ) ) {
                        if( 'full' === $wbg_publish_date_format ) {
                            echo date('d M, Y', strtotime( $wbgPublished ) );
                        } else {
                            echo date('Y', strtotime( $wbgPublished ) );
                        }
                    }
                ?>
            </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_isbn ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_isbn_label ); ?>:</b>
                    <?php
                            $wbgIsbn = get_post_meta($post->ID, 'wbg_isbn', true);
                            if (!empty($wbgIsbn)) {
                                echo $wbgIsbn;
                            }
                            ?>
                </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_page ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_page_label ); ?>:</b>
                    <?php
                            $wbgPages = get_post_meta($post->ID, 'wbg_pages', true);
                            if ( ! empty( $wbgPages ) ) {
                                //echo $wbgPages . ' Pages';
                                printf( esc_html__( '%d Pages', WBG_TXT_DOMAIN ), $wbgPages );
                            }
                            ?>
                </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_country ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_country_label ); ?>:</b>
                    <?php
                            $wbgCountry = get_post_meta($post->ID, 'wbg_country', true);
                            if (!empty($wbgCountry)) {
                                echo $wbgCountry;
                            }
                            ?>
                </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_language ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_language_label ); ?>:</b>
                    <?php
                            $wbgLanguage = get_post_meta($post->ID, 'wbg_language', true);
                            if (!empty($wbgLanguage)) {
                                echo $wbgLanguage;
                            }
                            ?>
                </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_dimension ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_dimension_label ); ?>:</b>
                    <?php
                            $wbgDimension = get_post_meta($post->ID, 'wbg_dimension', true);
                            if (!empty($wbgDimension)) {
                                echo $wbgDimension;
                            }
                            ?>
                </span>
            <?php } ?>
            <?php if ( '1' == $wbg_display_filesize ) { ?>
                <span>
                    <b><?php echo esc_html( $wbg_filesize_label ); ?>:</b>
                    <?php
                        $wbgFilesize = get_post_meta($post->ID, 'wbg_filesize', true);
                        if ( ! empty( $wbgFilesize ) ) {
                            echo $wbgFilesize;
                        }
                    ?>
                </span>
            <?php } ?>
            <?php
            $wbgPostTags = get_the_tags();
            $wbgTagsSeparator = ' | ';
            $wgbOutput = '';
            if ( ! empty( $wbgPostTags ) ) {
                $wgbOutput .= '<span><b>Tags:</b>';
                foreach ( $wbgPostTags as $tag ) {
                    $wgbOutput .= '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>' . $wbgTagsSeparator;
                }
                $wgbOutput .= '</span>';
                echo trim( $wgbOutput, $wbgTagsSeparator );
            }
            ?>
            <?php 
            if ( '1' == $wbg_display_download_button ) { ?>
                <?php
                $wbgLink = get_post_meta($post->ID, 'wbg_download_link', true);
                if ( $wbgLink !== '' ) {
                    if ( $wbg_buynow_btn_txt !== '' ) {
                    ?>
                    <span>
                        <a href="<?php echo esc_url( $wbgLink ); ?>" target="blank" class="button wbg-btn"><?php echo esc_html( $wbg_buynow_btn_txt ); ?></a>
                    </span>
                    <?php
                    }
                } 
            }
            ?>
        </div>
        
        <div class="wbg-details-description">
            <?php if ( '1' == $wbg_display_description ) { ?>
                <?php if( ! empty( get_the_content() ) ) { ?>
                    <div class="wbg-details-description-title">
                        <b><?php echo esc_html( $wbg_description_label ); ?>:</b>
                        <hr>
                    </div>
                    <div class="wbg-details-description-content">
                        <?php the_content(); ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php 
        }
    } 
    ?>

</div>

<?php get_footer(); ?>