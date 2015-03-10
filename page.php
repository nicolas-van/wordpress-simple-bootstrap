<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="<?php echo is_active_sidebar( 'sidebar1' ) ? 'col-sm-8' : 'col-md-8 col-md-push-2'; ?>" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php display_post(false); ?>
					
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found" class="block">
					    <p><?php _e("No pages found.", "default"); ?></p>
					</article>
					
					<?php endif; ?>
			
				</div>
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div>

<?php get_footer(); ?>