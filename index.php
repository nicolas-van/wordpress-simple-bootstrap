<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="col-sm-8 <?php echo (is_active_sidebar( 'sidebar1' ) ? '' : 'col-sm-push-2'); ?>" role="main">

					<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class("block"); ?> role="article">
						
						<header>
							
							<div class="article-header"><h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>

							<?php if (has_post_thumbnail()) { ?>
							<div class="featured-image">
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('wpbs-featured-small'); ?></a>
							</div>
							<?php } ?>
							
							<?php display_post_meta() ?>
						
						</header>
					
						<section class="post_content">
							<?php the_content( __("Read more &raquo;","wpbootstrap") ); ?>
						</section>
						
						<footer>
							<?php the_tags('<p class="tags">', ' ', '</p>'); ?>
						</footer>
					
					</article>
					
					<?php endwhile; ?>	
					
					<?php page_navi(); ?>	
					
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