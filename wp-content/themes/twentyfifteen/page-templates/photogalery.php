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
	<div class="container">		
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
		<?php 
     		query_posts('pagename=photogallery');

		?>
		 <?php if (have_posts()) : while (have_posts()) : the_post();?>
		 <div class="post">
  		<h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
  		<div class="entrytext">
   			<?php echo do_shortcode($post->post_content); ?>
  		</div>
 		</div>
 		<?php endwhile; endif; ?>		
	</div>	<!-- /container -->



<?php
get_footer();
