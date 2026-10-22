<?php
/**
 * Title: Home page (English)
 * Slug: centam/home
 * Categories: featured
 * Keywords: centam, home, front page
 * Block Types: core/post-content
 * Post Types: page
 * Description: The full CENTAM home page with all nine sections, in English. Use it once to build the English Home page.
 *
 * @package centam
 */

$centam_lang = 'en';

foreach ( array( 'hero', 'pillars', 'services', 'projects', 'about', 'team', 'news', 'partners', 'contact' ) as $centam_section ) {
	require get_theme_file_path( 'inc/home-sections/' . $centam_section . '.php' );
}
