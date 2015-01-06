<?php
/**
 * Template Name: Контакты
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div class="contacts" role="main">
		<div class="content">
			<h2>Контакты</h2>
			<div id="map"></div>
			
			</div>


<script type="text/javascript">
        ymaps.ready(init);
        var myMap;
        function init () {

    // Параметры карты можно задать в конструкторе.
        myMap = new ymaps.Map(
        // ID DOM-элемента, в который будет добавлена карта.
        'map',
        // Параметры карты.
        {
            // Географические координаты центра отображаемой карты.
            center: [53.437561, 41.394202],
            // Масштаб.
            zoom: 8,
           controls: ['zoomControl', 'typeSelector',  'fullscreenControl']
        }
        );

         var myPlacemark = new ymaps.Placemark(

            

            [53.437561, 41.394202], {

                balloonContentHeader: ' Наш адрес',

                balloonContent: 'Тут адрес' 

            } , { 

                present:'islands#circleDotIcon',
                zIndex: '25',

                iconColor: 'blue'}       

            );

 

            // Добавление метки на карту

            myMap.geoObjects.add(myPlacemark);

           

        }

    
</script>
		</div>


	</div>

<div class="contact_form">
	<div class="content">
        <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'page' ); ?>
        <?php endwhile; // end of the loop. ?>
		<div class="left_block">
         

            <?php $posts = get_posts ("category_name=adress&orderby=date"); ?>
            <?php if ($posts) : ?>
            <?php foreach ($posts as $post) : setup_postdata ($post); ?>
                <h3 class="cont"><?php
                    $text = get_the_content();
                    echo $text;

                ?></h3>
                
            <?php endforeach; ?>
            <?php endif; ?>

            <?php $posts = get_posts ("category_name=contactsdata&orderby=date"); ?>
            <?php if ($posts) : ?>
            <?php foreach ($posts as $post) : setup_postdata ($post); ?>
                <span class="cont"><?php the_title(); ?></span>



                <?php the_content(); ?>
            <?php endforeach; ?>
            <?php endif; ?>

            
          
        </div>
        <?php wp_reset_postdata(); ?>

        
	</div>

        
</div>
</div>
        </div>
  </div>



<?php
get_footer();
