<?php
$wbgShowSearchMessage = false;
if( isset( $_POST['updateSearchSettings'] ) ) {
    
    $wbgSearchSettingsInfo = array(
        'wbg_display_search_panel'      => ( isset( $_POST['wbg_display_search_panel'] ) && filter_var( $_POST['wbg_display_search_panel'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_panel'] : '',
        'wbg_display_search_title'      => ( isset( $_POST['wbg_display_search_title'] ) && filter_var( $_POST['wbg_display_search_title'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_title'] : '',
        'wbg_display_search_category'   => ( isset( $_POST['wbg_display_search_category'] ) && filter_var( $_POST['wbg_display_search_category'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_category'] : '',
        'wbg_display_search_author'     => ( isset( $_POST['wbg_display_search_author'] ) && filter_var( $_POST['wbg_display_search_author'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_author'] : '',
        'wbg_display_search_publisher'  => ( isset( $_POST['wbg_display_search_publisher'] ) && filter_var( $_POST['wbg_display_search_publisher'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_publisher'] : '',
    );
    
    $wbgShowSearchMessage = update_option( 'wbg_search_settings', serialize( $wbgSearchSettingsInfo ) );
}

$wbgSearchSettings              = stripslashes_deep( unserialize( get_option('wbg_search_settings') ) );
$wbg_display_search_panel       = isset( $wbgSearchSettings['wbg_display_search_panel'] ) ? $wbgSearchSettings['wbg_display_search_panel'] : '';
$wbg_display_search_title       = isset( $wbgSearchSettings['wbg_display_search_title'] ) ? $wbgSearchSettings['wbg_display_search_title'] : '';
$wbg_display_search_category    = isset( $wbgSearchSettings['wbg_display_search_category'] ) ? $wbgSearchSettings['wbg_display_search_category'] : '';
$wbg_display_search_author      = isset( $wbgSearchSettings['wbg_display_search_author'] ) ? $wbgSearchSettings['wbg_display_search_author'] : '';
$wbg_display_search_publisher   = isset( $wbgSearchSettings['wbg_display_search_publisher'] ) ? $wbgSearchSettings['wbg_display_search_publisher'] : '';
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">
    <div class="settings-banner">
        <h2><?php esc_html_e('Search Panel Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>
    <?php if( $wbgShowSearchMessage ) : $this->wbg_display_notification('success', 'Your information updated successfully.');
    endif; ?>

    <form name="wbg_search_settings_form" role="form" class="form-horizontal" method="post" action=""
        id="wbg-search-settings-form">
        <table class="form-table">
            <tr class="wbg_display_search_panel">
                <th scope="row">
                    <label for="wbg_display_search_panel"><?php esc_html_e('Display Search Panel?', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_search_panel" class="wbg_display_search_panel" value="1" <?php echo ( '1' === $wbg_display_search_panel ) ? 'checked' : ''; ?> >
                </td>
            </tr>
            <tr class="wbg_display_search_title">
                <th scope="row">
                    <label for="wbg_display_search_title"><?php esc_html_e('Search By Book Name', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_search_title" class="wbg_display_search_title" value="1" <?php echo ( '1' === $wbg_display_search_title ) ? 'checked' : ''; ?> >
                </td>
            </tr>
            <tr class="wbg_display_search_category">
                <th scope="row">
                    <label for="wbg_display_search_category"><?php esc_html_e('Search By Category', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_search_category" class="wbg_display_search_category" value="1" <?php echo ( '1' === $wbg_display_search_category ) ? 'checked' : ''; ?> >
                </td>
            </tr>
            <tr class="wbg_display_search_author">
                <th scope="row">
                    <label for="wbg_display_search_author"><?php esc_html_e('Search By Author', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_search_author" class="wbg_display_search_author" value="1" <?php echo ( '1' === $wbg_display_search_author ) ? 'checked' : ''; ?> >
                </td>
            </tr>
            <tr class="wbg_display_search_publisher">
                <th scope="row">
                    <label for="wbg_display_search_publisher"><?php esc_html_e('Search By Publisher', WBG_TXT_DOMAIN); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="wbg_display_search_publisher" class="wbg_display_search_publisher" value="1" <?php echo ( '1' === $wbg_display_search_publisher ) ? 'checked' : ''; ?> >
                </td>
            </tr>
        </table>
        <p class="submit"><button id="updateSearchSettings" name="updateSearchSettings" class="button button-primary"><?php esc_attr_e('Update Settings', WBG_TXT_DOMAIN); ?></button></p>
    </form>
</div>