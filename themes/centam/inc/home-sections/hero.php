<?php
/**
 * Home section: Hero (dark green, hex mesh, two buttons).
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

$copy = array(
	'en' => array(
		'eyebrow' => 'From design to customized production via 3D printing',
		'heading' => 'Engineering the Next Generation of Si-SiC Components',
		'text'    => 'With over 30 years of combined experience in additive manufacturing, CENTAM develops and post-processes advanced Si-SiC parts for critical industrial sectors.',
		'contact' => 'Get In Touch',
		'more'    => 'Learn More ↓',
	),
	'nl' => array(
		'eyebrow' => 'Van ontwerp tot maatwerkproductie via 3D-printen',
		'heading' => 'De Volgende Generatie Si-SiC Componenten',
		'text'    => 'Met meer dan 30 jaar ervaring in additieve productie, biedt CENTAM printing en post-processing aan van geavanceerde Si-SiC onderdelen voor kritieke industriële sectoren.',
		'contact' => 'Neem Contact Op',
		'more'    => 'Meer Weten ↓',
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];
?>
<!-- wp:cover {"overlayColor":"dark-green","isUserOverlayColor":true,"minHeight":100,"minHeightUnit":"vh","contentPosition":"center center","isDark":true,"anchor":"hero","align":"full","className":"is-style-centam-hero centam-home-hero","lock":{"move":true,"remove":true},"layout":{"type":"constrained","contentSize":"900px"}} -->
<div id="hero" class="wp-block-cover alignfull is-dark is-style-centam-hero centam-home-hero" style="min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-dark-green-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"className":"is-style-centam-eyebrow"} -->
<p class="is-style-centam-eyebrow"><?php echo esc_html( $t['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html( $t['heading'] ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"centam-home-hero-text"} -->
<p class="centam-home-hero-text"><?php echo esc_html( $t['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"centam-home-hero-actions"} -->
<div class="wp-block-buttons centam-home-hero-actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:info@centam.be"><?php echo esc_html( $t['contact'] ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#about"><?php echo esc_html( $t['more'] ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
