<?php
    if(!function_exists( 'vmag_dynamic_styles' ) ) {

        function vmag_dynamic_styles() {

        	$tpl_color = get_theme_mod( 'vmag_tpl_color', '#4db2ec' );

            $tpl_color_lighter = vmag_colour_brightness( $tpl_color, 0.8 );

        	$custom_css = "";
            
            /** Color **/
            $custom_css .= "
                .site-content .vmag-newsticker-wrapper ul li a:hover,
                .widget h4.block-title a:hover,
                .site-header .main-navigation ul li ul li a:hover,
                h3 a:hover, .widget .single-post .post-meta a:hover,
                .block-header .view-all a:hover,
                .site-footer a:hover,
                .post-meta a:hover, .entry-meta a:hover,
                #primary .entry-footer a:hover,
                #vmag-breadcrumbs span a:hover,
                .entry-meta .cat-links:hover,
                .archive .tags-links a:hover,
                .single-post .tags-links a:hover,
                .search .tags-links a:hover,
                .blog .tags-links a:hover,
                .post-navigation .nav-links .nav-previous a:hover,
                .post-navigation .nav-links .nav-next a:hover,
                #primary .vmag-author-metabox .author-desc-wrapper a.author-title:hover,
                #primary .vmag-author-metabox .author-desc-wrapper a:hover,
                .widget_recent_entries li a:hover, .widget_archive li a:hover,
                .widget_categories li a:hover, .widget_meta li a:hover,
                .widget_recent_comments li a:hover, .vmag-footer-widget .menu li a:hover{
                    color: {$tpl_color};
                }";

            /** Background **/
        	$custom_css .= "
                .vmag-top-header,
                .site-content .vmag-newsticker-wrapper .vmag-ticker-caption span,
                .widget .single-post .post-meta span.comments-count a,
                .vmag_categories_tabbed ul li.active a,
                .vmag_categories_tabbed ul li:hover a,
                span.format-icon:hover,
                #scroll-up:hover,
                .archive .vmag-archive-more:hover,
                .search .vmag-archive-more:hover,
                .blog .vmag-archive-more:hover,
                .pagination .nav-links span.current,
                .pagination .nav-links span:hover,
                .pagination .nav-links a:hover,
                #primary .comments-area .form-submit input[type=submit],
                .site-header .main-navigation .vmag-search-form-primary.search-in .search-form .search-submit:hover,
                .widget.vmag_category_posts_slider .lSSlideOuter ul.lSPager.lSpg > li.active a,
                .widget.vmag_category_posts_slider .lSSlideOuter ul.lSPager.lSpg > li a:hover,
                #secondary .widget_search input.search-submit:hover{
                    background: {$tpl_color};
                }";

            /** Background (Lighter) **/
            $custom_css .= "
                #secondary .widget_search input.search-submit{
                    background: {$tpl_color_lighter};
                }";
                
            /** Border Color **/
            $custom_css .= "
                .nav-wrapper .current-menu-item a:before,
                .nav-wrapper .current-menu-ancestor a:before,
                .site-header .main-navigation li a:hover:before,
                .site-header .main-navigation ul li ul li a:hover,
                .vmag_categories_tabbed ul,
                .archive .vmag-archive-more:hover,
                .search .vmag-archive-more:hover,
                .blog .vmag-archive-more:hover,
                .pagination .nav-links span.current,
                .pagination .nav-links span:hover,
                .pagination .nav-links a:hover,
                .site-header .main-navigation .vmag-search-form-primary .search-form{
                    border-color: {$tpl_color}; 
                }";
                
            /** Edge Border **/
            $custom_css .= "
                .widget .single-post .post-meta span.comments-count a:before{
                   border-color: {$tpl_color} transparent transparent; 
                }";

            /** Media Query **/
            $custom_css .= "
                @media (max-width: 1004px){
                    .nav-toggle span,
                    .sub-toggle, .sub-toggle-children{
                        background: {$tpl_color} !important;
                    }

                    .site-header .main-navigation li a:hover{
                        color: {$tpl_color} !important;
                    }

                    .site-header .main-navigation li a:hover{
                        border-color: {$tpl_color} !important;
                    }
                }";

            wp_add_inline_style( 'vmag-style', $custom_css );
        }

        add_action( 'wp_enqueue_scripts', 'vmag_dynamic_styles' );

    }

    if( !function_exists('vmag_colour_brightness') ) {
        function vmag_colour_brightness($hex, $percent) {
            // Work out if hash given
            $hash = '';
            if (stristr($hex, '#')) {
                $hex = str_replace('#', '', $hex);
                $hash = '#';
            }
            /// HEX TO RGB
            $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
            //// CALCULATE 
            for ($i = 0; $i < 3; $i++) {
                // See if brighter or darker
                if ($percent > 0) {
                    // Lighter
                    $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
                } else {
                    // Darker
                    $positivePercent = $percent - ($percent * 2);
                    $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
                }
                // In case rounding up causes us to go to 256
                if ($rgb[$i] > 255) {
                    $rgb[$i] = 255;
                }
            }
            //// RBG to Hex
            $hex = '';
            for ($i = 0; $i < 3; $i++) {
                // Convert the decimal digit to hex
                $hexDigit = dechex($rgb[$i]);
                // Add a leading zero if necessary
                if (strlen($hexDigit) == 1) {
                    $hexDigit = "0" . $hexDigit;
                }
                // Append to the hex string
                $hex .= $hexDigit;
            }
            return $hash . $hex;
        }
    }

    if(!function_exists('vmag_hex2rgb')) {
        function vmag_hex2rgb($hex) {
            $hex = str_replace("#", "", $hex);

            if (strlen($hex) == 3) {
                $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
            } else {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }
            $rgb = array($r, $g, $b);
            //return implode(",", $rgb); // returns the rgb values separated by commas
            return $rgb; // returns an array with the rgb values
        }
    }