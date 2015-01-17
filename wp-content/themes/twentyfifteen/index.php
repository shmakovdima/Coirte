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

<?php $posts = get_posts("category_name=about_compani&orderby=date&numberposts=1&post_status=publish"); $counters=0;?>
<?php if ($posts) : ?>
<?php foreach ($posts as $post) : setup_postdata ($post); ?>
	<?php $aboutcompany = 	'		<div class="center">
                                    <h1>'.get_the_title().'</h1></div>
									<div class="lead">
                                    <p >'.get_the_excerpt().'</p>  
									<a class="btn btn-primary readmore" href="'.get_permalink().'">Узнать больше</a>
									</div>
                                '; ?>
<?php endforeach; ?>
<?php endif; ?>	

<?php $posts = get_posts("category_name=nexttren&order=asc&orderby=date&numberposts=5&post_status=publish"); $counters=0; $nexttren=""; $nexttren.= 	'<div class="panel-group" id="accordion2">';?>
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
											<img src='.(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0]).' width=200 height=auto>
                                           
                                        </div>
                                      
                                             <h4>'.$date.'</h4>
                                             <p>'.get_the_excerpt().'</p>';
					
					if ($mest > 0) {
						$nexttren.='<span class="btn btn-primary ">Осталось '.$mest.' мест</span>';
					}
					
											 
									$nexttren.='		  <a class="btn btn-primary readmore" href="'.get_permalink().'">Узнать больше</a>
                                  </div>
                              </div>
                            </div>
							 </div>
							
						  '; ?>
<?php $counters++; endforeach; ?>
<?php endif; ?>	

<section id="main-slider" class=" wow fadeInDown">
		<div class="container">
			<div class="row">
			<div class="col-sm-7">
				 <div class="carousel slide" data-ride="carousel">
					 
	            <ol class="carousel-indicators">
				<?php $posts = get_posts("category_name=slayder-na-glavnoy-stranitse&orderby=date&numberposts=4&post_status=publish"); $counters=0;?>
					<?php if ($posts) : ?>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>	
				
				<?php if ($counters ==0){
				echo '<li data-target="#main-slider" data-slide-to="0" class="active"></li>';
				}else{
					echo '<li data-target="#main-slider" data-slide-to="'.$counters.'"></li>';
				}?>

							<?php  $counters++; ?>
							<?php endforeach; ?>
							<?php endif; ?>	

            </ol>
            <div class="carousel-inner">
				<?php $posts = get_posts("category_name=slayder-na-glavnoy-stranitse&orderby=date&numberposts=4&post_status=publish"); $counters=0;?>
					<?php if ($posts) : ?>
							<?php foreach ($posts as $post) : setup_postdata($post); ?>	
				
				<?php if ($counters ==0){?>
				<div class="item active" style="background-image: url(<?php print_r(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0]); ?>)">
				<?php }else{ ?>
					 <div class="item" style="background-image: url(<?php print_r(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0]); ?>)">
				<?php } ?>
								 
				  
					</div><!--/.item-->
							 
                           

				<?php  $counters++; ?>
				<?php endforeach; ?>
				<?php endif; ?>	

            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
					 
		  
			</div>
	
	
			<div class="col-sm-5">
					<div class="center">
						<h2 class="section-heading">Ближайшие тренинги:</h2>
					</div>
						<?php echo $nexttren;?>
				</div>
			</div>	
			 <div class="col-sm-12">
                                <?php echo $aboutcompany;?>
            </div>	
		</div>
				
		
    </section><!--/#main-slider-->
	<section id="vopros_psih" class="wow fadeInDown" >
		<div id="background-image">
			
		</div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 wow fadeInDown">
                    <div class="media contact-info ">
                        <div class="media-body">						
							<h2><a class="animated4s" href="<?php home_url();?>/vopros-psihologu" title="Задайте вопрос психологу">Задайте вопрос психологу!</a></h2>
                        </div>
						
                    </div>
                </div>
				
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->




	<div id="footer-wrapper">
				<section id="footer" class="container">
					<div class="row">
						<div class="col-sm-7">
							<section>
								<header class="center">
									<h2 >Наши новости</h2>
								</header>
								<ul class="dates">
									<?php $posts = get_posts("category_name=news&orderby=date&numberposts=5&post_status=publish"); ?>
									<?php if ($posts) : ?>
									<?php foreach ($posts as $post) : setup_postdata ($post); ?>
									<li>
										<span class="date"><?php the_time('M'); ?><strong><?php the_time('j'); ?></strong></span>
										<h3><a href="<?php echo get_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
											
											<?php echo "<img align=left src='".(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0])."' width=140 height=auto>"; ?>
                                       
										
										<p><?php the_excerpt();?></p>
									</li>

									<?php endforeach; ?>
									<?php endif; ?>	
								
								</ul>
								<h3>
									<a href="http://populartrening.ru/category/news" title="Новости">Прочитать все новости</a>
								</h3>
							</section>
						</div>
						<div class="col-sm-5">
							<section>
								<header class="center">
									<h2>Наши акции</h2>
								</header>
								<?php $posts = get_posts("category_name=skidks&orderby=date&numberposts=1&post_status=publish"); ?>
								<?php if ($posts) : ?>
								<?php foreach ($posts as $post) : setup_postdata ($post); ?>
								<a href="http://populartrening.ru/category/trenings" title="Акции">
								<?php echo "<img align=left src='".(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), full)[0])."' width=100% height=auto>"; ?>
								</a><p><?php echo $post->post_content; ?> </p>
								<?php endforeach; ?>
								<?php endif; ?>	
							</section>
						</div>
					</div>
					
				</section>
			</div>

	<section id="team" class="bg-light-gray wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center center">
                    <h2 class="section-heading ">Наша команда</h2>   
                </div>
            </div>
			 <div class="row">
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
		echo '<div class="col-sm-3"><div class="team-member ">';
        print get_avatar($polzovatel->ID,190, '', $name);
        print '<h4 class="text-center"><a href="' . home_url() . "/author/{$polzovatel->user_nicename}\">{$polzovatel->display_name}</a></h4>";
		 print '<p class="text-muted text-center">'.get_user_meta($polzovatel->ID, 'dolgn', true).'</p>';
        $description = get_user_meta($polzovatel->ID, 'description', true);
		echo '</div></div>';
    endforeach;
endif;
?>
            </div>
        </div>
    </section>

	<section id="team" class=" wow fadeInDown">"
		<div class="container">
		<div class="row">
			<!--
			<div class="col-sm-5">
				<h2 >Видео о благотворительности</h2>
				<?php /* $posts = get_posts("category_name=video-o-blagotvoritelnosti&orderby=date&numberposts=1&post_status=publish");  
if ($posts) : 
foreach ($posts as $post) : setup_postdata ($post); do_action('[youtube]VlramIFdgv0[/youtube]');  endforeach; endif; */ ?>	
				<div class="video-container">
					<iframe width="560" height="315" src="//www.youtube.com/embed/VlramIFdgv0" frameborder="0" allowfullscreen></iframe>
				</div>
				
				
			</div>
-->        
			<div class="col-sm-5">
							<section>
								<header class="center">
									<h2>Наши статьи</h2>
								</header>
								<ul class="dates">
									<?php $posts = get_posts("category=array(15,13,12)&orderby=date&numberposts=3&post_status=publish"); ?>
									<?php if ($posts) : ?>
									<?php foreach ($posts as $post) : setup_postdata ($post); ?>
									<li>
										<span class="date"><?php the_time('M'); ?><strong><?php the_time('j'); ?></strong></span>
										<h3><a href="<?php echo get_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
										<p><?php the_excerpt();?></p>
										<a class="btn btn-primary" href="<?php echo get_permalink(); ?>">Узнать больше</a>
									</li>
									
									
									
									<?php endforeach; ?>
									<?php endif; ?>	
								
								</ul>
							</section>
						</div>
			<div class="col-sm-7">
				<header class="center">
					<h2>Вопросы, которые вы никогда не задавали, а хотелось бы</h2>
				</header>
				
					<div class="panel-group" id="accordion1">
                         
									<?php  $posts = get_posts("category_name=askmain&orderby=date&numberposts=5&post_status=publish"); $counta=0;;  
						if ($posts) : 
							foreach ($posts as $post) : setup_postdata ($post); ?> 
                          <div class="panel panel-default">
							  <?php
									
									 
								if ($counta==0){
									echo '<div class="panel-heading active ">';
								}else{
									echo '<div class="panel-heading">';
								}
								?>
                           
								
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo<?php the_ID(); ?>">
                                  <?php the_title(); ?>
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
								 <?php
								if ($counta==0){
									echo ' <div id="collapseTwo'.get_the_ID().'" class="panel-collapse collapse in">';
								}else{
									echo ' <div id="collapseTwo'.get_the_ID().'" class="panel-collapse collapse">';
								}
							?>
                            
                             <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
											
                                            <?php 
												echo get_avatar($post->post_author);?>
                                        </div>
                                        <div class="media-body">
                                             <h4><a title="<?php echo get_the_author(); ?>" href="<?php echo home_url();?>/author/<?php the_author_nickname(); ?>"><?php echo get_the_author(); ?></a></h4>
                                             <p><?php echo $post->post_content; ?></p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>
						
						<?php $counta++; endforeach; endif;  ?>	
                
                        </div><!--/#accordion1-->
					<p class="padding_top">Не нашли ответ, тогда задайте нам на странице <a href="http://populartrening.ru/vopros-otvet" title="Вопрос-ответ">FAQ</a></p>
				
		</div>	
		</div>
	</section>

	<section id="partner" class="partner wow fadeInDown display_none">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Наши партнеры</h2>
            </div>    
            <div class="partners">
                <ul>
					<?php $posts = get_posts("category_name=ownpartners&orderby=date&numberposts=4&post_status=publish"); ?>
					<?php if ($posts) : ?>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>	
								<li><a href="<?php echo $post->post_content; ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive wow fadeInDown main_page', 'width'=>'auto', 'height'=>'auto' )); ?></a></li>
							<?php endforeach; ?>
							<?php endif; ?>	
                </ul>
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->
	<section id="conatcat-info" class="margin_bottom bg-light-gray wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
							<?php $posts = get_posts("category_name=newpartner&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							<h2><?php the_title(); ?></h2>
							<p><?php echo $post->post_content; ?> </p>
							<?php endforeach; ?>
							<?php endif; ?>	

                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

<?php get_footer(); ?>
