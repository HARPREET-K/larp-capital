<?php
/**
 * Menu Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-lines',
    'title' => esc_html__('Menu', 'H-Code'),
    'desc' => esc_html__('Assign menu for header section.', 'H-Code'),
    'fields' => array(
        array(
            'id'       => 'hcode_enable_menu',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Menu', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'       => 'hcode_header_menu',
            'type'     => 'select',
            'data'     => 'menus',
            'title'    => esc_html__( 'Select Primary Menu', 'H-Code' ),
            'subtitle'    => esc_html__( 'You can manage menu using Appearance > Menus', 'H-Code' ),
        ),
        array(
            'id'       => 'hcode_header_secondary_menu',
            'type'     => 'select',
            'data'     => 'menus',
            'title'    => esc_html__( 'Select Secondary Menu', 'H-Code' ),
            'subtitle'    => esc_html__( 'Select secondary menu when you have set center logo within menu. You can manage center logo using Appearance > Theme Settings > Header. Also you can manage menu using Appearance > Menus', 'H-Code' ),
            'required'  => array('hcode_header_logo_position', 'equals', array('center') ),
        ),
        array(
            'id'        => 'hcode_menu_hover_delay',
            'type'      => 'text',
            'title'     => esc_html__( 'Menu Hover Delay', 'H-Code' ),
            'default' => '100',
        ),
    )
);