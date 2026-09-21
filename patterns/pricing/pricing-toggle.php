<?php
/**
 * Title: Pricing with Toggle
 * Slug: krys/pricing-toggle
 * Categories: krys-pricing
 * Description: Pricing table with monthly/annual toggle and savings badge
 *
 * @package Krys
 * @since 2.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"gray-50","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-gray-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40)"><?php esc_html_e( 'Flexible Pricing', 'krys' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
	<p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)"><?php esc_html_e( 'Save 20% with annual billing', 'krys' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"className":"is-style-krys-card"} -->
		<div class="wp-block-column is-style-krys-card">
			<!-- wp:heading {"textAlign":"center","level":3} -->
			<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Monthly', 'krys' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","fontSize":"xx-large","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<p class="has-text-align-center has-xx-large-font-size" style="margin-top:var(--wp--preset--spacing--40)"><strong>$29</strong></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","textColor":"secondary"} -->
			<p class="has-text-align-center has-secondary-color has-text-color"><?php esc_html_e( 'per month', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
			<hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"/>
			<!-- /wp:separator -->

			<!-- wp:list {"className":"is-style-krys-checkmarks"} -->
			<ul class="is-style-krys-checkmarks">
				<li><?php esc_html_e( 'Billed monthly', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Cancel anytime', 'krys' ); ?></li>
				<li><?php esc_html_e( 'No commitment', 'krys' ); ?></li>
				<li><?php esc_html_e( 'All features included', 'krys' ); ?></li>
			</ul>
			<!-- /wp:list -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button {"width":100} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Start Monthly', 'krys' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"is-style-krys-shadow"} -->
		<div class="wp-block-column is-style-krys-shadow">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"0.5rem","right":"1rem","bottom":"0.5rem","left":"1rem"},"margin":{"bottom":"var:preset|spacing|30"}},"border":{"radius":"0.25rem"}},"backgroundColor":"success","textColor":"base","layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-base-color has-success-background-color has-text-color has-background" style="border-radius:0.25rem;margin-bottom:var(--wp--preset--spacing--30);padding-top:0.5rem;padding-right:1rem;padding-bottom:0.5rem;padding-left:1rem">
				<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
				<p class="has-text-align-center has-small-font-size"><?php esc_html_e( 'SAVE 20%', 'krys' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"textAlign":"center","level":3} -->
			<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Annual', 'krys' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","fontSize":"xx-large","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<p class="has-text-align-center has-xx-large-font-size" style="margin-top:var(--wp--preset--spacing--40)"><strong>$23</strong></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","textColor":"secondary"} -->
			<p class="has-text-align-center has-secondary-color has-text-color"><?php esc_html_e( 'per month, billed annually', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
			<hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"/>
			<!-- /wp:separator -->

			<!-- wp:list {"className":"is-style-krys-checkmarks"} -->
			<ul class="is-style-krys-checkmarks">
				<li><?php esc_html_e( 'Billed annually ($276/year)', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Save $72 per year', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Best value', 'krys' ); ?></li>
				<li><?php esc_html_e( 'All features included', 'krys' ); ?></li>
			</ul>
			<!-- /wp:list -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button {"width":100} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Start Annual', 'krys' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:paragraph {"align":"center","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
	<p class="has-text-align-center has-small-font-size" style="margin-top:var(--wp--preset--spacing--50)"><?php esc_html_e( '14-day money-back guarantee • No credit card required', 'krys' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
