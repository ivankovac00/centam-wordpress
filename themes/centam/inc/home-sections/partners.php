<?php
/**
 * Home section: Partners (intro + linked logos on cream).
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow' => 'Our Partners',
		'heading' => 'Driven by collaboration with innovation partners',
		'text'    => 'We work with research and technology organizations to accelerate advanced materials development and industrial adoption.',
		'alts'    => array( 'VLAIO logo', 'SO2 logo', 'StartIt logo' ),
	),
	'nl' => array(
		'eyebrow' => 'Onze Partners',
		'heading' => 'Gedreven door samenwerking met innovatiepartners',
		'text'    => 'Wij werken samen met onderzoeks- en technologie-organisaties om de ontwikkeling van geavanceerde materialen en industriële toepassing te versnellen.',
		'alts'    => array( 'VLAIO-logo', 'SO2-logo', 'StartIt-logo' ),
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

$partners = array(
	array( 'partner-vlaio.png', 'https://www.vlaio.be' ),
	array( 'partner-so2.png', 'https://www.sokwadraat.be' ),
	array( 'partner-start-it-kbc.png', 'https://startit-x.com/en/accelerate/start-it-kbc' ),
);

centam_home_section_open( 'partners', 'centam-section-light', 'centam-home-partners' );
centam_home_intro( $t['eyebrow'], $t['heading'], $t['text'] );
?>

<!-- wp:group {"align":"wide","className":"centam-home-partners-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide centam-home-partners-row">
<?php
foreach ( $partners as $i => $partner ) {
	centam_home_partner_logo( centam_home_image_uri( $partner[0] ), $t['alts'][ $i ], $partner[1] );
}
?>
</div>
<!-- /wp:group -->
<?php
centam_home_section_close();
