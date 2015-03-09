<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="col-sm-8 <?php echo (is_active_sidebar( 'sidebar1' ) ? '' : 'col-lg-push-2'); ?>" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('block'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<div class="article-header"><h1 itemprop="headline"><?php the_title(); ?></h1></div>
							
							<?php display_post_meta() ?>
						
						</header>/
					
						<section class="post_content" itemprop="articleBody">
							
							<?php the_content(); ?>
							
						</section>/
						
						<footer>
							<?php the_tags('<p class="tags">', ' ', '</p>'); ?>
						</footer>/
					
					</article>/
					
					<?php comments_template('', true); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found" class="block">
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
			
				</div>/
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div>/

<?php get_footer(); ?>