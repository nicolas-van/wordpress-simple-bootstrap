
<?php if ( is_active_sidebar( 'sidebar1' ) ) { ?>
<div id="sidebar1" class="vertical-nav col-sm-4" role="complementary">
    <div class="sidebar-container">
	<?php dynamic_sidebar( 'sidebar1' ); ?>
    </div>
</div>
<?php } ?>