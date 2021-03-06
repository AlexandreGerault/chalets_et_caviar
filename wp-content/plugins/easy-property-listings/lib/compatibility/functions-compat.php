<?php
/**
 * EPL Functions Compatibility
 *
 * @package     EPL
 * @subpackage  Compatibility/Functions
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get EPL author meta.
 *
 * @return void list of author meta variables
 * @since 1.0
 */
function epl_get_author_meta() {
	global $epl_author_meta_sent;
	if ( $epl_author_meta_sent ) {
		return;
	}

	require_once EPL_PATH_LIB . 'templates/content/author-meta.php';
	$epl_author_meta_sent = true;
}

/**
 * Print EPL property address.
 *
 * @param string $post_ID post id.
 *
 * @return void
 * @since 1.0
 */
function epl_the_property_address( $post_ID = '' ) {
	$address = epl_get_property_address( $post_ID );
	$address = apply_filters( 'epl_the_property_address_filter', $address );
	echo esc_attr( $address );
}

/**
 * Get EPL property address.
 *
 * @param string $post_ID post id.
 *
 * @return string The address
 * @since 1.0
 */
function epl_get_property_address( $post_ID = '' ) {
	if ( empty( $post_ID ) ) {
		$post_ID = get_the_ID();
	}
	$property_meta = epl_get_property_meta( $post_ID );

	$address = '';

	if ( isset( $property_meta['property_address_street_number'] ) && ! empty( $property_meta['property_address_street_number'] ) ) {
		$property_address_street_number = $property_meta['property_address_street_number'][0];
		if ( ! empty( $property_address_street_number ) ) {
			$address .= $property_address_street_number . ', ';
		}
	}

	if ( isset( $property_meta['property_address_street'] ) && ! empty( $property_meta['property_address_street'] ) ) {
		$property_address_street = $property_meta['property_address_street'][0];
		if ( ! empty( $property_address_street ) ) {
			$address .= $property_address_street . ', ';
		}
	}

	if ( isset( $property_meta['property_address_suburb'] ) && ! empty( $property_meta['property_address_suburb'] ) ) {
		$property_address_suburb = $property_meta['property_address_suburb'][0];
		if ( ! empty( $property_address_suburb ) ) {
			$address .= $property_address_suburb . ', ';
		}
	}

	if ( isset( $property_meta['property_address_state'] ) && ! empty( $property_meta['property_address_state'] ) ) {
		$property_address_state = $property_meta['property_address_state'][0];
		if ( ! empty( $property_address_state ) ) {
			$address .= $property_address_state . ', ';
		}
	}

	if ( isset( $property_meta['property_address_postal_code'] ) && ! empty( $property_meta['property_address_postal_code'] ) ) {
		$property_address_postal_code = $property_meta['property_address_postal_code'][0];
		if ( ! empty( $property_address_postal_code ) ) {
			$address .= $property_address_postal_code . ', ';
		}
	}

	$address = trim( $address );
	$address = trim( $address, ',' );
	$address = trim( $address );
	return apply_filters( 'epl_get_property_address_filter', $address );
}

/**
 * Get postcode label. Depreciated use epl_labels instead.
 *
 * @since 1.0
 * @depricated since 2.2. use epl_labels instead.
 */
function epl_display_label_postcode() {
	$epl_display_label_postcode = '';

	global $epl_settings;
	if ( ! empty( $epl_settings ) && isset( $epl_settings['label_postcode'] ) ) {
		$epl_display_label_postcode = $epl_settings['label_postcode'];
	}
	return apply_filters( 'epl_display_label_postcode', $epl_display_label_postcode );
}

/**
 * Get bond label. Depreciated use epl_labels instead.
 *
 * @since 1.0
 * @depricated since 2.2. use epl_labels instead.
 */
function epl_display_label_bond() {
	$epl_display_label_bond = '';

	global $epl_settings;
	if ( ! empty( $epl_settings ) && isset( $epl_settings['label_bond'] ) ) {
		$epl_display_label_bond = $epl_settings['label_bond'];
	}
	return apply_filters( 'epl_display_label_bond', $epl_display_label_bond );
}

/**
 * Get suburb label. Depreciated use epl_labels instead.
 *
 * @since 1.0
 * @depricated since 2.2. use epl_labels instead.
 */
function epl_display_label_suburb() {
	$epl_display_label_suburb = '';

	global $epl_settings;
	if ( ! empty( $epl_settings ) && isset( $epl_settings['label_suburb'] ) ) {
		$epl_display_label_suburb = $epl_settings['label_suburb'];
	}
	return apply_filters( 'epl_display_label_suburb', $epl_display_label_suburb );
}

// Front End Functions.
if ( ! is_admin() ) {
	return;
}

/**
 * Listing Function for paged card display.
 *
 * @compat  not being used @since 1.3 in core, but still kept for extensions which may be using this function
 * @since   1.3
 */
function epl_property_blog_default() {

	global $property,$epl_settings;
	$property_status = $property->get_property_meta( 'property_status' );

	// Status Removal Do Not Display Withdrawn or OffMarket listings.
	if ( ! in_array( $property_status, array( 'withdrawn', 'offmarket' ), true ) ) {
		// Do Not Display Withdrawn or OffMarket listings.
		$option = '';
		if ( ! empty( $epl_settings ) && isset( $epl_settings['epl_property_card_style'] ) ) {
			$option = $epl_settings['epl_property_card_style'];
		}

		$action_check = has_action( 'epl_loop_template' );
		if ( ! empty( $action_check ) && 0 !== $option ) {
			do_action( 'epl_loop_template' );
		} else {
			epl_get_template_part( 'loop-listing-blog-default.php' );
		}
	}
}

/**
 * Listing Function for slim view.
 *
 * @compat  not being used @since 1.3 in core, but still kept for extensions which may be using this function
 * @since   1.3
 */
function epl_property_blog_slim() {
	global $property,$epl_settings;
	if ( is_null( $property ) ) {
		return;
	}
	$property_status = $property->get_property_meta( 'property_status' );
	// Status Removal.
	if ( ! in_array( $property_status, array( 'withdrawn', 'offmarket' ), true ) ) {
		// Do Not Display Withdrawn or OffMarket listings.
		$option = '';
		if ( ! empty( $epl_settings ) && isset( $epl_settings['epl_property_card_style'] ) ) {
			$option = $epl_settings['epl_property_card_style'];
		}

		$action_check = has_action( 'epl_loop_template' );
		if ( ! empty( $action_check ) && 0 !== $option ) {
			do_action( 'epl_loop_template' );
		} else {
			epl_get_template_part( 'loop-listing-blog-slim.php' );
		}
	}
}

/**
 * Listing Function for table open.
 *
 * @since 2.1.6
 */
function epl_property_blog_table() {
	global $property,$epl_settings;
	if ( is_null( $property ) ) {
		return;
	}
	$property_status = $property->get_property_meta( 'property_status' );
	// Status Removal.
	if ( ! in_array( $property_status, array( 'withdrawn', 'offmarket' ), true ) ) {
		// Do Not Display Withdrawn or OffMarket listings.
		$option = '';
		if ( ! empty( $epl_settings ) && isset( $epl_settings['epl_property_card_style'] ) ) {
			$option = $epl_settings['epl_property_card_style'];
		}

		$action_check = has_action( 'epl_loop_template' );
		if ( ! empty( $action_check ) && 0 !== $option ) {
			do_action( 'epl_loop_template' );
		} else {
			epl_get_template_part( 'loop-listing-blog-table.php' );
		}
	}
}

/**
 * Listing Function for table open.
 *
 * Kept for extensions which may be using this function.
 *
 * @since 2.1.8
 */
function epl_property_blog_table_open() {
	global $property,$epl_settings;
	if ( is_null( $property ) ) {
		return;
	}
	$property_status = $property->get_property_meta( 'property_status' );
	// Status Removal.
	if ( ! in_array( $property_status, array( 'withdrawn', 'offmarket' ), true ) ) {
		// Do Not Display Withdrawn or OffMarket listings.
		$option = '';
		if ( ! empty( $epl_settings ) && isset( $epl_settings['epl_property_card_style'] ) ) {
			$option = $epl_settings['epl_property_card_style'];
		}

		$action_check = has_action( 'epl_loop_template' );
		if ( ! empty( $action_check ) && 0 !== $option ) {
			do_action( 'epl_loop_template' );
		} else {
			epl_get_template_part( 'loop-listing-blog-table-open.php' );
		}
	}
}

/**
 * TEMPLATE - Leased/sold property list.
 *
 * Kept for extensions which may be using this function.
 *
 * @since 1.3
 */
function epl_property_sold_leased() {
	$property_suburb = get_post_custom_values( 'property_address_suburb' );
	$post_id         = $property_suburb[0]['ID'];
	$post            = get_post( $post_id );
	$terms           = get_the_terms( $post->ID, 'location' );
	if ( ! empty( $terms ) ) {
		global $post;
		foreach ( $terms as $term ) {
			$term->slug;
		}
	}

	$post_type = get_post_type();

	if ( 'property' === $post_type ) {
		$query = new WP_Query(
			array(
				'post_type'      => 'property',
				'location'       => $term->slug,
				'meta_query'     => array(
					array(
						'key'   => 'property_status',
						'value' => 'sold',
					),
				),
				'posts_per_page' => '5',
			)
		);
	} elseif ( 'land' === $post_type ) {
		$query = new WP_Query(
			array(
				'post_type'       => 'land',
				'meta_query'      => array(
					array(
						'key'   => 'property_status',
						'value' => 'sold',
					),
				),
				'property_status' => 'sold',
				'posts_per_page'  => '5',
			)
		);
	} elseif ( 'rural' === $post_type ) {
		$query = new WP_Query(
			array(
				'post_type'      => 'rural',
				'location'       => $term->slug,
				'meta_query'     => array(
					array(
						'key'   => 'property_status',
						'value' => 'sold',
					),
				),
				'posts_per_page' => '5',
			)
		);
	} else {
		$query = new WP_Query(
			array(
				'post_type'      => 'rental',
				'location'       => $term->slug,
				'meta_query'     => array(
					array(
						'key'   => 'property_status',
						'value' => 'leased',
					),
				),
				'posts_per_page' => '5',
			)
		);
	}

	if ( $query->have_posts() ) { ?>
		<div class="epl-tab-section epl-tab-section-listing-history">
			<?php if ( 'property' === $post_type || 'land' === $post_type || 'rural' === $post_type ) { ?>
				<h5 class="epl-tab-title epl-tab-title-sales tab-title"><?php esc_html_e( 'Recently Sold', 'easy-property-listings' ); ?></h5>
			<?php } else { ?>
				<h5 class="epl-tab-title epl-tab-title-leased tab-title"><?php esc_html_e( 'Recently Leased', 'easy-property-listings' ); ?></h5>
			<?php } ?>
			<div class="tab-content">
				<ul>
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>

							<!-- Suburb Tab -->
							<li>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
									<?php echo esc_attr( $suburb[0] ); ?>
								</a>
							</li>
							<?php
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
	wp_reset_postdata();
}

/**
 * Staff Directory Card.
 *
 * Kept for extensions which may be using this function.
 *
 * @since 1.3
 * @param string $display post id.
 * @param string $image on off switch.
 * @param string $title on off switch.
 * @param string $icons styling switch.
 */
function epl_property_author_card( $display, $image, $title, $icons ) {
	global $property,$epl_author;
	if ( is_null( $epl_author ) ) {
		return;
	}
	$property_status = $property->get_property_meta( 'property_status' );
	// Status Removal.
	if ( ! in_array( $property_status, array( 'withdrawn', 'offmarket' ), true ) ) {

		// Do Not Display Withdrawn or OffMarket listings.
		?>
			<div id="post-<?php the_ID(); ?>" style="width: 20%;margin-right: 1em;float: left;" class="epl-widget property-widget-image hentry">
				<div class="entry-header">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="epl-img-widget">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( $image ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<div class="entry-content">
					<?php
					// Heading Options.
					if ( 'on' === $title ) {
						?>
						<h5 class="property-meta heading"><?php echo wp_kses( $the_property_heading ); ?></h5>
						<?php
					}
					?>

					<!-- Address -->
					<div class="property-address">
						<?php do_action( 'epl_property_address' ); ?>
					</div>
					<!-- END Address -->

					<?php
					// Icon Options.
					if ( 'all' === $icons ) {
						?>
							<div class="property-meta property-feature-icons"><?php epl_property_icons(); ?></div>
						<?php } elseif ( 'bb' === $icons ) { ?>
							<div class="property-meta property-feature-icons"><?php echo wp_kses( epl_get_property_bb_icons() ); ?></div>
						<?php } ?>

					<div class="property-meta price"><?php epl_property_price(); ?></div>
					<form class="epl-property-button" action="<?php the_permalink(); ?>" method="post">
						<input type=submit value="<?php esc_html_e( 'Read More', 'easy-property-listings' ); ?>" />
					</form>
				</div>
			</div>

		<?php
	}
}

/**
 * Modify the Excerpt length on archive pages
 *
 * @param int $length Excerpt word length.
 *
 * @return int
 * @since 1.0.0
 * @since 3.4.27 Depreciated function and deactivated filter.
 */
function epl_excerpt_length( $length ) {
	global $post;
	if ( 'property' === $post->post_type ) {
		return 16;
	} elseif ( 'rental' === $post->post_type ) {
		return 16;
	} elseif ( 'commercial' === $post->post_type ) {
		return 16;
	} elseif ( 'commercial_land' === $post->post_type ) {
		return 16;
	} elseif ( 'business' === $post->post_type ) {
		return 16;
	} elseif ( 'rural' === $post->post_type ) {
		return 16;
	} elseif ( 'land' === $post->post_type ) {
		return 16;
	} elseif ( 'suburb' === $post->post_type ) {
		return 39;
	} else {
		return 55;
	}
}
/**
 * Filter Removed. add_filter( 'excerpt_length', 'epl_excerpt_length', 999 ); Removed due to fix.
 */
