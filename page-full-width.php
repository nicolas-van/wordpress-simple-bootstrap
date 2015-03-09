<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="col-lg-12" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class("block"); ?> role="article">
						
						<header>
							
							<div class="article-header"><h1><?php the_title(); ?></h1></div>

							<?php if (has_post_thumbnail()) { ?>
							<div class="featured-image">
								<?php the_post_thumbnail('wpbs-featured-big'); ?>
							</div>
							<?php } ?>
						
						</header>/
					
						<section class="post_content">
							<?php the_content(); ?>
					
						</section>/
						
						<footer>
							<?php the_tags('<p class="tags">', ' ', '</p>'); ?>
						</footer>/
					
					</article>/
					
					<?php comments_template(); ?>
					
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
			
				</div>/
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div>/

<?php get_footer(); ?>