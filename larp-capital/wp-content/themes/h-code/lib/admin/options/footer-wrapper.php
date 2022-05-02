<?php
/**
 * Footer Wrapper Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fas fa-server',
    'title' => esc_html__('Footer Wrapper', 'H-Code'),
    'fields' => array(
        array(
            'id'       => 'hcode_enable_footer_wrapper',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Wrapper', 'H-Code'),
            'default'  => false,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_enable_phone_number',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Phone Number', 'H-Code'),
            'default'  => true,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_phone_icon',
            'type'     => 'switch',
            'title'    => esc_html__('Custom Phone Icon', 'H-Code'),
            'default'  => false,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_phone_icon',
            'type'     => 'select',
            'title'    => esc_html__('Phone Icon', 'H-Code'),
            'data'     => 'elusive-icons',
            'required' => array('hcode_footer_wrapper_custom_phone_icon', 'equals', '0'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_phone_icon_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'H-Code' ),
            'subtitle' => esc_html__('Recommended image size (25px X 25px)', 'H-Code'),
            'required' => array('hcode_footer_wrapper_custom_phone_icon', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_phone_text',
            'type'     => 'textarea',
            'title'    => esc_html__('Phone Number Text', 'H-Code'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_enable_map',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Map', 'H-Code'),
            'default'  => true,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_map_icon',
            'type'     => 'switch',
            'title'    => esc_html__('Custom Map Icon', 'H-Code'),
            'default'  => false,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_map_icon',
            'type'     => 'select',
            'title'    => esc_html__('Map Icon', 'H-Code'),
            'data'     => 'elusive-icons',
            'required' => array('hcode_footer_wrapper_custom_map_icon', 'equals', '0'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_map_icon_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'H-Code' ),
            'subtitle' => esc_html__('Recommended image size (25px X 25px)', 'H-Code'),
            'required' => array('hcode_footer_wrapper_custom_map_icon', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_map_text',
            'type'     => 'textarea',
            'title'    => esc_html__('Map Address Text', 'H-Code'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_enable_email',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Email', 'H-Code'),
            'default'  => true,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_email_icon',
            'type'     => 'switch',
            'title'    => esc_html__('Custom Email Icon', 'H-Code'),
            'default'  => false,
            '1'        => 'On',
            '0'        => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_wrapper_email_icon',
            'type'     => 'select',
            'title'    => esc_html__('Email Icon', 'H-Code'),
            'data'     => 'elusive-icons',
            'required' => array('hcode_footer_wrapper_custom_email_icon', 'equals', '0'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_custom_email_icon_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'H-Code' ),
            'subtitle' => esc_html__('Recommended image size (25px X 25px)', 'H-Code'),
            'required' => array('hcode_footer_wrapper_custom_email_icon', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_email_id',
            'type'     => 'textarea',
            'title'    => esc_html__('Email Address', 'H-Code'),
        ),
    )
);