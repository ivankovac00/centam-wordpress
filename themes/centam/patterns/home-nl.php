<?php
/**
 * Title: Home page (Nederlands)
 * Slug: centam/home-nl
 * Categories: featured
 * Keywords: centam, home, front page
 * Block Types: core/post-content
 * Post Types: page
 * Description: The full CENTAM home page with all nine sections, in Dutch (verbatim copy from the current site). Use it once to build the Dutch Home page.
 *
 * @package centam
 */

$centam_lang = 'nl';

foreach ( array( 'hero', 'pillars', 'services', 'projects', 'about', 'team', 'news', 'partners', 'contact' ) as $centam_section ) {
	require get_theme_file_path( 'inc/home-sections/' . $centam_section . '.php' );
}
