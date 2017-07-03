<?php
/**
 * Code that Adds Support for Microformats 2
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.7
 */

function independent_publisher_mf2_body_class( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = "hfeed";
		$classes[] = "h-feed";
	} else {
		// Adds a class for microformats v2
		$classes[] = 'h-entry';
		// add hentry to the same tag as h-entry
		$classes[] = 'hentry';
	}
	return $classes;
}

add_filter( 'body_class', 'independent_publisher_mf2_body_class' );

function independent_publisher_mf2_post_class( $classes ) {
	$classes = array_diff($classes, array('hentry'));
	if ( ! is_singular() ) {
		// Adds a class for microformats v2
		$classes[] = 'h-entry';
		// add hentry to the same tag as h-entry
		$classes[] = 'hentry';
	}
	return $classes;
}

add_filter( 'post_class', 'independent_publisher_mf2_post_class' );

/**  
 * Wraps the_content in e-content
 *
 */
function independent_publisher_the_content( $content ) {
	$wrap = '<div class="entry-content e-content" itemprop="mainContentOfPage">';
	if ($content!="") {
		return $wrap . $content . "\n" . '</div>';
	}
	return $content;
}

add_filter( 'the_content', 'independent_publisher_the_content', 1 );

/**
 * Wraps the_excerpt in p-summary
 *
 */
function independent_publisher_the_excerpt( $content ) {
	$wrap = '<div class="entry-summary p-summary">';
	if ($content!="") {
		return $wrap . $content . '</div>';
	}
	return $content;
}

add_filter( 'the_excerpt', 'independent_publisher_the_excerpt', 1 );

/**
 * Adds mf2 to avatar
 *
 * @param array $args Arguments passed to get_avatar_data(), after processing.
 * @param int|string|object $id_or_email A user ID, email address, or comment object
 * @return array $args
 */
function independent_publisher_mf2_get_avatar_data($args, $id_or_email) {
		if ( ! isset( $args['class'] ) ) {
			$args['class'] = array( 'u-photo' );
		} else {
			$args['class'][] = 'u-photo';
			$args['class'] = array_unique( $args['class'] );
		}
		return $args;
	}

add_filter( 'get_avatar_data', 'independent_publisher_mf2_get_avatar_data', 11, 2 );

/**
 * Adds custom classes to the array of comment classes.
 */
function independent_publisher_mf2_comment_class( $classes ) {
	$classes[] = 'u-comment';
	$classes[] = 'h-cite';
	return array_unique( $classes );
}

add_filter( 'comment_class', 'independent_publisher_mf2_comment_class', 11);
