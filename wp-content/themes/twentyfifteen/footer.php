<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<div class="page-buffer"></div>
</div>
<footer id="footer" class="site-footer" role="contentinfo">
		<div class="footer1">
			<div class="container">
				<div class="row">					
					<div class="col-md-6 widget">
						<h3 class="widget-title">Контакты</h3>
						<div class="widget-body">
							
							
							<!-- Вывод телефона-->
							<?php $posts = get_posts("category_name=contact_phone&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<nobr>
							<i class="fa fa-phone-square"></i>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							
							<a class="animation4s hoveropacity06 phone_footer" href="tel:<?php echo str_replace( array(' ','+','(',')'),'',$post->post_content); ?>" title="Наш телефон">
            				<?php echo $post->post_content; ?> 
							</a></nobr>
							<?php endforeach; ?>
							<?php endif; ?>
							
							
							
							<!-- Вывод почтового ящика-->
							
							
							<?php $posts = get_posts("category_name=contactmail&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<br>
							<nobr>
							<i class="fa fa-envelope-o"></i>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							
								
							<a href="mailto:<?php echo str_replace( array(''),'',$post->post_content); ?>"> 
            				<?php echo $post->post_content; ?> 
							<?php endforeach; ?>
								</a>
							</nobr>
							<?php endif; ?>
							
							<!-- Skype link -->
							<?php $posts = get_posts("category_name=contactskype&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<br>
							<nobr>
							<i class="fa fa-skype footer_skype"></i>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="skype:<?php echo str_replace( array(''),'',$post->post_content); ?>?call" title="Позвонить нам в skype">
							<?php echo $post->post_content; ?> 
							<?php endforeach; ?>
							</a>
							</nobr>
							<?php endif; ?>
								
							<br>
							<br>
							<!-- Вывод адреса-->
							
							
							<?php $posts = get_posts("category_name=contactadress&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							
							
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							
								
							
							<address>
            				<?php echo $post->post_content; ?> 
							</address>
							<?php endforeach; ?>
							
							<?php endif; ?>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Мы в социальных сетях</h3>
						<div class="widget-body">
							<p class="follow-me-icons">						
						
							<!-- Facebook link -->
							<?php $posts = get_posts("category_name=fblink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>"  title="Мы в Facebook">		
							<?php endforeach; ?>
							<i class="fa fa-facebook fa-2 animation4s"></i></a>
							<?php endif; ?>
                          
								
							<!-- Twitter link -->
							<?php $posts = get_posts("category_name=twlink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>"  title="Мы в Twitter">		
							<?php endforeach; ?>
							<i class="fa fa-twitter fa-2 animation4s"></i></a>
							<?php endif; ?>
                                
							
							<!-- VK link -->
							<?php $posts = get_posts("category_name=vklink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
						
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>" title="Мы в Вконтакте">		
							<?php endforeach; ?>
							<i class="fa fa-vk fa-2 animation4s"></i></a>
							<?php endif; ?>
								
							<!-- Instagram link -->
							<?php $posts = get_posts("category_name=instlink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
						
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>" title="Мы в Вконтакте">		
							<?php endforeach; ?>
							<i class="fa fa-instagram fa-2 animation4s"></i></a>
							<?php endif; ?>	
								
							</p>	
						</div>
					</div>

					

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
							<?php 

							$menuParameters = array(
								'menu' => 'footermenu',
  								'container'       => false,
  								'echo'            => false,
  								'items_wrap'      => '%3$s',
  								'depth'           => 0,
								
							);
							echo strip_tags(wp_nav_menu($menuParameters), '<a>'); ?>
							</p>
							
	
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2015, Темари.
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>	
<div class="overflow">
	<div class = "overflow_item">
		 <div class="deletesign"></div>
		<div>

		<h2 class="send_rass">
			Подписка на рассылку:
		</h2>
						
		</div>
		<?php  echo do_shortcode('[contact-form-7 id="1109" title="Подписаться на нас"]'); ?>
	</div>
	<div class="background_block">
		
	</div>
</div>



	
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/chosen.jquery.min.js"></script>

<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter27927810 = new Ya.Metrika({id:27927810, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/27927810" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58590786-1', 'auto');
  ga('send', 'pageview');

		$(".menu-item-has-children").each(function(){
			$(this).addClass("dropdown");
			$(this).find("a").eq(0).each(function(){
				$(this).append('<b class="caret"></b>');
				$(this).attr("data-toggle",'dropdown');

			});
		});
		
		$(".sub-menu").each(function(){
			$(this).addClass("dropdown-menu");
		});
		
		$(".current_page_parent").each(function(){
			$(this).addClass("active");
		});
		
		
		$(".current_page_item").each(function(){
			$(this).addClass("active");
		});
</script>

<script type="text/javascript">
var _tmr = _tmr || [];
_tmr.push({id: "2619644", type: "pageView", start: (new Date()).getTime()});
(function (d, w) {
   var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;
   ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
   var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
   if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window);
</script>


<?php wp_footer(); ?>

</body>
</html>
