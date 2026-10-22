<?php
/**
 * Title: Header
 * Slug: centam/part-header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * Logo, anchor menu to the home sections, and (added in functions.php) the
 * EN | NL switcher. Menu links point at /#section so they work from every
 * page; the Dutch header (Polylang translation of this part) uses /nl/#…
 *
 * @package centam
 */
?>
<!-- wp:group {"className":"centam-header__inner","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group centam-header__inner">
	<!-- wp:site-logo {"width":175,"className":"centam-header__logo"} /-->

	<!-- wp:navigation {"className":"centam-primary-nav","overlayMenu":"mobile","overlayBackgroundColor":"near-black","overlayTextColor":"cream","layout":{"type":"flex","justifyContent":"right"},"ariaLabel":"<?php echo esc_attr__( 'Main menu', 'centam' ); ?>"} -->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'About', 'centam' ); ?>","url":"/#about","kind":"custom","isTopLevelLink":true} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Services', 'centam' ); ?>","url":"/#services","kind":"custom","isTopLevelLink":true} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Projects', 'centam' ); ?>","url":"/#projects","kind":"custom","isTopLevelLink":true} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Team', 'centam' ); ?>","url":"/#team","kind":"custom","isTopLevelLink":true} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'News', 'centam' ); ?>","url":"/#news","kind":"custom","isTopLevelLink":true} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Contact', 'centam' ); ?>","url":"/#contact","kind":"custom","isTopLevelLink":true} /-->
	<!-- /wp:navigation -->
</div>
<!-- /wp:group -->
