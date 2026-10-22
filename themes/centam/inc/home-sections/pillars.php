<?php
/**
 * Home section: Pillars strip (three short headings on near black).
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

$copy = array(
	'en' => array( 'Advanced Ceramics', 'High Temperature Treatments', 'Engineering Consulting' ),
	'nl' => array( 'Geavanceerde Keramiek', 'Hogetemperatuurbehandelingen', 'Technisch Advies' ),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];
?>
<!-- wp:group {"align":"full","className":"centam-home-pillars","backgroundColor":"near-black","textColor":"cream","lock":{"move":true,"remove":true},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull centam-home-pillars has-cream-color has-near-black-background-color has-text-color has-background"><!-- wp:columns {"className":"centam-home-pillars-row"} -->
<div class="wp-block-columns centam-home-pillars-row">
<?php foreach ( $t as $pillar ) : ?>
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","level":4} -->
<h4 class="wp-block-heading has-text-align-center"><?php echo esc_html( $pillar ); ?></h4>
<!-- /wp:heading --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
