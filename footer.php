		
    	   </div>
        </div>
            
        <footer>
            <div id="inner-footer" class="vertical-nav">
                <div class="container">
                    <div class="row">
                        <?php dynamic_sidebar('footer1'); ?>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <p><?php _e('This website uses the <a href="http://nicolas-van.github.io/wordpress-simple-bootstrap/">Simple Bootstrap</a> theme', 'simple-bootstrap') ?></p>
                            <p><?php _e("Powered by WordPress", "simple-bootstrap"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

	<?php wp_footer(); // js scripts are inserted using this function ?>

</body>

</html>
