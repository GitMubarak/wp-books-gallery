<?php
$wbgShowGeneralMessage = false;
if( isset( $_POST['updateGeneralSettings'] ) ) {
    
    $wbgGeneralSettingsInfo = array(
        'wbg_gallary_column'        => ( isset( $_POST['wbg_gallary_column'] ) && filter_var( $_POST['wbg_gallary_column'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_gallary_column'] : 3,
        'wbg_gallary_sorting'       => ( isset( $_POST['wbg_gallary_sorting'] ) && filter_var( $_POST['wbg_gallary_sorting'], FILTER_SANITIZE_STRING ) ) ? $_POST['wbg_gallary_sorting'] : 'title',
        'wbg_details_is_external'   => ( isset( $_POST['wbg_details_is_external'] ) && filter_var( $_POST['wbg_details_is_external'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_details_is_external'] : '',
        'wbg_title_length'          => ( isset( $_POST['wbg_title_length'] ) && filter_var( $_POST['wbg_title_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_title_length'] : 4,
        'wbg_display_category'      => ( isset( $_POST['wbg_display_category'] ) && filter_var( $_POST['wbg_display_category'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_category'] : '',
        'wbg_cat_label_txt'         => ( sanitize_text_field($_POST['wbg_cat_label_txt']) != '' ) ? sanitize_text_field( $_POST['wbg_cat_label_txt'] ) : '',
        'wbg_display_author'        => ( isset( $_POST['wbg_display_author'] ) && filter_var( $_POST['wbg_display_author'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_author'] : '',
        'wbg_author_label_txt'      => ( sanitize_text_field($_POST['wbg_author_label_txt']) != '' ) ? sanitize_text_field( $_POST['wbg_author_label_txt'] ) : '',
        'wbg_display_description'   => ( isset( $_POST['wbg_display_description'] ) && filter_var( $_POST['wbg_display_description'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_description'] : '',
        'wbg_description_length'    => ( isset( $_POST['wbg_description_length'] ) && filter_var( $_POST['wbg_description_length'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_description_length'] : 20,
        'wbg_display_buynow'        => ( isset( $_POST['wbg_display_buynow'] ) && filter_var( $_POST['wbg_display_buynow'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_buynow'] : '',
        'wbg_buynow_btn_txt'        => ( sanitize_text_field( $_POST['wbg_buynow_btn_txt'] ) != '' ) ? sanitize_text_field( $_POST['wbg_buynow_btn_txt'] ) : '',
    );
    
    $wbgShowGeneralMessage = update_option( 'wbg_general_settings', serialize( $wbgGeneralSettingsInfo ) );
}

$wbgGeneralSettings         = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
$wbg_gallary_sorting        = isset( $wbgGeneralSettings['wbg_gallary_sorting'] ) ? $wbgGeneralSettings['wbg_gallary_sorting'] : 'title';
$wbg_display_category       = isset( $wbgGeneralSettings['wbg_display_category'] ) ? $wbgGeneralSettings['wbg_display_category'] : '';
$wbg_display_author         = isset( $wbgGeneralSettings['wbg_display_author'] ) ? $wbgGeneralSettings['wbg_display_author'] : '';
$wbg_display_description    = isset( $wbgGeneralSettings['wbg_display_description'] ) ? $wbgGeneralSettings['wbg_display_description'] : '';
$wbg_description_length     = isset( $wbgGeneralSettings['wbg_description_length'] ) ? $wbgGeneralSettings['wbg_description_length'] : 20;
$wbg_display_buynow         = isset( $wbgGeneralSettings['wbg_display_buynow'] ) ? $wbgGeneralSettings['wbg_display_buynow'] : '';
$wbg_buynow_btn_txt         = isset( $wbgGeneralSettings['wbg_buynow_btn_txt'] ) ? $wbgGeneralSettings['wbg_buynow_btn_txt'] : '';
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">
    <div class="settings-banner">
        <h2><?php esc_html_e('Gallery Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>
    <?php if ($wbgShowGeneralMessage) : $this->wbg_display_notification('success', 'Your information updated successfully.');
    endif; ?>

    <form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action=""
        id="wbg-general-settings-form">
        <table class="form-table">
            <tr class="wbg_gallary_column">
                <th scope="row">
                    <label for="wbg_gallary_column"><?php esc_html_e('Gallary Columns:', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <select name="wbg_gallary_column" class="medium-text">
                        <option value=""><?php esc_html_e('--Select One--', WBG_TXT_DOMAIN); ?></option>
                        <option value="2"
                            <?php if ('2' == esc_attr($wbgGeneralSettings['wbg_gallary_column'])) echo 'selected'; ?>>
                            <?php esc_html_e('2', WBG_TXT_DOMAIN); ?>
                        </option>
                        <option value="3"
                            <?php if ('3' == esc_attr($wbgGeneralSettings['wbg_gallary_column'])) echo 'selected'; ?>>
                            <?php esc_html_e('3', WBG_TXT_DOMAIN); ?>
                        </option>
                        <option value="4"
                            <?php if ('4' == esc_attr($wbgGeneralSettings['wbg_gallary_column'])) echo 'selected'; ?>>
                            <?php esc_html_e('4', WBG_TXT_DOMAIN); ?>
                        </option>
                    </select>
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
                    <input type="number" name="wbg_title_length" class="medium-text" min="1" max="10"
                        value="<?php echo esc_attr($wbgGeneralSettings['wbg_title_length']); ?>">
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
                class="button button-primary"><?php esc_attr_e('Update Settings', WBG_TXT_DOMAIN); ?></button></p>
    </form>
</div>