<?php
/**
 * Plugin Name:       CENTAM Deploy
 * Description:       One-shot installer for when GitHub Deployments is not set up. Activating it copies the CENTAM theme and the CENTAM Projects plugin bundled in this zip into wp-content, replacing older copies, and creates the Home and News pages (EN and NL) if they don't exist yet. Deactivate it afterwards; it does nothing while inactive.
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

/**
 * Creates a published page once and remembers its ID, so re-activating never
 * duplicates or overwrites a page that editors have changed since.
 */
function centam_deploy_page( $key, $title, $slug, $pattern = '' ) {
	$ids = get_option( 'centam_deploy_pages', array() );
	if ( ! empty( $ids[ $key ] ) && get_post( $ids[ $key ] ) ) {
		return (int) $ids[ $key ];
	}
	$content = '';
	if ( $pattern ) {
		$registered = WP_Block_Patterns_Registry::get_instance()->get_registered( $pattern );
		if ( ! $registered ) {
			return 0;
		}
		$content = $registered['content'];
	}
	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_content' => wp_slash( $content ),
		),
		true
	);
	if ( is_wp_error( $id ) ) {
		return 0;
	}
	$ids[ $key ] = $id;
	update_option( 'centam_deploy_pages', $ids, false );
	return $id;
}

/**
 * Home and News pages, front page settings, and (once Polylang has English
 * and Nederlands) the EN/NL translation links between them.
 */
function centam_deploy_setup() {
	$home    = centam_deploy_page( 'home', 'Home', 'home', 'centam/home' );
	$home_nl = centam_deploy_page( 'home_nl', 'Home', 'home-nl', 'centam/home-nl' );
	$news    = centam_deploy_page( 'news', 'News', 'news' );
	$news_nl = centam_deploy_page( 'news_nl', 'Nieuws', 'nieuws' );

	if ( $home && $news ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
		update_option( 'page_for_posts', $news );
	}
	if ( '/%postname%/' !== get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	if ( function_exists( 'pll_languages_list' ) && function_exists( 'pll_save_post_translations' ) ) {
		$langs = pll_languages_list();
		if ( in_array( 'en', $langs, true ) && in_array( 'nl', $langs, true ) ) {
			foreach ( array( array( $home, $home_nl ), array( $news, $news_nl ) ) as $pair ) {
				if ( $pair[0] && $pair[1] ) {
					pll_set_post_language( $pair[0], 'en' );
					pll_set_post_language( $pair[1], 'nl' );
					pll_save_post_translations( array( 'en' => $pair[0], 'nl' => $pair[1] ) );
				}
			}
		}
	}
	flush_rewrite_rules();
}

register_activation_hook(
	__FILE__,
	function () {
		centam_deploy_sync( __DIR__ . '/themes/centam', get_theme_root() . '/centam' );
		centam_deploy_sync( __DIR__ . '/plugins/centam-projects', WP_PLUGIN_DIR . '/centam-projects' );
		wp_clean_themes_cache();
		wp_clean_plugins_cache();
		if ( 'centam' === get_stylesheet() ) {
			centam_deploy_setup();
		}
	}
);
