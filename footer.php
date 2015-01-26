			
            <footer id="inner-footer" class="row vertical-nav" role="contentinfo">
                <hr />
        		
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
                <?php endif; ?>

                <div class="col-md-12 text-center">
                    <p>Created with Wordpress</p>
                </div>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>