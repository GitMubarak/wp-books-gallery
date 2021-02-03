<?php
$wbgShowDetailMessage = false;

if( isset( $_POST['updateDetailSettings'] ) ) {

    $wbgDetailSettingsInfo = array(
        'wbg_author_info'           => isset($_POST['wbg_author_info']) && filter_var($_POST['wbg_author_info'], FILTER_SANITIZE_NUMBER_INT) ? $_POST['wbg_author_info'] : '',
        'wbg_author_label'          => sanitize_text_field($_POST['wbg_author_label']) != '' ? sanitize_text_field($_POST['wbg_author_label']) : 'Author',
        'wbg_display_category'      => isset($_POST['wbg_display_category']) && filter_var($_POST['wbg_display_category'], FILTER_SANITIZE_NUMBER_INT) ? $_POST['wbg_display_category'] : '',
        'wbg_category_label'        => sanitize_text_field($_POST['wbg_category_label']) != '' ? sanitize_text_field($_POST['wbg_category_label']) : 'Category',
        'wbg_display_publisher'     => isset($_POST['wbg_display_publisher']) && filter_var($_POST['wbg_display_publisher'], FILTER_SANITIZE_NUMBER_INT) ? $_POST['wbg_display_publisher'] : '',
        'wbg_publisher_label'       => sanitize_text_field($_POST['wbg_publisher_label']) != '' ? sanitize_text_field($_POST['wbg_publisher_label']) : 'Publisher',
        'wbg_display_publish_date'  => isset($_POST['wbg_display_publish_date']) && filter_var($_POST['wbg_display_publish_date'], FILTER_SANITIZE_NUMBER_INT) ? $_POST['wbg_display_publish_date'] : '',
        'wbg_publish_date_label'    => sanitize_text_field($_POST['wbg_publish_date_label']) != '' ? sanitize_text_field($_POST['wbg_publish_date_label']) : '',
        'wbg_publish_date_format'   => isset( $_POST['wbg_publish_date_format'] ) && filter_var( $_POST['wbg_publish_date_format'], FILTER_SANITIZE_STRING ) ? $_POST['wbg_publish_date_format'] : 'full',
        'wbg_display_isbn'          => ( isset( $_POST['wbg_display_isbn'] ) && filter_var( $_POST['wbg_display_isbn'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_isbn'] : '',
        'wbg_isbn_label'            => ( sanitize_text_field( $_POST['wbg_isbn_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_isbn_label'] ) : 'ISBN',
        'wbg_display_page'          => ( isset( $_POST['wbg_display_page'] ) && filter_var( $_POST['wbg_display_page'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_page'] : '',
        'wbg_page_label'            => ( sanitize_text_field( $_POST['wbg_page_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_page_label'] ) : 'Pages',
        'wbg_display_country'       => ( isset( $_POST['wbg_display_country'] ) && filter_var( $_POST['wbg_display_country'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_country'] : '',
        'wbg_country_label'         => ( sanitize_text_field( $_POST['wbg_country_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_country_label'] ) : 'Country',
        'wbg_display_language'      => ( isset( $_POST['wbg_display_language'] ) && filter_var( $_POST['wbg_display_language'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_language'] : '',
        'wbg_language_label'        => ( sanitize_text_field( $_POST['wbg_language_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_language_label'] ) : 'Language',
        'wbg_display_dimension'     => ( isset( $_POST['wbg_display_dimension'] ) && filter_var( $_POST['wbg_display_dimension'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_dimension'] : '',
        'wbg_dimension_label'       => ( sanitize_text_field( $_POST['wbg_dimension_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_dimension_label'] ) : 'Dimension',
        'wbg_display_filesize'      => ( isset( $_POST['wbg_display_filesize'] ) && filter_var( $_POST['wbg_display_filesize'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_filesize'] : '',
        'wbg_filesize_label'        => ( sanitize_text_field( $_POST['wbg_filesize_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_filesize_label'] ) : 'File Size',
        'wbg_display_download_button'   => ( isset( $_POST['wbg_display_download_button'] ) && filter_var( $_POST['wbg_display_download_button'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_download_button'] : '',
        'wbg_display_description'       => ( isset( $_POST['wbg_display_description'] ) && filter_var( $_POST['wbg_display_description'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_description'] : '',
        'wbg_description_label'         => ( sanitize_text_field( $_POST['wbg_description_label'] ) != '' ) ? sanitize_text_field( $_POST['wbg_description_label'] ) : 'Description',
    );

    $wbgShowDetailMessage = update_option( 'wbg_detail_settings', serialize( $wbgDetailSettingsInfo ) );
}

$wbgDetailSettings          = stripslashes_deep( unserialize( get_option('wbg_detail_settings') ) );
$wbg_publish_date_format    = isset( $wbgDetailSettings['wbg_publish_date_format'] ) ? $wbgDetailSettings['wbg_publish_date_format'] : 'full';
$wbg_display_isbn           = isset( $wbgDetailSettings['wbg_display_isbn'] ) ? $wbgDetailSettings['wbg_display_isbn'] : '';
$wbg_isbn_label             = isset( $wbgDetailSettings['wbg_isbn_label'] ) ? $wbgDetailSettings['wbg_isbn_label'] : 'ISBN';
$wbg_display_page           = isset( $wbgDetailSettings['wbg_display_page'] ) ? $wbgDetailSettings['wbg_display_page'] : '';
$wbg_page_label             = isset( $wbgDetailSettings['wbg_page_label'] ) ? $wbgDetailSettings['wbg_page_label'] : 'Pages';
$wbg_display_country        = isset( $wbgDetailSettings['wbg_display_country'] ) ? $wbgDetailSettings['wbg_display_country'] : '';
$wbg_country_label          = isset( $wbgDetailSettings['wbg_country_label'] ) ? $wbgDetailSettings['wbg_country_label'] : 'Country';
$wbg_display_language       = isset( $wbgDetailSettings['wbg_display_language'] ) ? $wbgDetailSettings['wbg_display_language'] : '';
$wbg_language_label         = isset( $wbgDetailSettings['wbg_language_label'] ) ? $wbgDetailSettings['wbg_language_label'] : 'Language';
$wbg_display_dimension      = isset( $wbgDetailSettings['wbg_display_dimension'] ) ? $wbgDetailSettings['wbg_display_dimension'] : '';
$wbg_dimension_label        = isset( $wbgDetailSettings['wbg_dimension_label'] ) ? $wbgDetailSettings['wbg_dimension_label'] : 'Dimension';
$wbg_display_filesize       = isset( $wbgDetailSettings['wbg_display_filesize'] ) ? $wbgDetailSettings['wbg_display_filesize'] : '';
$wbg_filesize_label         = isset( $wbgDetailSettings['wbg_filesize_label'] ) ? $wbgDetailSettings['wbg_filesize_label'] : 'File Size';
$wbg_display_download_button    = isset( $wbgDetailSettings['wbg_display_download_button'] ) ? $wbgDetailSettings['wbg_display_download_button'] : '';
$wbg_display_description        = isset( $wbgDetailSettings['wbg_display_description'] ) ? $wbgDetailSettings['wbg_display_description'] : '';
$wbg_description_label          = isset( $wbgDetailSettings['wbg_description_label'] ) ? $wbgDetailSettings['wbg_description_label'] : 'Description';
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">
    
    <div class="settings-banner">
        <h2><?php _e('Book Details Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>
    
    <?php 
    if ( $wbgShowDetailMessage ) { 
        $this->wbg_display_notification('success', 'Your information updated successfully.');
    } 
    ?>

    <form name="wbg_detail_settings_form" role="form" class="form-horizontal" method="post" action=""
        id="wbg-detail-settings-form">
        <table class="wbg-details-settings-table">
            <tr class="wbg_author_info">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_author_info"><?php esc_html_e('Display Author:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_author_info" class="wbg_author_info" value="1" <?php if ($wbgDetailSettings['wbg_author_info'] == "1") { echo 'checked'; } ?>>
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_author_label"><?php esc_html_e('Author Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_author_label" class="medium-text" placeholder="<?php _e('Author', WBG_TXT_DOMAIN); ?>"
                        value="<?php echo esc_attr($wbgDetailSettings['wbg_author_label']); ?>">
                </td>
            </tr>
            <tr class="wbg_display_category">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_category"><?php esc_html_e('Display Category:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_category" class="wbg_display_category" value="1" <?php if ($wbgDetailSettings['wbg_display_category'] == "1") {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_category_label"><?php esc_html_e('Category Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_category_label" class="medium-text" placeholder="<?php _e('Category', WBG_TXT_DOMAIN); ?>"
                        value="<?php echo esc_attr($wbgDetailSettings['wbg_category_label']); ?>">
                </td>
            </tr>
            <tr class="wbg_display_publisher">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_publisher"><?php esc_html_e('Display Publisher:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_publisher" class="wbg_display_publisher" value="1" <?php if ($wbgDetailSettings['wbg_display_publisher'] == "1") {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_publisher_label"><?php esc_html_e('Publisher Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_publisher_label" class="medium-text" placeholder="<?php _e('Publisher', WBG_TXT_DOMAIN); ?>"
                        value="<?php echo esc_attr($wbgDetailSettings['wbg_publisher_label']); ?>">
                </td>
            </tr>
            <tr class="wbg_display_publish_date">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_publish_date"><?php esc_html_e('Display Publish Date:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_publish_date" class="wbg_display_publish_date" value="1" <?php if ($wbgDetailSettings['wbg_display_publish_date'] == "1") { echo 'checked'; } ?>>
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_publish_date_label"><?php esc_html_e('Publish Date Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_publish_date_label" class="medium-text" placeholder="<?php _e('Published', WBG_TXT_DOMAIN); ?>"
                        value="<?php echo esc_attr($wbgDetailSettings['wbg_publish_date_label']); ?>">
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_publish_date_format"><?php esc_html_e('Date Format:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="radio" name="wbg_publish_date_format" class="wbg_publish_date_format" value="full" <?php echo ( 'year' !== $wbg_publish_date_format ) ? 'checked' : ''; ?> >
                    <label for="default-templates"><span></span><?php esc_html_e( 'Full', WBG_TXT_DOMAIN ); ?></label>
                        &nbsp;&nbsp;
                    <input type="radio" name="wbg_publish_date_format" class="wbg_publish_date_format" value="year" <?php echo ( 'year' === $wbg_publish_date_format ) ? 'checked' : ''; ?> >
                    <label for="csutom-design"><span></span><?php esc_html_e( 'Only Year', WBG_TXT_DOMAIN ); ?></label>
                </td>
            </tr>
            <tr class="wbg_display_isbn">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_isbn"><?php esc_html_e('Display ISBN:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_isbn" class="wbg_display_isbn" value="1" <?php echo ( '1' === $wbg_display_isbn ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_isbn_label"><?php esc_html_e('ISBN Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_isbn_label" placeholder="<?php _e('ISBN', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_isbn_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_page">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_page"><?php esc_html_e('Display Pages:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_page" class="wbg_display_page" value="1" <?php echo ( '1' === $wbg_display_page ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_page_label"><?php esc_html_e('Pages Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_page_label" placeholder="<?php _e('Pages', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_page_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_country">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_country"><?php esc_html_e('Display Country:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_country" class="wbg_display_country" value="1" <?php echo ( '1' === $wbg_display_country ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_country_label"><?php esc_html_e('Country Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_country_label" placeholder="<?php _e('Country', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_country_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_language">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_language"><?php esc_html_e('Display Language:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_language" class="wbg_display_language" value="1" <?php echo ( '1' === $wbg_display_language ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_language_label"><?php esc_html_e('Language Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_language_label" placeholder="<?php _e('Language', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_language_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_dimension">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_dimension"><?php esc_html_e('Display Dimension:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_dimension" class="wbg_display_dimension" value="1" <?php echo ( '1' === $wbg_display_dimension ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_dimension_label"><?php esc_html_e('Dimension Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_dimension_label" placeholder="<?php _e('Dimension', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_dimension_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_filesize">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_filesize"><?php esc_html_e('Display File Size:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_filesize" class="wbg_display_filesize" value="1" <?php echo ( '1' === $wbg_display_filesize ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_filesize_label"><?php esc_html_e('File Size Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_filesize_label" placeholder="<?php _e('File Size', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_filesize_label ); ?>">
                </td>
            </tr>
            <tr class="wbg_display_download_button">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_download_button"><?php esc_html_e('Display Download / BuyNow Button:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_download_button" class="wbg_display_download_button" value="1" <?php echo ( '1' === $wbg_display_download_button ) ? 'checked' : ''; ?> >
                </td>
            </tr>
            <tr class="wbg_display_description">
                <th scope="row" style="text-align: right;">
                    <label for="wbg_display_description"><?php esc_html_e('Display Description:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_description" class="wbg_display_description" value="1" <?php echo ( '1' === $wbg_display_description ) ? 'checked' : ''; ?> >
                </td>
                <th scope="row" style="text-align: right;">
                    <label for="wbg_description_label"><?php esc_html_e('Description Label:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="text" name="wbg_description_label" placeholder="<?php _e('Description', WBG_TXT_DOMAIN); ?>" class="medium-text"
                        value="<?php echo esc_attr( $wbg_description_label ); ?>">
                </td>
            </tr>
        </table>
        <p class="submit"><button id="updateDetailSettings" name="updateDetailSettings"
                class="button button-primary"><?php _e('Save Settings', WBG_TXT_DOMAIN); ?></button></p>
    </form>
</div>