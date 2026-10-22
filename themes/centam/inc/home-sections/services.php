<?php
/**
 * Home section: Services (intro + six cards on cream).
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow' => 'What We Do',
		'heading' => 'Engineering advanced carbide ceramics for industrial use',
		'text'    => 'Our products and services are divided in six classes covering the full material production, optimization and characterization.',
		'cards'   => array(
			array( 'Material Characterization', 'Comprehensive analysis of ceramic materials — microstructure, phase composition, mechanical properties, and thermal behavior.' ),
			array( 'Custom Ceramic Development', 'From formulation to firing: we design and develop ceramic components tailored to your performance specifications and production requirements.' ),
			array( 'Failure Analysis & Material Diagnostics', 'In-depth studies including failure analysis, microstructural evaluation, and performance assessment of ceramic components.' ),
			array( 'Process Engineering', 'Improve your ceramic manufacturing processes — reducing waste, improving consistency, and enabling scalable production.' ),
			array( 'R&D Consulting', 'Expert support for research and development projects. We integrate with your team to accelerate materials innovation timelines.' ),
			array( 'Quality Control & Testing', 'Independent testing and quality verification services for ceramic components, aligned with international standards.' ),
		),
	),
	'nl' => array(
		'eyebrow' => 'Wat Wij Doen',
		'heading' => 'Ontwikkeling van geavanceerde carbidekeramiek voor industrieel gebruik',
		'text'    => 'Onze producten en diensten zijn onderverdeeld in zes categorieën die de volledige materiaalproductie, optimalisatie en karakterisatie omvatten.',
		'cards'   => array(
			array( 'Materiaalkarakterisatie', 'Uitgebreide analyse van keramische materialen: microstructuur, fasesamenstelling, mechanische eigenschappen en thermisch gedrag.' ),
			array( 'Ontwikkeling van Keramiek op Maat', 'Van formulering tot sintering: wij ontwerpen en ontwikkelen keramische componenten op maat van uw specificaties en eisen.' ),
			array( 'Faalanalyse & Materiaaldiagnostiek', 'Diepgaande studies, waaronder faalanalyse, microstructurele analyse en evaluatie van de performance van keramische componenten.' ),
			array( 'Procestechniek', 'Verbeter uw keramische productieprocessen: minder scrap, betere consistentie en schaalbare productie.' ),
			array( 'R&D Consulting', 'Deskundige ondersteuning voor onderzoeks- en ontwikkelingsprojecten. Wij werken samen met uw team om materiaalinnovatietrajecten te versnellen.' ),
			array( 'Kwaliteitscontrole & Testen', 'Onafhankelijke test- en kwaliteitsverificatiediensten voor keramische componenten, in lijn met internationale normen.' ),
		),
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

centam_home_section_open( 'services', 'centam-section-light', 'centam-home-services' );
centam_home_intro( $t['eyebrow'], $t['heading'], $t['text'] );
?>

<!-- wp:group {"align":"wide","className":"centam-home-grid","layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide centam-home-grid">
<?php
foreach ( $t['cards'] as $card ) {
	centam_home_card( $card[0], $card[1] );
}
?>
</div>
<!-- /wp:group -->
<?php
centam_home_section_close();
