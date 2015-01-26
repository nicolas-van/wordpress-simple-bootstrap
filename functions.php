<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Set content width
if ( ! isset( $content_width ) )
  $content_width = 750;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured-small', 780);
add_image_size( 'wpbs-featured-big', 1170);

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
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

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

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
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
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
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}

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

?>