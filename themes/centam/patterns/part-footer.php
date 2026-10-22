<?php
/**
 * Title: Footer
 * Slug: centam/part-footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * White logo and tagline, sitemap and contact columns, copyright line.
 *
 * @package centam
 */
?>
<!-- wp:group {"className":"centam-footer__inner","layout":{"type":"constrained"}} -->
<div class="wp-block-group centam-footer__inner">
	<!-- wp:columns {"className":"centam-footer__grid"} -->
	<div class="wp-block-columns centam-footer__grid">
		<!-- wp:column {"className":"centam-footer__brand"} -->
		<div class="wp-block-column centam-footer__brand">
			<!-- wp:image {"height":"76px","sizeSlug":"full","className":"centam-footer__logo"} -->
			<figure class="wp-block-image size-full is-resized centam-footer__logo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-white.png' ) ); ?>" alt="CENTAM" style="height:76px"/></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph {"className":"centam-footer__tagline"} -->
			<p class="centam-footer__tagline"><?php esc_html_e( 'Ceramic Engineering Through Additive Manufacturing', 'centam' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":4} -->
			<h4 class="wp-block-heading"><?php esc_html_e( 'Sitemap', 'centam' ); ?></h4>
			<!-- /wp:heading -->

			<!-- wp:group {"className":"centam-footer__links","layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group centam-footer__links">
				<!-- wp:paragraph --><p><a href="/#about"><?php esc_html_e( 'About', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="/#services"><?php esc_html_e( 'Services', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="/#projects"><?php esc_html_e( 'Projects', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="/#team"><?php esc_html_e( 'Team', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="/#news"><?php esc_html_e( 'News', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="mailto:info@centam.be"><?php esc_html_e( 'Contact', 'centam' ); ?></a></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":4} -->
			<h4 class="wp-block-heading"><?php esc_html_e( 'Contact', 'centam' ); ?></h4>
			<!-- /wp:heading -->

			<!-- wp:group {"className":"centam-footer__links","layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group centam-footer__links">
				<!-- wp:paragraph --><p><a href="mailto:info@centam.be">info@centam.be</a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="https://www.google.com/maps/place/Leuven/@50.88422,4.622966,12z/data=!3m1!4b1!4m6!3m5!1s0x47c160d05ebbdf85:0x40099ab2f4d5690!8m2!3d50.8791453!4d4.7024648!16zL20vMGs2YnQ?entry=ttu" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Leuven, Belgium', 'centam' ); ?></a></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p><a href="https://www.linkedin.com/company/centam-be" target="_blank" rel="noreferrer noopener">LinkedIn</a></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:paragraph {"className":"centam-footer__bottom"} -->
	<p class="centam-footer__bottom">© 2026 CENTAM. <?php esc_html_e( 'All rights reserved.', 'centam' ); ?><br>VAT BE 1034583489</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
