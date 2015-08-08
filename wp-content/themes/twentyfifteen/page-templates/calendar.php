<?php
/**
Template Name: Календарь
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
$default_query = clone $wp_query;



		
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
   wpcf7_enqueue_scripts();
   wpcf7_enqueue_styles();
}

get_header(); ?>


<script src="<?php echo get_template_directory_uri(); ?>/js/sweet-alert.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
jQuery(function(){
    jQuery("#contact_phone").mask("+7 (999) 999-9999");
});	
</script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sweet-alert.css">

	 <section id="blog" class="container container_padding wow fadeInDown">
	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
        <div class="center padding_top">
            <h1>Расписание событий</h1>
           
        </div>
        <div class="blog">
            <div class="row">
				
                 <div class="col-md-8">
					
					 <?php echo do_shortcode('[my_calendar]'); ?>
					
					 
					
					 
	                </div><!--/.col-md-8-->

               	<?php get_sidebar(); ?> 
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

<?php get_footer(); ?>
