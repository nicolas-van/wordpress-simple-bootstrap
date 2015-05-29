<?php

	if ( post_password_required() ) { ?>
		<div id="comments" class="block">
			<?php _e("This post is password protected. Enter the password to view comments.", "simple-bootstrap"); ?>
		</div>
		<?php
		return;
	}
?>

<?php if ( have_comments() || comments_open() ) : ?>

<div id="comments" class="block">

<?php if ( have_comments() ) : ?>
	<h3><?php echo __("Comments", "simple-bootstrap")?></h3>
	
	<ol class="commentlist">
		<?php wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<ul id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link( __("&laquo; Older Comments", "simple-bootstrap") ); ?></li>
			<li class="next"><?php next_comments_link( __("Newer Comments &raquo;", "simple-bootstrap") ); ?></li>
		</ul>
	</ul>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>

<?php endif; ?>
