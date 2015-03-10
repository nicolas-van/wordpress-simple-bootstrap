<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="<?php main_classes(); ?>" role="main">
					
					<div class="block block-title">
						<h1 class="archive_title">
							<?php echo get_the_archive_title() ?>
						</h1>
					</div>

					<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					
					<?php display_post(true); ?>
					
					<?php endwhile; ?>	
					
					<?php page_navi(); ?>	
					
					<?php else : ?>
					
					<article id="post-not-found" class="block">
					    <p><?php _e("No items found.", "default"); ?></p>
					</article>
					
					<?php endif; ?>
			
				</div>
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div>

<?php get_footer(); ?>