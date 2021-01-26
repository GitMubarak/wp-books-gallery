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
    );
    
    $wbgShowGeneralMessage = update_option( 'wbg_general_settings', serialize( $wbgGeneralSettingsInfo ) );
}

if( isset( $_POST['updateGeneralStyles'] ) ) {
    
    $wbgGeneralStylesInfo = array(
        'wbg_download_btn_color'        => isset( $_POST['wbg_download_btn_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_color'] ) : '#0274be',
        'wbg_download_btn_font_color'   => isset( $_POST['wbg_download_btn_font_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_font_color'] ) : '#FFFFFF',
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

// Styling
$wbgGeneralStyling              = stripslashes_deep( unserialize( get_option('wbg_general_styles') ) );
$wbg_download_btn_color         = isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be';
$wbg_download_btn_font_color    = isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF';
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
            <a href="?post_type=books&page=wbg-general-settings&tab=content" class="nav-tab <?php if ( $tab !== 'styles' ) { ?>nav-tab-active<?php } ?>">Content Settings</a>
            <a href="?post_type=books&page=wbg-general-settings&tab=styles" class="nav-tab <?php if ( $tab === 'styles' ) { ?>nav-tab-active<?php } ?>">Styles Settings</a>
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
                                        <label for="button_style_panel"><?php esc_html_e('Download Button:', WBG_TXT_DOMAIN); ?></label>
                                        <hr>
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
                            </table>
                            <p class="submit"><button id="updateGeneralStyles" name="updateGeneralStyles" class="button button-primary"><?php esc_attr_e('Save Styles', WBG_TXT_DOMAIN); ?></button></p>

                        </form>
                        <?php
                        break;
                    default:
                        ?>
                        <h3><?php _e('Content Settings :', WBG_TXT_DOMAIN); ?></h3>
                        <form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action=""
                            id="wbg-general-settings-form">
                            <table class="wbg-general-settings-table">
                                <tr class="wbg_gallary_column">
                                    <th scope="row">
                                        <label for="wbg_gallary_column"><?php esc_html_e('Gallary Columns:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                    <label for="wbg_gallary_column_mobile"><?php esc_html_e('Desktop:', WBG_TXT_DOMAIN); ?></label>
                                        <select name="wbg_gallary_column" class="medium-text">
                                            <option value="2" <?php echo ( '2' == $wbg_gallary_column ) ? 'selected' : ''; ?> ><?php esc_html_e('2', WBG_TXT_DOMAIN); ?></option>
                                            <option value="3" <?php echo ( '3' == $wbg_gallary_column ) ? 'selected' : ''; ?> ><?php esc_html_e('3', WBG_TXT_DOMAIN); ?></option>
                                            <option value="4" <?php echo ( '4' == $wbg_gallary_column ) ? 'selected' : ''; ?> ><?php esc_html_e('4', WBG_TXT_DOMAIN); ?></option>
                                        </select>
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="wbg_gallary_column_mobile"><?php esc_html_e('Mobile:', WBG_TXT_DOMAIN); ?></label>
                                        <select name="wbg_gallary_column_mobile" class="medium-text">
                                            <option value="1" <?php echo ( '1' == $wbg_gallary_column_mobile ) ? 'selected' : ''; ?> ><?php esc_html_e('1', WBG_TXT_DOMAIN); ?></option>
                                            <option value="2" <?php echo ( '2' == $wbg_gallary_column_mobile ) ? 'selected' : ''; ?> ><?php esc_html_e('2', WBG_TXT_DOMAIN); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="wbg_book_cover_width">
                                    <th scope="row">
                                        <label for="wbg_book_cover_width"><?php esc_html_e('Book Cover Width:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="radio" name="wbg_book_cover_width" class="wbg_book_cover_width" value="default" <?php echo ( 'full' !== $wbg_book_cover_width ) ? 'checked' : ''; ?> >
                                        <label for="default-templates"><span></span><?php esc_html_e( 'Default', WBG_TXT_DOMAIN ); ?></label>
                                        &nbsp;&nbsp;
                                        <input type="radio" name="wbg_book_cover_width" class="wbg_book_cover_width" value="full" <?php echo ( 'full' === $wbg_book_cover_width ) ? 'checked' : ''; ?> >
                                        <label for="csutom-design"><span></span><?php esc_html_e( 'Full', WBG_TXT_DOMAIN ); ?></label>
                                    </td>
                                </tr>
                                <tr class="wbg_gallary_sorting">
                                    <th scope="row">
                                        <label for="wbg_gallary_sorting"><?php esc_html_e('Sorting By:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <select name="wbg_gallary_sorting" class="medium-text">
                                            <option value=""><?php esc_html_e('--Select One--', WBG_TXT_DOMAIN); ?></option>
                                            <option value="title" <?php echo ( 'title' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Name', WBG_TXT_DOMAIN); ?></option>
                                            <option value="wbg_author" <?php echo ( 'wbg_author' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Author', WBG_TXT_DOMAIN); ?></option>
                                            <option value="date" <?php echo ( 'date' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Date', WBG_TXT_DOMAIN); ?></option>
                                            <option value="wbg_publisher" <?php echo ( 'wbg_publisher' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Publisher', WBG_TXT_DOMAIN); ?></option>
                                            <option value="wbg_published_on" <?php echo ( 'wbg_published_on' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Published On', WBG_TXT_DOMAIN); ?></option>
                                            <option value="wbg_language" <?php echo ( 'wbg_language' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Language', WBG_TXT_DOMAIN); ?></option>
                                            <option value="wbg_country" <?php echo ( 'wbg_country' === $wbg_gallary_sorting ) ? 'selected' : ''; ?> ><?php esc_html_e('Country', WBG_TXT_DOMAIN); ?></option>
                                        </select>
                                    </td>
                                    <th scope="row" style="text-align: right;">
                                        <label for="wbg_books_order"><?php esc_html_e('Order By:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="radio" name="wbg_books_order" class="wbg_books_order" value="ASC" <?php echo ( 'DESC' !== $wbg_books_order ) ? 'checked' : ''; ?> >
                                        <label for="default-templates"><span></span><?php esc_html_e( 'Ascending', WBG_TXT_DOMAIN ); ?></label>
                                            &nbsp;&nbsp;
                                        <input type="radio" name="wbg_books_order" class="wbg_books_order" value="DESC" <?php echo ( 'DESC' === $wbg_books_order ) ? 'checked' : ''; ?> >
                                        <label for="csutom-design"><span></span><?php esc_html_e( 'Descending', WBG_TXT_DOMAIN ); ?></label>
                                    </td>
                                </tr>
                                <tr class="wbg_display_details_page">
                                    <th scope="row">
                                        <label
                                            for="wbg_display_details_page"><?php esc_html_e('Enable Book Details Page?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_display_details_page" class="wbg_display_details_page" value="1"
                                            <?php echo ( '1' === $wbg_display_details_page ) ? 'checked' : ''; ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_details_is_external">
                                    <th scope="row">
                                        <label
                                            for="wbg_details_is_external"><?php esc_html_e('Open Book Details in New Tab?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_details_is_external" class="wbg_details_is_external" value="1"
                                            <?php if( '1' === $wbgGeneralSettings['wbg_details_is_external'] ) { echo 'checked'; } ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_title_length">
                                    <th scope="row">
                                        <label for="wbg_title_length"><?php esc_html_e('Title Word Length:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="number" name="wbg_title_length" class="medium-text" min="1" max="10" value="<?php echo esc_attr( $wbg_title_length ); ?>">
                                    </td>
                                </tr>
                                <tr class="wbg_display_category">
                                    <th scope="row">
                                        <label for="wbg_display_category"><?php esc_html_e('Display Category?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_display_category" class="wbg_display_category" value="1"
                                            <?php echo ( '1' === $wbg_display_category ) ? 'checked' : ''; ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_cat_label_txt">
                                    <th scope="row">
                                        <label for="wbg_cat_label_txt"><?php esc_html_e('Category Label Text:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" name="wbg_cat_label_txt" placeholder="Category:" class="medium-text"
                                            value="<?php echo esc_attr($wbgGeneralSettings['wbg_cat_label_txt']); ?>">
                                    </td>
                                </tr>
                                <tr class="wbg_display_author">
                                    <th scope="row">
                                        <label for="wbg_display_author"><?php esc_html_e('Display Author?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_display_author" class="wbg_display_author" value="1"
                                            <?php echo ( '1' === $wbg_display_author ) ? 'checked' : ''; ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_author_label_txt">
                                    <th scope="row">
                                        <label for="wbg_author_label_txt"><?php esc_html_e('Author Label Text:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" name="wbg_author_label_txt" placeholder="By:" class="medium-text"
                                            value="<?php echo esc_attr($wbgGeneralSettings['wbg_author_label_txt']); ?>">
                                    </td>
                                </tr>
                                <tr class="wbg_display_description">
                                    <th scope="row">
                                        <label for="wbg_display_description"><?php esc_html_e('Display Description?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_display_description" class="wbg_display_description" value="1"
                                            <?php echo ( '1' === $wbg_display_description ) ? 'checked' : ''; ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_description_length">
                                    <th scope="row">
                                        <label for="wbg_description_length"><?php esc_html_e('Description Word Length:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="number" name="wbg_description_length" class="medium-text" min="1" max="20" value="<?php echo esc_attr( $wbg_description_length ); ?>">
                                    </td>
                                </tr>
                                <tr class="wbg_display_buynow">
                                    <th scope="row">
                                        <label for="wbg_display_buynow"><?php esc_html_e('Display Buynow/Download Button?', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="checkbox" name="wbg_display_buynow" class="wbg_display_buynow" value="1"
                                            <?php echo ( '1' === $wbg_display_buynow ) ? 'checked' : ''; ?> >
                                    </td>
                                </tr>
                                <tr class="wbg_buynow_btn_txt">
                                    <th scope="row">
                                        <label for="wbg_buynow_btn_txt"><?php esc_html_e('Buynow/Download Button Text:', WBG_TXT_DOMAIN); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" name="wbg_buynow_btn_txt" placeholder="Download / Buynow" class="medium-text"
                                            value="<?php echo esc_attr( $wbg_buynow_btn_txt ); ?>">
                                    </td>
                                </tr>
                                <tr class="wbg_shortcode">
                                <th scope="row">
                                        <label for="wbg_shortcode"><?php esc_html_e('Shortcode:', WBG_TXT_DOMAIN); ?></label>
                                </th>
                                <td>
                                        <input type="text" name="wbg_shortcode" id="wbg_shortcode" class="medium-text" value="[wp_books_gallery]" readonly />
                                </td>
                                </tr>
                            </table>
                            <p class="submit"><button id="updateGeneralSettings" name="updateGeneralSettings"
                                    class="button button-primary"><?php esc_attr_e('Save Settings', WBG_TXT_DOMAIN); ?></button></p>
                        </form>
                        <?php
                        break;
                } 
                ?>
            </div>
        </div>

        <?php $this->wbg_admin_sidebar(); ?>

    </div>

</div>