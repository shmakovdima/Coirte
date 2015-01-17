
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>
<?php if (!empty ($gallery)) : ?>
<!-- Thumbnails -->

 <ul class="sidebar-gallery">		
<?php foreach ( $images as $image ) : ?>    
	  <li><a rel="prettyPhoto[gallery]" title="<?php echo $image->alttext; ?>" href="<?php echo $image->imageURL; ?>"><img src="<?php echo $image->thumbnailURL;?>" alt="<?php echo $image->alttext; ?>" />
			<div class="opacity">
				
		     </div>
		  
		  </a></li>
<?php endforeach; ?> 
 </ul>
<?php endif; ?>


                           
                       