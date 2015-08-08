<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$params = array(
	'posts_per_page' => 10, // количество постов на странице
	'cat'       =>  getCurrentCatID(), // тип постов
	'paged'           => $current_page // текущая страница
);


get_header(); ?>
<!-- container -->
	 <section id="blog" class="container container_padding wow fadeInDown">
	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?> 
        <div class="center padding_top">
            <h1><?php single_tag_title(); ?></h1>
            <!--<p class="lead"><?php //echo category_description(); ?></p>-->
        </div>
        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
				<?php
						query_posts($params);
						$wp_query->is_archive = true;
						$wp_query->is_home = false;
 						if (have_posts()){
						while(have_posts()): the_post();
						?>
					 	 <div class="blog-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
									<?php $cat = get_category(get_query_var('cat'),false);
									$cat_parent = $cat->parent; // ID родительской категории
									if (($cat_parent==30)|| ($cat_parent== 39)){
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
							echo "<h2 class='text-center no_result'>Простите, но в этой рубрике нет пока постов</h2>";
						}
						
				?>
                    
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>  
                </div><!--/.col-md-8-->

               	<?php get_sidebar(); ?> 
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

<?php get_footer(); ?>
