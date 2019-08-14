<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
    <fieldset>
		<div class="input-group">
			<input type="text" name="s" id="search" placeholder="<?php _e("Search", "simple-bootstrap"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
			<div class="input-group-append">
				<button type="submit" class="btn btn-primary"><?php _e("Search", "simple-bootstrap"); ?></button>
			</div>
		</div>
    </fieldset>
</form>