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

 $posts = get_posts("category_name=nexttren&order=asc&orderby=date&numberposts=5&post_status=publish"); $counters=0; $nexttren=""; $nexttren.= 	'<div class="panel-group" id="accordion2">';?>
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
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo'.get_the_ID().'">
									 <i class="fa fa-angle-right pull-right"></i>'.get_the_title().'
                                </a>
                              </h3>
                            </div>';
							
							if ($counters==0){
									$nexttren.= '<div id="collapseTwo'.get_the_ID().'" class="panel-collapse collapse in">';
								}else{
									$nexttren.= '<div id="collapseTwo'.get_the_ID().'" class="panel-collapse collapse">';
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



get_header(); ?>

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
									
									if ($cat[0]->parent == 30){
										$date = get_field("время_тренинга",get_the_ID());
										$who = get_field("кто_ведет",get_the_ID());
										$mest = get_field("кол-во_мест",get_the_ID());
										$sold = get_field("стоимость",get_the_ID());
										$robo = get_field("шорт-код_робокассы",get_the_ID());
									
									if ($date!="") {
									?>
									<span id="publish_date"><?php echo $date; ?></span>
									<?php } else {
										echo '<span id="publish_date">Скоро</span>';
									}?>
                                    <span class="text-center"><i class="fa fa-user"></i> <a class="text-center" href="<?php echo home_url();?>/author/<?php echo $who[nickname]; ?>"><?php echo $who[display_name]; ?></a></span>
									<span class="text-center">Кол-во оставшихся мест: <?php echo $mest; ?></a></span>
									<?php if ($sold>0){?>
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
									if ($cat[0]->parent == 30){
										?>
									<div class="margin_bottom_float">
										 <h3 >Оплата тренинга:</h3>
										<?php echo do_shortcode($robo); ?>
									</div>
									<?php } ?>
                                   	<?php echo the_content();?>
									</div>
					  </div>
                        </div><!--/.blog-item-->
									<?php
									if ($cat[0]->parent == 30){
										?>
									<div>
										 <h2 class="sold">Оплата тренинга:</h2>
										<?php echo do_shortcode($robo); ?>
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
