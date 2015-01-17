<?php
/**
Template Name: Вопрос-ответ
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
            <h1>Вопрос-ответ</h1>
            <p class="lead">Здесь вы можете задать вопрос на любые темы</p>
        </div>
        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
						 <h2>Если не нашли ответа - тогда нажмите на интересующего вас специалиста:</h2>
						 <div class="bloq_quest">
						<?php
				$parametri = array(
				'role' => 'Administrator',
				'exclude' => array(
					'nicename' =>'shmakovdima',
				)
			);
 
			$zapros_uzerov = new WP_User_Query($parametri);
 
if (empty($zapros_uzerov->results) == FALSE) : 
    foreach ($zapros_uzerov->results as $polzovatel):
		if (($polzovatel->user_nicename)==='shmakovdima') continue;
		echo '<div class="col-sm-6  select_user"><div class="team-member">';
		echo "<div id = '".($polzovatel->ID)."' class='select_answer'>";
        print get_avatar($polzovatel->ID,190, '', $name);
		echo "</div>";
        print '<h4 class="text-center"><a href="' . home_url() . "/author/{$polzovatel->user_nicename}\">{$polzovatel->display_name}</a></h4>";
		 print '<p class="text-muted text-center">'.get_user_meta($polzovatel->ID, 'dolgn', true).'</p>';
        $description = get_user_meta($polzovatel->ID, 'description', true);
		
		echo '</div>
		</div>
		';
			
		
    endforeach;
	echo "<div class='margins'>";
	 foreach ($zapros_uzerov->results as $polzovatel):
		if (($polzovatel->user_nicename)==='shmakovdima') continue;
		echo '<div class="col-sm-12  select_block sel'.($polzovatel->ID).'" >';
		echo '<div class="margin_h2"><h2>Для связи с  '.($polzovatel->display_name).' заполните форму</h2></div>';
		echo do_shortcode(get_user_meta($polzovatel->ID, 'contactform', true));
       
		echo '
		</div>
		';
			
		
    endforeach;
	echo "</div>";
endif;
?>	 
						 </div>
						 <br>
						 
						 <br>
						 <br>
						 		<?php  $posts = get_posts("category_name=vopros_otvet&orderby=date&post_status=publish"); 
									if ($posts) : 
									foreach ($posts as $post) : setup_postdata ($post);  ?>
									 <div class="dsfaq_qa_block">
										 
					
									<div class=" post_reply_comments ask_quest">
										<div>
											<img src="http://1.gravatar.com/avatar/1589b20d73ed6998cef192a312a4dbb8?s=85&d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D85&r=G" class="avatar avatar-85 wp-user-avatar wp-user-avatar-85 alignnone photo img-responsive">
										
										</div>
										<div>
											<h2>Вопрос:</h2>
											<p><?php the_title(); ?></p>
										</div>
										
									</div>
									
									 <div class=" post_reply_comments answer">
										 <div>
											<?php echo get_avatar($post->post_author);?>
										 </div>
										 <div>
											 <h2><a title="<?php echo get_the_author(); ?>" href="<?php echo home_url();?>/author/<?php the_author_nickname(); ?>"><?php echo get_the_author(); ?></a></h2>
											 
												 <?php the_content(); ?>
											
										 </div>
									 </div>
								 </div>
								<?php endforeach; endif;  ?>	
					 
					 	 <br>
					 	 

					 
					 
					 
					 
	                </div><!--/.col-md-8-->

               	<?php get_sidebar(); ?> 
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

<?php get_footer(); ?>
