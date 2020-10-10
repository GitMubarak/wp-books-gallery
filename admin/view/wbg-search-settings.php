<?php
$wbgShowSearchMessage = false;

if ( isset( $_POST['updateSearchSettings'] ) ) {
    
    $wbgSearchSettingsInfo = array(
        'wbg_display_search_panel'      => ( isset( $_POST['wbg_display_search_panel'] ) && filter_var( $_POST['wbg_display_search_panel'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_panel'] : '',
        'wbg_display_search_title'      => ( isset( $_POST['wbg_display_search_title'] ) && filter_var( $_POST['wbg_display_search_title'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_title'] : '',
        'wbg_display_search_category'   => ( isset( $_POST['wbg_display_search_category'] ) && filter_var( $_POST['wbg_display_search_category'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_category'] : '',
        'wbg_display_search_author'     => ( isset( $_POST['wbg_display_search_author'] ) && filter_var( $_POST['wbg_display_search_author'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_author'] : '',
        'wbg_display_search_publisher'  => ( isset( $_POST['wbg_display_search_publisher'] ) && filter_var( $_POST['wbg_display_search_publisher'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_display_search_publisher'] : '',
        'wbg_search_btn_txt'            => isset( $_POST['wbg_search_btn_txt'] ) ? sanitize_text_field( $_POST['wbg_search_btn_txt'] ) : 'Search Books',
    );
    
    $wbgShowSearchMessage = update_option( 'wbg_search_settings', serialize( $wbgSearchSettingsInfo ) );
}

if ( isset( $_POST['updateSearchStyles'] ) ) {
    
    $wbgSearchStylesInfo = array(
        'wbg_btn_color'                 => isset( $_POST['wbg_btn_color'] ) ? sanitize_text_field( $_POST['wbg_btn_color'] ) : '#0274be',
    );
    
    $wbgShowSearchMessage = update_option( 'wbg_search_styles', serialize( $wbgSearchStylesInfo ) );
}

$wbgSearchSettings              = stripslashes_deep( unserialize( get_option('wbg_search_settings') ) );
$wbg_display_search_panel       = isset( $wbgSearchSettings['wbg_display_search_panel'] ) ? $wbgSearchSettings['wbg_display_search_panel'] : '1';
$wbg_display_search_title       = isset( $wbgSearchSettings['wbg_display_search_title'] ) ? $wbgSearchSettings['wbg_display_search_title'] : '1';
$wbg_display_search_category    = isset( $wbgSearchSettings['wbg_display_search_category'] ) ? $wbgSearchSettings['wbg_display_search_category'] : '1';
$wbg_display_search_author      = isset( $wbgSearchSettings['wbg_display_search_author'] ) ? $wbgSearchSettings['wbg_display_search_author'] : '1';
$wbg_display_search_publisher   = isset( $wbgSearchSettings['wbg_display_search_publisher'] ) ? $wbgSearchSettings['wbg_display_search_publisher'] : '1';
$wbg_search_btn_txt             = isset( $wbgSearchSettings['wbg_search_btn_txt'] ) ? $wbgSearchSettings['wbg_search_btn_txt'] : 'Search Books';

$wbgSearchStyles                = stripslashes_deep( unserialize( get_option('wbg_search_styles') ) );
$wbg_btn_color                  = isset( $wbgSearchStyles['wbg_btn_color'] ) ? $wbgSearchStyles['wbg_btn_color'] : '#0274be';
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">
    
    <div class="settings-banner">
        <h2><?php esc_html_e('Search Panel Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>

    <?php 
        if ( $wbgShowSearchMessage ) {
            $this->wbg_display_notification('success', 'Your information updated successfully.');
        }
    ?>

    <nav class="nav-tab-wrapper">
        <a href="?post_type=books&page=wbg-search-panel-settings&tab=settings" class="nav-tab <?php if ( $tab != 'styles' ) { ?>nav-tab-active<?php } ?>">Settings</a>
        <a href="?post_type=books&page=wbg-search-panel-settings&tab=styles" class="nav-tab <?php if ( $tab === 'styles' ) { ?>nav-tab-active<?php } ?>">Styles</a>
    </nav>

    <div class="tab-content">
        <?php 
        switch ( $tab ) {
            case 'styles':
                ?>
                <form name="wbg_search_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-search-style-form">
                    <table class="form-table">
                        <tr class="wbg_btn_color">
                            <th scope="row">
                                <label for="wbg_btn_color"><?php esc_html_e('Button Color:', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input class="wbg-wp-color" type="text" name="wbg_btn_color" id="wbg_btn_color" value="<?php echo esc_attr( $wbg_btn_color ); ?>">
                                <div id="colorpicker"></div>
                            </td>
                        </tr>
                    </table>
                    <p class="submit"><button id="updateSearchStyles" name="updateSearchStyles" class="button button-primary"><?php esc_attr_e('Update Styles', WBG_TXT_DOMAIN); ?></button></p>

                </form>
                <?php
                break;
            default:
                ?>
                <form name="wbg_search_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-search-settings-form">
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
                                <label for="wbg_display_search_title"><?php esc_html_e('Search By Book Name?', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="wbg_display_search_title" class="wbg_display_search_title" value="1" <?php echo ( '1' === $wbg_display_search_title ) ? 'checked' : ''; ?> >
                            </td>
                        </tr>
                        <tr class="wbg_display_search_category">
                            <th scope="row">
                                <label for="wbg_display_search_category"><?php esc_html_e('Search By Category?', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="wbg_display_search_category" class="wbg_display_search_category" value="1" <?php echo ( '1' === $wbg_display_search_category ) ? 'checked' : ''; ?> >
                            </td>
                        </tr>
                        <tr class="wbg_display_search_author">
                            <th scope="row">
                                <label for="wbg_display_search_author"><?php esc_html_e('Search By Author?', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="wbg_display_search_author" class="wbg_display_search_author" value="1" <?php echo ( '1' === $wbg_display_search_author ) ? 'checked' : ''; ?> >
                            </td>
                        </tr>
                        <tr class="wbg_display_search_publisher">
                            <th scope="row">
                                <label for="wbg_display_search_publisher"><?php esc_html_e('Search By Publisher?', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="wbg_display_search_publisher" class="wbg_display_search_publisher" value="1" <?php echo ( '1' === $wbg_display_search_publisher ) ? 'checked' : ''; ?> >
                            </td>
                        </tr>
                        <tr class="wbg_cat_label_txt">
                            <th scope="row">
                                <label for="wbg_search_btn_txt"><?php esc_html_e('Search Button Text:', WBG_TXT_DOMAIN); ?></label>
                            </th>
                            <td>
                                <input type="text" name="wbg_search_btn_txt" placeholder="Search Books" class="medium-text"
                                    value="<?php echo esc_attr( $wbg_search_btn_txt ); ?>">
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit"><button id="updateSearchSettings" name="updateSearchSettings" class="button button-primary"><?php esc_attr_e('Update Settings', WBG_TXT_DOMAIN); ?></button></p>

                </form>
                <?php
                break;
        } 
        ?>
    </div>

</div>