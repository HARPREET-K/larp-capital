<?php
/**
 * H-Code Hamburger Menu Admin Options.
 *
 * @package H-Code
 */
?>
<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    die;
}

/*==============================================================*/
// H-Code Hamburger Menu Front walkar
/*==============================================================*/
if (!class_exists('Hcode_Hamburger_Menu_Walker')) {
    class Hcode_Hamburger_Menu_Walker extends Walker_Nav_Menu {

        public $mega_menu_sub = 1;
        public $get_first_level_menu_id = '';
        public $i = 1;

        /**
         * Start the element output.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $menu_style = hcode_option( 'hcode_header_layout' );

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Get All Postmeta Of Current Item
            $attribute_class = $mega_menu_attribute = '';
            $hcode_mega_menu_single_item_status = get_post_meta( $item->ID, '_hcode_mega_menu_single_item_status', true );

            if( $depth == 0 && $hcode_mega_menu_single_item_status != 'enabled' ){
                $this->get_first_level_menu_id = $item->ID;
                $classes[] = 'menu-first-level';
            }

            switch ($depth) {
                case 0:
                    $classes[] = "dropdown panel simple-dropdown";
                    if( $hcode_mega_menu_single_item_status == 'enabled' ):
                        $attribute_class .= ' class="dropdown-toggle collapsed "';
                        $mega_menu_attribute = ' data-hover="dropdown" data-toggle="collapse"';
                    else:
                        $attribute_class .= ' class="dropdown-toggle"';
                    endif;
                    break;
                case 1:
                    $classes[] = "";
                    break;
                case 2:
                    $classes[] = "";
                    break;
                default:
                    $classes[] = "dropdown panel";
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

            if( $depth == 0 && $menu_style == 'headertype11' ) {
                $output .= '<span class="menu-number">'. str_pad($this->i++, 2, 0, STR_PAD_LEFT) .'</span>';
            }

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
            
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

            } else {

                $item_output .= '<a'. $attributes . $attribute_class. $mega_menu_attribute .'>';

                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                                
                $item_output .= '</a>';

                if( $item -> hasChildren ):
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
        }

        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            // check, whether there are children for the given ID and append it to the element with a (new) ID
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }
}