<?php
/**
 * Social Sharing Links Tab For ( post and product both) Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fas fa-share-alt',
    'title' => esc_html__('Social Sharing Links', 'H-Code'),
    'desc' => esc_html__('Select on to show that specific social sharing icon on blog posts and product pages.', 'H-Code'),
    'fields' => array(
                    array(
                        'id'        => 'opt-accordion-begin-general',
                        'type'      => 'accordion',
                        'title'     => esc_html__('Social Sharing Links For WooCommerce', 'H-Code'),
                        'subtitle'  => esc_html__('Set Social Sharing Links For WooCommerce', 'H-Code'),
                        'position'  => 'start',
                    ),
                    array(
                        'id'       => 'enable_social_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable Social Sharing', 'H-Code' ),
                        'default'  => true,
                    ),
                    array(
                      'id' => 'share_title',
                      'type' => 'text',
                      'title' => esc_html__('Title', 'H-Code'),
                      'default' => 'Share on',
                      'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                	array(
                        'id'       => 'enable_facebook',
                        'type'     => 'switch',
                        'title'    => esc_html__('Facebook', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_twitter',
                        'type'     => 'switch',
                        'title'    => esc_html__('Twitter', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_linkedin',
                        'type'     => 'switch',
                        'title'    => esc_html__('LinkedIn', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_pinterest',
                        'type'     => 'switch',
                        'title'    => esc_html__('Pinterest', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_email',
                        'type'     => 'switch',
                        'title'    => esc_html__('Email', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_delicious',
                        'type'     => 'switch',
                        'title'    => esc_html__('Delicious', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_reddit',
                        'type'     => 'switch',
                        'title'    => esc_html__('Reddit', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_stumbleupon',
                        'type'     => 'switch',
                        'title'    => esc_html__('Stumbleupon', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_digg',
                        'type'     => 'switch',
                        'title'    => esc_html__('Digg', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_tumblr',
                        'type'     => 'switch',
                        'title'    => esc_html__('Tumblr', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_vk',
                        'type'     => 'switch',
                        'title'    => esc_html__('VK', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_xing',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'XING', 'H-Code' ),
                        'default'  => false,
                        'required' => array('enable_social_sharing', 'equals', array('1') ),
                    ),
                    array(
                        'id'        => 'opt-accordion-end-general',
                        'type'      => 'accordion',
                        'position'  => 'end',
                    ),

                    /* Single Post Social */

                    array(
                        'id'        => 'opt-accordion-begin-general',
                        'type'      => 'accordion',
                        'title'     => esc_html__('Social Sharing Links For Single Post', 'H-Code'),
                        'subtitle'  => esc_html__('Set Social Sharing Links For Single Post', 'H-Code'),
                        'position'  => 'start',
                    ),
                    array(
                        'id'       => 'enable_social_sharing_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable Social Sharing', 'H-Code' ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'enable_facebook_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Facebook', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_twitter_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Twitter', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_linkedin_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('LinkedIn', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_pinterest_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Pinterest', 'H-Code'),
                        'default'  => true,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_delicious_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Delicious', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_reddit_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Reddit', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_stumbleupon_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Stumbleupon', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_digg_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Digg', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_tumblr_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('Tumblr', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_vk_post',
                        'type'     => 'switch',
                        'title'    => esc_html__('VK', 'H-Code'),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'       => 'enable_xing_post',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'XING', 'H-Code' ),
                        'default'  => false,
                        'required' => array('enable_social_sharing_post', 'equals', array('1') ),
                    ),
                    array(
                        'id'        => 'opt-accordion-end-general',
                        'type'      => 'accordion',
                        'position'  => 'end',
                    ),
                )
);