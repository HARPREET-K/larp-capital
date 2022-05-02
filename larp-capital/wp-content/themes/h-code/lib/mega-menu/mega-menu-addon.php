<?php
/**
 * H-Code Mega Menu Admin Options.
 *
 * @package H-Code
 */
?>
<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    die;
}
// http://wordpress.stackexchange.com/questions/33342/how-to-add-a-custom-field-in-the-advanced-menu-properties Thanks to "djrmom"
/*
 * Saves new field to postmeta for navigation
 */
add_action('wp_update_nav_menu_item', 'hcode_nav_option_update',10, 3);
if ( ! function_exists( 'hcode_nav_option_update' ) ) :
    function hcode_nav_option_update($menu_id, $menu_item_db_id, $args ) {
        
        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-item-status'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-item-status'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_item_status = $_REQUEST['menu-item-hcode-mega-menu-item-status'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_item_status', $hcode_mega_menu_item_status );

        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-single-item-status'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-single-item-status'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_single_item_status = $_REQUEST['menu-item-hcode-mega-menu-single-item-status'][$menu_item_db_id];

        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_single_item_status', $hcode_mega_menu_single_item_status );
        
        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-item-title-status'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-item-title-status'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_item_title_status = $_REQUEST['menu-item-hcode-mega-menu-item-title-status'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_item_title_status', $hcode_mega_menu_item_title_status );
        
        if( !isset( $_REQUEST['menu-item-hcode-mega-submenu-position'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-submenu-position'][$menu_item_db_id] = '';
        }
        $hcode_mega_submenu_position = $_REQUEST['menu-item-hcode-mega-submenu-position'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_submenu_position', $hcode_mega_submenu_position );
        
        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-columns'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-columns'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_columns = $_REQUEST['menu-item-hcode-mega-menu-columns'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_columns', $hcode_mega_menu_columns );

        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-item-icon'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-item-icon'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_item_icon = $_REQUEST['menu-item-hcode-mega-menu-item-icon'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_item_icon', $hcode_mega_menu_item_icon );

        if( !isset( $_REQUEST['menu-item-hcode-mega-menu-item-sidebar'][$menu_item_db_id] )) { 
            $_REQUEST['menu-item-hcode-mega-menu-item-sidebar'][$menu_item_db_id] = '';
        }
        $hcode_mega_menu_item_sidebar = $_REQUEST['menu-item-hcode-mega-menu-item-sidebar'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_hcode_mega_menu_item_sidebar', $hcode_mega_menu_item_sidebar );
    }
endif;

/*
 * Adds value of new field to $item object that will be passed to Hcode_Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','hcode_get_nav_post_meta' );
if ( ! function_exists( 'hcode_get_nav_post_meta' ) ) :
    function hcode_get_nav_post_meta($menu_item) {
        $menu_item->hcode_mega_menu_item_status = get_post_meta( $menu_item->ID, '_hcode_mega_menu_item_status', true );
        $menu_item->hcode_mega_menu_item_title_status = get_post_meta( $menu_item->ID, '_hcode_mega_menu_item_title_status', true );
        $menu_item->hcode_mega_submenu_position = get_post_meta( $menu_item->ID, '_hcode_mega_submenu_position', true );
        $menu_item->hcode_mega_menu_columns = get_post_meta( $menu_item->ID, '_hcode_mega_menu_columns', true );
        $menu_item->hcode_mega_menu_item_icon = get_post_meta( $menu_item->ID, '_hcode_mega_menu_item_icon', true );
        $menu_item->hcode_mega_menu_item_sidebar = get_post_meta( $menu_item->ID, '_hcode_mega_menu_item_sidebar', true );
        return $menu_item;
    }
endif;

add_filter( 'wp_edit_nav_menu_walker', 'hcode_custom_nav_edit_walker',10,2 );
if ( ! function_exists( 'hcode_custom_nav_edit_walker' ) ) :
    function hcode_custom_nav_edit_walker($walker,$menu_id) {
        return 'Hcode_Walker_Nav_Menu_Edit_Custom';
    }
endif;

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
if (!class_exists('Hcode_Walker_Nav_Menu_Edit_Custom')) {
    class Hcode_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    public $menu_icon_number = 1;

    public function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( esc_html__( '%s (Invalid)','H-Code'),$item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( esc_html__('%s (Pending)','H-Code'),$item->title );
        }

        $title = empty( $item->label ) ? $title : $item->label;

        $submenu_text = '';
        if ( 0 === $depth ) {
            $submenu_text = 'style="display: none;"';
        }

        ?>
        <li id="menu-item-<?php echo esc_attr( $item_id) ; ?>" class="<?php echo implode(' ', $classes ); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <label class="item-title" for="menu-item-checkbox-<?php echo $item_id; ?>">
                        <input id="menu-item-checkbox-<?php echo $item_id; ?>" type="checkbox" class="menu-item-checkbox" data-menu-item-id="<?php echo $item_id; ?>" disabled="disabled" />
                        <span class="menu-item-title"><?php echo esc_html( $title ); ?></span>
                        <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span>
                    </label>

                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-up"><abbr title="<?php esc_attr('Move up', 'H-Code'); ?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-down"><abbr title="<?php esc_attr('Move down', 'H-Code'); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr('Edit Menu Item', 'H-Code'); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'H-Code' ); ?></a></a>
                    </span>
                </dt>
            </dl>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                            <strong class="mega-menu-title"><?php esc_html_e( 'URL', 'H-Code' ); ?></strong>
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Navigation Label', 'H-Code' ); ?></strong>
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Title Attribute', 'H-Code' ); ?></strong>
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <strong><?php esc_html_e( 'Open link in a new window/tab', 'H-Code' ); ?></strong>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'CSS Classes (optional)', 'H-Code' ); ?></strong>
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Link Relationship (XFN)', 'H-Code' ); ?></strong>
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Description', 'H-Code' ); ?></strong>
                        <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'H-Code'); ?></span>
                    </label>
                </p>

                <?php /* Mega Menu Custom Field Start */ 
                    $item->hcode_mega_menu_item_status = get_post_meta( $item_id, '_hcode_mega_menu_item_status', true );
                    $item->hcode_mega_menu_single_item_status = get_post_meta( $item_id, '_hcode_mega_menu_single_item_status', true );
                    $item->hcode_mega_submenu_position = get_post_meta( $item_id, '_hcode_mega_submenu_position', true );
                    $item->hcode_mega_menu_item_title_status = get_post_meta( $item_id, '_hcode_mega_menu_item_title_status', true );
                    $item->hcode_mega_menu_columns = get_post_meta( $item_id, '_hcode_mega_menu_columns', true );
                    $item->hcode_mega_menu_item_icon = get_post_meta( $item_id, '_hcode_mega_menu_item_icon', true );
                    $item->hcode_mega_menu_item_sidebar = get_post_meta( $item_id, '_hcode_mega_menu_item_sidebar', true );
                ?>

                <div class="clear"></div>
                <div class="hcode-backhand-mega-menu-init" id="hcode-backhand-mega-menu-init">

                <?php /* Enable Mega Menu Item Status Start */ ?>
                <?php $title_status_checked = ''; ?>
                <?php 
                    $status_checked = $single_status_checked = '';
                ?>
                <?php if( $depth == 0 ) { ?>
                    <p class="field-hcode-mega-menu-single-item-status description description-wide">
                        <label for="edit-menu-item-hcode-mega-submenu-position-<?php echo esc_attr($item_id); ?>">
                            <strong class="mega-menu-title"><?php esc_html_e( 'Submenu Position', 'H-Code' ); ?></strong>
                            <select id="edit-menu-item-hcode-mega-submenu-position-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-hcode-mega-submenu-position" name="menu-item-hcode-mega-submenu-position[<?php echo esc_attr($item_id); ?>]">
                                <option <?php if( $item->hcode_mega_submenu_position == 'right' ) { echo 'selected="selected" '; }?> value="right"><?php esc_html_e( 'Right', 'H-Code' ); ?></option>
                                <option <?php if( $item->hcode_mega_submenu_position == 'left' ) { echo 'selected="selected" '; }?> value="left"><?php esc_html_e( 'Left', 'H-Code' ); ?></option>
                            </select>
                        </label>
                    </p>
                <?php } ?>
                <p class="field-hcode-mega-menu-single-item-status description description-wide">
                    <label for="edit-menu-item-hcode-mega-menu-single-item-status-<?php echo esc_attr($item_id); ?>">
                        <?php if($item->hcode_mega_menu_single_item_status == 'enabled') { $single_status_checked = 'checked="checked"'; } ?>
                        <input type="checkbox" id="edit-menu-item-hcode-mega-menu-single-item-status-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-hcode-mega-menu-single-item-status" name="menu-item-hcode-mega-menu-single-item-status[<?php echo esc_attr($item_id); ?>]" value="enabled" <?php echo esc_html($single_status_checked); ?> />
                        <strong><?php esc_html_e( 'Enable Onepage For This Item (only for main parent)', 'H-Code' ); ?></strong>
                    </label>
                </p>
                <p class="field-hcode-mega-menu-item-status description description-wide">
                    <label for="edit-menu-item-hcode-mega-menu-item-status-<?php echo esc_attr($item_id); ?>">
                        <?php if($item->hcode_mega_menu_item_status == 'enabled') { $status_checked = 'checked="checked"'; } ?>
                        <input type="checkbox" id="edit-menu-item-hcode-mega-menu-item-status-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-hcode-mega-menu-item-status" name="menu-item-hcode-mega-menu-item-status[<?php echo esc_attr($item_id); ?>]" value="enabled" <?php echo esc_html($status_checked); ?> />
                        <strong><?php esc_html_e( 'Enable H-Code Mega Menu For This Item (only for main parent)', 'H-Code' ); ?></strong>
                    </label>
                </p>
                <?php /* Enable Mega Menu Item Status End */ ?>

                <?php /* Enable Mega Menu Item Title Status Start */ ?>
                <p class="field-hcode-mega-menu-item-title-status description description-wide">
                    <label for="edit-menu-item-hcode-mega-menu-item-title-status-<?php echo esc_attr($item_id); ?>">
                        <?php if($item->hcode_mega_menu_item_title_status == 'enabled') { $title_status_checked = 'checked="checked"'; } ?>
                        <input type="checkbox" id="edit-menu-item-hcode-mega-menu-item-title-status-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-hcode-mega-menu-item-title-status" name="menu-item-hcode-mega-menu-item-title-status[<?php echo esc_attr($item_id); ?>]" value="enabled" <?php echo esc_html($title_status_checked); ?> />
                        <strong><?php esc_html_e( 'Enable H-Code Mega Menu Title For This Item (It Remove Url For This Item).', 'H-Code' ); ?></strong>
                    </label>
                </p>
                <?php /* Enable Mega Menu Item Title Status End */ ?>

                <?php /* Mega Menu column Start */ ?>
                <?php if($depth == 0 ){  ?>
                <p class="field-hcode-mega-menu-item-columns description description-wide">
                    <label for="edit-menu-item-hcode-mega-menu-columns-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Select Mega Menu Number of Columns', 'H-Code' ); ?></strong>
                        <select id="edit-menu-item-hcode-mega-menu-columns-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-hcode-mega-menu-columns" name="menu-item-hcode-mega-menu-columns[<?php echo esc_attr($item_id); ?>]">
                            <option <?php if( $item->hcode_mega_menu_columns == '1' ) { echo 'selected="selected" '; }?> value="1">1</option>
                            <option <?php if( $item->hcode_mega_menu_columns == '2' ) { echo 'selected="selected" '; }?> value="2">2</option>
                            <option <?php if( $item->hcode_mega_menu_columns == '3' ) { echo 'selected="selected" '; }?> value="3">3</option>
                            <option <?php if( $item->hcode_mega_menu_columns == '4' ) { echo 'selected="selected" '; }?> value="4">4</option>
                        </select>
                    </label>
                </p>
                <?php }?>
                <?php /* Mega Menu column End */ ?>

                <?php /* Set Mega Menu Item Icon Start */ ?>
                <p class="field-hcode-mega-menu-item-icon description description-wide">
                    <label for="edit-hcode-mega-menu-item-icon-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Select Mega Menu Item Icon', 'H-Code' ); ?></strong>
                        <?php echo '<select id="edit-menu-item-hcode-mega-menu-item-icon-'.$item_id.'" class="widefat code edit-menu-item-hcode-mega-menu-item-icon js-example-templating js-states"'.$this->menu_icon_number.' form-control" name="menu-item-hcode-mega-menu-item-icon['.$item_id.']"></select>'; ?>
                        <?php 
                            $fontawesome_solid_icon_lists = hcode_fontawesome_icons_solid();
                            $fontawesome_reg_icon_lists = hcode_fontawesome_icons_reg();
                            $fontawesome_brand_icon_lists = hcode_fontawesome_icons_brand();
                            $fontawesome_old_icon_lists = hcode_fontawesome_icons_old();
                            $select_id = $item_id;
                            echo '<select class="js-source-states">';
                            echo '<option id="'.$select_id.'" value="1">'.esc_html__( 'Select Menu Icon', 'H-Code' ).'</option>';
                            $value = $item->hcode_mega_menu_item_icon;

                            // Check and replace old Font Awesome Icons
                            if( $value ) {
                                if(array_key_exists($value, $fontawesome_old_icon_lists)){
                                  $value = $fontawesome_old_icon_lists[$value];
                                }else{
                                  if(in_array($value, $fontawesome_solid_icon_lists)){
                                      $value = 'fas '.$value;
                                  }else if(in_array($value, $fontawesome_reg_icon_lists)){
                                      $value = 'far '.$value;
                                  }else if(in_array($value, $fontawesome_brand_icon_lists)){
                                      $value = 'fab '.$value;
                                  }
                                }
                            }
                              
                            // Solid Font Awesome Icons
                            foreach ( $fontawesome_solid_icon_lists as $icon => $val ) {
                                
                                $selected = ( ( 'fas '.$val == $value ) ) ? ' selected="selected"' : '';
                                echo '<option '.$selected.' data="'.$value.' value, fas '.$val.' val, id='.$select_id.'" data-icon="fas '. $val .'" value="fas '. $val .'">fas '.htmlspecialchars( $val ).'</option>';
                            }

                            // Regular Font Awesome Icons
                            foreach ( $fontawesome_reg_icon_lists as $icon => $val ) {
                                
                                $selected = ( ( 'far '.$val == $value ) ) ? ' selected="selected"' : '';
                                echo '<option '.$selected.' data="'.$value.' value, far '.$val.' val, id='.$select_id.'" data-icon="far '. $val .'" value="far '. $val .'">far '.htmlspecialchars( $val ).'</option>';
                            }

                            // Brand Font Awesome Icons
                            foreach ( $fontawesome_brand_icon_lists as $icon => $val ) {
                                
                                $selected = ( ( 'fab '.$val == $value ) ) ? ' selected="selected"' : '';
                                echo '<option '.$selected.' data="'.$value.' value, fab '.$val.' val, id='.$select_id.'" data-icon="fab '. $val .'" value="fab '. $val .'">fab '.htmlspecialchars( $val ).'</option>';
                            }
                            echo '</select>';
                        ?>
                    </label>
                </p>
                <?php /* Set Mega Menu Item Icon End */ ?>

                <p class="field-hcode-mega-menu-item-sidebar description description-wide">
                    <label for="edit-hcode-mega-menu-item-sidebar-<?php echo esc_attr($item_id); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'Select Mega Menu Item Sidebar', 'H-Code' ); ?></strong>
                        <?php 
                            echo '<select id="edit-menu-item-hcode-mega-menu-item-sidebar-'.$item_id.'" class="widefat code edit-menu-item-hcode-mega-menu-item-sidebar" name="menu-item-hcode-mega-menu-item-sidebar['.$item_id.']">';
                                global $wp_registered_sidebars;
                                if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ){ 
                                    echo '<option value="0">'.esc_html__( 'Select Widget Area', 'H-Code' ).'</option>';
                                    foreach( $wp_registered_sidebars as $sidebar ){
                                        $sidebar_value = $item->hcode_mega_menu_item_sidebar;
                                        $selected = ( ( $sidebar_value == $sidebar['id'] ) ) ? ' selected="selected"' : '';
                                        echo '<option '.$selected.' sidebar-id="'. $sidebar['id'] .'" value="'. $sidebar['id'] .'">'.htmlspecialchars( $sidebar['name'] ).'</option>';
                                    }
                                }
                            echo '</select>';
                        ?>
                    </label>
                </p>

                <?php /* Set Mega Menu Item As Sidebar End */ ?>

                </div>
                <?php /* end added field */ ?>
                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span><?php esc_html_e( 'Move', 'H-Code' ); ?></span>
                        <a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'H-Code' ); ?></a>
                        <a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'H-Code' ); ?></a>
                        <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                        <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                        <a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'H-Code' ); ?></a>
                    </label>
                </p>
                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( esc_html__('Original: %s','H-Code'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php esc_html_e('Remove','H-Code'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                        ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'H-Code'); ?></a>
                </div>
                <div class="clear"></div>
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>

        <?php
        $output .= ob_get_clean();
        }
    }
}

/*==============================================================*/
// H-Code Mega Menu Front walkar
/*==============================================================*/
if (!class_exists('Hcode_Mega_Menu_Walker')) {
    class Hcode_Mega_Menu_Walker extends Walker_Nav_Menu {

        public $hcode_mega_menu_item_status_for_all = '';

        public $mega_menu_sub = 1;
        public $mega_menu_sub_status = '';
        public $mega_menu_column_count;

        public $get_first_level_menu_id = '';

        /**
         * Starts the list before the elements are added.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $mega_menu_sub_ul_id = $this->mega_menu_sub;
            $megamenu_class = ( $this->mega_menu_sub_status == 'enabled' ) ? ' mega-menu-full' : '';
            switch ($depth) {
                case 0:
                    $output .= "\n$indent<ul id=\"collapse".$mega_menu_sub_ul_id."\" class=\"dropdown-menu mega-menu panel-collapse collapse".$megamenu_class."\">\n";
                    $this->mega_menu_column_count = 1;
                    break;
                case 1:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
                    break;
                case 2:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
                    break;
                default:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
            }        
        }

        /**
         * Ends the list of after the elements are added.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            
            if( $depth == 0){
                $this->get_first_level_menu_id = '';
            }

            $output .= "$indent</ul>\n";
        }

        /**
         * Start the element output.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Get All Postmeta Of Current Item
            $attribute_class = $mega_menu_attribute = $col_setting = '';
            $hcode_mega_menu_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_item_status', true );
            $hcode_mega_menu_single_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_single_item_status', true );
            $hcode_mega_submenu_position = get_post_meta( $item->ID, '_hcode_mega_submenu_position', true );
            $hcode_mega_menu_item_title_status = get_post_meta( $item->ID, '_hcode_mega_menu_item_title_status', true );
            $hcode_mega_menu_columns = get_post_meta( $item->ID, '_hcode_mega_menu_columns', true );
            $hcode_mega_menu_item_icon = get_post_meta( $item->ID, '_hcode_mega_menu_item_icon', true );
            $hcode_mega_menu_item_sidebar = get_post_meta( $item->ID, '_hcode_mega_menu_item_sidebar', true );

            //Replace old Awesome Font Icons

            $hcode_fontawesome_solid_icon_lists = hcode_fontawesome_icons_solid();
            $hcode_fontawesome_reg_icon_lists = hcode_fontawesome_icons_reg();
            $hcode_fontawesome_brand_icon_lists = hcode_fontawesome_icons_brand();
            $hcode_fontawesome_old_icon_lists = hcode_fontawesome_icons_old();

            if( $hcode_mega_menu_item_icon ) {
                if( array_key_exists( $hcode_mega_menu_item_icon, $hcode_fontawesome_old_icon_lists ) ) {
                  $hcode_mega_menu_item_icon = $hcode_fontawesome_old_icon_lists[$hcode_mega_menu_item_icon];
                } else {
                    if( in_array( $hcode_mega_menu_item_icon, $hcode_fontawesome_solid_icon_lists ) ) {
                        $hcode_mega_menu_item_icon = 'fas '.$hcode_mega_menu_item_icon;
                    } else if( in_array( $hcode_mega_menu_item_icon, $hcode_fontawesome_reg_icon_lists ) ) {
                        $hcode_mega_menu_item_icon = 'far '.$hcode_mega_menu_item_icon;
                    } else if( in_array( $hcode_mega_menu_item_icon, $hcode_fontawesome_brand_icon_lists ) ) {
                        $hcode_mega_menu_item_icon = 'fab '.$hcode_mega_menu_item_icon;
                    }
                }
            }

            // Get parent data second level
            $hcode_mega_menu_parent_item_status = get_post_meta( $item->menu_item_parent, '_hcode_mega_menu_item_status', true );
            $hcode_mega_menu_parent_columns = get_post_meta( $item->menu_item_parent, '_hcode_mega_menu_columns', true );

            //Get parent data third level
            $hcode_get_first_level_status = get_post_meta( $this->get_first_level_menu_id, '_hcode_mega_menu_item_status', true );

            $this->mega_menu_sub_status = $hcode_mega_menu_item_status;

            if( $depth == 0 ){
                $this->hcode_mega_menu_item_status_for_all = $hcode_mega_menu_item_status;
            }

            if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' ){
                $this->get_first_level_menu_id = $item->ID;
                $classes[] = 'menu-first-level';
            }

            if( $depth == 0 && $hcode_mega_menu_item_status != 'enabled' ) {
                if( $hcode_mega_submenu_position == 'left' ) {
                    $classes[] = 'simple-dropdown-left';
                } else {
                    $classes[] = 'simple-dropdown-right';
                }   
            }

            switch ($depth) {
                case 0:
                    ($hcode_mega_menu_item_status == 'enabled') ? $classes[] = "dropdown mega-menu-dropdown" : $classes[] = "dropdown simple-dropdown";
                    ( $hcode_mega_menu_columns && $hcode_mega_menu_item_status == 'enabled' ) ? $classes[] = 'megamenu-column-'.$hcode_mega_menu_columns : '';
                        //if( $hcode_mega_menu_single_item_status == 'enabled' ):
                            $attribute_class .= ' class="dropdown-toggle collapsed "';
                            $mega_menu_attribute = ' data-hover="dropdown" data-toggle="collapse"';
                        //endif;
                    break;
                case 1:
                    if( $hcode_mega_menu_parent_item_status == 'enabled' ){
                        $classes[] = "mega-menu-column";
                        $attribute_class .= ' class="dropdown-header"';
                        $mega_menu_attribute = '';

                        switch ($hcode_mega_menu_parent_columns) {
                            case '1':
                                $classes[] = "col-sm-12";
                                break;

                            case '2':
                                $classes[] = "col-sm-6";
                                break;

                            case '3':
                                $classes[] = "col-sm-4";
                                break;

                            case '4':
                                $classes[] = "col-sm-3";
                                break;

                            default:
                                $classes[] = "col-sm-3";
                                break;
                        }

                        $clear_both_positions = array($hcode_mega_menu_parent_columns+1, 2*$hcode_mega_menu_parent_columns+1, 3*$hcode_mega_menu_parent_columns+1, 4*$hcode_mega_menu_parent_columns+1, 5*$hcode_mega_menu_parent_columns+1);

                        if (in_array($this->mega_menu_column_count, $clear_both_positions)) {
                            $classes[] = "clear-both";
                        }

                        $this->mega_menu_column_count++;
                    }else{
                        $classes[] = "";
                    }
                    break;
                case 2:
                    $classes[] = "";
                    break;
                default:
                    $classes[] = "dropdown";
            }

            /**
             * Filter the CSS class(es) applied to a menu item's list item element.
             */
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . ' dropdown-toggle collapsed"' : '';

            $megamenu_attributs = ' data-toggle="collapse" data-parent="#accordion" data-hover="dropdown"';
            /**
             * Filter the ID applied to a menu item's list item element.
             */
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            if( $depth == 0 ) {
                $atts['href']   = ! empty( $item->url )        ? $item->url        : '#';
            } else {
                $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
            }
            
            /**
             * Filter the HTML attributes applied to a menu item's anchor element.
             */
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

            $attributes = $icon_attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    
                    if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' && $attr == 'href' ){
                        $attributes .= ' ' . $attr . '="#collapse'.$this->mega_menu_sub.'" data-redirect-url="' . $value . '" data-default-url="#collapse'.$this->mega_menu_sub.'"';
                        $icon_attributes .= ' ' . $attr . '="#collapse'.$this->mega_menu_sub.'"';
                    }else{
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
            }

            $item_output = $args->before;
            
            if( $hcode_mega_menu_single_item_status == 'enabled' ){
                $item_output .= '<a'. $attributes .' class="inner-link">';
                
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                
                $item_output .= '</a>';

            }elseif( $hcode_mega_menu_item_sidebar && $hcode_mega_menu_item_sidebar != '0' && $hcode_get_first_level_status == 'enabled'){

                ob_start();
                dynamic_sidebar( $hcode_mega_menu_item_sidebar );
                $item_output .= ob_get_clean();

            }elseif($hcode_mega_menu_item_title_status != '' && $depth == 1 && $hcode_get_first_level_status == 'enabled'){
                $item_output .= '<div'.$attribute_class.'>';
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 0 && $hcode_mega_menu_item_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 1 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 2 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    
                    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                    /* Check If Item Has Children */
                    $item_output .= ((($item -> hasChildren && $depth == 1 && $hcode_mega_menu_parent_item_status != 'enabled' )) ? '<i class="fas fa-angle-right"></i>' : '' );
                $item_output .= '</div>';

            }else{

                $item_output .= '<a'. $attributes . $attribute_class. $mega_menu_attribute .'>';

                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 0 && $hcode_mega_menu_item_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 1 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 2 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                
                $item_output .= ( $item->hasChildren && ( $this->hcode_mega_menu_item_status_for_all != 'enabled' ) && ( $depth != 0 ) ) ? '<i class="fas fa-angle-right"></i>' : '';
                
                
                $item_output .= '</a>';

                if( $item -> hasChildren && $depth == 0 ):
                    $attribute_class_icon = '';
                    $attribute_class_icon = ' class="dropdown-toggle collapsed megamenu-right-icon"';

                    $item_output .= '<a'. $icon_attributes . $attribute_class_icon. $mega_menu_attribute .'>';
                    
                    /* Check If Item Has Children */
                    $item_output .= '<i class="fas fa-angle-down megamenu-mobile-icon"></i>';
                    
                    $item_output .= '</a>';
                endif;
            }
            $item_output .= $args->after;

            /**
             * Filter a menu item's starting output.
             */
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
        }

        /**
         * Ends the element output, if needed.
         */
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";

            $hcode_mega_menu_single_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_single_item_status', true );
            if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' ){
                $this->mega_menu_sub++;
            }
        }

        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            // check, whether there are children for the given ID and append it to the element with a (new) ID
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }
}

/*==============================================================*/
// H-Code Mega Menu For Second Menu walkar
/*==============================================================*/
if (!class_exists('Hcode_Second_Mega_Menu_Walker')) {
    class Hcode_Second_Mega_Menu_Walker extends Walker_Nav_Menu {

        public $hcode_mega_menu_item_status_for_all = '';

        public $mega_menu_sub = 100;
        public $mega_menu_sub_status = '';
        public $mega_menu_column_count;

        public $get_first_level_menu_id = '';

        /**
         * Starts the list before the elements are added.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $mega_menu_sub_ul_id = $this->mega_menu_sub;
            $megamenu_class = ( $this->mega_menu_sub_status == 'enabled' ) ? ' mega-menu-full' : '';
            switch ($depth) {
                case 0:
                    $output .= "\n$indent<ul id=\"collapse".$mega_menu_sub_ul_id."\" class=\"dropdown-menu mega-menu panel-collapse collapse".$megamenu_class."\">\n";
                    $this->mega_menu_column_count = 1;
                    break;
                case 1:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
                    break;
                case 2:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
                    break;
                default:
                    $output .= "\n$indent<ul class=\"mega-sub-menu\">\n";
            }        
        }

        /**
         * Ends the list of after the elements are added.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            
            if( $depth == 0){
                $this->get_first_level_menu_id = '';
            }

            $output .= "$indent</ul>\n";
        }

        /**
         * Start the element output.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Get All Postmeta Of Current Item
            $attribute_class = $mega_menu_attribute = $col_setting = '';
            $hcode_mega_menu_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_item_status', true );
            $hcode_mega_menu_single_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_single_item_status', true );
            $hcode_mega_submenu_position = get_post_meta( $item->ID, '_hcode_mega_submenu_position', true );
            $hcode_mega_menu_item_title_status = get_post_meta( $item->ID, '_hcode_mega_menu_item_title_status', true );
            $hcode_mega_menu_columns = get_post_meta( $item->ID, '_hcode_mega_menu_columns', true );
            $hcode_mega_menu_item_icon = get_post_meta( $item->ID, '_hcode_mega_menu_item_icon', true );
            $hcode_mega_menu_item_sidebar = get_post_meta( $item->ID, '_hcode_mega_menu_item_sidebar', true );

            // Get parent data second level
            $hcode_mega_menu_parent_item_status = get_post_meta( $item->menu_item_parent, '_hcode_mega_menu_item_status', true );
            $hcode_mega_menu_parent_columns = get_post_meta( $item->menu_item_parent, '_hcode_mega_menu_columns', true );

            //Get parent data third level
            $hcode_get_first_level_status = get_post_meta( $this->get_first_level_menu_id, '_hcode_mega_menu_item_status', true );

            $this->mega_menu_sub_status = $hcode_mega_menu_item_status;

            if( $depth == 0 ){
                $this->hcode_mega_menu_item_status_for_all = $hcode_mega_menu_item_status;
            }

            if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' ){
                $this->get_first_level_menu_id = $item->ID;
                $classes[] = 'menu-first-level';
            }

            if( $depth == 0 && $hcode_mega_menu_item_status != 'enabled' ) {
                if( $hcode_mega_submenu_position == 'left' ) {
                    $classes[] = 'simple-dropdown-left';
                } else {
                    $classes[] = 'simple-dropdown-right';
                }   
            }

            switch ($depth) {
                case 0:
                    ($hcode_mega_menu_item_status == 'enabled') ? $classes[] = "dropdown mega-menu-dropdown" : $classes[] = "dropdown simple-dropdown";
                    ( $hcode_mega_menu_columns && $hcode_mega_menu_item_status == 'enabled' ) ? $classes[] = 'megamenu-column-'.$hcode_mega_menu_columns : '';
                        //if( $hcode_mega_menu_single_item_status == 'enabled' ):
                            $attribute_class .= ' class="dropdown-toggle collapsed "';
                            $mega_menu_attribute = ' data-hover="dropdown" data-toggle="collapse"';
                        //endif;
                    break;
                case 1:
                    if( $hcode_mega_menu_parent_item_status == 'enabled' ){
                        $classes[] = "mega-menu-column";
                        $attribute_class .= ' class="dropdown-header"';
                        $mega_menu_attribute = '';

                        switch ($hcode_mega_menu_parent_columns) {
                            case '1':
                                $classes[] = "col-sm-12";
                                break;

                            case '2':
                                $classes[] = "col-sm-6";
                                break;

                            case '3':
                                $classes[] = "col-sm-4";
                                break;

                            case '4':
                                $classes[] = "col-sm-3";
                                break;

                            default:
                                $classes[] = "col-sm-3";
                                break;
                        }

                        $clear_both_positions = array($hcode_mega_menu_parent_columns+1, 2*$hcode_mega_menu_parent_columns+1, 3*$hcode_mega_menu_parent_columns+1, 4*$hcode_mega_menu_parent_columns+1, 5*$hcode_mega_menu_parent_columns+1);

                        if (in_array($this->mega_menu_column_count, $clear_both_positions)) {
                            $classes[] = "clear-both";
                        }

                        $this->mega_menu_column_count++;
                    }else{
                        $classes[] = "";
                    }
                    break;
                case 2:
                    $classes[] = "";
                    break;
                default:
                    $classes[] = "dropdown";
            }

            /**
             * Filter the CSS class(es) applied to a menu item's list item element.
             */
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . ' dropdown-toggle collapsed"' : '';

            $megamenu_attributs = ' data-toggle="collapse" data-parent="#accordion" data-hover="dropdown"';
            /**
             * Filter the ID applied to a menu item's list item element.
             */
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            if( $depth == 0 ) {
                $atts['href']   = ! empty( $item->url )        ? $item->url        : '#';
            } else {
                $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
            }
            
            /**
             * Filter the HTML attributes applied to a menu item's anchor element.
             */
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

            $attributes = $icon_attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    
                    if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' && $attr == 'href' ){
                        $attributes .= ' ' . $attr . '="#collapse'.$this->mega_menu_sub.'" data-redirect-url="' . $value . '" data-default-url="#collapse'.$this->mega_menu_sub.'"';
                        $icon_attributes .= ' ' . $attr . '="#collapse'.$this->mega_menu_sub.'"';
                    }else{
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
            }

            $item_output = $args->before;
            
            if( $hcode_mega_menu_single_item_status == 'enabled' ){
                $item_output .= '<a'. $attributes .' class="inner-link">';
                
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                
                $item_output .= '</a>';

            }elseif( $hcode_mega_menu_item_sidebar && $hcode_mega_menu_item_sidebar != '0' && $hcode_get_first_level_status == 'enabled' ){

                ob_start();
                dynamic_sidebar( $hcode_mega_menu_item_sidebar );
                $item_output .= ob_get_clean();

            }elseif($hcode_mega_menu_item_title_status != '' && $depth == 1 && $hcode_get_first_level_status == 'enabled'){
                $item_output .= '<div'.$attribute_class.'>';
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 0 && $hcode_mega_menu_item_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 1 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 2 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                    
                    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                    /* Check If Item Has Children */
                    $item_output .= ((($item -> hasChildren && $depth == 1 && $hcode_mega_menu_parent_item_status != 'enabled' )) ? '<i class="fas fa-angle-right"></i>' : '' );
                $item_output .= '</div>';

            }else{

                $item_output .= '<a'. $attributes . $attribute_class. $mega_menu_attribute .'>';

                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 0 && $hcode_mega_menu_item_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 1 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                ( ( $hcode_mega_menu_item_icon != '' && $hcode_mega_menu_item_icon != '1' && $depth == 2 && $hcode_get_first_level_status == 'enabled') ? $item_output .= '<i class="'.$hcode_mega_menu_item_icon.' menu-icon-left"></i>' : '');
                
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                
                $item_output .= ( $item->hasChildren && ( $this->hcode_mega_menu_item_status_for_all != 'enabled' ) && ( $depth != 0 ) ) ? '<i class="fas fa-angle-right"></i>' : '';
                
                
                $item_output .= '</a>';

                if( $item -> hasChildren && $depth == 0 ):
                    $attribute_class_icon = '';
                    $attribute_class_icon = ' class="dropdown-toggle collapsed megamenu-right-icon"';

                    $item_output .= '<a'. $icon_attributes . $attribute_class_icon. $mega_menu_attribute .'>';
                    
                    /* Check If Item Has Children */
                    $item_output .= '<i class="fas fa-angle-down megamenu-mobile-icon"></i>';
                    
                    $item_output .= '</a>';
                endif;
            }
            $item_output .= $args->after;

            /**
             * Filter a menu item's starting output.
             */
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
        }

        /**
         * Ends the element output, if needed.
         */
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";

            $hcode_mega_menu_single_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_single_item_status', true );
            if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' ){
                $this->mega_menu_sub++;
            }
        }

        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            // check, whether there are children for the given ID and append it to the element with a (new) ID
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }
}
?>