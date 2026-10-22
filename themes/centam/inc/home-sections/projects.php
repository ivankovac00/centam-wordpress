<?php
/**
 * Home section: Projects (intro + Query Loop of all projects, dark green with mesh).
 *
 * Lists the "centam_project" post type from the CENTAM Projects plugin.
 * Polylang limits the list to the page's language. Each card shows the
 * featured image, project category, title, excerpt and a Read More link.
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow'   => 'Selected Work',
		'heading'   => 'Projects & Case Studies',
		'text'      => 'A snapshot of recent engagements across different industrial sectors.',
		'read_more' => 'Read More →',
	),
	'nl' => array(
		'eyebrow'   => 'Geselecteerd Werk',
		'heading'   => "Projecten & Casestudy's",
		'text'      => 'Een overzicht van recente projecten binnen verschillende industriële sectoren.',
		'read_more' => 'Lees Meer →',
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

centam_home_section_open( 'projects', 'centam-section-darker', 'centam-home-projects' );
centam_home_intro( $t['eyebrow'], $t['heading'], $t['text'] );
?>

<!-- wp:query {"queryId":1,"query":{"perPage":99,"pages":0,"offset":0,"postType":"centam_project","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"centam-home-query centam-home-query--projects"} -->
<div class="wp-block-query alignwide centam-home-query centam-home-query--projects"><!-- wp:post-template {"className":"is-style-centam-card-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"is-style-centam-card centam-card--project","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-centam-card centam-card--project"><!-- wp:post-featured-image {"isLink":true,"className":"centam-card__media"} /-->

<!-- wp:post-terms {"term":"centam_project_category","className":"centam-card__tag"} /-->

<!-- wp:post-title {"level":3} /-->

<!-- wp:post-excerpt {"excerptLength":40} /-->

<!-- wp:read-more <?php echo wp_json_encode( array( 'content' => $t['read_more'] ) ); ?> /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
<?php
centam_home_section_close();
