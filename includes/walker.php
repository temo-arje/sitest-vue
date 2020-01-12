<?php
class Walkernav extends Walker_Nav_Menu
{

    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        /* Add active class */
        if(in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }

        /* Check for children */
//        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
//        if (!empty($children)) {
//            $classes[] = 'has-sub';
//        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url;
        $output .= "<li class='" .  implode(" ", $item->classes) . "'>";

        // <router-link class="menu__links-item" to="/blog">ბლოგი</router-link>-->
        //Add SPAN if no Permalink
        if( $permalink && $permalink != '#' ) {
            $path = parse_url($permalink)['path'];

            $output .= '<router-link to="' . $path . '">';
        } else {
            $output .= '<span>';
        }

        $output .= $title;
        if( $description != '' && $depth == 0 ) {
            $output .= '<small class="description">' . $description . '</small>';
        }
        if( $permalink && $permalink != '#' ) {
            $output .= '</router-link>';
        } else {
            $output .= '</span>';
        }

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

//    function end_el( &$output, $item, $depth = 0, $args = array() ) {
//        $output .= "</li>\n";
//    }
//    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
//      echo '<pre>';
//        print_r($item);
//        echo '</pre>';
//        $object = $item->object;
//
//        $type = $item->type;
//        $title = $item->title;
//        $description = $item->description;
//        $permalink = $item->url;
//        $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
//
//       // <router-link class="menu__links-item" to="/blog">ბლოგი</router-link>-->
//        //Add SPAN if no Permalink
//        if( $permalink && $permalink != '#' ) {
//            $path = parse_url($permalink)['path'];
//
//            $output .= '<router-link to="' . $path . '">';
//        } else {
//            $output .= '<span>';
//        }
//
//        $output .= $title;
//        if( $description != '' && $depth == 0 ) {
//            $output .= '<small class="description">' . $description . '</small>';
//        }
//        if( $permalink && $permalink != '#' ) {
//            $output .= '</router-link>';
//        } else {
//            $output .= '</span>';
//        }
//    }
}