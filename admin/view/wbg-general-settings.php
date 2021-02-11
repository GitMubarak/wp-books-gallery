<?php
$wbgShowGeneralMessage = false;
if( isset( $_POST['updateGeneralSettings'] ) ) {
    
    $wbgGeneralSettingsInfo = array(
        'wbg_gallary_column'        => ( isset( $_POST['wbg_gallary_column'] ) && filter_var( $_POST['wbg_gallary_column'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_gallary_column'] : 3,
        'wbg_gallary_column_mobile' => ( isset( $_POST['wbg_gallary_column_mobile'] ) && filter_var( $_POST['wbg_gallary_column_mobile'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_gallary_column_mobile'] : 1,
        'wbg_gallary_sorting'       => ( isset( $_POST['wbg_gallary_sorting'] ) && filter_var( $_POST['wbg_gallary_sorting'], FILTER_SANITIZE_STRING ) ) ? $_POST['wbg_gallary_sorting'] : 'title',
        'wbg_details_is_external'   => ( isset( $_POST['wbg_details_is_external'] ) && filter_var( $_POST['wbg_details_is_external'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_details_is_external'] : '',
        'wbg_title_length'          => ( isset( $_POST['wbg_title_length'] ) && filter_var( $_POST['wbg_title_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_title_length'] : 4,
        'wbg_display_details_page'  => ( isset( $_POST['wbg_display_details_page'] ) && filter_var( $_POST['wbg_display_details_page'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_details_page'] : '',
        'wbg_display_category'      => ( isset( $_POST['wbg_display_category'] ) && filter_var( $_POST['wbg_display_category'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_category'] : '',
        'wbg_cat_label_txt'         => ( sanitize_text_field($_POST['wbg_cat_label_txt']) != '' ) ? sanitize_text_field( $_POST['wbg_cat_label_txt'] ) : '',
        'wbg_display_author'        => ( isset( $_POST['wbg_display_author'] ) && filter_var( $_POST['wbg_display_author'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_author'] : '',
        'wbg_author_label_txt'      => ( sanitize_text_field($_POST['wbg_author_label_txt']) != '' ) ? sanitize_text_field( $_POST['wbg_author_label_txt'] ) : '',
        'wbg_display_description'   => ( isset( $_POST['wbg_display_description'] ) && filter_var( $_POST['wbg_display_description'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_description'] : '',
        'wbg_description_length'    => ( isset( $_POST['wbg_description_length'] ) && filter_var( $_POST['wbg_description_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_description_length'] : 20,
        'wbg_display_buynow'        => ( isset( $_POST['wbg_display_buynow'] ) && filter_var( $_POST['wbg_display_buynow'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_buynow'] : '',
        'wbg_buynow_btn_txt'        => ( sanitize_text_field( $_POST['wbg_buynow_btn_txt'] ) != '' ) ? sanitize_text_field( $_POST['wbg_buynow_btn_txt'] ) : '',
        'wbg_books_order'           => isset( $_POST['wbg_books_order'] ) && filter_var( $_POST['wbg_books_order'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_books_order'] : 'ASC',
        'wbg_book_cover_width'      => isset( $_POST['wbg_book_cover_width'] ) && filter_var( $_POST['wbg_book_cover_width'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_book_cover_width'] : 'default',
        'wbg_display_total_books'   => ( isset( $_POST['wbg_display_total_books'] ) && filter_var( $_POST['wbg_display_total_books'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_total_books'] : '',
    );
    
    $wbgShowGeneralMessage = update_option( 'wbg_general_settings', serialize( $wbgGeneralSettingsInfo ) );
}

if( isset( $_POST['updateGeneralStyles'] ) ) {
    
    $wbgGeneralStylesInfo = array(
        'wbg_download_btn_color'        => isset( $_POST['wbg_download_btn_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_color'] ) : '#0274be',
        'wbg_download_btn_font_color'   => isset( $_POST['wbg_download_btn_font_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_font_color'] ) : '#FFFFFF',
        'wbg_title_color'               => isset( $_POST['wbg_title_color'] ) ? sanitize_text_field( $_POST['wbg_title_color'] ) : '#242424',
        'wbg_title_hover_color'         => isset( $_POST['wbg_title_hover_color'] ) ? sanitize_text_field( $_POST['wbg_title_hover_color'] ) : '#999999',
        'wbg_title_font_size'           => ( isset( $_POST['wbg_title_font_size'] ) && filter_var( $_POST['wbg_title_font_size'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_title_font_size'] : 12,
        'wbg_description_color'         => isset( $_POST['wbg_description_color'] ) ? sanitize_text_field( $_POST['wbg_description_color'] ) : '#242424',
        'wbg_description_font_size'     => ( isset( $_POST['wbg_description_font_size'] ) && filter_var( $_POST['wbg_description_font_size'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_description_font_size'] : 12,
    );
    
    $wbgShowGeneralMessage = update_option( 'wbg_general_styles', serialize( $wbgGeneralStylesInfo ) );
}

$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbg_gallary_column         = isset( $wbgGeneralSettings['wbg_gallary_column'] ) ? $wbgGeneralSettings['wbg_gallary_column'] : 3;
$wbg_book_cover_width       = isset( $wbgGeneralSettings['wbg_book_cover_width'] ) ? $wbgGeneralSettings['wbg_book_cover_width'] : 'default';
$wbg_gallary_column_mobile  = isset( $wbgGeneralSettings['wbg_gallary_column_mobile'] ) ? $wbgGeneralSettings['wbg_gallary_column_mobile'] : 1;
$wbg_gallary_sorting        = isset( $wbgGeneralSettings['wbg_gallary_sorting'] ) ? $wbgGeneralSettings['wbg_gallary_sorting'] : 'title';
$wbg_title_length           = isset( $wbgGeneralSettings['wbg_title_length'] ) ? $wbgGeneralSettings['wbg_title_length'] : 4;
$wbg_display_details_page   = isset( $wbgGeneralSettings['wbg_display_details_page'] ) ? $wbgGeneralSettings['wbg_display_details_page'] : '1';
$wbg_display_category       = isset( $wbgGeneralSettings['wbg_display_category'] ) ? $wbgGeneralSettings['wbg_display_category'] : '1';
$wbg_display_author         = isset( $wbgGeneralSettings['wbg_display_author'] ) ? $wbgGeneralSettings['wbg_display_author'] : '1';
$wbg_display_description    = isset( $wbgGeneralSettings['wbg_display_description'] ) ? $wbgGeneralSettings['wbg_display_description'] : '1';
$wbg_description_length     = isset( $wbgGeneralSettings['wbg_description_length'] ) ? $wbgGeneralSettings['wbg_description_length'] : 20;
$wbg_display_buynow         = isset( $wbgGeneralSettings['wbg_display_buynow'] ) ? $wbgGeneralSettings['wbg_display_buynow'] : '1';
$wbg_buynow_btn_txt         = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : '';
$wbg_books_order            = isset( $wbgGeneralSettings['wbg_books_order'] ) ? $wbgGeneralSettings['wbg_books_order'] : 'ASC';
$wbg_display_total_books    = isset( $wbgGeneralSettings['wbg_display_total_books'] ) ? $wbgGeneralSettings['wbg_display_total_books'] : '';

// Styling
$wbgGeneralStyling          = stripslashes_deep( unserialize( get_option('wbg_general_styles') ) );
$wbg_download_btn_color     = isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be';
$wbg_download_btn_font_color    = isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF';
$wbg_title_color            = isset( $wbgGeneralStyling['wbg_title_color'] ) ? $wbgGeneralStyling['wbg_title_color'] : '#242424';
$wbg_title_hover_color      = isset( $wbgGeneralStyling['wbg_title_hover_color'] ) ? $wbgGeneralStyling['wbg_title_hover_color'] : '#999999';
$wbg_title_font_size        = isset( $wbgGeneralStyling['wbg_title_font_size'] ) ? $wbgGeneralStyling['wbg_title_font_size'] : 12;
$wbg_description_color      = isset( $wbgGeneralStyling['wbg_description_color'] ) ? $wbgGeneralStyling['wbg_description_color'] : '#242424';
$wbg_description_font_size  = isset( $wbgGeneralStyling['wbg_description_font_size'] ) ? $wbgGeneralStyling['wbg_description_font_size'] : 12;
?>

<div id="wph-wrap-all" class="wrap wbg-settings-page">

    <div class="settings-banner">
        <h2><?php esc_html_e('Books Gallery Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>

    <?php 
    if ( $wbgShowGeneralMessage ) { 
        $this->wbg_display_notification('success', 'Your information updated successfully.'); 
    } 
    ?>

    <div class="hmacs-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=books&page=wbg-general-settings&tab=content" class="nav-tab <?php if ( $tab !== 'styles' ) { ?>nav-tab-active<?php } ?>"><?php _e('Content Settings', WBG_TXT_DOMAIN); ?></a>
            <a href="?post_type=books&page=wbg-general-settings&tab=styles" class="nav-tab <?php if ( $tab === 'styles' ) { ?>nav-tab-active<?php } ?>"><?php _e('Styles Settings', WBG_TXT_DOMAIN); ?></a>
        </nav>

        <div class="hmacs_personal_wrap hmacs_personal_help" style="width: 845px; float: left; margin-top: 5px;">
            
            <div class="tab-content">
                <?php 
                switch ( $tab ) {
                    case 'styles':
                        ?>
                        <h3><?php _e('Styles Settings :', WBG_TXT_DOMAIN); ?></h3>
                        <form name="wbg_general_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-style-form">
                            <table class="wbg-general-style-settings-table">
                                <tr class="wbg_download_btn">
                                    <th scope="row" colspan="2">
                                        <hr><label><?php esc_html_e('Download Button:', WBG_TXT_DOMAIN); ?></label><hr>
                                    </th>
                                </tr>
                                <tr class="wbg_download_btn_color">
                                    <th scope="row">
                                        <label for="wbg_download_btn_color"><?php esc_html_e('Button Color:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input class="wbg-wp-color" type="text" name="wbg_download_btn_color" id="wbg_download_btn_color" value="<?php echo esc_attr( $wbg_download_btn_color ); ?>">
                                        <div id="colorpicker"></div>
                                    </td>
                                </tr>
                                <tr class="wbg_download_btn_font_color">
                                    <th scope="row">
                                        <label for="wbg_download_btn_font_color"><?php esc_html_e('Button Font Color:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input class="wbg-wp-color" type="text" name="wbg_download_btn_font_color" id="wbg_download_btn_font_color" value="<?php echo esc_attr( $wbg_download_btn_font_color ); ?>">
                                        <div id="colorpicker"></div>
                                    </td>
                                </tr>
                                <tr class="wbg_download_btn">
                                    <th scope="row" colspan="2">
                                        <hr><label><?php _e('Title:', WBG_TXT_DOMAIN); ?></label><hr>
                                    </th>
                                </tr>
                                <tr class="wbg_title_color">
                                    <th scope="row">
                                        <label for="wbg_title_color"><?php _e('Font Color:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input class="wbg-wp-color" type="text" name="wbg_title_color" id="wbg_title_color" value="<?php esc_attr_e( $wbg_title_color ); ?>">
                                        <div id="colorpicker"></div>
                                    </td>
                                </tr>
                                <tr class="wbg_title_hover_color">
                                    <th scope="row">
                                        <label for="wbg_title_hover_color"><?php _e('Hover Color:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input class="wbg-wp-color" type="text" name="wbg_title_hover_color" id="wbg_title_hover_color" value="<?php esc_attr_e( $wbg_title_hover_color ); ?>">
                                        <div id="colorpicker"></div>
                                    </td>
                                </tr>
                                <tr class="wbg_title_font_size">
                                    <th scope="row">
                                        <label for="wbg_title_font_size"><?php _e('Font Size:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="number" class="medium-text" min="12" max="50" name="wbg_title_font_size" id="wbg_title_font_size" value="<?php esc_attr_e( $wbg_title_font_size ); ?>">
                                        <code>px</code>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="2">
                                        <hr><label><?php _e('Description:', WBG_TXT_DOMAIN); ?></label><hr>
                                    </th>
                                </tr>
                                <tr">
                                    <th scope="row">
                                        <label><?php _e('Font Color:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input class="wbg-wp-color" type="text" name="wbg_description_color" id="wbg_description_color" value="<?php esc_attr_e( $wbg_description_color ); ?>">
                                        <div id="colorpicker"></div>
                                    </td>
                                </tr>
                                <tr class="wbg_description_font_size">
                                    <th scope="row">
                                        <label for="wbg_description_font_size"><?php _e('Font Size:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="number" class="medium-text" min="10" max="30" name="wbg_description_font_size" id="wbg_description_font_size" value="<?php esc_attr_e( $wbg_description_font_size ); ?>">
                                        <code>px</code>
                                    </td>
                                </tr>
                            </table>
                            <p class="submit"><button id="updateGeneralStyles" name="updateGeneralStyles" class="button button-primary"><?php _e('Save Styles', WBG_TXT_DOMAIN); ?></button></p>

                        </form>
                        <?php
                        break;
                    default:
                        ?>
                        <h3><?php _e('Content Settings :', WBG_TXT_DOMAIN); ?></h3>
                        <?php
                        include_once WBG_PATH . 'admin/view/partial/wbg-general-settings-content.php';
                        break;
                } 
                ?>
            </div>
        </div>

        <?php $this->wbg_admin_sidebar(); ?>

    </div>

</div>