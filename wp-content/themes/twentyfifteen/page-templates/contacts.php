<?php
/**
 * Template Name: Контакты
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
   wpcf7_enqueue_scripts();
   wpcf7_enqueue_styles();
}

get_header(); ?>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/google-map.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
jQuery(function(){
    jQuery("#contact_phone").mask("+7 (999) 999-9999");
});

</script>


<!-- container -->
	<div class="container wow fadeInDown" id ="blog">		
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
		

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-9 maincontent">
				<header class="page-header">
					<h1 class="page-title">Связь с нами</h1>
				</header>	
				<p>
							<?php $posts = get_posts("category_name=textcontacts&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							<?php echo $post->post_content; ?> 
						
							<?php endforeach; ?>
							<?php endif; ?>	
							<?php wp_reset_query(); ?>
				</p>
				<br>
					<?php echo do_shortcode('[contact-form-7 id="40" title="Заголовок"]'); ?> 

			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-3 sidebar sidebar-right">

				<div class="widget">
					<?php $posts = get_posts("category_name=contactadress&orderby=date&numberposts=1&post_status=publish"); ?>
					<?php if ($posts) : ?>
					<h4>Наш адрес</h4>
					<?php foreach ($posts as $post) : setup_postdata ($post); ?>
					<address>
					<?php echo $post->post_content; ?> 
					</address>
					<?php endforeach; ?>
					<?php endif; ?>	
					<?php wp_reset_query(); ?>
					
					<?php $posts = get_posts("category_name=contact_phone&orderby=date&numberposts=1&post_status=publish"); ?>
					<?php if ($posts) : ?>
					<h4>Наш телефон</h4>
					<?php foreach ($posts as $post) : setup_postdata ($post); ?>
					<p class="adress_copy">
					<?php echo $post->post_content; ?> 
					</p>
					<?php endforeach; ?>
					<?php endif; ?>	
					<?php wp_reset_query(); ?>
					
					<?php $posts = get_posts("category_name=contactmail&orderby=date&numberposts=1&post_status=publish"); ?>
					<?php if ($posts) : ?>
					<h4>Наша электронная почта</h4>
					<?php foreach ($posts as $post) : setup_postdata ($post); ?>
					<p class="adress_copy">
					<?php echo $post->post_content; ?> 
					</p>
					<?php endforeach; ?>
					<?php endif; ?>	
					<?php wp_reset_query(); ?>
					<?php $posts = get_posts("category_name=contactskype&orderby=date&numberposts=1&post_status=publish"); ?>
					<?php if ($posts) : ?>
					<h4>Наш skype</h4>
					<?php foreach ($posts as $post) : setup_postdata ($post); ?>
					<p class="adress_copy">
					<?php echo $post->post_content; ?> 
					</p>
					<?php endforeach; ?>
					<?php endif; ?>	
					<?php wp_reset_query(); ?>	
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	<?php $posts = get_posts("category_name=contactadress&orderby=date&numberposts=1&post_status=publish"); ?>
	<?php if ($posts) : ?>
	<section class="container-full top-space wow fadeInDown">
		<div id="map"></div>
	</section>
	<?php endif; ?>	
	<?php wp_reset_query(); ?>


<?php
get_footer();
