<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>

	<section id="partner" class="partner autors">
        <div class="container">
			<div class="row center wow fadeInDown">
                <?php print get_avatar($curauth->ID,260, '', $name);?>
            </div> 	 
            <div class="row center wow fadeInDown">
                <h1><?php echo $curauth->display_name; ?></h1>
		<h3><?php echo get_user_meta($curauth->ID, 'dolgn', true);?></h3>
				
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->
	<section  class="container_autor wow fadeInDown">
		<div class="container">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs() ?> 
			<div class="row">
			<!-- Article main content -->
			
			<article class="col-sm-9 maincontent">
				<header class="page-header">
					<h2 class="page-title">О себе:</h2>
					
				</header>	
				<p><?php echo $curauth->user_description; ?></p>
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-3 sidebar sidebar-right">

				<div class="widget">
					
					<h4>E-mail</h4>
					<?php echo $curauth->user_email; ?>
					

				</div>

			</aside>
			<!-- /Sidebar -->
			
	</section>
	

<?php get_footer(); ?>
