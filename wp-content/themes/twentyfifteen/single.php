<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */



$default_query = clone $wp_query;
if ( have_posts() ) {
	foreach ($posts as $post) : setup_postdata ($post); 
		$idpost = get_the_ID();
		
	endforeach;
}

$posts = get_posts("category_name=nexttren&order=asc&orderby=date&numberposts=5&post_status=publish"); $counters=0; $nexttren=""; $nexttren.= 	'<div class="panel-group" id="accordion3">';?>
<?php if ($posts) : ?>
<?php foreach ($posts as $post) : setup_postdata ($post); ?>
	<?php 	
	if (get_the_ID()==$idpost) continue;
	$date = get_field("время_тренинга",get_the_ID());
	if ($date!="") {}else{
		$date = "Скоро";
	}
	$mest = get_field("кол-во_мест",get_the_ID());

							$nexttren.='<div class="panel panel-default">';
								if ($counters==0){
									$nexttren.='<div class="panel-heading active">';
								}else{
									$nexttren.= '<div class="panel-heading">';
								}
				
							$nexttren.= '	
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo'.get_the_ID().'1">
									 <i class="fa fa-angle-right pull-right"></i>'.get_the_title().'
                                </a>
                              </h3>
                            </div>';
							
							if ($counters==0){
									$nexttren.= '<div id="collapseTwo'.get_the_ID().'1" class="panel-collapse collapse in">';
								}else{
									$nexttren.= '<div id="collapseTwo'.get_the_ID().'1" class="panel-collapse collapse">';
								}

                           $nexttren.= ' <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
											<img src='.(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0]).' width=140 height=auto>
                                           
                                        </div>
                                      
                                             <h4>'.$date.'</h4>
                                             <p>'.get_the_excerpt().'</p>';
					
					if ($mest > 0) {
						$nexttren.='<span class="btn  ">Осталось '.$mest.' мест</span>';
					}
					
											 
									$nexttren.='		  <a class="btn btn-primary readmore" href="'.get_permalink().'">Узнать больше</a>
                                  </div>
                              </div>
                            </div>
							 </div>
							
						  '; ?>
<?php $counters++; endforeach; ?>
<?php endif; 

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
$(document).load(function(){
	$("select").chosen({disable_search_threshold: 10});
});
</script>



 <section id="blog" class="container container_padding wow fadeInDown">
	 <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
        <div class="center ">
           
        </div>

        <div class="blog padding_top">
            <div class="row">
                <div class="col-md-8">
				<?php
						update_post_caches($posts);

						$wp_query = clone  $default_query;
						
						query_posts(
							$wp_query->query // это массив базового запроса текущей страницы
						);
						
						
 						if (have_posts()){
							
						while(have_posts()):the_post();
							
						?>
                    <div class="blog-item">
							<?php if (has_post_thumbnail()) { ?>
                           		<?php the_post_thumbnail('full', array('class' => 'img-responsive img-blog' )); ?>
							<?php
									}
							?>
                            <div class="row">  
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
									<?php 
									
									$cat = get_the_category();
									if (($cat[0]->parent == 30) || ($cat[0]->parent == 39) ) {
										$date = get_field("время_тренинга",get_the_ID());
										$who = get_field("кто_ведет",get_the_ID());
										$mest = get_field("кол-во_мест",get_the_ID());
										$sold = get_field("стоимость",get_the_ID());
										$robo = get_field("шорт-код_робокассы",get_the_ID());
										$robo = '[contact-form-7 id="316" title="Запись на семинар"]';
									
									if ($date!="") {
									?>
									<span id="publish_date"><?php echo $date; ?></span>
									<?php } else {
										echo '<span id="publish_date">Скоро</span>';
									}?>
                                    <span class="text-center"><i class="fa fa-user"></i> <a class="text-center" href="<?php echo home_url();?>/author/<?php echo $who[nickname]; ?>"><?php echo $who[display_name]; ?></a></span>
									<span class="text-center">Кол-во оставшихся мест: <?php echo $mest; ?></a></span>
									<?php if ($sold!=""){?>
										<span class="text-center">Стоимость сегодня: <?php echo $sold; ?></a></span>
									<?php }?>
									<?php	
									}else{
									?>
									<span id="publish_date"><?php the_time('j M'); ?></span>
                                    <span class="text-center"><i class="fa fa-user"></i> <a class="text-center" href="<?php echo home_url();?>/author/<?php the_author_nickname(); ?>"><?php echo get_the_author(); ?></a></span>

									<?	
									}
									?>
                                    <span><i class="fa fa-comment"></i> <a href="<?php echo get_permalink(); ?>#comments"><?php comments_number( 'Нет комментариев', 'Один комментарий', '% комментариев' ); ?></a></span>
                                 	
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
									
                                    <h1><?php echo the_title() ?></h1>
									<?php
									if (($cat[0]->parent == 30) || ($cat[0]->parent == 39) && ($robo!="")){
										
										
									if (date('d.m.Y', strtotime($date)) == $date) {
										
										
										$datestart =  get_the_date('d.m.Y'); 
										
										$currentday = date("d.m.Y");
										//echo alex_date_dif($datestart,$date,".",0);
										$sliderlength = alex_date_dif($datestart,$date,".",0);
										$difference = alex_date_dif($datestart,$currentday,".",0);
										
										?>
									
									<div class = "header_life">
									<h3 class="lefted_counters">
											Осталось:
										</h3>
									<div id = "slider"></div>
									<div>
									
									
										
									</div>
									<script>
										
										$(function() {
												$("#slider").slider({
											value: 0, //Значение, которое будет выставлено слайдеру при загрузке
		min: 0, //Минимально возможное значение на ползунке
		max: <?php echo $sliderlength; ?>, //Максимально возможное значение на ползунке
		value: <?php echo $difference; ?> ,
		step: 1, //Шаг, с которым будет двигаться ползунок
		animate: true,
		range: "min",
		disable: true
		});	
		$("#slider").slider("disable");
						<?php if ($date>$currentday) {			?>		
		 $(".digit").countdown({
          image: "<?php echo get_template_directory_uri(); ?>/images/digits.png",
          format: "dd:hh:mm:ss",
			 endTime: new Date("<?php echo  date("m/d/y",strtotime($date));?>")
        });					
									<?php	}	?>

										});
									
									</script>
								
									</div>	
										<?php 
										
										}
										?>
									
									
								
									
										<?php if (in_category('free_tren') && in_category('vebinaryi')) {?>		
											
										<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на бесплатный вебинар
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на бесплатный вебинар:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1052" title="Форма на бесплатный тренинг"]'); 	
											
										} else {  
											if (in_category('vebinaryi')) {?>
											
											<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на вебинар
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на вебинар:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1142" title="Форма на вебинар"]'); 	
										}else{
											
											
											if (in_category('free_tren')) {?>
											
										<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на бесплатный тренинг
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на бесплатный тренинг:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1052" title="Форма на бесплатный тренинг"]'); 	
										}else{?>
											
											<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на тренинг
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на тренинг:</h3>
											
											
											
											
											
									
											
											
											
											
											
											<?php	echo do_shortcode($robo); }} }?>
										
										
									</div>
									<?php } ?>
                                   	<?php echo the_content();?>
									</div>
					  </div>
                        </div><!--/.blog-item-->
									<?php
									if (($cat[0]->parent == 30) || ($cat[0]->parent == 39) && ($robo!="")){
										?>
									
									<div class="header_life overflowed">
										
											<?php if ($date>$currentday) {			?>		
										<h2>
											Осталось:
										</h2>
										<div class="digit">
										
										</div>
										<div class="digit_counters">
											<span>дней</span>
											<span>часов</span>
											<span>минут</span>
											<span>секунд</span>
										</div>
										<?php } ?>
									</div>
																			<?php if (in_category('free_tren') && in_category('vebinaryi')) {?>		
											
										<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на бесплатный вебинар
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на бесплатный вебинар:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1052" title="Форма на бесплатный тренинг"]'); 	
											
										} else {  
											if (in_category('vebinaryi')) {?>
											
											<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на вебинар
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на вебинар:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1142" title="Форма на вебинар"]'); 	
										}else{
											
											
											if (in_category('free_tren')) {?>
											
										<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на бесплатный тренинг
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на бесплатный тренинг:</h3>
										
										 <?php echo do_shortcode('[contact-form-7 id="1052" title="Форма на бесплатный тренинг"]'); 	
										}else{?>
											
											<div class="margin_bottom_float form_order_button_div">
											<button class="btn form_order_button">
											Запись на тренинг
											</button>
										</div>
										<div class="margin_bottom_float form_order_form">
											<h3>Запись на тренинг:</h3>
											
											
											
											
											
									
											
											
											
											
											
											<?php	echo do_shortcode($robo); }} }?>
										
										
									</div>
			
									<div>
										<h2 class="seld">С этим семинаром также покупают:</h2>
										<?php echo $nexttren;?>
									</div>
									</div>
									<?php
									}
										?>
                                
                          
                        
                    
                        
                       
			<?php		
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

						<?php endwhile;
						}else{
							echo "<h2 class='text-center'>Простите, но в этой рубрике нет пока постов</h2>";
						}?>
                    </div><!--/.col-md-8-->

                <?php get_sidebar(); ?>     

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->


<?php get_footer(); ?>
