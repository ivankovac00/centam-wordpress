<?php
/**
 * Title: Team member
 * Slug: centam/team-member
 * Categories: team
 * Keywords: centam, team, person, hexagon
 * Post Types: page
 * Description: One team member with a hexagon photo, name linking to LinkedIn and role. Insert it inside the Team grid.
 *
 * @package centam
 */

require_once get_theme_file_path( 'inc/home-sections/helpers.php' );

centam_home_team_member( 'Name Surname', 'Role & Co-founder', centam_home_image_uri( 'team-placeholder.jpg' ), 'https://www.linkedin.com/' );
