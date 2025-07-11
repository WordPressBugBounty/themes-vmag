<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package VMag
 */

if ( ! function_exists( 'vmag_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function vmag_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>
		<time class="updated" datetime="%3$s">%4$s</time>';
	}

	
	// $post_date     = strtotime( get_the_date( 'Y-m-d H:i:s' ) );
	// $backward_date = strtotime( $comp_time );
	// if ( $post_date < $backward_date ) {
	// 	$this->update_meta_values( $current_post_id );
	// }

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s : posted date */
		esc_html( '%s', 'post date' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	$byline = sprintf(
			/* translators: %s: post author. */
			esc_html( '%s', 'post author' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
	echo '<span class="post-author">'. ($byline) .'</span><span class="posted-on">'. ($posted_on) .'</span>'; // WPCS: XSS OK.
}
endif;
add_action( 'vmag_post_meta', 'vmag_posted_on' );


if ( ! function_exists( 'vmag_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function vmag_entry_footer() {

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'vmag' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function vmag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'vmag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'vmag_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so vmag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so vmag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in vmag_categorized_blog.
 */
function vmag_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'vmag_categories' );
}
add_action( 'edit_category', 'vmag_category_transient_flusher' );
add_action( 'save_post',     'vmag_category_transient_flusher' );

/**
 * Get list of tags for individual posts
 */
add_action( 'vmag_post_tag_lists', 'vmag_post_tag_lists_hook' );
if( ! function_exists( 'vmag_post_tag_lists_hook' ) ) {
	function vmag_post_tag_lists_hook() {
		$post_tags_list = get_the_tag_list();
		$post_tag_option = get_theme_mod( 'vmag_homepage_tag_option', 'show' );
		if ( $post_tags_list && $post_tag_option != 'hide' ) {
			/* translators: %s : tag list */
			printf( '<span class="post-tags-links">%s</span>', $post_tags_list );
		}
	}
}

/**
 * Get post comment number
 */
if( ! function_exists( 'vmag_post_comments' ) ):
	function vmag_post_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-count">';
				comments_popup_link( 0 , esc_html__( '1', 'vmag' ), esc_html__( '%', 'vmag' ) );
			echo '</span>';
		}
		
	}
endif;

/**
 * Single post Categories lists
 */

if( ! function_exists( 'vmag_post_cat_lists' ) ) :
	function vmag_post_cat_lists() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'vmag' ) );
			if ( $categories_list && vmag_categorized_blog() ) {
				/* translators: %s : category list */
				printf( '<span class="cat-links">%s</span>', $categories_list ); 
			}
		}
	}
endif;

/**
 * Single post Tags lists
 */

if( ! function_exists( 'vmag_single_post_tags_list' ) ) :
	function vmag_single_post_tags_list() {

		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				/* translators: %s : tag lists */
				printf( '<span class="tags-links clearfix">%s</span>', $tags_list ); 
			}
		}
	}
endif;