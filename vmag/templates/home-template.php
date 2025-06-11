<?php
/**
 * Template Name: Home Page
 *
 * Display all widget content related to front page / home page.
 *
 * @package VMag
 */

get_header(); ?>

		<main id="main" class="site-main" role="main">

			<div class="vmag-newsticker-wrapper">
				<div class="vmag-container">
					<?php do_action( 'vmag_news_ticker' ); ?>
				</div>	
			</div><!-- .vmag-newsticker-wrapper -->
			
			<div class="homepage-slider-section">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_featured_slider_area' ) ) {
			            	dynamic_sidebar( 'vmag_featured_slider_area');
			         	}
			        ?>
		        </div>
			</div> <!-- .end of home slider -->

			<div class="homepage-content-wrapper clearfix">
				<div class="vmag-container">
					<div class="vmag-main-content">
						<?php
				        	if( is_active_sidebar( 'vmag_homepage_blocks_area' ) ) {
				            	dynamic_sidebar( 'vmag_homepage_blocks_area' );
				         	}
				        ?>
			        </div><!-- .vmag-main-content -->
			        <div class="vmag-home-aside">
			        	<?php
				        	if( is_active_sidebar( 'vmag_homepage_sidebar_area' ) ) {
				            	dynamic_sidebar( 'vmag_homepage_sidebar_area' );
				         	}
				        ?>
			        </div><!-- .vmag-home-aside -->
		        </div>
			</div><!-- .homepage-content-wrapper -->
				
			<div class="homepage-fullwidth-wrapper clearfix">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_homepage_fullwidth_area_one' ) ) {
			            	dynamic_sidebar( 'vmag_homepage_fullwidth_area_one' );
			         	}
			        ?>
		        </div>
			</div><!-- .homepage-fullwidth-wrapper -->
			<?php $widget_column = vmag_widgets_count( 'vmag_homepage_fullwidth_area_two' ); ?>
			<div class="homepage-second-fullwidth-wrapper <?php echo esc_attr( $widget_column ); ?> clearfix">
				<div class="vmag-container">
					<?php
			        	if( is_active_sidebar( 'vmag_homepage_fullwidth_area_two' ) ) {
			            	dynamic_sidebar( 'vmag_homepage_fullwidth_area_two' );
			         	}
			        ?>
			    </div>    
			</div><!-- .homepage-widget-column-wrapper -->

		</main><!-- #main -->

<?php
get_footer();