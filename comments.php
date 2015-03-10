<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div id="comments" class="block">
			<?php _e("This post is password protected. Enter the password to view comments.", "default"); ?>
		</div>
		<?php
		return;
	}
?>

<?php if ( have_comments() || comments_open() ) : ?>

<div id="comments" class="block">

<?php if ( have_comments() ) : ?>
	<h3><?php echo __("Comments", "default")?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<ul id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<li class="nav-previous"><?php previous_comments_link( __("&laquo; Older Comments", "default") ); ?></li>
		<li class="nav-next"><?php next_comments_link( __("Newer Comments &raquo;", "default") ); ?></li>
	</ul>
	<?php endif; ?>
	
	<ol class="commentlist">
		<?php wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<ul id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<li class="nav-previous"><?php previous_comments_link( __("&laquo; Older Comments", "default") ); ?></li>
		<li class="nav-next"><?php next_comments_link( __("Newer Comments &raquo;", "default") ); ?></li>
	</ul>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>

<?php endif; ?>
