<?php
/**
 * Plugin Name:       CENTAM Deploy
 * Description:       One-shot installer for when GitHub Deployments is not set up. Activating it copies the CENTAM theme and the CENTAM Projects plugin bundled in this zip into wp-content, replacing older copies. Deactivate and delete it afterwards; it does nothing else.
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Author:            CENTAM
 * License:           GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;

/**
 * Replaces $dest with a copy of $src.
 */
function centam_deploy_sync( $src, $dest ) {
	if ( ! is_dir( $src ) ) {
		return;
	}
	if ( is_dir( $dest ) ) {
		$old = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $dest, FilesystemIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::CHILD_FIRST
		);
		foreach ( $old as $file ) {
			$file->isDir() ? rmdir( $file->getPathname() ) : unlink( $file->getPathname() );
		}
	} else {
		wp_mkdir_p( $dest );
	}
	$new = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $src, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);
	foreach ( $new as $file ) {
		$target = $dest . '/' . $new->getSubPathName();
		$file->isDir() ? wp_mkdir_p( $target ) : copy( $file->getPathname(), $target );
	}
}

register_activation_hook(
	__FILE__,
	function () {
		centam_deploy_sync( __DIR__ . '/themes/centam', get_theme_root() . '/centam' );
		centam_deploy_sync( __DIR__ . '/plugins/centam-projects', WP_PLUGIN_DIR . '/centam-projects' );
		wp_clean_themes_cache();
		wp_clean_plugins_cache();
	}
);
