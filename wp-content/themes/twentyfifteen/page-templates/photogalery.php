<?php
/**
 * Template Name: Фотогалерея
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */



get_header(); ?>


<!-- container -->
	<div class="container wow fadeInDown" id="blog">		
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
		<?php 
     		query_posts('pagename=photogallery');
		?>
		 <?php if (have_posts()) : while (have_posts()) : the_post();?>
   			<?php echo do_shortcode($post->post_content); ?> 		
 		<?php endwhile; endif; ?>		
	
	</div>	<!-- /container -->

<?php
get_footer();
