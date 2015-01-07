<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-152x152.png" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	
	<!-- core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet">
	
	
	
	<?php wp_head(); ?>
</head>
<body class="homepage"<?php body_class(); ?>>
	
	
	<div id="content" class="site-content">
	<header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p>
							<?php $posts = get_posts("category_name=contactphone&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<nobr>
							<i class="fa fa-phone-square"></i>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>
							
							<a class="animation4s hoveropacity06" href="tel:<?php echo str_replace( array(' ','+','(',')'),'',$post->post_content); ?>" title="Наш телефон">
            				<?php echo $post->post_content; ?> 
							</a></nobr>
							<?php endforeach; ?>
							<?php endif; ?>	
							<?php wp_reset_query(); ?>
							</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
								
							<!-- Skype link -->
							<?php $posts = get_posts("category_name=contactskype&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<li>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="skype:<?php echo str_replace( array(''),'',$post->post_content); ?>?call" title="Позвонить нам в skype">		
							<?php endforeach; ?>
							<i class="fa fa-skype"></i></a></li> 
							<?php endif; ?>
							<?php wp_reset_query(); ?>
								
                               
							<!-- Facebook link -->
							<?php $posts = get_posts("category_name=fblink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<li>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>"  title="Мы в Facebook">		
							<?php endforeach; ?>
							<i class="fa fa-facebook"></i></a></li> 
							<?php endif; ?>
							<?php wp_reset_query(); ?>
                          
								
							<!-- Twitter link -->
							<?php $posts = get_posts("category_name=twlink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<li>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>"  title="Мы в Twitter">		
							<?php endforeach; ?>
							<i class="fa fa-twitter"></i></a></li> 
							<?php endif; ?>
							<?php wp_reset_query(); ?>
                                
							
							<!-- VK link -->
							<?php $posts = get_posts("category_name=vklink&orderby=date&numberposts=1&post_status=publish"); ?>
							<?php if ($posts) : ?>
							<li>
							<?php foreach ($posts as $post) : setup_postdata ($post); ?>							
							<a href="<?php echo str_replace( array(''),'',$post->post_content); ?>" title="Мы в Вконтакте">		
							<?php endforeach; ?>
							<i class="fa fa-vk"></i></a></li> 
							<?php endif; ?>
							<?php wp_reset_query(); ?>	
                            </ul>
                            <div class="search">
                                <form role="form" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <input title="Поиск" type="text" class="search-form" autocomplete="off" placeholder="Найти..." name="s">
                                    <i class="fa fa-search"></i>							
                                </form>
								
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?php echo get_template_directory_uri(); ?>/images/logoA.png" width="185" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="portfolio.html">Portfolio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-item.html">Blog Single</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="shortcodes.html">Shortcodes</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a></li> 
                        <li><a href="contact-us.html">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->

	
	
