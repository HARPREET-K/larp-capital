<?php
/**
 * WooCommerce Extra Function.
 *
 * @package H-Code
 */
?>
<?php
if ( class_exists( 'WooCommerce' ) ){ 

    /* For Woocommerce Color Attributele */
    $hcode_color_attributele = hcode_option( 'hcode_color_attributele' );
    if( $hcode_color_attributele && ( hcode_option( 'hcode_enable_color_attribute' ) == 1) ):
        add_action( 'pa_'.$hcode_color_attributele.'_add_form_fields', 'hcode_add_color_field', 10, 2 );
        add_action( 'pa_'.$hcode_color_attributele.'_edit_form_fields', 'hcode_edit_color_field', 10, 2 );
        add_action( 'edited_pa_'.$hcode_color_attributele, 'hcode_save_taxonomy_custom_field_color', 10, 2 );  
        add_action( 'create_pa_'.$hcode_color_attributele, 'hcode_save_taxonomy_custom_field_color', 10, 2 );
    endif;

    // Add H-Code Custom Product Tabs
    if ( ! function_exists( 'hcode_custom_tab_options_tab' ) ) {
        function hcode_custom_tab_options_tab() {

            echo '<li class="custom_tab wc-special-product"><a href="#custom_tab_data">'.esc_html( 'Special Product', 'H-Code' ).'</a></li>';
            echo '<li class="custom_tab wc-washing-instruction"><a href="#washing_instruction">'.esc_html( 'Washing Instructions', 'H-Code' ).'</a></li>';
            echo '<li class="custom_tab wc-sizes"><a href="#sizes_tab">'.esc_html( 'Sizes', 'H-Code' ).'</a></li>';
        }
    }
    add_action( 'woocommerce_product_write_panel_tabs', 'hcode_custom_tab_options_tab' );

    if ( ! function_exists( 'hcode_custom_tab_options' ) ) {
        function hcode_custom_tab_options() {
            global $post;
            $hcode_feature_product_order = array(
                'hcode_feature_product_order' => get_post_meta( $post->ID, 'hcode_feature_product_order', true ),
            );
            $hcode_feature_product_shop = array(
                'hcode_feature_product_shop' => get_post_meta( $post->ID, 'hcode_feature_product_shop', true ),
            );
            $hcode_new_product_shop = array(
                'hcode_new_product_shop' => get_post_meta( $post->ID, 'hcode_new_product_shop', true ),
            );

            echo '<div id="custom_tab_data" class="panel woocommerce_options_panel">';
                echo '<div class="options_group custom_tab_options">';                                              
                    echo '<p class="form-field">';
                        echo '<label>'.esc_html( 'Order:', 'H-Code' ).'</label>';
                        echo '<input type="text" name="hcode_feature_product_order" placeholder="'.esc_html( 'Enter your Order', 'H-Code' ).'" value="'.esc_html( $hcode_feature_product_order['hcode_feature_product_order'] ).'">';
                    echo '</p>';
                    echo '<p class="form-field">';
                        echo '<label>'.esc_html( 'Feature:', 'H-Code' ).'</label>';
                            $features_prod=$hcode_feature_product_shop['hcode_feature_product_shop'];
                        ?>
                        <select name="hcode_feature_product_shop" class="hcode_feature_product" id="feature_product">
                            <option value=""><?php echo esc_html( 'Select One', 'H-Code' ); ?></option>
                            <option value="yes"<?php selected( $features_prod, 'yes' ); ?>><?php echo esc_html( 'Yes', 'H-Code' ); ?></option>
                            <option value="no"<?php selected( $features_prod, 'no' ); ?>><?php echo esc_html( 'No', 'H-Code' ); ?></option>
                        </select>
                        <?php
                    echo '</p>';
                    echo '<p class="form-field">';
                        echo '<label>'.esc_html( 'New Product:', 'H-Code' ).'</label>';
                            $new_prod=$hcode_new_product_shop['hcode_new_product_shop'];
                        ?>
                        <select name="hcode_new_product_shop" class="hcode_feature_product" id="new_product">
                            <option value=""><?php echo esc_html( 'Select One', 'H-Code' ); ?></option>
                            <option value="yes"<?php selected( $new_prod, 'yes' ); ?>><?php echo esc_html( 'Yes', 'H-Code' ); ?></option>
                            <option value="no"<?php selected( $new_prod, 'no' ); ?>><?php echo esc_html( 'No', 'H-Code' ); ?></option>
                        </select>
                        <?php
                    echo '</p>';
                echo '</div>';
            echo '</div>';
        }
    }
    add_action( 'woocommerce_product_data_panels', 'hcode_custom_tab_options' );

    if ( ! function_exists( 'hcode_sizes_tab' ) ) {
        function hcode_sizes_tab() {
            global $post;
            $hcode_size_tab = '';
            $meta_size_tab = get_post_meta( $post->ID, 'hcode_product_tabs_options', true );
            if( isset( $meta_size_tab[0]['hcode_size_tab'] ) ) {
                $breaks = array( "<br />", "<br>", "<br/>" );
                $hcode_size_tab = ( $meta_size_tab[0]['hcode_size_tab'] ) ? str_ireplace( $breaks, " ", $meta_size_tab[0]['hcode_size_tab'] ) : '';
            }

            echo '<div id="sizes_tab" class="panel woocommerce_options_panel">';
                echo '<div class="options_group custom_tab_options">';
                    echo '<p class="form-field">';
                        echo '<label>'.esc_html( 'Sizes Description:', 'H-Code' ).'</label>';
                        echo '<textarea class="theEditor" rows="10" cols="40" name="hcode_size_tab" placeholder="'.esc_html( 'Enter your sizes content', 'H-Code' ).'" style="height:250px">'.$hcode_size_tab.'</textarea>';
                    echo '</p>';
                echo '</div>';
            echo '</div>';
        }
    }
    add_action( 'woocommerce_product_data_panels', 'hcode_sizes_tab' );

    if ( ! function_exists( 'hcode_washing_instruction' ) ) {
        function hcode_washing_instruction() {
            global $post;
            $hcode_washing_instruction = '';
            $metabox_washing_instruction = get_post_meta( $post->ID, 'hcode_product_tabs_options', true );
            if( isset( $metabox_washing_instruction[0]['hcode_washing_instruction'] ) ) {
                $breaks = array( "<br />", "<br>", "<br/>" );
                $hcode_washing_instruction = ( $metabox_washing_instruction[0]['hcode_washing_instruction'] ) ? str_ireplace( $breaks, " ", $metabox_washing_instruction[0]['hcode_washing_instruction'] ) : '';
            }

            echo '<div id="washing_instruction" class="panel woocommerce_options_panel">';
                echo '<div class="options_group custom_tab_options">';
                    echo '<p class="form-field">';
                        echo '<label>'.esc_html( 'Washing Instruction:', 'H-Code' ).'</label>';
                        echo '<textarea class="theEditor" rows="10" cols="40" name="hcode_washing_instruction" placeholder="'.esc_html( 'Enter your washing instruction', 'H-Code' ).'" style="height:250px">'.$hcode_washing_instruction.'</textarea>';
                    echo '</p>';
                echo '</div>';
            echo '</div>';
        }
    }
    add_action( 'woocommerce_product_data_panels', 'hcode_washing_instruction' );

    if ( ! function_exists( 'hcode_process_product_meta_custom_tab' ) ) {
        function hcode_process_product_meta_custom_tab( $post_id ) {
            
            update_post_meta( $post_id, 'hcode_feature_product_order', $_POST['hcode_feature_product_order'] );
            update_post_meta( $post_id, 'hcode_feature_product_shop', $_POST['hcode_feature_product_shop'] );
                
            /* field array */
            $data_args = $options_value = array();
                
            /* sizes */
            if( $_POST['hcode_size_tab'] ) {
                $data_args['hcode_size_tab'] = stripslashes( nl2br( $_POST['hcode_size_tab'] ) );
                update_post_meta( $post_id, 'hcode_size_tab',  $_POST['hcode_size_tab'] );
            }

            /* washing instruction */
            if( $_POST['hcode_washing_instruction'] ) {
                update_post_meta( $post_id, 'hcode_washing_instruction', serialize( $_POST['hcode_washing_instruction'] ) );
                $data_args['hcode_washing_instruction'] = stripslashes( nl2br( $_POST['hcode_washing_instruction'] ) );
            }
                
            $options_value[] = $data_args;
            update_post_meta( $post_id, 'hcode_product_tabs_options', $options_value );
        }
    }
    add_action( 'woocommerce_process_product_meta', 'hcode_process_product_meta_custom_tab' );
    
    // Remove Woocommerce setup screen.
    remove_action( 'admin_init', 'setup_wizard' );
    
    if ( ! function_exists( 'hcode_remove_woocommerce_admin_notice' ) ) {
        function hcode_remove_woocommerce_admin_notice() {
            if ( class_exists( 'WC_Admin_Notices' ) ) {
                // Remove the "you have outdated template files" nag
                WC_Admin_Notices::remove_notice( 'template_files' );
                
                // Remove the "install pages" nag
                WC_Admin_Notices::remove_notice( 'install' );
            }
        }
    }
    add_action( 'wp_loaded', 'hcode_remove_woocommerce_admin_notice', 99 );
    
    // Hide the "install the WooThemes Updater"
    remove_action( 'admin_notices', 'woothemes_updater_notice' );

    // To Remove woocommerce_breadcrumb Action And Add New Action For Breadcrumb
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action( 'hcode_woocommerce_breadcrumb', 'hcode_woocommerce_breadcrumb', 20, 0 );
    /* Woocommerce Breadcrumb*/
    if ( ! function_exists( 'hcode_woocommerce_breadcrumb' ) ) {
    	function hcode_woocommerce_breadcrumb( $args = array() ) {
    		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
    			'delimiter'   => '',
    			'wrap_before' => '',
    			'wrap_after'  => '',
    			'before'      => '',
    			'after'       => '',
    			'home'        => esc_html__( 'Home', 'H-Code' )
    		) ) );

    		$breadcrumbs = new WC_Breadcrumb();

    		if ( $args['home'] ) {
    			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url( '/' ) ) );
    		}

    		$args['breadcrumb'] = $breadcrumbs->generate();
            
    		wc_get_template( 'global/breadcrumb.php', $args );
    	}
    }

    /* Naxt and Prev button on product pages */
    if ( ! function_exists( 'hcode_woocommerce_next_prev' ) ) {
    	function hcode_woocommerce_next_prev( $args = array() ) {

    		global $post;

            if( is_shop() ) return;
    		$current_url = get_permalink( $post->ID );
    			
    		// Get the previous and next product links
    		$previous_link = get_permalink(get_adjacent_post(false,'',false)); 
    		$next_link = get_permalink(get_adjacent_post(false,'',true));
    			
    		// Create the two links provided the product exists
    		if ( $previous_link != $current_url ) {
    			echo '<a rel="previous" class="black-text-link" href="' . $previous_link . '"><i class="fas fa-angle-left"></i> '.esc_html__("Previous",'H-Code').'</a>';
    		}
            if ( $next_link != $current_url ) {
                echo '<a rel="next" class="black-text-link" href="' . $next_link . '">'.esc_html__('Next','H-Code').'<i class="fas fa-angle-right"></i></a>';
            }
    		
    	}
    }

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta',40);
    /* H-Code V1.8 add category and tags */
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta',60);
    
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
    // H-Code 2.0
    $hcode_options = get_option( 'hcode_theme_setting' );
    $enable_product_rating = ( isset( $hcode_options['enable_product_rating'] ) && !empty( $hcode_options['enable_product_rating'] ) ) ? $hcode_options['enable_product_rating'] : '';
    if( $enable_product_rating == 1 ) { 
        add_action('hcode_woocommerce_product_single_rating_sku','woocommerce_template_single_rating',10);
    }
    // Show price after woocommerce_template_single_excerpt
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);
    // TO remove rating in related product
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    // To remove Sale! from product
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    add_action( 'hcode_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );

    // related product config
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    add_action( 'woocommerce_after_single_product_summary', 'hcode_related_products', 20 );
    if ( ! function_exists( 'hcode_related_products' ) ) {
    	
    	function hcode_related_products() {
    		$args = array(
    			'posts_per_page' => ( hcode_option('related_product_show_no') ) ? hcode_option('related_product_show_no') : 7,
    			'orderby' => 'rand'
    		);
    		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
    	}
    }

    add_action('hcode_woocommerce_product_single_rating_sku', 'hcode_woocommerce_product_single_sku',40);
    if ( ! function_exists( 'hcode_woocommerce_product_single_sku' ) ) {
        function hcode_woocommerce_product_single_sku(){
        	global $post, $product;
            $enable_product_sku = hcode_option( 'enable_product_sku' );
        	if ( $enable_product_sku == 1 && wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
        			<div class="product_meta">
        				<span class="rating-text text-uppercase">
        					<?php echo __( 'SKU:', 'H-Code' ); ?>
        					<span class="sku black-text" itemprop="sku">
        						<?php echo ( $sku = $product->get_sku() ) ? $sku : ''; ?>
        					</span>
        				</span>
        			</div>
        	<?php endif;
        }
    }

    /* Product Title And Stock Action For Responsive Version Start */
    add_action ('woocommerce_product_title_responsive', 'woocommerce_template_single_title',5);
    add_action ('woocommerce_product_title_responsive', 'hcode_woocommerce_template_single_stock_and_shipping_available',5);
    /* Product Title And Stock Action For Responsive Version End */


    remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title',5);

    add_action( 'hcode_woocommerce_product_list_excerpt', 'woocommerce_template_single_excerpt', 20 );

    add_action ( 'hcode_woocommerce_product_title_stock_and_shipping_available', 'hcode_woocommerce_template_single_stock_and_shipping_available', 5 );
    if ( ! function_exists( 'hcode_woocommerce_template_single_stock_and_shipping_available' ) ) {
        function hcode_woocommerce_template_single_stock_and_shipping_available(){
        	global $post, $product;
        	$stock = $shipping_available = $separatorline = '';
        	$enable_product_stock_status = hcode_option( 'enable_product_stock_status' );
        	$enable_product_shipping = hcode_option( 'enable_product_shipping' );
        	$hcode_shipping_available_text = hcode_option( 'hcode_shipping_available_text' );
        	$availability = $product->get_availability();

		    if ( $product->is_type( 'simple' ) && $availability['availability'] && $enable_product_stock_status ) :
		        $stock = apply_filters( 'woocommerce_stock_html', esc_html( $availability['availability'] ), $availability['availability'] );
		    endif;
		    if( $product->is_type( 'simple' ) && $enable_product_stock_status ) :
		    	$stock = ( $stock ) ? $stock : __( 'In stock', 'H-Code' );
		    endif;
		    if( get_option('woocommerce_calc_shipping') == 'yes' && $enable_product_shipping && !$product->is_virtual() && ( $product->get_stock_status() !== 'outofstock' ) ) :
		    	$shipping_available = $hcode_shipping_available_text;
		    endif;
		    if( $stock && $shipping_available ):
		    	$separatorline = ' / ';
		    endif;
        	echo '<p class="text-uppercase letter-spacing-2 margin-two product-available">'.$stock.$separatorline.$shipping_available.'</p>';
        	echo '<div class="separator-line bg-black no-margin-lr margin-five"></div>';
        }
    }

    // check for empty-cart get param to clear the cart
    add_action( 'init', 'hcode_woocommerce_clear_cart_url' );
    if ( ! function_exists( 'hcode_woocommerce_clear_cart_url' ) ) {
        function hcode_woocommerce_clear_cart_url() {
          global $woocommerce;
        	
        	if ( isset( $_GET['empty-cart'] ) ) {
        		$woocommerce->cart->empty_cart(); 
        	}
        }
    }

    /* Remove Woocommerce Default style */
    add_filter( 'woocommerce_enqueue_styles', 'hcode_dequeue_woocommerce_styles' );
    if ( ! function_exists( 'hcode_dequeue_woocommerce_styles' ) ) {
        function hcode_dequeue_woocommerce_styles( $enqueue_styles ) {
            
        	unset( $enqueue_styles['woocommerce-general'] );
        	unset( $enqueue_styles['woocommerce-layout'] );
        	unset( $enqueue_styles['woocommerce-smallscreen'] );
            unset( $enqueue_styles['select2'] );
        	return $enqueue_styles;
        }
    }

    // To add custom color field in taxonomy "pa_color"
    if ( ! function_exists( 'hcode_edit_color_field' ) ) {
        function hcode_edit_color_field($term) {
        	// put the term ID into a variable
                
                $t_id = $term->term_id;
         
        	// retrieve the existing value(s) for this meta field. This returns an array
        	$term_meta = get_option( "taxonomy_$t_id" ); ?>
        	<tr class="form-field">
        	<th scope="row" valign="top"><label for="term_meta[custom_color]"><?php esc_html_e( 'Add color code with #', 'H-Code' ); ?></label></th>
        		<td>
        			<input type="text" name="term_meta[custom_color]" id="term_meta[custom_color]" value="<?php echo esc_attr( $term_meta['custom_color'] ) ? esc_attr( $term_meta['custom_color'] ) : ''; ?>">
        			<p class="description"><?php esc_html_e( 'Enter a color code. ex. for white = #FFFFFF','H-Code' ); ?></p>
        		</td>
        	</tr>
        <?php
        }
    }

    if ( ! function_exists( 'hcode_add_color_field' ) ) {
        function hcode_add_color_field( $term ){ ?>
            <tr class="form-field">
        	<th scope="row" valign="top"><label for="term_meta[custom_color]"><?php esc_html_e( 'Add color code with #', 'H-Code' ); ?></label></th>
        		<td>
        			<input type="text" name="term_meta[custom_color]" id="term_meta[custom_color]" value="">
        			<p class="description"><?php esc_html_e( 'Enter a color code. ex. for white = #FFFFFF','H-Code' ); ?></p>
        		</td>
        	</tr>
        <?php
        }
    }

    // Save extra taxonomy fields callback function.
    if ( ! function_exists( 'hcode_save_taxonomy_custom_field_color' ) ) {
        function hcode_save_taxonomy_custom_field_color( $term_id ) {
            if ( isset( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option( "taxonomy_$t_id" );
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset ( $_POST['term_meta'][$key] ) ) {
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // Save the option array.
                update_option( "taxonomy_$t_id", $term_meta );
            }
        } 
    }

    add_filter('woocommerce_add_to_cart_fragments', 'hcode_add_to_cart_fragments'); 
    if ( ! function_exists( 'hcode_add_to_cart_fragments' ) ) {
        function hcode_add_to_cart_fragments( $fragments ) {
        	global $woocommerce;       
        	ob_start();
        	?>
        	<div class="hcode_shopping_cart_content">
        		<?php wc_get_template( 'cart/mini-cart.php');?>
        	</div>
        	<?php
        	$fragments['.hcode_shopping_cart_content'] = ob_get_clean();
        	return $fragments;
        }
    }

    /* For Grid and List view in Woocommerce */

    if ( ! function_exists( 'hcode_woocommerce_category_view' ) ) :

        function hcode_woocommerce_category_view() {
            $product_view_type = '';
            $hcode_woocommerce_category_view_type = hcode_option( 'hcode_woocommerce_category_view_type' );
            if( $hcode_woocommerce_category_view_type == 1 ):
                $product_view_type = ' product-grid-view';
            elseif( $hcode_woocommerce_category_view_type == 2 ):
                $product_view_type = ' product-list-view';
            else:
            endif;
            echo esc_attr( $product_view_type );
        }
    endif;

    /* For Woocommerce product Tabs */
    add_filter( 'woocommerce_product_tabs', 'hcode_woo_rename_tabs', 10 );
    if ( ! function_exists( 'hcode_woo_rename_tabs' ) ) {
        function hcode_woo_rename_tabs( $tabs ) {
            global $product, $post;

            // Description Additional Information First Tab
            if ( $post->post_content ) :
                $tabs['description'] = array(
                'title'     => esc_html__( 'Details', 'H-Code' ),
                'priority'  => 10,
                'callback'  => 'woocommerce_product_description_tab'
               );
            endif;

            // Adds Washing Instructions Second Tab
            $hcode_washing_instruction = get_post_meta( $post->ID, 'hcode_washing_instruction', true );
            if( $hcode_washing_instruction ):
                $tabs['washing_instructions'] = array(
            	'title' 	=> esc_html__( 'Washing Instructions', 'H-Code' ),
            	'priority' 	=> 30,
            	'callback' 	=> 'hcode_woocommerce_product_tab_instructions'
                );
            endif;

            // Adds Sizing Third Tab
            $hcode_size_tab = get_post_meta($post->ID, 'hcode_size_tab', true);
            if ($hcode_size_tab):
                $tabs['sizing'] = array(
            	'title' 	=> esc_html__( 'Sizing', 'H-Code' ),
            	'priority' 	=> 35,
            	'callback' 	=> 'hcode_woocommerce_product_tab_sizing'
                );
            endif;
            
            // Reviews Last Tab
            if ( comments_open() ) {
                $tabs['reviews']['priority'] = 40;
            }

        	return $tabs;
        }
    }

    if ( ! function_exists( 'hcode_woocommerce_product_tab_instructions' ) ) {
        function hcode_woocommerce_product_tab_instructions() {
            global $post;
            
            $meta_value = get_post_meta( $post->ID, 'hcode_product_tabs_options', true );
                        
            if( !empty($meta_value) && isset( $meta_value[0]['hcode_washing_instruction'] )) {
            
                $hcode_washing_instruction = ( $meta_value[0]['hcode_washing_instruction'] ) ? $meta_value[0]['hcode_washing_instruction'] : '';
                // Washing Instructions Content
                echo '<div class="col-md-12 col-sm-12 col-xs-12">'.$hcode_washing_instruction.'</div>';
            }        	
        }
    }

    if ( ! function_exists( 'hcode_woocommerce_product_tab_sizing' ) ) {
        function hcode_woocommerce_product_tab_sizing() {
            global $post;
            
            $meta_value = get_post_meta($post->ID, 'hcode_product_tabs_options', true);
            if( !empty($meta_value) && isset( $meta_value[0]['hcode_size_tab'] )) {
            
                $hcode_size_tab = ( $meta_value[0]['hcode_size_tab'] ) ? $meta_value[0]['hcode_size_tab'] : '';
                // Sizing Content
                echo '<div class="col-md-12 col-sm-12 col-xs-12">'.$hcode_size_tab.'</div>';
            }
        }
    }

    /* Product single Title setup */
    if ( ! function_exists( 'hcode_woocommerce_product_single_title' ) ) {
        function hcode_woocommerce_product_single_title(){
            global $post;
            $output = '';

            ob_start();
            do_action('woocommerce_product_title_responsive');
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
            
        }
    }
    
    /* To Remove Placehoder From Checkout Form */
    add_filter( 'woocommerce_default_address_fields', 'hcode_override_address_fields' );
    if ( ! function_exists( 'hcode_override_address_fields' ) ) {
        function hcode_override_address_fields( $address_fields ) {
            if( is_checkout() ) {
                $address_fields['address_1']['placeholder'] = '';
                $address_fields['address_2']['placeholder'] = '';
                $address_fields['city']['placeholder'] = '';
                $address_fields['state']['placeholder'] = '';
                $address_fields['postcode']['placeholder'] = '';
            }
            return $address_fields;
        }
    }

    /* Remove Mini cart buttons */
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

    /* Removed cart totals from cart page */
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

    if ( ! function_exists( 'hcode_woocommerce_archive_column_class' ) ) :
        function hcode_woocommerce_archive_column_class( $classes ) {

            if( is_shop() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_product_taxonomy() ) {

                $hcode_category_product_row = hcode_option( 'hcode_category_product_row_column' );

                switch ( $hcode_category_product_row ) {
                    case '6':
                        $classes[] = 'col-md-2 col-sm-6 col-xs-12';
                    break;
                    case '4':
                        $classes[] = 'col-md-3 col-sm-6 col-xs-12';
                    break;
                    case '3':
                        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
                    break;
                    case '2':
                        $classes[] = 'col-md-6 col-sm-6 col-xs-12';
                    break;
                    case '1':
                        $classes[] = 'col-md-12 col-sm-12 col-xs-12';
                    break;
                    default:
                        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
                    break;
                }
            }
            return $classes;
        }
    endif;
    add_filter( 'post_class', 'hcode_woocommerce_archive_column_class' );

    if ( ! function_exists( 'hcode_woocommerce_archive_loop_columns' ) ) :
        function hcode_woocommerce_archive_loop_columns() {
            $hcode_category_product_row = hcode_option( 'hcode_category_product_row_column' );
            $column = '';
            switch ( $hcode_category_product_row ) {
                case '6':
                    $column = 6;
                break;
                case '4':
                    $column = 4;
                break;
                case '3':
                    $column = 3;
                break;
                case '2':
                    $column = 2;
                break;
                case '1':
                    $column = 1;
                break;
                default:
                    $column = 3;
                break;
            }
            return $column;
        }
    endif;
    add_filter( 'loop_shop_columns', 'hcode_woocommerce_archive_loop_columns', 999 );

    /* Add Thumbnail on Product Tag page */
    add_action( 'product_tag_add_form_fields', 'hcode_add_thumbnail_option_in_product_tag_page' );

    if ( ! function_exists( 'hcode_add_thumbnail_option_in_product_tag_page' ) ) :
        function hcode_add_thumbnail_option_in_product_tag_page() { ?>
            <div class="form-field product_tag_thumbnail_main">
                <label><?php echo esc_html__( 'Thumbnail', 'H-Code' ); ?></label>
                <div id="product_tag_thumbnail" class="thumb_img_preview" style="float: left; margin-right: 10px;">
                    <img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" alt=""/>
                </div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="product_tag_thumbnail_id" class="product_tag_thumb_id" name="product_tag_thumbnail_id" />
                    <button type="button" class="upload_image_button button"><?php echo esc_html__( 'Upload/Add image', 'H-Code' ); ?></button>
                    <button type="button" class="remove_image_button button"><?php echo esc_html__( 'Remove image', 'H-Code' ); ?></button>
                </div>
                <div class="clear"></div>
            </div>
            <script type="text/javascript">
                (function( $ ) {
                    // Only show the "remove image" button when needed
                    if ( !$( '.product_tag_thumbnail_main #product_tag_thumbnail_id' ).val() ) {
                        $( '.product_tag_thumbnail_main .remove_image_button' ).hide();
                    }
                    $( document ).on( 'click', '.upload_image_button', function( event ) {
                        // Uploading files
                        var file_frame;
                        event.preventDefault();
                        var currentdiv = $(this).parent().parent();
                        
                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php echo esc_html__( "Choose an image", "H-Code" ); ?>',
                            button: {
                                text: '<?php echo esc_html__( "Use image", "H-Code" ); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            var attachment = file_frame.state().get( 'selection' ).first().toJSON();
                            currentdiv.find( '.product_tag_thumb_id' ).val( attachment.id );
                            currentdiv.find( '.thumb_img_preview img' ).attr( 'src', attachment.url );
                            currentdiv.find( '.remove_image_button' ).show();
                        });

                        // Finally, open the modal.
                        file_frame.open();
                    });

                    $( document ).on( 'click', '.remove_image_button', function() {
                        var currentdiv = $(this).parent().parent();
                        currentdiv.find( '.thumb_img_preview img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                        currentdiv.find( '.product_tag_thumb_id   ' ).val( '' );
                        currentdiv.find( '.remove_image_button' ).hide();
                        return false;
                    });
                    $( document ).ajaxComplete( function( event, request, options ) {
                        if ( request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

                            var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
                            if ( ! res || res.errors ) {
                                return;
                            }
                            // Clear Thumbnail fields on submit
                            $( '#product_tag_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                            $( '#product_tag_thumbnail_id' ).val( '' );
                            $( '.remove_image_button' ).hide();
                            return;
                        }
                    });
                })( jQuery );
            </script>
        <?php
        }
    endif;
    
    /* Add Thumbnail on Edit Product Tag page */
    add_action( 'product_tag_edit_form_fields', 'hcode_edit_thumbnail_option_in_product_tag_page', 10, 2 );

    if ( ! function_exists( 'hcode_edit_thumbnail_option_in_product_tag_page' ) ) :
        function hcode_edit_thumbnail_option_in_product_tag_page( $term, $taxonomy ) {
            $image = '';
            $thumbnail_id   = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
            if ( $thumbnail_id ){
                $image = wp_get_attachment_thumb_url( $thumbnail_id );
            } else {
                $image = wc_placeholder_img_src();  
            }

            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label><?php echo esc_html__( 'Thumbnail', 'H-Code' ); ?></label></th>
                <td>
                    <div class="product_tag_thumbnail_main">
                        <div id="product_brand_thumbnail" class="thumb_img_preview" style="float: left; margin-right: 10px;">
                            <img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" alt="" />
                        </div>
                        <div style="line-height: 60px;">
                            <input type="hidden" id="product_tag_thumbnail_id" name="product_tag_thumbnail_id" class="product_tag_thumb_id" value="<?php echo $thumbnail_id; ?>" />
                            <button type="button" class="upload_image_button button"><?php echo esc_html__( 'Upload/Add image', 'H-Code' ); ?></button>
                            <button type="button" class="remove_image_button button"><?php echo esc_html__( 'Remove image', 'H-Code' ); ?></button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </td>

                <script type="text/javascript">
                    (function( $ ) {
                        // Only show the "remove image" button when needed
                        if ( '0' === $( '.product_tag_thumbnail_main #product_tag_thumbnail_id' ).val() ) {
                            $( '.product_tag_thumbnail_main .remove_image_button' ).hide();
                        }

                        $( document ).on( 'click', '.upload_image_button', function( event ) {
                            // Uploading files
                            var file_frame;
                            event.preventDefault();
                            var currentdiv = $(this).parent().parent();

                            // If the media frame already exists, reopen it.
                            if ( file_frame ) {
                                file_frame.open();
                                return;
                            }

                            // Create the media frame.
                            file_frame = wp.media.frames.downloadable_file = wp.media({
                                title: '<?php echo esc_html__( "Choose an image", "H-Code" ); ?>',
                                button: {
                                        text: '<?php echo esc_html__( "Use image", "H-Code" ); ?>'
                                },
                                multiple: false
                            });

                            // When an image is selected, run a callback.
                            file_frame.on( 'select', function() {
                                var attachment = file_frame.state().get( 'selection' ).first().toJSON();
                                currentdiv.find( '.product_tag_thumb_id' ).val( attachment.id );
                                currentdiv.find( '.thumb_img_preview img' ).attr( 'src', attachment.url );
                                currentdiv.find( '.remove_image_button' ).show();
                            });

                            // Finally, open the modal.
                            file_frame.open();
                        });

                        $( document ).on( 'click', '.remove_image_button', function() {
                            var currentdiv = $(this).parent().parent();
                            currentdiv.find( '.thumb_img_preview img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
                            currentdiv.find( '.product_tag_thumb_id' ).val( '' );
                            currentdiv.find( '.remove_image_button' ).hide();
                            return false;
                        });
                    })( jQuery );
                </script>
            </tr>
        <?php
        }
    endif;

    /* Save Thumbnail */
    add_action( 'created_term', 'hcode_save_product_tag_field', 10, 3 );
    add_action( 'edit_term', 'hcode_save_product_tag_field', 10, 3 );

    if ( ! function_exists( 'hcode_save_product_tag_field' ) ) :
        function hcode_save_product_tag_field( $term_id, $tt_id, $taxonomy ) {
            if ( isset( $_POST['product_tag_thumbnail_id'] ) && 'product_tag' === $taxonomy ) {
                update_term_meta( $term_id, 'thumbnail_id', absint( $_POST['product_tag_thumbnail_id'] ) );
            }
        }
    endif;

    /* Add Thumbnail on Tags listing */
    add_filter( 'manage_edit-product_tag_columns', 'hcode_product_tag_columns' );
    if ( ! function_exists( 'hcode_product_tag_columns' ) ) :
        function hcode_product_tag_columns( $columns ) {
                    
            $new_columns          = array();
            $new_columns['cb']    = $columns['cb'];
            $new_columns['banner_thumb'] = esc_html__( 'Banner', 'H-Code' );
            unset( $columns['cb'] );

            return array_merge( $new_columns, $columns );
        }
    endif;

    add_filter( 'manage_product_tag_custom_column', 'hcode_product_tag_column', 10, 3 );

    if ( ! function_exists( 'hcode_product_tag_column' ) ) :
        function hcode_product_tag_column( $columns, $column, $id ) {
            if ( 'banner_thumb' == $column ) {
                $thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );
                if ( $thumbnail_id ) {
                    $image = wp_get_attachment_thumb_url( $thumbnail_id );
                } else {
                    $image = wc_placeholder_img_src();
                }

                // Prevent esc_url from breaking spaces in urls for image embeds
                // Ref: http://core.trac.wordpress.org/ticket/23605
                $image = str_replace( ' ', '%20', $image );
                $columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'H-Code' ) . '" class="wp-post-image" height="48" width="48" />';
            }
            return $columns;
        }
    endif;

    /* H-Code Version 1.9.9 Continue shopping Link */
    add_action( 'hcode_woocommerce_continue_shopping_link', 'hcode_woocommerce_continue_shopping_link_callback' );
    if ( ! function_exists( 'hcode_woocommerce_continue_shopping_link_callback' ) ) :
        function hcode_woocommerce_continue_shopping_link_callback() {
            $hcode_options = get_option( 'hcode_theme_setting' );
            $continue_shopping_page_link = ( isset( $hcode_options['continue_shopping_page_link'] ) && !empty( $hcode_options['continue_shopping_page_link'] ) ) ? $hcode_options['continue_shopping_page_link'] : '';
            if( $continue_shopping_page_link ) {
                $continue_shopping_page_link_url = get_page_by_path( $continue_shopping_page_link );
                if( is_cart() ) {
                    echo '<a href="'.get_permalink( $continue_shopping_page_link_url ).'" class="highlight-button btn btn-very-small no-margin pull-right continue-shopping">'.esc_html__( 'Continue shopping', 'woocommerce' ).'</a>';
                } else {
                    echo '<a href="'.get_permalink( $continue_shopping_page_link_url ).'" class="highlight-button btn btn-small no-margin-bottom clear-both pull-left"><i class="fas fa-long-arrow-alt-left extra-small-icon"></i>'.esc_html__( 'Continue shopping', 'woocommerce' ).'</a>';
                }
            } else {
                if( is_cart() ) {
                    echo '<a href="'.get_permalink( wc_get_page_id( 'shop' ) ).'" class="highlight-button btn btn-very-small no-margin pull-right continue-shopping">'.esc_html__( 'Continue shopping', 'woocommerce' ).'</a>';
                } else {
                    echo '<a href="'.get_permalink( wc_get_page_id( 'shop' ) ).'" class="highlight-button btn btn-small no-margin-bottom clear-both pull-left"><i class="fas fa-long-arrow-alt-left extra-small-icon"></i>'.esc_html__( 'Continue shopping', 'woocommerce' ).'</a>';
                }   
            }
        }
    endif;
}