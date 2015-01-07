<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

		<main id="main" class="site-main_404" role="main">

			<section id="error" class="container text-center">
        <h1>404, Страница не найдена</h1>
        <p>Страница, которую вы искали, не существует или произошла другая ошибка.</p>
        <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Вернуться на главную страницу</a>
    </section><!--/#error-->
				

		</main><!-- .site-main -->


<?php get_footer(); ?>
