<?php

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
    add_theme_support('menus');            // wp menus
    add_theme_support('custom-background', array(
        'default-color' => '#eeeeee',
    ));
    register_nav_menus(                      // wp3+ menus
        array( 
            'main_nav' => 'Main Menu',   // main nav in header
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
add_image_size( 'wpbs-featured-small', 750, 750 * (9 / 21), true);
add_image_size( 'wpbs-featured-big', 1141, 1141 * (9 / 21), true);

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

        $dropdown = $args->has_children && $depth == 0;

        $class_names = $value = '';

        // If the item has children, add the dropdown class for bootstrap
        if ( $dropdown ) {
            $class_names = "dropdown ";
        }

        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

        if ( $dropdown ) {
            $attributes = ' href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"';
        } else {
            $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
            $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
            $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
            $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
        $item_output .= $args->link_after;

        // if the item has children add the caret just before closing the anchor tag
        if ( $dropdown ) {
            $item_output .= ' <b class="caret"></b>';
        }
        $item_output .= '</a>';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
    } // end start_el function
        
    function start_lvl(&$output, $depth = 0, $args = Array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='dropdown-menu' role='menu'>\n";
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
    if( in_array('current-menu-item', $classes) ) {
        $classes[] = "active";
    }
  
    return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

// display the main menu bootstrap-style
// this menu is limited to 2 levels (that's a bootstrap limitation)
function display_main_menu() {
    if ( has_nav_menu("main_nav") ) {
        wp_nav_menu(
            array( 
                'theme_location' => 'main_nav', /* where in the theme it's assigned */
                'menu' => 'main_nav', /* menu name */
                'menu_class' => 'nav navbar-nav',
                'container' => false, /* container class */
                'depth' => 2,
                'walker' => new Bootstrap_walker(),
            )
        );
    }
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

function page_navi() {
    global $wp_query;

    ?>

    <?php if (get_next_posts_link() || get_previous_posts_link()) { ?>
        <nav class="block">
            <ul class="pager pager-unspaced">
                <li class="previous"><?php previous_posts_link(esc_html(__('Newer posts'))); ?></li>
                <li class="next"><?php next_posts_link(esc_html(__('Older posts'))); ?></li>
            </ul>
        </nav>
    <?php } ?>

    <?php
}

function display_post($multiple_on_page) { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class("block"); ?> role="article">
        
        <header>
            
            <?php if ($multiple_on_page) : ?>
            <div class="article-header">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <?php else: ?>
            <div class="article-header">
                <h1><?php the_title(); ?></h1>
            </div>
            <?php endif ?>

            <?php if (has_post_thumbnail()) { ?>
            <div class="featured-image">
                <?php if ($multiple_on_page) : ?>
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('wpbs-featured-small'); ?></a>
                <?php else: ?>
                <?php the_post_thumbnail('wpbs-featured-small'); ?>
                <?php endif ?>
            </div>
            <?php } ?>

            <?php display_post_meta() ?>
        
        </header>
    
        <section class="post_content">
            <?php
            if ($multiple_on_page) {
                the_excerpt();
            } else {
                the_content();
                wp_link_pages();
            }
            ?>
        </section>
        
        <footer>
            <?php the_tags('<p class="tags">', ' ', '</p>'); ?>
        </footer>
    
    </article>

<?php }

?>