<?php
/**
 * Plugin Name:       CENTAM Projects
 * Description:       Adds the Projects content type (and Project categories) used by the CENTAM theme. Keep this plugin active: deactivating it hides projects, it does not delete them.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            CENTAM
 * License:           GPL-2.0-or-later
 * Text Domain:       centam-projects
 */

defined( 'ABSPATH' ) || exit;

function centam_projects_register() {
	register_post_type(
		'centam_project',
		array(
			'labels'        => array(
				'name'               => __( 'Projects', 'centam-projects' ),
				'singular_name'      => __( 'Project', 'centam-projects' ),
				'add_new_item'       => __( 'Add New Project', 'centam-projects' ),
				'edit_item'          => __( 'Edit Project', 'centam-projects' ),
				'new_item'           => __( 'New Project', 'centam-projects' ),
				'view_item'          => __( 'View Project', 'centam-projects' ),
				'search_items'       => __( 'Search Projects', 'centam-projects' ),
				'not_found'          => __( 'No projects found.', 'centam-projects' ),
				'not_found_in_trash' => __( 'No projects found in Trash.', 'centam-projects' ),
				'all_items'          => __( 'All Projects', 'centam-projects' ),
			),
			'public'        => true,
			'show_in_rest'  => true, // Needed for the block editor and Query Loop.
			'menu_position' => 5,    // Right below Posts.
			'menu_icon'     => 'dashicons-portfolio',
			'has_archive'   => 'projects',
			'rewrite'       => array( 'slug' => 'projects', 'with_front' => false ),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author' ),
		)
	);

	// Mirrors the "category" label on project cards (e.g. "Research").
	register_taxonomy(
		'centam_project_category',
		'centam_project',
		array(
			'labels'            => array(
				'name'          => __( 'Project Categories', 'centam-projects' ),
				'singular_name' => __( 'Project Category', 'centam-projects' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'project-category', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'centam_projects_register' );

function centam_projects_activate() {
	centam_projects_register();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'centam_projects_activate' );

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
