<!doctype html>  

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>
	
<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<a class="skip-link sr-only sr-only-focusable" href="#main">
		<?php _e( 'Skip to content', 'simple-bootstrap' ); ?>
	</a>

	<div id="content-wrapper">

		<header>
			<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
				<div class="container">
		  
					<a class="navbar-brand"
						href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
					<?php if (has_nav_menu("main_nav")): ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="<?php _e('Toggle Navigation', 'simple-bootstrap'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php endif ?>

					<?php if (has_nav_menu("main_nav")): ?>
					<div id="navbarSupportedContent" class="collapse navbar-collapse">
						<?php
						    simple_bootstrap_display_main_menu();
						?>
					</div>
					<?php endif ?>

				</div>
			</nav>
		</header>

        <?php if (has_header_image()): ?>
        <div class="header-image-container">
            <div class="header-image" style="background-image: url(<?php echo get_header_image(); ?>)">
                <div class="container pt-5">
                    <?php if (display_header_text()): ?>
                    <div class="site-title mb-4" style="color: #<?php header_textcolor(); ?>;"><?php bloginfo('name') ?></div>
                    <div class="site-description" style="color: #<?php header_textcolor(); ?>;"><?php bloginfo('description') ?></div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php endif ?>
		
		<div id="page-content">
			<div class="container">
