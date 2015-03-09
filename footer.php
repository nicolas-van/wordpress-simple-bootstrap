			
            <footer id="inner-footer" class="vertical-nav block" role="contentinfo">
                <div class="row">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
                    <?php endif; ?>

                    <div class="col-md-12 text-center">
                        <p>Created with Wordpress</p>
                    </div>
                </div>
				
			</footer>
		
		</div>

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>