<?php
/**
 * The WordPress template hierarchy first checks for any
 * MIME-types and then looks for the attachment.php file.
 *
 * @link codex.wordpress.org/Template_Hierarchy#Attachment_display 
 */ 

get_header(); ?>

<div id="content" class="row">

	<div id="main" class="<?php simple_boostrap_main_classes(); ?>" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class("block"); ?> role="article">
			
			<header> 
				
				<div class="article-header"><h1 itemprop="headline"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo esc_html(get_the_title($post->post_parent)); ?></a> &raquo; <?php the_title(); ?></h1></div>
				
				
				<?php simple_bootstrap_display_post_meta() ?>
			
			</header>
		
			<section class="post_content" itemprop="articleBody">
				
				<!-- To display current image in the photo gallery -->
				<div class="attachment-img">
				      <a href="<?php echo wp_get_attachment_url($post->ID); ?>">
				      							      
				      <?php 
				      	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
				       
					      if ($image) : ?>
					          <img src="<?php echo $image[0]; ?>" alt="" />
					      <?php endif; ?>
				      
				      </a>
				</div>
				
			</section>
			
			<footer>
				<?php the_tags('<p class="tags">', ' ', '</p>'); ?>
			</footer>

			<nav>
			  	<ul class="pager">
			    	<li class="previous"><?php next_image_link( false, __( '&laquo; Previous', "simple-bootstrap")); ?></li>
			    	<li class="next"><?php previous_image_link( false, __( 'Next &raquo;', "simple-bootstrap")); ?></li>
			  	</ul>
			</nav>
		
		</article>
		
		<?php comments_template(); ?>
		
		<?php endwhile; ?>			
		
		<?php else : ?>
		
		<article id="post-not-found" class="block">
		    <p><?php _e("No items found.", "simple-bootstrap"); ?></p>
		</article>
		
		<?php endif; ?>

	</div>
	
	<?php get_sidebar("left"); ?>
	<?php get_sidebar("right"); ?>

</div>

<?php get_footer(); ?>