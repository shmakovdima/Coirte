<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

 $posts = get_posts("category_name=nexttren&order=asc&orderby=date&numberposts=5&post_status=publish"); $counters=0; $nexttren=""; $nexttren.= 	'<div class="panel-group" id="accordion2">';?>
<?php if ($posts) : ?>
<?php foreach ($posts as $post) : setup_postdata ($post); ?>
	<?php 		 
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
<?php endif; ?>	

 <aside class="col-md-4">
                    <div class="widget search">
						 <form role="form" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                             <input title="Поиск" type="text" class="form-control search_box" autocomplete="off" placeholder="Найти..." name="s">     						
                         </form>
                    </div><!--/.search-->
    				
    				<div class="widget categories">
                        <h2>Ближайшие тренинги</h2>
                     
                           
								<?php echo $nexttren; ?>
							</div>
                                         
                    </div><!--/.recent comments-->
                     <div class="widget categories akc">
                        <h2>Наши акции</h2>
						<?php $posts = get_posts("category_name=skidks&orderby=date&numberposts=1&post_status=publish"); ?>
								<?php if ($posts) : ?>
								<?php foreach ($posts as $post) : setup_postdata ($post); ?>
								 <a href="http://populartrening.ru/category/trenings" title="Акции">
								<?php echo "<img align=left src='".(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0])."' width=100% height=auto>"; ?>
								</a><p><?php echo $post->post_content; ?> </p>
								<?php endforeach; ?>
								<?php endif; ?>	
                    </div><!--/.recent comments-->

                    <div class="widget categories">
                        <h2>Категории</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="blog_category">
									<?php 
										// Проверка в категории новости	
									$count = get_category(16)->category_count;
									if ($count > 0){
										echo '  <li><a href="'.get_category_link(16).'">Новости <span class="badge">'. $count.'</span></a></li>';
									}
									?>
									<?php 
										// Проверка в категории полезные статьи
									$count = get_category(12)->category_count;
									if ($count > 0){
										echo '  <li><a href="'.get_category_link(12).'">Полезные статьи <span class="badge">'. $count.'</span></a></li>';
									}
									?>
									<?php 
										// Проверка в категории лучшие статьи
									$count = get_category(13)->category_count;
									if ($count > 0){
										echo '  <li><a href="'.get_category_link(13).'">Лучшие статьи <span class="badge">'. $count.'</span></a></li>';
									}
									?>
									<?php 
										// Проверка в категории за чашкой чая
									$count = get_category(15)->category_count;
									if ($count > 0){
										echo '  <li><a href="'.get_category_link(15).'">За чашкой чая <span class="badge">'. $count.'</span></a></li>';
									}
									?>
                                </ul>
                            </div>
                        </div>                     
                    </div><!--/.categories-->
    				

    				<div class="widget blog_gallery">
						<h2>Наша фотогалерея</h2>     	
							<?php echo do_shortcode('[random max="6"  template=sidebar5]'); ?> 
							<a href="<?php echo get_home_url(); ?>/photogallery" title="Просмотреть все">Все наши фотографии</a>
       
                    </div><!--/.blog_gallery-->
					
    			</aside> 
