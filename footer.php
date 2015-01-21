			<footer id="inner-footer" class="row vertical-nav" role="contentinfo">
        <hr />
		
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
        <?php endif; ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
        <?php endif; ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
        <?php endif; ?>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>