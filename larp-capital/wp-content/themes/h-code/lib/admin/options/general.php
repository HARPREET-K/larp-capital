<?php
/**
 * General Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$accordian_content_start = $url_slug = $categories_url_slug = $tags_url_slug = $accordian_content_end = $hcode_enable_under_construction = '';
if(class_exists( 'Hcode_Addons_Post_Type' )){

    if ( function_exists( 'hcode_under_construction_theme_option' ) ) {
        $hcode_enable_under_construction = hcode_under_construction_theme_option();
    }

    $accordian_content_start = array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Portfolio Rewrite / URL Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Set portfolio, categories and tags url slug. After updating slug in this setting please go to Settings > Permalinks and click Save Changes button to have this new url slug change affected in your overall website.', 'H-Code' ),
            'position'  => 'start'
        );
    $url_slug = array(
            'id'        => 'hcode_portfolio_url_slug',
            'type'      => 'text',
            'title'     => esc_html__('Portfolio URL Slug', 'H-Code' ),
        );
    $categories_url_slug = array(
            'id'        => 'hcode_portfolio_categories_url_slug',
            'type'      => 'text',
            'title'     => esc_html__('Categories URL Slug', 'H-Code' ),
        );
    $tags_url_slug = array(
            'id'        => 'hcode_portfolio_tags_url_slug',
            'type'      => 'text',
            'title'     => esc_html__('Tags URL Slug', 'H-Code' ),
        );
    $accordian_content_end = array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        );
}


$this->sections[] = array(
    'icon' => 'el-icon-adjust-alt',
    'title' => esc_html__('General', 'H-Code' ),
    'fields' => array(
        $hcode_enable_under_construction,
        array(
            'id'       => 'sidebar_creation',
            'type'     => 'multi_text',
            'title'    => esc_html__( 'Custom Sidebars', 'H-Code' ),
            'subtitle' => esc_html__( 'Custom sidebars can be assigned to any post or pages ', 'H-Code' ),
            'desc' => esc_html__('You can add multiple custom sidebars', 'H-Code' ),
        ),
        array(
            'id'       => 'general_css_code',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'H-Code' ),
            'subtitle' => esc_html__('Add your custom CSS code here', 'H-Code' ),
            'mode'     => 'css',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id' => 'tracking',
            'type' => 'info_title',
            'title' => esc_html__('Any Tracking Code / Space Before Head End Tag / Space Before Body End Tag', 'H-Code' ),
        ),
        array(
            'id'       => 'tracking_code',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Any Tracking Code', 'H-Code' ),
            'subtitle' => esc_html__( 'Paste your google analytics (GA) or other tracking code here. This will be added into the &lt;/head&gt; tag. Please put code with script tags.', 'H-Code' ),
        ),
        array(
            'id'       => 'space_before_head',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Space Before &lt;/head&gt;', 'H-Code' ),
            'subtitle' => esc_html__( 'Code that you want to add before the &lt;/head&gt; tag', 'H-Code' ),
        ),
        array(
            'id'       => 'space_before_body',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Space Before &lt;/body&gt;', 'H-Code' ),
            'subtitle' => esc_html__( 'Code that you want to add before the &lt;/body&gt; tag', 'H-Code' ),
        ),
        array(
            'id'       => 'hcode_header_top_offset',
            'type'     => 'text',
            'title'    => esc_html__('Header Offset', 'H-Code' ),
            'default'  => '0',
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Favicon Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set favicon for general desktop, Apple iPhone, Apple iPhone Retina, Apple iPad, Apple iPad Retina', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'enable_theme_favicon',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Favicon', 'H-Code' ),
            'subtitle'  => esc_html__( 'Select off to load favicon from Customize Panel.', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'       => 'default_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Favicon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for your website (32px x 32px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPhone_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone (57px x 57px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPhone_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Retina Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone retina version (149px x 149px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPad_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad (72px x 72px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPad_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Retina Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad retina version (149px x 149px)', 'H-Code' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Image Meta Data Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set visibility for image alt, title and caption', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'enable_image_alt',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Alt', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'       => 'enable_image_title',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Title', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_title',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Title in Lightbox Popup', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_caption',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Caption in Lightbox Popup', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Search Block Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set search placeholder text.', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_search_placeholder_text',
            'type'     => 'text',
            'title'    => esc_html__('Placeholder Text', 'H-Code' ),
            'default'  => 'Enter your keywords...',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Post Default Image Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Upload your default image which will be displayed in portfolio and blog post grid / list if there is no featured image assigned to post.', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_no_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'H-Code' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Popup Cursor Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Enable / Disable + / - cursor or upload your custom cursor image (32px X 32px size)', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_show_default_cursor_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Cursor', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'       => 'hcode_default_open_cursor_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Cursor Image for Open Popup', 'H-Code' ),
            'required'  => array( 'hcode_show_default_cursor_image', 'equals', array( '1' ) ),
        ),
        array(
            'id'       => 'hcode_default_close_cursor_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Cursor Image for Close Popup', 'H-Code' ),
            'required'  => array( 'hcode_show_default_cursor_image', 'equals', array( '1' ) ),
        ),
        array(
            'id'       => 'hcode_popup_on_click_close',
            'type'     => 'switch',
            'title'    => esc_html__( 'Close Popup on Click', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        $accordian_content_start,
        $url_slug, 
        $categories_url_slug,
        $tags_url_slug,
        $accordian_content_end,

        array(
            'id'        => 'hcode_general_bg_image_content',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Background image settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'You can set Background image for whole website', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_general_bg_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Background image', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_general_bg_image_content',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'hcode_general_header_top_space',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Header Add / Remove Top Space', 'H-Code' ),
            'subtitle'  => esc_html__( 'Add / remove top space for the first content section', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_top_header_space_all',
            'type'     => 'switch',
            'title'    => esc_html__( 'Add top space', 'H-Code' ),
            'desc' => esc_html__('Select on to add top space in first content section for transparent headers like ( Light Header, Dark Transparent Header, Light Transparent Header, Hamburger Header 2 ).', 'H-Code'),
        ),
        array(
            'id'       => 'hcode_remove_top_header_space_all',
            'type'     => 'switch',
            'title'    => esc_html__( 'Remove top space', 'H-Code' ),
            'desc' => esc_html__('Select on to remove top space in first content section for headers like ( Dark Header, Static Sticky Header, White Sticky Header, Gray Header, Non Sticky Header, Hamburger Header 3 ).', 'H-Code'),
        ),
        array(
            'id'        => 'hcode_general_bg_image_content',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'hcode_custom_header_start',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Header Image Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Set your header image height and width', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_custom_header_height',
            'type'     => 'text',
            'title'    => esc_html__( 'Header Image Height', 'H-Code' ),
            'subtitle' => esc_html__( 'Specify the height in pixel eg. 104px', 'H-Code' ),

        ),
        array(
            'id'       => 'hcode_custom_header_width',
            'type'     => 'text',
            'title'    => esc_html__( 'Header Image Width', 'H-Code' ),
            'subtitle' => esc_html__( 'Specify the width in pixel eg. 1838px', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_custom_header_end',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'hcode_general_remove_third_party_style',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Remove Third Party Font Awesome Style', 'H-Code' ),
            'subtitle'  => esc_html__( 'You can remove third party font awesome style from site', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_remove_font_awesome_third_party_style',
            'type'     => 'switch',
            'title'    => esc_html__( 'Remove Font Awesome Style', 'H-Code' ),
            'desc' => esc_html__('Select on to remove third party font awesome style', 'H-Code'),
            'default'  => true,
        ),
        array(
            'id'        => 'hcode_general_remove_third_party_style',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);