<?php
/*
The comments page for Bones
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","wpbootstrap"); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->
<div id="comments">

<?php if ( have_comments() ) : ?>
	<?php if ( have_comments() ) : ?>
	<h3><?php echo __("Comments")?></h3>

	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) ); ?>
	</ol>
	
	<?php endif; ?>
	
	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
		</ul>
	</nav>
  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed 
	?>
		
	<!-- If comments are closed. -->
	<p class="alert alert-info"><?php _e("Comments are closed","wpbootstrap"); ?>.</p>
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>
