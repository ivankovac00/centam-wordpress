<?php
/**
 * Home section: Contact (intro, Jetpack form sending to info@centam.be, contact details).
 *
 * The form is the Jetpack Forms block bundled with WordPress.com. Replies go
 * to info@centam.be and every submission is also kept under Feedback in WP Admin.
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow'  => 'Get In Touch',
		'heading'  => "Let's Talk About Your Material Challenge",
		'text'     => "Have a question, or want to explore a collaboration? We'd love to hear from you. Fill in the form below and a member of our team will get back to you shortly.",
		'fields'   => array(
			array( 'field-name', 'Full Name', 'Your full name', true ),
			array( 'field-text', 'Company', 'Your company', false ),
			array( 'field-email', 'Email Address', 'you@example.com', true ),
			array( 'field-textarea', 'Message', 'Tell us about your challenge...', true ),
		),
		'submit'   => 'Send Message',
		'email'    => 'EMAIL',
		'location' => 'LOCATION',
		'place'    => 'Leuven, Belgium',
	),
	'nl' => array(
		'eyebrow'  => 'Neem Contact Op',
		'heading'  => 'Laten We Het Hebben Over Uw Materiaaluitdaging',
		'text'     => 'Heeft u een vraag of wilt u een samenwerking verkennen? Wij horen graag van u. Vul het formulier hieronder in en een lid van ons team neemt spoedig contact met u op.',
		'fields'   => array(
			array( 'field-name', 'Volledige Naam', 'Uw volledige naam', true ),
			array( 'field-text', 'Bedrijf', 'Uw bedrijf', false ),
			array( 'field-email', 'E-mailadres', 'u@voorbeeld.com', true ),
			array( 'field-text', 'Onderwerp', 'Korte onderwerpomschrijving', false ),
			array( 'field-textarea', 'Bericht', 'Vertel ons over uw uitdaging...', true ),
		),
		'submit'   => 'Verstuur Bericht',
		'email'    => 'E-MAIL',
		'location' => 'LOCATIE',
		'place'    => 'Leuven, België',
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

$maps_url     = 'https://www.google.com/maps/place/Leuven/@50.88422,4.622966,12z/data=!3m1!4b1!4m6!3m5!1s0x47c160d05ebbdf85:0x40099ab2f4d5690!8m2!3d50.8791453!4d4.7024648!16zL20vMGs2YnQ?entry=ttu&g_ep=EgoyMDI2MDYxNi4wIKXMDSoASAFQAw%3D%3D';
$linkedin_url = 'https://www.linkedin.com/company/centam-be';

$section_attrs = array(
	'tagName'         => 'section',
	'anchor'          => 'contact',
	'align'           => 'full',
	'className'       => 'centam-home-contact',
	'backgroundColor' => 'dark-green',
	'textColor'       => 'cream',
	'lock'            => array( 'move' => true, 'remove' => true ),
	'style'           => array(
		'spacing' => array(
			'padding' => array(
				'top'    => 'var:preset|spacing|section',
				'bottom' => 'var:preset|spacing|section',
			),
		),
	),
	'layout'          => array( 'type' => 'constrained' ),
);
?>
<!-- wp:group <?php echo wp_json_encode( $section_attrs ); ?> -->
<section id="contact" class="wp-block-group alignfull centam-home-contact has-cream-color has-dark-green-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">
<?php centam_home_intro( $t['eyebrow'], $t['heading'], $t['text'], 'left' ); ?>

<!-- wp:columns {"align":"wide","className":"centam-home-contact-grid"} -->
<div class="wp-block-columns alignwide centam-home-contact-grid"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:jetpack/contact-form {"to":"info@centam.be","className":"centam-home-contact-form"} -->
<div class="wp-block-jetpack-contact-form centam-home-contact-form">
<?php
foreach ( $t['fields'] as $field ) {
	$field_attrs = array(
		'label'       => $field[1],
		'placeholder' => $field[2],
	);
	if ( $field[3] ) {
		$field_attrs['required']     = true;
		$field_attrs['requiredText'] = '*';
	}
	echo '<!-- wp:jetpack/' . $field[0] . ' ' . wp_json_encode( $field_attrs ) . ' /-->' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput
}
?>
<!-- wp:jetpack/button <?php echo wp_json_encode( array( 'element' => 'button', 'text' => $t['submit'] ) ); ?> /-->
</div>
<!-- /wp:jetpack/contact-form --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%","className":"centam-home-contact-details"} -->
<div class="wp-block-column centam-home-contact-details" style="flex-basis:33.33%"><!-- wp:heading {"level":4,"className":"centam-home-contact-label"} -->
<h4 class="wp-block-heading centam-home-contact-label"><?php echo esc_html( $t['email'] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"centam-home-contact-detail"} -->
<p class="centam-home-contact-detail"><a href="mailto:info@centam.be">info@centam.be</a></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"className":"centam-home-contact-label"} -->
<h4 class="wp-block-heading centam-home-contact-label"><?php echo esc_html( $t['location'] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"centam-home-contact-detail"} -->
<p class="centam-home-contact-detail"><a href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $t['place'] ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"className":"centam-home-contact-label"} -->
<h4 class="wp-block-heading centam-home-contact-label">LINKEDIN</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"centam-home-contact-link"} -->
<p class="centam-home-contact-link"><a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $linkedin_url ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</section>
<!-- /wp:group -->
