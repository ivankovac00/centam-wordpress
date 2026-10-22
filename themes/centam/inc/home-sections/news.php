<?php
/**
 * Home section: News (intro + Query Loop of the latest 3 posts + "Read All News" button).
 *
 * Polylang limits the list to the page's language. The theme script
 * (assets/js/centam.js) makes the whole card clickable.
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow'   => 'Latest News',
		'heading'   => 'News & Updates',
		'read_more' => 'Read More →',
		'all_news'  => 'Read All News →',
		'news_url'  => '/news/',
	),
	'nl' => array(
		'eyebrow'   => 'Laatste Nieuws',
		'heading'   => 'Nieuws & Updates',
		'read_more' => 'Lees Meer →',
		'all_news'  => 'Alle Nieuws Bekijken →',
		'news_url'  => '/nl/nieuws/',
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

centam_home_section_open( 'news', 'centam-section-light', 'centam-home-news' );
centam_home_intro( $t['eyebrow'], $t['heading'] );
?>

<!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"centam-home-query centam-home-query--news"} -->
<div class="wp-block-query alignwide centam-home-query centam-home-query--news"><!-- wp:post-template {"className":"is-style-centam-card-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"is-style-centam-card centam-card--news","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-centam-card centam-card--news"><!-- wp:post-featured-image {"className":"centam-card__media"} /-->

<!-- wp:post-terms {"term":"category","className":"centam-card__tag"} /-->

<!-- wp:post-title {"level":3} /-->

<!-- wp:post-excerpt {"excerptLength":40} /-->

<!-- wp:group {"className":"centam-card__footer","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group centam-card__footer"><!-- wp:post-date /-->

<!-- wp:paragraph {"className":"centam-card__dot"} -->
<p class="centam-card__dot">·</p>
<!-- /wp:paragraph -->

<!-- wp:read-more <?php echo wp_json_encode( array( 'content' => $t['read_more'] ) ); ?> /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:buttons {"align":"wide","className":"centam-home-news-cta","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons alignwide centam-home-news-cta"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $t['news_url'] ); ?>"><?php echo esc_html( $t['all_news'] ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<?php
centam_home_section_close();
