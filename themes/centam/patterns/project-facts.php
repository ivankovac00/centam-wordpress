<?php
/**
 * Title: Project facts grid
 * Slug: centam/project-facts
 * Categories: text
 * Keywords: centam, project, facts, details
 * Post Types: centam_project
 * Description: Label and value pairs (such as Sector, Geometry, Wall Thickness) shown in three columns on a project page.
 *
 * @package centam
 */

require_once get_theme_file_path( 'inc/home-sections/helpers.php' );
?>
<!-- wp:group {"className":"centam-home-values centam-project-facts","layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group centam-home-values centam-project-facts">
<?php
centam_home_value_item( 'Sector', 'Thermal Management' );
centam_home_value_item( 'Geometry', 'Graded gyroid (TPMS)' );
centam_home_value_item( 'Wall Thickness', '2 mm' );
?>
</div>
<!-- /wp:group -->
