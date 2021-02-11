<?php
if ( ! defined('ABSPATH') ) exit;
?>
<form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
    <table class="wbg-general-settings-table">
        <tr class="wbg_gallary_column">
            <th scope="row">
                <label for="wbg_gallary_column"><?php esc_html_e('Gallary Columns:', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
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
                <input type="checkbox" name="wbg_display_category" class="wbg_display_category" id="wbg_display_category" value="1"
                    <?php echo $wbg_display_category ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label for="wbg_cat_label_txt"><?php esc_html_e('Category Label Text:', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="wbg_cat_label_txt" placeholder="<?php _e('Category:', WBG_TXT_DOMAIN); ?>" class="medium-text"
                    value="<?php echo esc_attr($wbgGeneralSettings['wbg_cat_label_txt']); ?>">
            </td>
        </tr>
        <tr class="wbg_display_author">
            <th scope="row">
                <label for="wbg_display_author"><?php esc_html_e('Display Author?', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_author" class="wbg_display_author" id="wbg_display_author" value="1"
                    <?php echo $wbg_display_author ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label for="wbg_author_label_txt"><?php esc_html_e('Author Label Text:', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="wbg_author_label_txt" placeholder="<?php _e('By:', WBG_TXT_DOMAIN); ?>" class="medium-text"
                    value="<?php echo esc_attr($wbgGeneralSettings['wbg_author_label_txt']); ?>">
            </td>
        </tr>
        <tr class="wbg_display_description">
            <th scope="row">
                <label for="wbg_display_description"><?php esc_html_e('Display Description?', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_description" class="wbg_display_description" id="wbg_display_description" value="1"
                    <?php echo $wbg_display_description ? 'checked' : ''; ?> >
            </td>
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
                <input type="checkbox" name="wbg_display_buynow" class="wbg_display_buynow" id="wbg_display_buynow" value="1"
                    <?php echo $wbg_display_buynow ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label for="wbg_buynow_btn_txt"><?php esc_html_e('Button Text:', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="wbg_buynow_btn_txt" placeholder="<?php _e('Download/Buynow', WBG_TXT_DOMAIN); ?>" class="medium-text"
                    value="<?php echo esc_attr( $wbg_buynow_btn_txt ); ?>">
            </td>
        </tr>
        <tr class="wbg_display_total_books">
            <th scope="row">
                <label for="wbg_display_total_books"><?php esc_html_e('Display Total Books?', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_total_books" class="wbg_display_total_books" id="wbg_display_total_books" value="1"
                    <?php echo $wbg_display_total_books ? 'checked' : ''; ?> >
            </td>
        </tr>
        <tr class="wbg_shortcode">
            <th scope="row">
                    <label for="wbg_shortcode"><?php esc_html_e('Shortcode:', WBG_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="2">
                    <input type="text" name="wbg_shortcode" id="wbg_shortcode" class="medium-text" value="[wp_books_gallery]" readonly />
            </td>
        </tr>
    </table>
    <p class="submit"><button id="updateGeneralSettings" name="updateGeneralSettings"
            class="button button-primary"><?php esc_attr_e('Save Settings', WBG_TXT_DOMAIN); ?></button></p>
</form>