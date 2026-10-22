<?php
/**
 * Home section: About (who we are, what we strive for, image, three values).
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow'     => 'Who We Are',
		'heading'     => 'Team',
		'paragraphs'  => array(
			'Founded by a team of engineers and materials scientists, CENTAM combines deep technical expertise with a practical understanding of industrial manufacturing. The founding team brings together years of experience gained through KU Leuven and industrial collaborations across Europe, spanning advanced ceramics, additive manufacturing, and materials engineering. Our team has spent years developing high-performance components for demanding applications, working across the entire process chain from powder selection and feedstock development to shaping, post-processing, characterization, and final component qualification.',
			'What sets CENTAM apart is the breadth of our manufacturing expertise. We have worked with multiple additive manufacturing technologies for both ceramics and metals, including extrusion-based (DIW, FFF), powder-based (LPBF, BJ), and slurry-based processes (DLP, LS). This experience allows us to approach challenges from a material, process, and application perspective, selecting and developing the most suitable manufacturing route rather than being limited to a single technology.',
			'Throughout our careers, we have collaborated with industrial partners, research organizations, and technology leaders across semiconductor, aerospace, energy, and advanced manufacturing sectors. These projects have provided first-hand experience with the performance requirements, quality standards, and production realities that define high-value ceramic components.',
			'Today, CENTAM focuses on enabling the next generation of Si-SiC components through additive manufacturing, advanced post-processing, materials characterization, and process development. By combining expertise across the full manufacturing chain, from raw powder to final product, we help transform innovative designs into reliable, high-performance ceramic solutions.',
		),
		'strive'      => 'What We Strive For',
		'strive_text' => array(
			'We believe the future of advanced ceramics lies at the intersection of material performance and manufacturing freedom.',
			'Silicon-infiltrated silicon carbide offers an exceptional combination of thermal stability, stiffness, wear resistance, and chemical durability. Yet its adoption is often limited by manufacturing complexity, long lead times, and restricted design freedom.',
			'Our mission is to unlock the full potential of Si-SiC through additive manufacturing and advanced processing technologies. By combining material expertise with manufacturing know-how, we enable geometries, functionalities, and design approaches that are difficult or impossible to achieve through conventional production methods.',
			'Our goal is simple: make high-performance Si-SiC components easier to design, faster to develop, and more accessible to the industries that depend on them.',
		),
		'image_alt'   => 'Gyroid lattice structure',
		'values'      => array(
			array( 'SCIENTIFIC RIGOR', 'Every recommendation is grounded in evidence and peer-reviewed methodology.' ),
			array( 'INDUSTRIAL RELEVANCE', 'We focus on solutions that work in real production environments.' ),
			array( 'LONG-TERM PARTNERSHIP', "We invest in understanding our clients' challenges deeply." ),
		),
	),
	'nl' => array(
		'eyebrow'     => 'Wie Wij Zijn',
		'heading'     => 'Team',
		'paragraphs'  => array(
			'CENTAM is opgericht door een team van materiaalkundige ingenieurs en biedt diepgaande technische expertise aan met een praktisch begrip van industriële productie. Het founding team brengt jarenlange ervaring samen op het gebied van geavanceerde keramiek, additieve productie en materiaaltechniek, opgebouwd via KU Leuven en industriële samenwerkingen door heel Europa. Ons team heeft gedurende verschillende jaren hoogwaardige componenten ontwikkeld voor veeleisende toepassingen, van poederselectie en grondstofontwikkeling tot vormgeving, nabewerking, karakterisatie en uiteindelijke componentkwalificatie.',
			'Wat CENTAM onderscheidt, is de breedte van onze productie-expertise. Wij hebben gewerkt met meerdere additieve productietechnologieën voor zowel keramiek als metalen, waaronder extrusiegebaseerde (DIW, FFF), poedergebaseerde (LPBF, BJ) en slurrygebaseerde processen (DLP, LS). Deze ervaring stelt ons in staat om uitdagingen te benaderen vanuit een uniek perspectief, met kennis van materiaal- en proceskunde, waarbij wij het meest geschikte productietraject selecteren en ontwikkelen en niet beperkt te zijn tot één technologie.',
			'Doorheen onze carrières hebben wij samengewerkt met industriële partners, onderzoeksorganisaties en technologieleiders binnen de halfgeleider-, ruimtevaart-, energie- en geavanceerde productiesectoren. Dankzij deze samenwerkingen hebben wij directe ervaring kunnen opdoen met prestatie eisen, kwaliteitsnormen en productierealiteiten die hoogwaardige keramische componenten bepalen.',
			'Vandaag richt CENTAM zich op het mogelijk maken van de volgende generatie Si-SiC componenten via additieve productie, geavanceerde nabewerking, materiaalkarakterisatie en procesontwikkeling. Door expertise te combineren over de volledige productieketen, van startpoeder tot eindproduct, helpen wij innovatieve ontwerpen om te zetten in betrouwbare, hoogwaardige keramische oplossingen.',
		),
		'strive'      => 'Waar Wij Naar Streven',
		'strive_text' => array(
			'Wij geloven sterk dat de toekomst van geavanceerde keramiek afhangt van zowel materiaalprestaties als productievrijheid.',
			'Silicium geïnfiltreerd siliciumcarbide biedt een uitzonderlijke combinatie van thermische stabiliteit, stijfheid, slijtvastheid en chemische duurzaamheid. Toch wordt de toepassing ervan vaak beperkt door moeilijkheden in productie, lange doorlooptijden en beperkte ontwerpvrijheid.',
			'Onze missie is om het volledige potentieel van SiSiC te benutten via additieve productie en geavanceerde nabewerkingstechnologieën. Door materiaalkennis te combineren met productie-knowhow maken wij geometrieën, functionaliteiten en ontwerpbenaderingen mogelijk die zeer moeilijk of onmogelijk te realiseren zijn met conventionele productiemethoden.',
			'Ons doel is eenvoudig: hoogwaardige Si-SiC componenten makkelijker ontwerp- en produceerbaar maken, sneller te ontwikkelen en ervoor zorgen dat het toegankelijker wordt voor de sectoren die het nodig hebben.',
		),
		'image_alt'   => 'Gyroïde roosterstructuur',
		'values'      => array(
			array( 'WETENSCHAPPELIJKE NAUWKEURIGHEID', 'Elke advies steunt op wetenschappelijk bewijs en peer-reviewed methodologie.' ),
			array( 'INDUSTRIËLE RELEVANTIE', 'Wij richten ons op oplossingen die werken in echte productieomgevingen.' ),
			array( 'LANGETERMIJNPARTNERSCHAP', 'Wij zetten in op het volledig begrijpen van de uitdagingen van onze klanten.' ),
		),
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

centam_home_section_open( 'about', 'centam-section-light', 'centam-home-about' );
?>
<!-- wp:group {"align":"wide","className":"centam-home-about-text","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide centam-home-about-text"><!-- wp:paragraph {"align":"center","className":"is-style-centam-eyebrow"} -->
<p class="has-text-align-center is-style-centam-eyebrow"><?php echo esc_html( $t['eyebrow'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html( $t['heading'] ); ?></h2>
<!-- /wp:heading -->
<?php foreach ( $t['paragraphs'] as $paragraph ) : ?>

<!-- wp:paragraph -->
<p><?php echo esc_html( $paragraph ); ?></p>
<!-- /wp:paragraph -->
<?php endforeach; ?>

<!-- wp:heading {"level":3,"className":"centam-home-about-subheading"} -->
<h3 class="wp-block-heading centam-home-about-subheading"><?php echo esc_html( $t['strive'] ); ?></h3>
<!-- /wp:heading -->
<?php foreach ( $t['strive_text'] as $paragraph ) : ?>

<!-- wp:paragraph -->
<p><?php echo esc_html( $paragraph ); ?></p>
<!-- /wp:paragraph -->
<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"center","className":"centam-home-about-image"} -->
<figure class="wp-block-image aligncenter size-full centam-home-about-image"><img src="<?php echo esc_url( centam_home_image_uri( 'about-gyroid-sandblasted.webp' ) ); ?>" alt="<?php echo esc_attr( $t['image_alt'] ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"align":"wide","className":"centam-home-values","layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide centam-home-values">
<?php
foreach ( $t['values'] as $value ) {
	centam_home_value_item( $value[0], $value[1] );
}
?>
</div>
<!-- /wp:group -->
<?php
centam_home_section_close();
