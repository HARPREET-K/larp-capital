<?php
/**
 * Performance Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$hcode_performance_remove_emojis = $hcode_performance_remove_query_string = $hcode_performance_remove_embeds_script = '';
if( class_exists( 'Hcode_Addons_Post_Type' ) ){
    $hcode_performance_remove_emojis = array(
        'id' => 'hcode_performance_remove_emojis',
        'type' => 'switch',
        'title' => esc_html__( 'Remove Emojis script', 'H-Code' ),
        'desc' => esc_html__( 'Select on to remove WordPress emojis script and style.', 'H-Code' ),
    );

    $hcode_performance_remove_query_string = array(
        'id' => 'hcode_performance_remove_query_string',
        'type' => 'switch',
        'title' => esc_html__( 'Remove Query Strings', 'H-Code' ),
        'desc' => esc_html__( 'Select on to remove query strings from static resources.', 'H-Code' ),
    );
    $hcode_performance_remove_embeds_script = array(
        'id' => 'hcode_performance_remove_embeds_script',
        'type' => 'switch',
        'title' => esc_html__( 'Remove Embeds Script', 'H-Code' ),
        'desc' => esc_html__( 'Select on to remove WordPress embeds script.', 'H-Code' ),
    );
}
$this->sections[] = array(
    'icon' => 'fas fa-tachometer-alt',
    'title' => esc_html__( 'Performance', 'H-Code' ),
    'desc' => esc_html__( 'Performance section configuration settings', 'H-Code' ),
    'fields' => array(
        $hcode_performance_remove_emojis,
        $hcode_performance_remove_query_string,
        $hcode_performance_remove_embeds_script,
        array(
            'id' => 'hcode_performance_remove_wp_block_library',
            'type' => 'switch',
            'title' => esc_html__( 'Remove Block Library Style', 'H-Code' ),
            'desc' => esc_html__( 'Select on to remove WordPress Block Library Style.', 'H-Code' ),
        ),
        array(
            'id' => 'hcode_performance_google_fonts_render',
            'type' => 'switch',
            'title' => esc_html__( 'Load Google Fonts Async in Footer', 'H-Code' ),
        ),
    )
);