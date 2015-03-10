<?php get_header(); ?>

<div id="content" class="row">

	<div id="main" class="<?php main_classes(); ?>" role="main">
		
		<div class="block block-title">
			<h1><?php echo _x("Search for:", "label", "default"); ?> <?php echo esc_attr(get_search_query()); ?></h1>
		</div>

		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		
		<?php display_post(true); ?>
		
		<?php endwhile; ?>	
		
		<?php page_navi(); ?>		
		
		<?php else : ?>
		
		<!-- this area shows up if there are no results -->
		
		<article id="post-not-found" class="block">
		    <p><?php _e("No items found.", "default"); ?></p>
		</article>
		
		<?php endif; ?>

	</div>
	
	<?php get_sidebar(); // sidebar 1 ?>

</div>

<?php get_footer(); ?>