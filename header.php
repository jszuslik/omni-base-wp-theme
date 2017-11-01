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
<body id="omni_one_page_home" <?php body_class(); ?>>
<?php do_action('omni_wp_theme_action_before'); ?>
<?php do_action('omni_wp_theme_action_before_header'); ?>
<?php do_action('omni_wp_theme_action_header'); ?>
<?php do_action('omni_wp_theme_action_after_header'); ?>