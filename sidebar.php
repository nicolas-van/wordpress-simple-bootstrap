
<?php if ( is_active_sidebar( 'sidebar1' ) ) { ?>
<div id="sidebar1" class="col-sm-4" role="complementary">
    <div class="vertical-nav">
	<?php dynamic_sidebar( 'sidebar1' ); ?>
    </div>
</div>
<?php } ?>