<?php
/**
 * Home section: Team (intro + members with hexagon photos, near black).
 *
 * Editors add a member by duplicating one (or inserting the "Team member"
 * pattern) and swapping the photo, name, link and role.
 *
 * Expects $centam_lang ('en' or 'nl') from the including pattern.
 *
 * @package centam
 */

require_once __DIR__ . '/helpers.php';

$copy = array(
	'en' => array(
		'eyebrow' => 'The Team',
		'heading' => 'Advanced ceramics engineering, built for industry',
		'text'    => 'CENTAM is led by researchers who built their careers in advanced ceramics manufacturing and now bring that depth to industry partners.',
		'members' => array(
			array( 'Dr. Berfu Göksel', 'CEO & Co-founder' ),
			array( 'Dr. Margherita Beretta', 'CTO & Co-founder' ),
			array( 'Dr. Mia Kovač', 'COO & Co-founder' ),
			array( 'Dr. Sebastian Meyers', 'CSO & Co-founder' ),
			array( 'Waut Declercq', 'Technical Expert & Co-founder' ),
		),
	),
	'nl' => array(
		'eyebrow' => 'Het Team',
		'heading' => 'Geavanceerde keramische technologie, toegepast in de industrie',
		'text'    => 'CENTAM wordt geleid door onderzoekers die hun carrière hebben opgebouwd in de productie van geavanceerde keramiek en die deze diepgaande kennis nu inzetten voor industriële partners.',
		'members' => array(
			array( 'Dr. Berfu Göksel', 'Algemeen Directeur & Medeoprichter' ),
			array( 'Dr. Margherita Beretta', 'Directeur R&D & Medeoprichter' ),
			array( 'Mia Kovač', 'Directeur Proces- en Productontwikkeling & Medeoprichter' ),
			array( 'Dr. Sebastian Meyers', 'Directeur Operations & Medeoprichter' ),
			array( 'Waut Declercq', 'Technisch Expert & Medeoprichter' ),
		),
	),
);
$t = $copy[ isset( $centam_lang ) && 'nl' === $centam_lang ? 'nl' : 'en' ];

// Photo and LinkedIn profile, in the same order as the members above.
$profiles = array(
	array( 'team-berfu-goksel.jpg', 'https://www.linkedin.com/in/berfu-g%C3%B6ksel/' ),
	array( 'team-margherita-beretta.jpg', 'https://www.linkedin.com/in/margherita-beretta-384769174/' ),
	array( 'team-mia-kovac.jpg', 'https://www.linkedin.com/in/mia-kovac/' ),
	array( 'team-sebastian-meyers.jpg', 'https://www.linkedin.com/in/sebastian-meyers-b3541275/' ),
	array( 'team-waut-declercq.jpg', 'https://www.linkedin.com/in/wautdeclercq/' ),
);

centam_home_section_open( 'team', 'centam-section-dark', 'centam-home-team' );
centam_home_intro( $t['eyebrow'], $t['heading'], $t['text'] );
?>

<!-- wp:group {"align":"wide","className":"centam-home-team-grid","layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide centam-home-team-grid">
<?php
foreach ( $t['members'] as $i => $member ) {
	centam_home_team_member( $member[0], $member[1], centam_home_image_uri( $profiles[ $i ][0] ), $profiles[ $i ][1] );
}
?>
</div>
<!-- /wp:group -->
<?php
centam_home_section_close();
