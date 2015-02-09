<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */

function kama_excerpt($args=''){
	global $post;
		parse_str($args, $i);
		$maxchar 	 = isset($i['maxchar']) ?  (int)trim($i['maxchar'])		: 350;
		$text 		 = isset($i['text']) ? 			trim($i['text'])		: '';
		$save_format = isset($i['save_format']) ?	trim($i['save_format'])			: false;
		$echo		 = isset($i['echo']) ? 			false		 			: true;

	if (!$text){
		$out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
		$out = preg_replace ("!\[/?.*\]!U", '', $out ); //убираем шоткоды, например:[singlepic id=3]
		// для тега <!--more-->
		if( !$post->post_excerpt && strpos($post->post_content, '<!--more-->') ){
			preg_match ('/(.*)<!--more-->/s', $out, $match);
			$out = str_replace("\r", '', trim($match[1], "\n"));
			$out = preg_replace( "!\n\n+!s", "</p><p>", $out );
			$out = '<p>'. str_replace( "\n", '<br />', $out ) .' <a href="'. get_permalink($post->ID) .'#more-'. $post->ID.'">Читать дальше...</a></p>';
			if ($echo)
				return print $out;
			return $out;
		}
	}

	$out = $text.$out;
	if (!$post->post_excerpt)
		$out = strip_tags($out, $save_format);

	if ( iconv_strlen($out, 'utf-8') > $maxchar ){
		$out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
		$out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $out); //убираем последнее слово, ибо оно в 99% случаев неполное
	}

	if($save_format){
		$out = str_replace( "\r", '', $out );
		$out = preg_replace( "!\n\n+!", "</p><p>", $out );
		$out = "<p>". str_replace ( "\n", "<br />", trim($out) ) ."</p>";
	}

	if($echo) return print $out;
	return $out;
}

function get_category_parents_ID( $_, $separator = '/', $visited = array() ) {
    $chain = '';
    $parent = &get_category( $_ );
    if ( is_wp_error( $parent ) )
    {
        foreach((get_the_category()) as $category) 
        { 
            $chain .= get_category_parents_ID( $category, '/', $visited );
        }
    }
    $category = $parent->term_id;
    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
        $visited[] = $parent->parent;
        $chain .= get_category_parents_ID( $parent->parent, '/', $visited );
    }
     $chain .= $category.$separator;
    return $chain;
}

remove_filter('pre_user_description', 'wp_filter_kses');
add_filter('user_contactmethods', 'my_user_contactmethods');
 
function my_user_contactmethods($user_contactmethods){
 
  $user_contactmethods['dolgn'] = 'Должность';
  $user_contactmethods['contactform'] = 'Шорт код контактной формы';
  return $user_contactmethods;
}

function kama_recent_comments($limit=10, $ex=45, $cat=0, $echo=1, $gravatar=''){
	global $wpdb;
	if($cat){
		$IN = (strpos($cat,'-')===false)?"IN ($cat)":"NOT IN (".str_replace('-','',$cat).")";
		$join = "LEFT JOIN $wpdb->term_relationships rel ON (p.ID = rel.object_id)
		LEFT JOIN $wpdb->term_taxonomy tax ON (rel.term_taxonomy_id = tax.term_taxonomy_id)";
		$and = "AND tax.taxonomy = 'category'
		AND tax.term_id $IN";
	}
	$sql = "SELECT comment_ID, comment_post_ID, comment_content, post_title, guid, comment_author, comment_author_email
	FROM $wpdb->comments com
		LEFT JOIN $wpdb->posts p ON (com.comment_post_ID = p.ID) {$join}
	WHERE comment_approved = '1'
		AND comment_type = '' {$and}
	ORDER BY comment_date DESC
	LIMIT $limit"; 

	$results = $wpdb->get_results($sql);

	$out = '';
	foreach ($results as $comment){
		if($gravatar)
			$grava = '<img src="http://www.gravatar.com/avatar/'. md5($comment->comment_author_email) .'?s=$gravatar&default=" alt="" width="'. $gravatar .'" height="'. $gravatar.'" />';
		$comtext = strip_tags($comment->comment_content);
		$leight = (int) iconv_strlen( $comtext, 'utf-8' );
		if($leight > $ex) $comtext =  iconv_substr($comtext,0,$ex, 'UTF-8').' …';
		$out .= "\n<div class='single_comments'>$grava<p>{$comtext}
		</p><div class='entry-meta small muted'><span>Написал ".strip_tags($comment->comment_author)." на <a href='".get_comment_link($comment->comment_ID)." title='{$comment->post_title}'>{$comment->post_title}</a></span></div></div>";
	}
	

	if ($echo) echo $out;
	else return $out;
}

function getCurrentCatID(){  
  global $wp_query;  
  	if(is_category() || is_single()){  
		$cat_ID = get_query_var('cat');  
  	}  
  return $cat_ID;  
 }

function wp_corenavi($before = '', $after = '', $echo = true ) {  
	/* ================ Настройки ================ */
	$text_num_page = ''; // Текст перед пагинацией. {current} - текущая; {last} - последняя (пр. 'Страница {current} из {last}' получим: "Страница 4 из 60" )
	$num_pages = 10; // сколько ссылок показывать
	$stepLink = 10; // ссылки с шагом (значение - число, размер шага (пр. 1,2,3...10,20,30). Ставим 0, если такие ссылки не нужны.
	$dotright_text = '…'; // промежуточный текст "до".
	$dotright_text2 = '…'; // промежуточный текст "после".
	$backtext = 'Предыдущая страница'; // текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
	$nexttext = 'Следующая страница'; // текст "перейти на следующую страницу". Ставим 0, если эта ссылка не нужна.
	$first_page_text = '« к началу'; // текст "к первой странице". Ставим 0, если вместо текста нужно показать номер страницы.
	$last_page_text = 'в конец »'; // текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	/* ================ Конец Настроек ================ */ 

	global $wp_query;

	$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	$paged = (int) $wp_query->query_vars['paged'];
	$max_page = $wp_query->max_num_pages;

	//проверка на надобность в навигации
	if( $max_page <= 1 )
		return false; 

	if( empty($paged) || $paged == 0 ) 
		$paged = 1;

	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1/2 ); //сколько ссылок до текущей страницы
	$half_page_end = ceil( $pages_to_show_minus_1/2 ); //сколько ссылок после текущей страницы

	$start_page = $paged - $half_page_start; //первая страница
	$end_page = $paged + $half_page_end; //последняя страница (условно)

	if( $start_page <= 0 ) 
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 ) 
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 ) 
		$start_page = 1;

	//выводим навигацию
	$out = '';

	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = get_pagenum_link( 99999999 ); // 99999999 будет заменено
	$link_base = str_replace( 99999999, '___', $link_base);
	$first_url = get_pagenum_link( 1 );
	$out .= $before . "<ul class='wp-pagenavi pagination pagination-lg'>\n";
		
		if( $text_num_page ){
			$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
			$out.= sprintf( "<span class='pages'>$text_num_page</span> ", $paged, $max_page );
		}
		// назад <li><a href="#"><i class="fa fa-long-arrow-left"></i>Предыдущая страница</a></li>
		if ( $backtext && $paged != 1 ) 
			$out .= '<li><a class="prev" href="'. str_replace( '___', ($paged-1), $link_base ) .'"><i class="fa fa-long-arrow-left"></i>'. $backtext .'</a></li> ';
		// в начало 
		if ( $start_page >= 2 && $pages_to_show < $max_page ) {
			$out.= '<a class="first" href="'. $first_url .'">'. ( $first_page_text ? $first_page_text : 1 ) .'</a> ';
			if( $dotright_text && $start_page != 2 ) $out .= '<span class="extend">'. $dotright_text .'</span> ';
		}
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<li class="active"><a  href="#">'.$i.'</a></li> ';
			elseif( $i == 1 )
				$out .= '<li><a href="'. $first_url .'">1</a></li> ';
			else
				$out .= '<li><a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a></li> ';
		}

		//ссылки с шагом
		if ( $stepLink && $end_page < $max_page ){
			for( $i = $end_page+1; $i<=$max_page; $i++ ) {
				if( $i % $stepLink == 0 && $i !== $num_pages ) {
					if ( ++$dd == 1 ) 
						$out.= '<span class="extend">'. $dotright_text2 .'</span> ';
					$out.= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
				}
			}
		}
		// в конец
		if ( $end_page < $max_page ) {
			if( $dotright_text && $end_page != ($max_page-1) ) 
				$out.= '<span class="extend">'. $dotright_text2 .'</span> ';
			$out.= '<a class="last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $last_page_text ? $last_page_text : $max_page ) .'</a> ';
		}
		// вперед <li><a href="#">Next Page<i class="fa fa-long-arrow-right"></i>Следующая страница</a></li>
		if ( $nexttext && $paged != $end_page ) 
			$out.= '<li><a class="next" href="'. str_replace( '___', ($paged+1), $link_base ) .'"><i class="fa fa-long-arrow-right"></i>'. $nexttext .'</a></li> ';

	$out .= "</ul>". $after ."\n";
	
	if ( ! $echo ) 
		return $out;
	echo $out;  
}  

					/*<ul class="pagination pagination-lg">
                       <li><a href="#"><i class="fa fa-long-arrow-left"></i>Предыдущая страница</a></li>
					   <li><a href="#">Next Page<i class="fa fa-long-arrow-right"></i>Следующая страница</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li></ul>
                        
                   
*/


function dimox_breadcrumbs() {  
  
  /* === ОПЦИИ === */  
  $text['home'] = 'Главная'; // текст ссылки "Главная"  
  $text['category'] = 'Архив рубрики "%s"'; // текст для страницы рубрики  
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска  
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега  
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора  
  $text['404'] = 'Ошибка 404'; // текст для страницы 404  
 
  $show_current = 1; // 1 - показывать название текущей статьи/страницы/рубрики, 0 - не показывать  
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать  
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать  
  $show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать  
  $delimiter = ''; // разделить между "крошками"  
  $before = '<li class="active">'; // тег перед текущей "крошкой"  
  $after = '</li>'; // тег после текущей "крошки"  
  /* === КОНЕЦ ОПЦИЙ === */  
  
  global $post;  
  $home_link = home_url('/');  
  $link_before = '<li typeof="v:Breadcrumb">';  
  $link_after = '</li>';  
  $link_attr = ' rel="v:url" property="v:title"';  
  $link = $link_before . '<a' .str_replace(Array('"'),"",$link_attr). ' href="%1$s">%2$s</a>' . $link_after;  
  $parent_id = $parent_id_2 = $post->post_parent;  
  $frontpage_id = get_option('page_on_front');  
  
  if (is_home() || is_front_page()) {  
  
    if ($show_on_home == 1) echo '<ol class="breadcrumb"><li><a href="' . $home_link . '">' . $text['home'] . '</a></li></ol>';  
  
  } else {  
  
    echo '<ol class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';  
    if ($show_home_link == 1) {  
      echo '<li><a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a></li>';  
      if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;  
    }  
  
    if ( is_category() ) {  
      $this_cat = get_category(get_query_var('cat'), false);  
      if ($this_cat->parent != 0) {  
        $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);  
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
        echo $cats;  
      }  
      if ($show_current == 1) echo $before . sprintf(str_replace(Array('"',"Архив рубрики "),"",$text['category']), single_cat_title('', false)) . $after;  
  
    } elseif ( is_search() ) {  
      echo $before . sprintf($text['search'], get_search_query()) . $after;  
  
    } elseif ( is_day() ) {  
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
      echo $before . get_the_time('d') . $after;  
  
    } elseif ( is_month() ) {  
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
      echo $before . get_the_time('F') . $after;  
  
    } elseif ( is_year() ) {  
      echo $before . get_the_time('Y') . $after;  
  
    } elseif ( is_single() && !is_attachment() ) {  
      if ( get_post_type() != 'post' ) {  
        $post_type = get_post_type_object(get_post_type());  
        $slug = $post_type->rewrite;  
        printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);  
        if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
      } else {  
        $cat = get_the_category(); $cat = $cat[0];  
        $cats = get_category_parents($cat, TRUE, $delimiter);  
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
        echo $cats;  
        if ($show_current == 1) echo $before . get_the_title() . $after;  
      }  
  
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
      $post_type = get_post_type_object(get_post_type());  
      echo $before . $post_type->labels->singular_name . $after;  
  
    } elseif ( is_attachment() ) {  
      $parent = get_post($parent_id);  
      $cat = get_the_category($parent->ID); $cat = $cat[0];  
      if ($cat) {  
        $cats = get_category_parents($cat, TRUE, $delimiter);  
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
        echo $cats;  
      }  
      printf($link, get_permalink($parent), $parent->post_title);  
      if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
  
    } elseif ( is_page() && !$parent_id ) {  
      if ($show_current == 1) echo $before . get_the_title() . $after;  
  
    } elseif ( is_page() && $parent_id ) {  
      if ($parent_id != $frontpage_id) {  
        $breadcrumbs = array();  
        while ($parent_id) {  
          $page = get_page($parent_id);  
          if ($parent_id != $frontpage_id) {  
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
          }  
          $parent_id = $page->post_parent;  
        }  
        $breadcrumbs = array_reverse($breadcrumbs);  
        for ($i = 0; $i < count($breadcrumbs); $i++) {  
          echo $breadcrumbs[$i];  
          if ($i != count($breadcrumbs)-1) echo $delimiter;  
        }  
      }  
      if ($show_current == 1) {  
        if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;  
        echo $before . get_the_title() . $after;  
      }  
  
    } elseif ( is_tag() ) {  
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
  
    } elseif ( is_author() ) {  
      global $author;  
      $userdata = get_userdata($author);  
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
  
    } elseif ( is_404() ) {  
      echo $before . $text['404'] . $after;  
  
    } elseif ( has_post_format() && !is_singular() ) {  
      echo get_post_format_string( get_post_format() );  
    }  
  
    if ( get_query_var('paged') ) {  
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';  
      echo 'Страница ' . get_query_var('paged');  
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';  
    }  
  
    echo '</ol><!-- .breadcrumbs -->';  
  
  }  
} // end dimox_breadcrumbs()  

add_filter( 'show_admin_bar', '__return_false' );


if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141212', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';
