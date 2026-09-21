<?php
/**
 * Title: Pricing Comparison Table
 * Slug: krys/pricing-comparison
 * Categories: krys-pricing
 * Description: Detailed feature comparison table for pricing plans
 *
 * @package Krys
 * @since 2.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)"><?php esc_html_e( 'Compare Plans', 'krys' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:table {"hasFixedLayout":true,"className":"is-style-stripes"} -->
	<figure class="wp-block-table is-style-stripes"><table class="has-fixed-layout"><thead><tr><th><?php esc_html_e( 'Features', 'krys' ); ?></th><th><?php esc_html_e( 'Starter', 'krys' ); ?></th><th><?php esc_html_e( 'Professional', 'krys' ); ?></th><th><?php esc_html_e( 'Enterprise', 'krys' ); ?></th></tr></thead><tbody><tr><td><strong><?php esc_html_e( 'Projects', 'krys' ); ?></strong></td><td><?php esc_html_e( '10', 'krys' ); ?></td><td><?php esc_html_e( 'Unlimited', 'krys' ); ?></td><td><?php esc_html_e( 'Unlimited', 'krys' ); ?></td></tr><tr><td><strong><?php esc_html_e( 'Storage', 'krys' ); ?></strong></td><td><?php esc_html_e( '5GB', 'krys' ); ?></td><td><?php esc_html_e( '100GB', 'krys' ); ?></td><td><?php esc_html_e( 'Unlimited', 'krys' ); ?></td></tr><tr><td><strong><?php esc_html_e( 'Team Members', 'krys' ); ?></strong></td><td><?php esc_html_e( '3', 'krys' ); ?></td><td><?php esc_html_e( '10', 'krys' ); ?></td><td><?php esc_html_e( 'Unlimited', 'krys' ); ?></td></tr><tr><td><strong><?php esc_html_e( 'Support', 'krys' ); ?></strong></td><td><?php esc_html_e( 'Email', 'krys' ); ?></td><td><?php esc_html_e( 'Priority', 'krys' ); ?></td><td><?php esc_html_e( '24/7 Phone', 'krys' ); ?></td></tr><tr><td><strong><?php esc_html_e( 'API Access', 'krys' ); ?></strong></td><td>✗</td><td>✓</td><td>✓</td></tr><tr><td><strong><?php esc_html_e( 'Custom Integrations', 'krys' ); ?></strong></td><td>✗</td><td>✗</td><td>✓</td></tr><tr><td><strong><?php esc_html_e( 'Advanced Analytics', 'krys' ); ?></strong></td><td>✗</td><td>✓</td><td>✓</td></tr><tr><td><strong><?php esc_html_e( 'Dedicated Manager', 'krys' ); ?></strong></td><td>✗</td><td>✗</td><td>✓</td></tr><tr><td><strong><?php esc_html_e( 'Monthly Price', 'krys' ); ?></strong></td><td><strong>$9</strong></td><td><strong>$29</strong></td><td><strong>$99</strong></td></tr></tbody></table></figure>
	<!-- /wp:table -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Start Free Trial', 'krys' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
