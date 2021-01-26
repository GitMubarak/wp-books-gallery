<table class="form-table">
    <tr class="wbg_author">
        <th scope="row">
            <label for="wbg_author"><?php esc_html_e('Author:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_author" value="<?php echo esc_attr( $wbg_author ); ?>" class="regular-text">
        </td>
    </tr>
    <tr class="wbg_publisher">
        <th scope="row">
            <label for="wbg_publisher"><?php esc_html_e('Publisher:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_publisher" value="<?php echo esc_attr($wbg_publisher); ?>"
                class="regular-text">
        </td>
    </tr>
    <tr class="wbg_published_on">
        <th scope="row">
            <label for="wbg_published_on"><?php esc_html_e('Published On:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_published_on" id="wbg_published_on"
                value="<?php echo esc_attr($wbg_published_on); ?>" class="medium-text" readonly>
        </td>
    </tr>
    <tr class="wbg_isbn">
        <th scope="row">
            <label for="wbg_isbn"><?php esc_html_e('ISBN:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_isbn" value="<?php echo esc_attr($wbg_isbn); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_pages">
        <th scope="row">
            <label for="wbg_pages"><?php esc_html_e('Pages:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_pages" value="<?php echo esc_attr($wbg_pages); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_country">
        <th scope="row">
            <label for="wbg_country"><?php esc_html_e('Country:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_country" value="<?php echo esc_attr($wbg_country); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_language">
        <th scope="row">
            <label for="wbg_language"><?php esc_html_e('Language:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_language" value="<?php echo esc_attr($wbg_language); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_dimension">
        <th scope="row">
            <label for="wbg_dimension"><?php esc_html_e('Dimension:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_dimension" value="<?php echo esc_attr($wbg_dimension); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_download_link">
        <th scope="row">
            <label for="wbg_download_link"><?php esc_html_e('External Url:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_download_link" value="<?php echo esc_attr($wbg_download_link); ?>"
                class="widefat">
        </td>
    </tr>
    <tr class="wbg_filesize">
        <th scope="row">
            <label for="wbg_filesize"><?php esc_html_e('File Size:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="text" name="wbg_filesize" value="<?php echo esc_attr($wbg_filesize); ?>" class="medium-text">
        </td>
    </tr>
    <tr class="wbg_status">
        <th scope="row">
            <label for="wbg_status"><?php esc_html_e('Status:', WBG_TXT_DOMAIN); ?></label>
        </th>
        <td>
            <input type="radio" name="wbg_status" class="wbg_status" value="active" <?php echo ( 'inactive' !== $wbg_status ) ? 'checked' : ''; ?> >
            <label for="wbg_status_active"><span></span><?php esc_html_e( 'Active', WBG_TXT_DOMAIN ); ?></label>
                &nbsp;&nbsp;
            <input type="radio" name="wbg_status" class="wbg_status" value="inactive" <?php echo ( 'inactive' === $wbg_status ) ? 'checked' : ''; ?> >
            <label for="wbg_status_active"><span></span><?php esc_html_e( 'Inactive', WBG_TXT_DOMAIN ); ?></label>
        </td>
    </tr>
</table>