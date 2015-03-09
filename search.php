<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="<?php echo is_active_sidebar( 'sidebar1' ) ? 'col-sm-8' : 'col-md-8 col-md-push-2'; ?>" role="main">
					
					<div class="block block-title">
						<h1><span><?php _e("Search Results for","wpbootstrap"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1>
					</div>

					<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					
					<?php display_post(true); ?>
					
					<?php endwhile; ?>	
					
					<?php page_navi(); ?>		
					
					<?php else : ?>
					
					<!-- this area shows up if there are no results -->
					
					<article id="post-not-found" class="block">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div>
    			
    			<?php get_sidebar(); // sidebar 1 ?>
    
			</div>

<?php get_footer(); ?>