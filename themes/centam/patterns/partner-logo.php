<?php
/**
 * Title: Partner logo
 * Slug: centam/partner-logo
 * Categories: gallery
 * Keywords: centam, partner, logo, sponsor
 * Post Types: page
 * Description: One partner logo linking to the partner's website. Insert it inside the Partners row, then replace the image and link.
 *
 * @package centam
 */

require_once get_theme_file_path( 'inc/home-sections/helpers.php' );

centam_home_partner_logo( centam_home_image_uri( 'partner-placeholder.png' ), 'Partner logo', 'https://example.com/' );
