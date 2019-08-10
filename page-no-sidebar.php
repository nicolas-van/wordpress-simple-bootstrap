<?php
/*
Template Name: No Sidebar
*/
?>

<?php get_header(); ?>

<div id="content" class="row">

	<div id="main" class="col-lg-12" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php simple_boostrap_display_post(false); ?>
		
		<?php comments_template(); ?>
		
		<?php endwhile; ?>	
		
		<?php else : ?>
		
		<article id="post-not-found" class="block">
		    <p><?php _e("No pages found.", "simple-bootstrap"); ?></p>
		</article>
		
		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>