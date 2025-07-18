<?php 
/**
 * Dimox Breadcrumbs
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Since ver 1.0.0
 * Add this to any template file by calling dimox_breadcrumbs()
 * Changes: MC added taxonomy support
 */
function vmag_breadcrumbs(){
  /* === OPTIONS === */
	$text['home']     = esc_html( get_theme_mod( 'vmag_bread_home_txt', __( 'Home', 'vmag' ) ) ); // text for the 'Home' link	
	$text['category'] = '%s'; // text for a category page
	$text['tax'] 	  = '%s'; // text for a taxonomy page
	$text['search']   = '%s'; // text for a search results page
	$text['tag']      = '%s'; // text for a tag page
	$text['author']   = '%s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' &gt; '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$homeLink = esc_url( home_url( '/' ) );
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) echo '<div id="vmag-breadcrumbs"><a href="' . esc_url($homeLink) . '">' . esc_html($text['home']) . '</a></div>';
	} else {
		echo '<div id="vmag-breadcrumbs" xmlns:v="https://schema.org/BreadcrumbList">' . sprintf( wp_kses_post($link), wp_kses_post($homeLink), wp_kses_post($text['home'])) . esc_html($delimiter);
		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses($cats, array(
					'span' => array(
						'typeof' => array(),
					),
					'a' => array(
						'rel' => array(),
						'property' => array(),
					)
				));
			}
			echo wp_kses_post($before) . sprintf( esc_html($text['category']), single_cat_title( '', false ) ) . wp_kses_post($after);
		} elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
			}
			echo wp_kses_post($before) . sprintf(esc_html($text['tax']), wp_kses_post(single_cat_title('', false))) . wp_kses_post($after);
		
		}elseif ( is_search() ) {
			echo wp_kses_post($before) . sprintf(esc_html($text['search']), wp_kses_post(get_search_query())) . wp_kses_post($after);
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . wp_kses_post($delimiter);
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . wp_kses_post($delimiter);
			echo wp_kses_post($before) . wp_kses_post(get_the_time('d')) . wp_kses_post($after);
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . wp_kses_post($delimiter);
			echo wp_kses_post($before) . wp_kses_post(get_the_time('F')) . wp_kses_post($after);
		} elseif ( is_year() ) {
			echo wp_kses_post($before) . wp_kses_post(get_the_time('Y')) . wp_kses_post($after);
		} elseif ( is_single() && !is_attachment() ) {
			 if( 'product' == get_post_type()){
			 	$post_type = get_post_type_object(get_post_type());
			  	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			  	printf($link,$shop_page_url . '/', $post_type->labels->singular_name);
			  	if ($showCurrent == 1) echo wp_kses_post($delimiter) . wp_kses_post($before) . esc_html(get_the_title()) . wp_kses_post($after);
			 }
			elseif ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . wp_kses_post($before) . wp_kses_post(get_the_title()) . wp_kses_post($after);
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo wp_kses_post($cats);
				if ($showCurrent == 1) echo wp_kses_post($before) . wp_kses_post(get_the_title()) . wp_kses_post($after);
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo wp_kses_post($before) . wp_kses_post($post_type->labels->singular_name) . wp_kses_post($after);
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo wp_kses_post($cats);
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . wp_kses_post($before) . wp_kses_post(get_the_title()) . wp_kses_post($after);
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo wp_kses_post($before) . wp_kses_post(get_the_title()) . wp_kses_post($after);
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
			}
			if ($showCurrent == 1) echo wp_kses_post($delimiter) . wp_kses_post($before) . wp_kses_post(get_the_title()) . wp_kses_post($after);
		} elseif ( is_tag() ) {
			echo wp_kses_post($before) . sprintf($text['tag'], single_tag_title('', false)) . wp_kses_post($after);
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo wp_kses_post($before) . sprintf(esc_html($text['author']), wp_kses_post($userdata->display_name)) . wp_kses_post($after);
		} elseif ( is_404() ) {
			echo wp_kses_post($before) . wp_kses_post($text['404']) . wp_kses_post($after);
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo esc_html__( 'Page', 'vmag' ) . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div>';
	}
} // end vmag_breadcrumbs()