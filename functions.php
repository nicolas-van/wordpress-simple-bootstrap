<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// registration of the translations
load_theme_textdomain( 'wpbootstrap', TEMPLATEPATH.'/languages' );

// Declaration of theme supported features
function wp_bootstrap_theme_support() {
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size(125, 125, true);   // default thumb size
    add_theme_support('automatic-feed-links'); // rss thingy
    add_theme_support( 'menus' );            // wp menus
    register_nav_menus(                      // wp3+ menus
        array( 
            'main_nav' => 'The Main Menu',   // main nav in header
        )
    );
}
add_action('after_setup_theme','wp_bootstrap_theme_support');

// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles() { 
        // For child themes
        wp_register_style( 'wpbs-style', get_stylesheet_directory_uri() . '/style.min.css', array(), null, 'all' );
        wp_enqueue_style( 'wpbs-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// enqueue javascript
if( !function_exists( "theme_js" ) ) {  
    function theme_js(){
        wp_register_script( 'bower-libs', 
            get_template_directory_uri() . '/app.min.js', 
            array('jquery'), 
            null );
        wp_enqueue_script('bower-libs');
    }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );


// Set content width
if ( ! isset( $content_width ) )
    $content_width = 750;

// Thumbnail sizes
add_image_size( 'wpbs-featured-small', 780);
add_image_size( 'wpbs-featured-big', 1170);

// Sidebar and Footer declaration
function wp_bootstrap_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar',
    	'description' => 'Used on every page.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer',
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    
}
add_action( 'widgets_init', 'wp_bootstrap_register_sidebars' );


// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

    function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        // If the item has children, add the dropdown class for bootstrap
        if ( $args->has_children ) {
        	$class_names = "dropdown ";
        }

        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        // if the item has children add these two attributes to the anchor tag
        // if ( $args->has_children ) {
        //     $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
        // }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
        $item_output .= $args->link_after;

        // if the item has children add the caret just before closing the anchor tag
        if ( $args->has_children ) {
            $item_output .= '<b class="caret"></b></a>';
        }
        else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
    } // end start_el function
        
    function start_lvl(&$output, $depth = 0, $args = Array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
      
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }        
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
        $classes[] = "active";
	}
  
    return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

// display the menu
function wp_bootstrap_main_nav() {
    wp_nav_menu( 
        array( 
            'menu' => 'main_nav', /* menu name */
            'menu_class' => 'nav navbar-nav',
            'theme_location' => 'main_nav', /* where in the theme it's assigned */
            'container' => 'false', /* container class */
            'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
            // 'depth' => '2',  suppress lower levels for now 
            'walker' => new Bootstrap_walker()
        )
    );
}

// this is the fallback for header menu
function wp_bootstrap_main_nav_fallback() { 
    // Figure out how to make this output bootstrap-friendly html
    //wp_page_menu( 'show_home=Home&menu_class=nav' ); 
}

/*
  A function used in multiple places to generate the metadata of a post.
*/
function display_post_meta() {
?>

    <ul class="meta text-muted list-inline">
        <li>
            <a href="<?php echo esc_url(get_permalink()) ?>">
                <span class="glyphicon glyphicon-time"></span>
                <?php echo esc_html(get_the_date()); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                <span class="glyphicon glyphicon-user"></span>
                <?php echo esc_html(get_the_author()); ?>
            </a>
        </li>
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
        <li>
            <?php
                $sp = '<span class="glyphicon glyphicon-comment"></span> ';
                comments_popup_link( $sp.esc_html(__( 'Leave a comment')), $sp.esc_html(__( '1 Comment')), $sp.esc_html(__( '% Comments')) );
            ?>
        </li>
        <?php endif; ?>
        <?php edit_post_link(esc_html(__( 'Edit')), '<li><span class="glyphicon glyphicon-pencil"></span> ', '</li>'); ?>
    </ul>

<?php
}

function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
        
    echo $before.'<ul class="pagination">'."";
    if ($paged > 1) {
        $first_page_text = "&laquo";
        echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
    }
        
    $prevposts = get_previous_posts_link('&larr; Previous');
    if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
    else { echo '<li class="disabled"><a href="#">&larr; Previous</a></li>'; }
    
    for($i = $start_page; $i  <= $end_page; $i++) {
        if($i == $paged) {
            echo '<li class="active"><a href="#">'.$i.'</a></li>';
        } else {
            echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
    }
    echo '<li class="">';
    next_posts_link('Next &rarr;');
    echo '</li>';
    if ($end_page < $max_page) {
        $last_page_text = "&raquo;";
        echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
    }
    echo '</ul>'.$after."";
}

?>