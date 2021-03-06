<?php
/**
 * General Layout Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$search_content = '';
if( class_exists( 'WooCommerce' ) ) {
    $search_content = array(
                'only-page' => esc_html__( 'Page', 'H-Code' ),
                'only-post' => esc_html__( 'Post', 'H-Code' ),
                'only-portfolio' => esc_html__( 'Portfolio', 'H-Code' ),
                'only-product' => esc_html__( 'Product', 'H-Code' ),
            );
} else {
    $search_content = array(
                'only-page' => esc_html__( 'Page', 'H-Code' ),
                'only-post' => esc_html__( 'Post', 'H-Code' ),
                'only-portfolio' => esc_html__( 'Portfolio', 'H-Code' ),
            );

}
$search_content = apply_filters( 'hcode_search_custom_post_types', $search_content );
$this->sections[] = array(
    'icon' => 'el-icon-cogs',
    'title' => esc_html__( 'Layout Settings', 'H-Code' ),
    'fields' => array(
    	
        array(
            'id'        => 'hcode_layout_settings',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_layout_full_screen' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => 'hcode_layout_full_screen',
                ),
                'hcode_layout_left_sidebar' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => 'hcode_layout_left_sidebar',
                ),
                'hcode_layout_right_sidebar' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => 'hcode_layout_right_sidebar',
                ),
                'hcode_layout_both_sidebar' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => 'hcode_layout_both_sidebar',
                ),
            ),
            'default'   => 'hcode_layout_full_screen'
        ),
        array(
            'id'        => 'hcode_enable_container_fluid',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_layout_settings', 'equals', 'hcode_layout_full_screen' ),
        ),
        array(
            'id'        => 'hcode_layout_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings', 'equals', array( 'hcode_layout_left_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_layout_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings', 'equals', array( 'hcode_layout_right_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),

        array(
            'id'        => 'hcode_enable_page_feature_image',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Page Featured Image', 'H-Code' ),
            'default'   => false,
        ),

        /* Blog Page Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Default Posts / Blog Page Layout Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Settings for default posts / blog landing page', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_blog_page_settings',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_blog_page_full_screen' => array(
                    'alt' => esc_html__( 'One Column', 'H-Code' ),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'hcode_blog_page_left_sidebar' => array(
                    'alt' => esc_html__( 'Two Columns Left', 'H-Code' ),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'hcode_blog_page_right_sidebar' => array(
                    'alt' => esc_html__( 'Two Columns Right', 'H-Code' ),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'hcode_blog_page_both_sidebar' => array(
                    'alt' => esc_html__( 'Three Columns', 'H-Code' ),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'   => 'hcode_blog_page_full_screen'
        ),
        array(
            'id'        => 'hcode_blog_page_enable_container_fluid',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_blog_page_settings', 'equals', 'hcode_blog_page_full_screen' ),
        ),
        array(
            'id'        => 'hcode_blog_page_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_blog_page_settings', 'equals', array( 'hcode_blog_page_left_sidebar', 'hcode_blog_page_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_blog_page_settings', 'equals', array( 'hcode_blog_page_right_sidebar', 'hcode_blog_page_both_sidebar' ) ),
        ),
        array(
          'id'          => 'hcode_blog_page_thumbnail_size',
          'type'        => 'select',
          'data'        => 'srcset',
          'title'       => esc_html__( 'Post Thumbnail Size', 'H-Code' ),
          'default'     => 'full',
        ),
        array(
          'id'          => 'hcode_blog_page_title',
          'type'        => 'text',
          'title'       => esc_html__( 'Blog Page Title', 'H-Code' ),
          'default'     => 'Blog',
        ),
        array(
            'id'        => 'hcode_blog_page_grid_layout',
            'type'      => 'select',
            'title'     => esc_html__( 'Blog Layout', 'H-Code' ),
            'options'   => array(
                'grid'    => esc_html__( 'Grid', 'H-Code' ),
                'masonry' => esc_html__( 'Masonry', 'H-Code' ),
                'classic' => esc_html__( 'Classic', 'H-Code' ),
                'modern'  => esc_html__( 'Modern', 'H-Code' ),
                'box'     => esc_html__( 'Box', 'H-Code' ),
                'list'    => esc_html__( 'List', 'H-Code' ),
            ),
            'default'   => 'grid',
        ),
        array(
            'id'        => 'hcode_blog_page_grid_column',
            'type'      => 'select',
            'title'     => esc_html__( 'Blog Column Layout', 'H-Code' ),
            'options'   => array(
                '2' => esc_html__( 'Column 2', 'H-Code' ),
                '3' => esc_html__( 'Column 3', 'H-Code' ),
                '4' => esc_html__( 'Column 4', 'H-Code' ),
            ),
            'default'   => '3',
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','box' ) ),
        ),
        array(
            'id'=>'hcode_blog_page_show_thumbnail',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Thumbnail', 'H-Code'),
            'default' => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'=>'hcode_blog_page_show_feature_image',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Featured Image Only', 'H-Code'),
            'default' => false,
            'required'  => array('hcode_blog_page_show_thumbnail', 'equals', array('1') ),
        ),
        array(
            'id'        => 'hcode_blog_page_enable_navigation',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Pagination', 'H-Code' ),
            'default'   => true,
        ),
        array(
          'id'          => 'hcode_blog_page_navigation_style',
          'type'        => 'select',
          'title'       => esc_html__( 'Pagination Types', 'H-Code' ),
          'options'     => array(
                'number-pagination' => esc_html__( 'Number Pagination', 'H-Code' ),
                'infinite-scroll-pagination' => esc_html__( 'Infinite Scroll', 'H-Code' )
            ),
          'default'     => 'number-pagination',
          'required'    => array( 'hcode_blog_page_enable_navigation', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_number',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Number', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'modern' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_post_author',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Meta Author', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_post_meta',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Meta Date', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
         array(
          'id'          => 'hcode_blog_page_date_format',
          'type'        => 'text',
          'title'       => esc_html__( 'Date Format', 'H-Code' ),
          'default'     => '',
          'required'    => array( 'hcode_blog_page_show_post_meta', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_excerpt',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Excerpt', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
          'id'          => 'hcode_blog_page_excerpt_length',
          'type'        => 'text',
          'title'       => esc_html__( 'Excerpt', 'H-Code' ),
          'default'     => '30',
          'subtitle'    => esc_html__( 'Specify content length in no. of words', 'H-Code' ),
          'required'    => array( 'hcode_blog_page_show_excerpt', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_content',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Content', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_show_excerpt', 'equals', false ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_category',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Category', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','list' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_posts_like',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Post Like Button', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_comments',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Post Comments', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_blog_page_show_button',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Button', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','list' ) ),
        ),
        array(
          'id'          => 'hcode_blog_page_button_text',
          'type'        => 'text',
          'title'       => esc_html__( 'Button Text', 'H-Code' ),
          'default'     => 'Continue Reading',
          'required'    => array( 'hcode_blog_page_show_button', 'equals', array( '1' ) ),
        ),
        array(
          'id'          => 'hcode_blog_page_item_per_page',
          'type'        => 'text',
          'title'       => esc_html__( 'No. of items per Page', 'H-Code' ),
          'required'    => array( 'hcode_blog_page_grid_layout', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
          'default'     => '15',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        
        /* Single Post */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Single Post/Custom Post Layout Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Set layout for single post/custom post', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_layout_settings_post',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_layout_full_screen' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => 'hcode_layout_full_screen',
                ),
                'hcode_layout_left_sidebar' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => 'hcode_layout_left_sidebar',
                ),
                'hcode_layout_right_sidebar' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => 'hcode_layout_right_sidebar',
                ),
                'hcode_layout_both_sidebar' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => 'hcode_layout_both_sidebar',
                ),
            ),
        ),
        array(
            'id'        => 'hcode_enable_container_fluid_post',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_layout_settings_post', 'equals', 'hcode_layout_full_screen' ),
        ),
        array(
            'id'        => 'hcode_layout_left_sidebar_post',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings_post', 'equals', array( 'hcode_layout_left_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_layout_right_sidebar_post',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings_post', 'equals', array( 'hcode_layout_right_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_single_layout_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Select Layout', 'H-Code' ),
            'options'   => array(
                'hcode_single_layout_standard' => esc_html__( 'Standard', 'H-Code' ),
                'hcode_single_layout_full_width' => esc_html__( 'Full width header', 'H-Code' ),
                'hcode_single_layout_full_width_image_slider' => esc_html__( 'Full width with image slider', 'H-Code' ),
                'hcode_single_layout_full_width_lightbox' => esc_html__( 'Full width with lightbox gallery', 'H-Code' )
            ),
            'default'   => 'hcode_single_layout_standard',
        ),
        array(
            'id'        => 'hcode_enable_breadcrumb_category',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Breadcrumb Category', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'hcode_disable_feature_image',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Featured Image', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        =>'hcode_disable_post_title',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Title', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'hcode_enable_navigation',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Navigation', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'=>'hcode_post_pagination_type',
            'type' => 'select',
            'title' => esc_html__('Navigation Type', 'H-Code'),
            'options' => array(
                'default' => esc_html__('Default', 'H-Code'),
                'category' => esc_html__('Category', 'H-Code'),
                'post_tag' => esc_html__('Tags', 'H-Code'),
            ),
            'default' => 'category',
        ),
        array(
          'id'          => 'enable_navigation_style',
          'type'        => 'select',
          'title'       => esc_html__( 'Select Navigation Style', 'H-Code' ),
          'options'     => array(
                'normal' => esc_html__( 'Normal', 'H-Code' ),
                'modern' => esc_html__( 'Modern', 'H-Code' )
            ),
          'default'     => 'normal',
          'required'    => array( 'hcode_enable_navigation', 'equals', array( '1' ) ),
        ),
        array(
            'id'        =>'navigation_post_category_link',
            'type'      => 'text',
            'title'     => esc_html__( 'Navigation Category Link', 'H-Code' ),
            'required'  => array( 'enable_navigation_style', 'equals', array( 'normal' ) ),
        ),
        array(
          'id'          => 'navigation_post_category_link_target',
          'type'        => 'select',
          'title'       => esc_html__( 'Select Navigation Category Link Target', 'H-Code' ),
          'options'     => array(
                '_self' => esc_html__( 'Same window / tab', 'H-Code' ),
                '_blank' => esc_html__( 'New window / tab', 'H-Code' )
            ),
          'default'     => '_self',
          'required'  => array( 'enable_navigation_style', 'equals', array( 'normal' ) ),
        ),
        array(
            'id'        =>'navigation_image_srcset',
            'type'      => 'select',
            'title'     => esc_html__( 'Navigation Image SRCSET', 'H-Code' ),
            'data'      => 'srcset',
            'required'  => array( 'enable_navigation_style', 'equals', array( 'modern' ) ),
            'default'   => 'hcode-navigation-img',
        ),
        array(
            'id'        => 'hcode_single_enable_author',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Post Meta Author', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_single_enable_date',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Post Meta Date', 'H-Code' ),
            'default'   => true,
        ),
        array(
          'id'          => 'hcode_single_date_format',
          'type'        => 'text',
          'title'       => esc_html__( 'Date Format', 'H-Code' ),
          'subtitle'    => esc_html__( 'Date format not work for "Full width with image slider" post type.', 'H-Code' ),
          'default'     => '',
          'required'    => array( 'hcode_single_enable_date', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_single_enable_category',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Post Meta Category', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_meta_tags',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Meta Tags', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_post_author',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Author Box', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_social_icons',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Social Icons', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Single Related Post */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Single Post/Custom Related Post Layout Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Set layout for single post/custom related post', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_enable_related_posts',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Related Post', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_related_post_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Related Post Title', 'H-Code' ),
            'default'   => 'Related Blogs',
            'required'  => array( 'hcode_enable_related_posts', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_enable_related_posts_excerpt',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Related Post Excerpt', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_related_post_excerpt_length',
            'type'      => 'text',
            'title'     => esc_html__( 'Related Post Excerpt Length', 'H-Code' ),
            'default'   => '30',
            'required'  => array( 'hcode_enable_related_posts_excerpt', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_enable_related_posts_title',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Title', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_related_posts_author',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Author', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_related_posts_date',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Date', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_related_posts_date_format',
            'type'      => 'text',
            'title'     => esc_html__( 'Date Format', 'H-Code' ),
            'default'   => '',
            'required'  => array( 'hcode_enable_related_posts_date', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_enable_related_posts_separator',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Separator', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_related_posts_like',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Like Button', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_related_posts_comments',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Related Post Comments Button', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        =>'related_post_image_srcset',
            'type'      => 'select',
            'title'     => esc_html__( 'Related Post Image SRCSET', 'H-Code' ),
            'data'      => 'srcset',
            'required'  => array( 'hcode_enable_related_posts', 'equals', array( '1' ) ),
            'default'   => 'hcode-related-post',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Single Portfolio Page*/

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Single Portfolio Post Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Single portfolio post configurations', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_layout_settings_portfolio',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_layout_full_screen' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => 'hcode_layout_full_screen',
                ),
                'hcode_layout_left_sidebar' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => 'hcode_layout_left_sidebar',
                ),
                'hcode_layout_right_sidebar' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => 'hcode_layout_right_sidebar',
                ),
                'hcode_layout_both_sidebar' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => 'hcode_layout_both_sidebar',
                ),
            ),
        ),
        array(
            'id'        => 'hcode_enable_container_fluid_portfolio',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_layout_settings_portfolio', 'equals', 'hcode_layout_full_screen' ),
        ),
        array(
            'id'        => 'hcode_layout_left_sidebar_portfolio',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings_portfolio', 'equals', array( 'hcode_layout_left_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_layout_right_sidebar_portfolio',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_layout_settings_portfolio', 'equals', array( 'hcode_layout_right_sidebar', 'hcode_layout_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_enable_breadcrumb_category_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Breadcrumb Category', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'hcode_enable_featured_image_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Featured Image', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_related_portfolio_posts',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Related Post', 'H-Code' ),
            'default'   => true,
        ),
        array(
          'id'          => 'hcode_related_title',
          'type'        => 'text',
          'title'       => esc_html__( 'Related Portfolio Title', 'H-Code' ),
          'default'     => 'Related Projects',
          'required'    => array( 'hcode_enable_related_portfolio_posts', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'related_portfolio_image_srcset',
            'type'      => 'select',
            'title'     => esc_html__( 'Related Portfolio Image SRCSET', 'H-Code' ),
            'data'      => 'srcset',
            'required'  => array( 'hcode_enable_related_portfolio_posts', 'equals', array( '1' ) ),
            'default'   => 'hcode-related-post',
        ),
        array(
            'id'        => 'hcode_enable_navigation_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Navigation', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'=>'hcode_portfolio_pagination_type',
            'type' => 'select',
            'title' => esc_html__('Navigation Type', 'H-Code'),
            'options' => array(
                'default' => esc_html__('Default', 'H-Code'),
                'portfolio-category' => esc_html__('Category', 'H-Code'),
                'portfolio-tags' => esc_html__('Tags', 'H-Code'),
            ),
            'default' => 'portfolio-category',
        ),
        array(
            'id'        => 'enable_navigation_portfolio_style',
            'type'      => 'select',
            'title'     => esc_html__( 'Select Navigation Style', 'H-Code' ),
            'options'   => array(
                'normal' => esc_html__( 'Normal', 'H-Code' ),
                'modern' => esc_html__( 'Modern', 'H-Code' )
            ),
            'default'   => 'normal',
            'required'  => array( 'hcode_enable_navigation_portfolio', 'equals', array( '1' ) ),
        ),
        array(
            'id'        =>'navigation_portfolio_category_link',
            'type'      => 'text',
            'title'     => esc_html__( 'Navigation Category Link', 'H-Code' ),
            'required'  => array( 'enable_navigation_portfolio_style', 'equals', array( 'normal' ) ),
        ),
        array(
          'id'          => 'navigation_portfolio_category_link_target',
          'type'        => 'select',
          'title'       => esc_html__( 'Select Navigation Category Link Target', 'H-Code' ),
          'options'     => array(
                '_self' => esc_html__( 'Same window / tab', 'H-Code' ),
                '_blank' => esc_html__( 'New window / tab', 'H-Code' )
            ),
          'default'     => '_self',
          'required'  => array( 'enable_navigation_portfolio_style', 'equals', array( 'normal' ) ),
        ),
        array(
            'id'        => 'portfolio_navigation_image_srcset',
            'type'      => 'select',
            'title'     => esc_html__( 'Navigation Image SRCSET', 'H-Code' ),
            'data'      => 'srcset',
            'required'  => array( 'enable_navigation_portfolio_style', 'equals', array( 'modern' ) ),
            'default'   => 'hcode-navigation-img',
        ),
        array(
            'id'        => 'hcode_enable_meta_author_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Meta Author', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'hcode_enable_meta_date_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Meta Date', 'H-Code' ),
            'default'   => false,
        ),
        array(
          'id'          => 'hcode_portfolio_date_format',
          'type'        => 'text',
          'title'       => esc_html__( 'Date Format', 'H-Code' ),
          'default'     => '',
          'required'    => array( 'hcode_enable_meta_date_portfolio', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_enable_meta_category_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Meta Category', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'hcode_enable_meta_tags_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Meta Tags', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_post_author_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Post Author Box', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_social_icons_portfolio',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Social Icons', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_enable_portfolio_text_breadcrumb',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Portfolio Text In Breadcrumb', 'H-Code' ),
            'default'   => true,
        ),
        array(
          'id'          => 'hcode_portfolio_breadcrumb_text',
          'type'        => 'text',
          'title'       => esc_html__( 'Breadcrumb Portfolio Text', 'H-Code' ),
          'default'     => 'Portfolio',
          'required'    => array( 'hcode_enable_portfolio_text_breadcrumb', 'equals', array( '1' ) ),
        ),
        array(
          'id'          => 'hcode_portfolio_text_url',
          'type'        => 'text',
          'title'       => esc_html__( 'Breadcrumb Portfolio URL', 'H-Code' ),
          'default'     => '',
          'required'    => array( 'hcode_enable_portfolio_text_breadcrumb', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        
        /* Archive Pages Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Pages Layout Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Page layout settings only for Archive, Category, Search, Tag, Author pages', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_general_settings',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_general_full_screen' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => 'hcode_general_full_screen',
                ),
                'hcode_general_left_sidebar' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => 'hcode_general_left_sidebar',
                ),
                'hcode_general_right_sidebar' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => 'hcode_general_right_sidebar',
                ),
                'hcode_general_both_sidebar' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => 'hcode_general_both_sidebar',
                ),
            ),
            'default'   => 'hcode_general_right_sidebar'
        ),
        array(
            'id'        => 'hcode_general_enable_container_fluid',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_general_settings', 'equals', 'hcode_general_full_screen' ),
        ),
        array(
            'id'        => 'hcode_general_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_general_settings', 'equals', array( 'hcode_general_left_sidebar', 'hcode_general_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_general_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_general_settings', 'equals', array( 'hcode_general_right_sidebar', 'hcode_general_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_general_layout_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Layout Settings', 'H-Code' ),
            'options'   => array(
                'grid'    => esc_html__( 'Grid', 'H-Code' ),
                'masonry' => esc_html__( 'Masonry', 'H-Code' ),
                'classic' => esc_html__( 'Classic', 'H-Code' ),
                'modern'  => esc_html__( 'Modern', 'H-Code' ),
                'box'     => esc_html__( 'Box', 'H-Code' ),
                'list'    => esc_html__( 'List', 'H-Code' ),
            ),
            'default'   => 'classic',
        ),
        array(
            'id'        => 'hcode_general_archive_page_thumbnail_size',
            'type'      => 'select',
            'data'      => 'srcset',
            'title'     => esc_html__( 'Post Thumbnail Size', 'H-Code' ),
            'default'   => 'full',
        ),
        array(
            'id'        => 'hcode_general_columns_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Layout Columns Settings', 'H-Code' ),
            'options'   => array(
                '2' => esc_html__( 'column 2', 'H-Code' ),
                '3' => esc_html__( 'column 3', 'H-Code' ),
                '4' => esc_html__( 'column 4', 'H-Code' ),
            ),
            'default'   => '2',
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry', 'box' ) ),
        ),
        array(
            'id'=>'hcode_general_show_thumbnail',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Thumbnail', 'H-Code'),
            'default' => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid','masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'=>'hcode_general_show_feature_image',
            'type' => 'switch', 
            'title' => esc_html__('Show Featured Image Only', 'H-Code'),
            'default' => false,
            'required'  => array('hcode_general_show_thumbnail', 'equals', array('1') ),
        ),
        array(
            'id'        => 'hcode_general_archive_page_enable_navigation',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Enable Pagination', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_general_archive_page_navigation_style',
            'type'      => 'select',
            'title'     => esc_html__( 'Pagination Types', 'H-Code' ),
            'options'   => array(
                'number-pagination' => esc_html__( 'Number Pagination', 'H-Code' ),
                'infinite-scroll-pagination' => esc_html__( 'Infinite Scroll', 'H-Code' )
            ),
            'default'   => 'number-pagination',
            'required'  => array( 'hcode_general_archive_page_enable_navigation', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_title',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Title', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_number',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Number', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'modern' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_author',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Author', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_date',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Date', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_date_format',
            'type'      => 'text',
            'title'     => esc_html__( 'Date Format', 'H-Code' ),
            'default'   => '',
            'required'  => array( 'hcode_general_enable_date', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_excerpt',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Excerpt', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
          'id'          => 'hcode_general_excerpt_length',
          'type'        => 'text',
          'title'       => esc_html__( 'Excerpt', 'H-Code' ),
          'default'     => '30',
          'subtitle'    => esc_html__( 'Specify content length in no. of words', 'H-Code' ),
          'required'    => array( 'hcode_general_enable_excerpt', 'equals', array( '1' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_content',
            'type'      => 'switch', 
            'title'     => esc_html__( 'Show Full Content', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_enable_excerpt', 'equals', false ),
        ),
        array(
            'id'        => 'hcode_general_enable_like',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Like', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_comment',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Comment', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','box','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_separator',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Separator', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','list' ) ),
        ),
        array(
            'id'        => 'hcode_general_enable_button',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Continue Button', 'H-Code' ),
            'default'   => true,
            'required'  => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','list' ) ),
        ),
        array(
          'id'          => 'hcode_general_button_text',
          'type'        => 'text',
          'title'       => esc_html__( 'Button Text', 'H-Code' ),
          'default'     => 'Continue Reading',
          'required'    => array( 'hcode_general_layout_settings', 'equals', array( 'grid', 'masonry','classic','modern','list' ) ),
        ),
        array(
          'id'          => 'hcode_general_item_per_page',
          'type'        => 'text',
          'title'       => esc_html__( 'No. of items per Page', 'H-Code' ),
          'default'     => '10',
        ),
        array(
            'id'        => 'hcode_general_search_content_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Search Content', 'H-Code' ),
            'multi'     => true,
            'options'   => $search_content,
            'default'   => array( 'only-page','only-post' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Portfolio Category Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Portfolio Category Layout Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Portfolio category page configurations', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_portfolio_cat_settings',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Sidebar Settings', 'H-Code' ),
            'options'   => array(
                'hcode_portfolio_cat_full_screen' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => 'hcode_portfolio_cat_full_screen'
                ),
                'hcode_portfolio_cat_left_sidebar' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => 'hcode_portfolio_cat_left_sidebar'
                ),
                'hcode_portfolio_cat_right_sidebar' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => 'hcode_portfolio_cat_right_sidebar'
                ),
                'hcode_portfolio_cat_both_sidebar' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => 'hcode_portfolio_cat_both_sidebar'
                ),
            ),
            'default'   => 'hcode_portfolio_cat_full_screen'
        ),
        array(
            'id'        => 'hcode_portfolio_cat_enable_container_fluid',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Container Fluid', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_portfolio_cat_settings', 'equals', 'hcode_portfolio_cat_full_screen' ),
        ),
        array(
            'id'        => 'hcode_portfolio_cat_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Left Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in left column of page', 'H-Code' ),
            'required'  => array( 'hcode_portfolio_cat_settings', 'equals', array( 'hcode_portfolio_cat_left_sidebar', 'hcode_portfolio_cat_both_sidebar' ) ),
        ),
        array(
            'id'        => 'hcode_portfolio_cat_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Right Sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__( 'Select sidebar to display in right column of page', 'H-Code' ),
            'required'  => array( 'hcode_portfolio_cat_settings', 'equals', array( 'hcode_portfolio_cat_right_sidebar', 'hcode_portfolio_cat_both_sidebar' ) ),
        ),
        array(
          'id'          => 'hcode_portfolio_cat_title',
          'type'        => 'text',
          'title'       => esc_html__( 'Portfolio Page Title', 'H-Code' ),
          'default'     => 'Portfolio',
        ),
        array(
            'id'        => 'hcode_portfolio_cat_layout_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Layout Settings', 'H-Code' ),
            'options'   => array(
                'grid' => esc_html__( 'Grid', 'H-Code' ),
                'grid-gutter' => esc_html__( 'Grid Gutter', 'H-Code' ),
                'grid-with-title' => esc_html__( 'Grid With Title', 'H-Code' ),
                'wide' => esc_html__( 'Wide', 'H-Code' ),
                'wide-gutter' => esc_html__( 'Wide Gutter', 'H-Code' ),
                'wide-with-title' => esc_html__( 'Wide With Title', 'H-Code' ),
                'masonry' => esc_html__( 'Masonry', 'H-Code' ),
            ),
            'default'   => 'grid-gutter',
        ),
        array(
            'id'        => 'hcode_portfolio_cat_columns_settings',
            'type'      => 'select',
            'title'     => esc_html__( 'Layout Columns Settings', 'H-Code' ),
            'options'   => array(
                '2' => esc_html__( 'column 2', 'H-Code' ),
                '3' => esc_html__( 'column 3', 'H-Code' ),
                '4' => esc_html__( 'column 4', 'H-Code' ),
                '5' => esc_html__( 'column 5', 'H-Code' ),
            ),
            'default'   => '3',
        ),
        array(
            'id'        => 'hcode_portfolio_cat_item_per_page',
            'type'      => 'text',
            'title'     => esc_html__( 'No. of items per Page', 'H-Code' ),
            'default'   => '10',
        ),
        array(
            'id'        => 'hcode_portfolio_cat_enable_infinite_pagination',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Infinite Pagination', 'H-Code' ),
            'default'   => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Archive Pages Header Setting */
        
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Header Settings', 'H-Code' ),
            'subtitle'  => esc_html__( 'Header settings only for Archive, Category, Search, Tag, Author Pages', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'        => 'hcode_enable_header_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Header', 'H-Code' ),
            'default'   => true,
        ),
        array(
            'id'        => 'hcode_header_layout_general',
            'type'      => 'images',
            'title'     => esc_html__( 'Select a Header Style', 'H-Code' ),
            'options'   => hcode_get_header_layout( 'preview' ),
            'imgtitle'  => hcode_get_header_layout( 'title' ),
            'default'   => 'headertype6',
            'validate'  => 'not_empty'
        ),
        array(
            'id'        => 'hcode_non_sticky_menu_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Non Sticky', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype1', 'headertype2', 'headertype3', 'headertype4', 'headertype5', 'headertype6', 'headertype7', 'headertype10', 'headertype11' ) ),
        ),
        array(
            'id'        => 'hcode_top_header_space_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Add Top Header Space', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype1','headertype3','headertype4', 'headertype10' ) ),
        ),
        array(
            'id'       => 'hcode_remove_top_header_space_general',
            'type'     => 'switch',
            'title'    => esc_html__('Remove Top Header Space', 'H-Code'),
            'required'  => array('hcode_header_layout_general', 'equals', array('headertype2','headertype5','headertype6', 'headertype7', 'headertype8', 'headertype11') ),
        ),
        array(
            'id'        => 'hcode_header_text_color_general',
            'type'      => 'select',
            'title'     => esc_html__( 'Header Text Color', 'H-Code' ),
            'options'   => array(
                'nav-black' => esc_html__( 'Black', 'H-Code' ),
                'nav-white' => esc_html__( 'White', 'H-Code' ),
            ),
            'default'   => 'nav-black',
        ),
        array(
            'id'        => 'hcode_header_logo_position_general',
            'type'      => 'select',
            'title'     => esc_html__( 'Header Logo Position', 'H-Code' ),
            'options'   => array(
                'left'   => esc_html__( 'Left', 'H-Code' ),
                'center' => esc_html__( 'Center', 'H-Code' ),
                'top'    => esc_html__( 'Top', 'H-Code' ),
            ),
            'default'   => 'left',
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype1', 'headertype2', 'headertype3', 'headertype4', 'headertype5', 'headertype6', 'headertype7', 'headertype8' ) ),
        ),
        array(
            'id'       => 'hcode_header_full_width_general',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Header Full Width', 'H-Code'),
            'default'  => false,
            'required'  => array('hcode_header_layout_general', 'equals', array('headertype1', 'headertype2', 'headertype3', 'headertype4', 'headertype5', 'headertype6', 'headertype7', 'headertype8') ),
        ),
        array(
            'id'       => 'hcode_header_menu_position_general',
            'type'     => 'select',
            'title'    => esc_html__('Header Menu Position', 'H-Code'),
            'options' => array(
                'menu-left-align' => esc_html__('Left', 'H-Code'),
                'menu-center-align' => esc_html__('Center', 'H-Code'),
                'menu-right-align' => esc_html__('Right', 'H-Code'),
            ),
            'default'  => 'menu-right-align',
            'required'  => array('hcode_header_logo_position_general', 'equals', array('','left') ),
        ),
        array(
            'id'        => 'hcode_menu_image_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,
            'title'     => esc_html__( 'Menu Background Image', 'H-Code' ),
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype10', 'headertype11' ) ),
        ),
        array(
            'id'        => 'hcode_menu_logo_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,
            'title'     => esc_html__( 'Menu Logo', 'H-Code' ),
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype10' ) ),
        ),
        array(
            'id'        => 'hcode_enable_menu_social_icons_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Menu Social Icons', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype9', 'headertype10', 'headertype11' ) ),
        ),
        array(
            'id'        => 'hcode_menu_social_sidebar_general',
            'type'      => 'select',
            'title'     => esc_html__( 'Menu Social Sidebar', 'H-Code' ),
            'subtitle'  => esc_html__( 'Select custom sidebar', 'H-Code' ),
            'data'      => 'sidebar',
            'default'   => '',
            'required'  => array( 'hcode_enable_menu_social_icons_general', 'equals', '1' ),
        ),
        array(
            'id'        => 'hcode_enable_menu_separator_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Menu Separator', 'H-Code' ),
            'default'   => false,
            'required'  => array( 'hcode_header_layout_general', 'equals', array( 'headertype11' ) ),
        ),
        array(
            'id'        => 'hcode_header_menu_general',
            'type'      => 'select',
            'title'     => esc_html__( 'Header menu', 'H-Code' ),
            'data'      => 'menus',
        ),
        array(
            'id'        => 'hcode_header_secondary_menu_general',
            'type'      => 'select',
            'data'      => 'menus',
            'title'     => esc_html__( 'Secondary Menu', 'H-Code' ),
            'required'  => array( 'hcode_header_logo_position_general', 'equals', array( 'center' ) ),
        ),
        array(
            'id'        => 'hcode_header_logo_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,  
            'title'     => esc_html__( 'Logo', 'H-Code' ),
            'subtitle'  => esc_html__( 'Upload the logo that will be displayed in the header', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_header_light_logo_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,  
            'title'     => esc_html__( 'Logo (Light)', 'H-Code' ),
            'subtitle'  => esc_html__( 'Upload a light version of logo used in dark backgrounds header template', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_retina_logo_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,  
            'title'     => esc_html__( 'Logo Retina', 'H-Code' ),
            'subtitle'  => esc_html__( 'Optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_retina_logo_light_general',
            'type'      => 'media',
            'preview'   => true,
            'url'       => true,  
            'title'     => esc_html__( 'Logo Retina (Light)', 'H-Code' ),
            'subtitle'  => esc_html__( '(Upload a light version of logo) optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_retina_logo_width_general',
            'type'      => 'text',
            'title'     => esc_html__( 'Retina logo Width', 'H-Code' ),
            'default'   => '109px',
            'subtitle'  => esc_html__( 'Specify the width in pixel eg. 15px', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_retina_logo_height_general',
            'type'      => 'text',
            'title'     => esc_html__( 'Retina logo Height', 'H-Code' ),
            'default'   => '34px',
            'subtitle'  => esc_html__( 'Specify the height in pixel eg. 15px', 'H-Code' ),
        ),
        array(
            'id'        => 'hcode_header_search_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Search', 'H-Code' ),
            'default'   => false,
            'subtitle'  => esc_html__( 'If on, a search module will be displayed in header section','H-Code' ),
        ), 
        array(
            'id'        => 'hcode_header_cart_general',
            'type'      => 'switch',
            'title'     => esc_html__( 'Cart', 'H-Code' ),
            'default'   => false,
            'subtitle'  => esc_html__( 'If on, a cart module will be displayed in header section. It will only work if WooCommerce plugin is installed and active.','H-Code' ),
        ),
        array(
            'id'        => 'hcode_header_mini_cart_general',
            'type'      => 'select',
            'title'     => esc_html__( 'Header Mini cart', 'H-Code' ),
            'data'      => 'sidebars',
            'default'   => 'hcode-mini-cart',
            'required'  => array( 'hcode_header_cart_general', 'equals', '1' ),
          ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);