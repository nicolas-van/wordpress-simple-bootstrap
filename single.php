<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="col-sm-8 <?php echo (is_active_sidebar( 'sidebar1' ) ? '' : 'col-sm-push-2'); ?>" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php display_post(false); ?>
					
					<?php comments_template('',true); ?>
					
					<?php if (get_next_post() || get_previous_post()) { ?>
					<nav class="block">
						<ul class="pager pager-unspaced">
							<li class="previous"><?php next_post_link( '%link', esc_html(__( 'Next Post')) ); ?></li>
							<li class="next"><?php previous_post_link( '%link', esc_html(__( 'Previous Post')) ); ?></li>
						</ul>
					</nav>
					<?php } ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
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