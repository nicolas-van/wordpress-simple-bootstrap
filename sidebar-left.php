
<?php if ( is_active_sidebar( 'sidebar-left' ) ) { ?>
<div id="sidebar-left" class="<?php simple_boostrap_sidebar_left_classes(); ?>" role="complementary">
    <div class="vertical-nav block">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
    </div>
</div>
<?php } ?>