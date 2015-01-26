<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="col-sm-8 <?php echo (is_active_sidebar( 'sidebar1' ) ? '' : 'col-lg-push-2'); ?>" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<div class="page-header"><h1 itemprop="headline"><?php the_title(); ?></h1></div>
							
							<?php display_post_meta() ?>
						
						</header> <!-- end article header -->
					
						<section class="post_content" itemprop="articleBody">
							
							<?php the_content(); ?>
							
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="tags"><?php the_tags('', ' ', ''); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template('', true); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found","wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.","wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>