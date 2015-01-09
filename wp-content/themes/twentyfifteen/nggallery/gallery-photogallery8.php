
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>
<?php if (!empty ($gallery)) : ?>
<!-- Thumbnails -->

<section id="portfolio">

<div class="container container_padding">
            <div class="center">
               <h1><?php echo $gallery->title; ?></h1>
               <p class="lead"><?php echo $gallery->description; ?></p>
            </div>
<div class="row ">
     <div class="portfolio-items">
<?php foreach ( $images as $image ) : ?>
     <div class="portfolio-item apps col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
						
                            <img class="img-responsive" title="<?php echo $image->alttext ?>" src="<?php echo $image->thumbnailURL?>" <?php echo $image->size ?> alt="<?php echo $image->alttext ?>">
                            <a rel="prettyPhoto" href="<?php echo $image->imageURL ?>"class="overlay">
                                <div class="recent-work-inner">
                                    <h2><?php echo $image->alttext ?></h2>
                                    <p><?php echo $image->description ?></p>
                                    <i class="fa fa-eye"></i> Просмотреть
                                </div> 
							</a>
                        </div>
                    </div><!--/.portfolio-item-->
    
<?php endforeach; ?>
                </div>
            </div>
        </div>
    </section><!--/#portfolio-item-->


<?php endif; ?>

