<?php
/**
 * Title: Features Alternating
 * Slug: krys/features-alternating
 * Categories: krys-features
 * Description: Alternating image and text features layout
 *
 * @package Krys
 * @since 2.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--70)"><?php esc_html_e( 'Features That Set Us Apart', 'krys' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--70)">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"0.5rem"}}} -->
			<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/feature-1.jpg" alt="" style="border-radius:0.5rem;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph {"fontSize":"small","textColor":"primary"} -->
			<p class="has-primary-color has-text-color has-small-font-size"><?php esc_html_e( 'FEATURE 01', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-x-large-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Intuitive Design', 'krys' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"medium"} -->
			<p class="has-medium-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Built with user experience in mind. Our interface is clean, modern, and incredibly easy to navigate for users of all skill levels.', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"is-style-krys-checkmarks","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<ul class="is-style-krys-checkmarks" style="margin-top:var(--wp--preset--spacing--40)">
				<li><?php esc_html_e( 'Drag-and-drop interface', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Customizable workflows', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Quick onboarding', 'krys' ); ?></li>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"bottom":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--70)">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph {"fontSize":"small","textColor":"primary"} -->
			<p class="has-primary-color has-text-color has-small-font-size"><?php esc_html_e( 'FEATURE 02', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-x-large-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Powerful Automation', 'krys' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"medium"} -->
			<p class="has-medium-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Automate repetitive tasks and focus on what matters. Set up workflows once and let the system handle the rest.', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"is-style-krys-checkmarks","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<ul class="is-style-krys-checkmarks" style="margin-top:var(--wp--preset--spacing--40)">
				<li><?php esc_html_e( 'Smart triggers', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Conditional logic', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Multi-step workflows', 'krys' ); ?></li>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"0.5rem"}}} -->
			<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/feature-2.jpg" alt="" style="border-radius:0.5rem;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"0.5rem"}}} -->
			<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/feature-3.jpg" alt="" style="border-radius:0.5rem;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph {"fontSize":"small","textColor":"primary"} -->
			<p class="has-primary-color has-text-color has-small-font-size"><?php esc_html_e( 'FEATURE 03', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-x-large-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Advanced Analytics', 'krys' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontSize":"medium"} -->
			<p class="has-medium-font-size" style="margin-top:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Make data-driven decisions with comprehensive analytics and reporting tools that provide deep insights into your performance.', 'krys' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"is-style-krys-checkmarks","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<ul class="is-style-krys-checkmarks" style="margin-top:var(--wp--preset--spacing--40)">
				<li><?php esc_html_e( 'Real-time dashboards', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Custom reports', 'krys' ); ?></li>
				<li><?php esc_html_e( 'Export capabilities', 'krys' ); ?></li>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
