<?php
/**
 * Small markup helpers shared by the home section patterns.
 *
 * Every home section lives in one file in this folder, holding its block
 * markup once and its English and Dutch copy side by side. The pattern files
 * in /patterns set $centam_lang ('en' or 'nl') and include the section, so the
 * EN and NL patterns can never drift apart in layout.
 *
 * The output is ordinary core block markup: once a pattern is inserted on the
 * Home page, editors change it like any other block.
 *
 * @package centam
 */

if ( ! function_exists( 'centam_home_image_uri' ) ) {
	/**
	 * URL of an image bundled with the theme for the home patterns.
	 *
	 * @param string $file File name inside assets/images/home/.
	 * @return string
	 */
	function centam_home_image_uri( $file ) {
		return get_theme_file_uri( 'assets/images/home/' . $file );
	}
}

if ( ! function_exists( 'centam_home_intro' ) ) {
	/**
	 * Section intro: eyebrow, heading and optional paragraph.
	 *
	 * @param string $eyebrow Eyebrow label.
	 * @param string $heading Section heading (h2).
	 * @param string $text    Intro paragraph, optional.
	 * @param string $align   'center' (most sections) or 'left' (Contact).
	 */
	function centam_home_intro( $eyebrow, $heading, $text = '', $align = 'center' ) {
		$centered    = 'center' === $align;
		$group_class = $centered ? 'centam-home-intro' : 'centam-home-intro centam-home-intro--left';
		$group_attrs = array(
			'className' => $group_class,
			'layout'    => $centered
				? array( 'type' => 'constrained', 'contentSize' => '700px' )
				: array( 'type' => 'default' ),
		);
		$text_attrs  = $centered ? '{"align":"center"} ' : '';
		$text_class  = $centered ? ' class="has-text-align-center"' : '';
		$eyebrow_attrs = $centered
			? '{"align":"center","className":"is-style-centam-eyebrow"}'
			: '{"className":"is-style-centam-eyebrow"}';
		$eyebrow_class = $centered ? 'has-text-align-center is-style-centam-eyebrow' : 'is-style-centam-eyebrow';
		$heading_attrs = $centered ? ' {"textAlign":"center"}' : '';
		$heading_class = $centered ? 'wp-block-heading has-text-align-center' : 'wp-block-heading';
		?>
<!-- wp:group <?php echo wp_json_encode( $group_attrs ); ?> -->
<div class="wp-block-group <?php echo esc_attr( $group_class ); ?>"><!-- wp:paragraph <?php echo $eyebrow_attrs; // phpcs:ignore WordPress.Security.EscapeOutput ?> -->
<p class="<?php echo esc_attr( $eyebrow_class ); ?>"><?php echo esc_html( $eyebrow ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading<?php echo $heading_attrs; // phpcs:ignore WordPress.Security.EscapeOutput ?> -->
<h2 class="<?php echo esc_attr( $heading_class ); ?>"><?php echo esc_html( $heading ); ?></h2>
<!-- /wp:heading -->
		<?php if ( $text ) : ?>

<!-- wp:paragraph <?php echo $text_attrs; // phpcs:ignore WordPress.Security.EscapeOutput ?>-->
<p<?php echo $text_class; // phpcs:ignore WordPress.Security.EscapeOutput ?>><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph -->
		<?php endif; ?></div>
<!-- /wp:group -->
		<?php
	}
}

if ( ! function_exists( 'centam_home_section_open' ) ) {
	/**
	 * Opens a full-width home section (a Group with a section block style).
	 *
	 * The section wrapper is locked against removal and moving, so editors
	 * can change everything inside it without accidentally deleting or
	 * reordering a whole section.
	 *
	 * @param string $anchor Section id, used by the menu (#about, #team, ...).
	 * @param string $style  Section block style: centam-section-light, -dark or -darker.
	 * @param string $class  Extra class for section-specific CSS.
	 */
	function centam_home_section_open( $anchor, $style, $class ) {
		$classes = 'is-style-' . $style . ' ' . $class;
		$attrs   = array(
			'tagName'   => 'section',
			'anchor'    => $anchor,
			'align'     => 'full',
			'className' => $classes,
			'lock'      => array( 'move' => true, 'remove' => true ),
			'layout'    => array( 'type' => 'constrained' ),
		);
		?>
<!-- wp:group <?php echo wp_json_encode( $attrs ); ?> -->
<section id="<?php echo esc_attr( $anchor ); ?>" class="wp-block-group alignfull <?php echo esc_attr( $classes ); ?>">
		<?php
	}
}

if ( ! function_exists( 'centam_home_section_close' ) ) {
	/**
	 * Closes a section opened with centam_home_section_open().
	 */
	function centam_home_section_close() {
		?>
</section>
<!-- /wp:group -->
		<?php
	}
}

if ( ! function_exists( 'centam_home_card' ) ) {
	/**
	 * A text card (heading + paragraph) in the "Card" Group style.
	 * Used for services; editors duplicate a card to add one.
	 *
	 * @param string $title Card heading (h3).
	 * @param string $text  Card text.
	 */
	function centam_home_card( $title, $text ) {
		?>
<!-- wp:group {"className":"is-style-centam-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-centam-card"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
		<?php
	}
}

if ( ! function_exists( 'centam_home_team_member' ) ) {
	/**
	 * One team member: hexagon photo and name, both linking to LinkedIn, and role.
	 *
	 * @param string $name     Full name.
	 * @param string $role     Role line.
	 * @param string $photo    Image URL.
	 * @param string $linkedin LinkedIn profile URL.
	 */
	function centam_home_team_member( $name, $role, $photo, $linkedin ) {
		$image_attrs = array(
			'width'           => '200px',
			'height'          => '230px',
			'aspectRatio'     => '200/230',
			'scale'           => 'cover',
			'sizeSlug'        => 'full',
			'linkDestination' => 'custom',
			'align'           => 'center',
			'className'       => 'is-style-centam-hexagon',
		);
		?>
<!-- wp:group {"className":"centam-home-team-member","layout":{"type":"default"}} -->
<div class="wp-block-group centam-home-team-member"><!-- wp:image <?php echo wp_json_encode( $image_attrs ); ?> -->
<figure class="wp-block-image aligncenter size-full is-resized is-style-centam-hexagon"><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noreferrer noopener"><img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" style="aspect-ratio:200/230;object-fit:cover;width:200px;height:230px"/></a></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center"><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $name ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"centam-home-team-role"} -->
<p class="has-text-align-center centam-home-team-role"><?php echo esc_html( $role ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
		<?php
	}
}

if ( ! function_exists( 'centam_home_partner_logo' ) ) {
	/**
	 * One partner logo linking to the partner's site.
	 *
	 * @param string $logo Image URL.
	 * @param string $alt  Alt text.
	 * @param string $url  Partner website.
	 */
	function centam_home_partner_logo( $logo, $alt, $url ) {
		?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"is-style-centam-partner-logo"} -->
<figure class="wp-block-image size-full is-style-centam-partner-logo"><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noreferrer noopener"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $alt ); ?>"/></a></figure>
<!-- /wp:image -->
		<?php
	}
}

if ( ! function_exists( 'centam_home_value_item' ) ) {
	/**
	 * A label + text pair (About values, project facts).
	 *
	 * @param string $label Small heading (h4).
	 * @param string $text  Text.
	 */
	function centam_home_value_item( $label, $text ) {
		?>
<!-- wp:group {"className":"centam-home-value","layout":{"type":"default"}} -->
<div class="wp-block-group centam-home-value"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php echo esc_html( $label ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
		<?php
	}
}
