<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package VMag
 */

get_header(); ?>
	
	<div class="vmag-container">
		<?php do_action( 'vmag_before_body_content' ); ?>
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php vmag_breadcrumbs(); ?>

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							/* translators: %s : search keyword */
							printf( esc_html__( 'Search Results for: %s', 'vmag' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->
		<?php get_sidebar(); ?>
		<?php do_action( 'vmag_after_body_content' ); ?>
	</div><!-- .vmag-container -->

<?php
get_footer();
