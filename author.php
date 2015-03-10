<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="<?php echo is_active_sidebar( 'sidebar1' ) ? 'col-sm-8' : 'col-md-8 col-md-push-2'; ?>" role="main">
				
					<div class="block block-title">
						<h1 class="archive_title">
							<span><?php _e("Posts By:", "wpbootstrap"); ?></span> 
							<?php 
								// If google profile field is filled out on author profile, link the author's page to their google+ profile page
								$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
								$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
								if ( $google_profile ) {
									echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>'; 
							?>
							<?php 
								} else {
									echo get_the_author_meta('display_name', $curauth->ID);
								}
							?>
						</h1>
					</div>
					
					<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					
					<?php display_post(true); ?>
					
					<?php endwhile; ?>	
					
					<?php page_navi(); ?>
					
					<?php else : ?>
					
					<article id="post-not-found" class="block">
					    <header>
					    	<h1><?php _e("No Posts Yet", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, What you were looking for is not here.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div>
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div>

<?php get_footer(); ?>