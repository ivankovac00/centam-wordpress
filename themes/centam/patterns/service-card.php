<?php
/**
 * Title: Service card
 * Slug: centam/service-card
 * Categories: services
 * Keywords: centam, service, card
 * Post Types: page
 * Description: One service card with a heading and short text. Insert it inside the Services grid.
 *
 * @package centam
 */

require_once get_theme_file_path( 'inc/home-sections/helpers.php' );

centam_home_card( 'Service name', 'One or two sentences describing the service.' );
