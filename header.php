<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Omni_WP_Theme
 */?>
<?php do_action('omni_wp_theme_action_doctype'); ?>
<head>
	<?php do_action('omni_wp_theme_action_head'); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action('omni_wp_theme_action_before'); ?>
<?php do_action('omni_wp_theme_action_before_header'); ?>
        <div class="row no-gutters d-none d-md-block">
            <div class="col-12">
                <?php if(!has_custom_logo()) { ?>
                    <a class="navbar-brand" href="/"><h1><?php bloginfo('name'); ?></h1></a>
                <?php } else { ?>
                    <a class="navbar-brand" href="/"><?php the_custom_logo(); ?></a>
                <?php } ?>

            </div>
        </div>

        <div class="row no-gutters">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand d-block d-md-none" href="#">Logo</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
	                <?php
	                wp_nav_menu(
		                array(
			                'theme_location'	=> 'primary',
			                'depth'				=> 2,
			                'container'			=> 'div',
			                'container_class'	=> 'collapse navbar-collapse',
			                'container_id'		=> 'navbarSupportedContent',
			                'menu_class'		=> 'navbar-nav mr-auto',
			                'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
			                'walker'			=> new WP_Bootstrap_Navwalker()
		                )
	                );
	                ?>
                </nav>

            </div>
        </div>
<?php do_action('omni_wp_theme_action_after_header'); ?>