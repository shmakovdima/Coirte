<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$default_query = clone $wp_query;


get_header(); ?>

	 <section id="blog" class="container container_padding wow fadeInDown">
	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
        <div class="center padding_top">
            <h1><?php printf( __( 'Search Results for: %s', 'twentyfifteen' ), get_search_query() ); ?></h1>
        </div>
        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
				<?php
						update_post_caches($posts);

						$wp_query = clone  $default_query;
						
						query_posts(
							$wp_query->query // это массив базового запроса текущей страницы
						);
 						if (have_posts()){
						while(have_posts()): the_post();
						?>
					 	 <div class="blog-item">
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
								<?php 
									if ( has_post_thumbnail()) { ?>
							
									
                                <a href="<?php echo get_permalink(); ?>">
									<?php the_post_thumbnail('full', array('class' => 'img-responsive img-blog' )); ?>
								</a>
								<?php
									}
								?>
                                <h2><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h2>
                                <h3><?php the_excerpt(); ?></h3>
                                <a class="btn btn-primary readmore" href="<?php echo get_permalink(); ?>">Читать дальше <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>    
                    </div><!--/.blog-item-->	
					 	<?php 
						endwhile;
						}else{
							get_template_part( 'content', 'none' );
						}
						
				?>
                    
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>  
                </div><!--/.col-md-8-->

               	<?php get_sidebar(); ?> 
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

<?php get_footer(); ?>
