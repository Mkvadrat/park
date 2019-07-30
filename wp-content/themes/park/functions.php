<?php
/*
Theme Name: Premium park
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function mk_scripts(){
	wp_register_style( 'awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, '4.4.0' );
	wp_enqueue_style( 'awesome' );
	
	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i|PT+Serif:400,400i,700,700i&amp;subset=cyrillic', false, '' );
	wp_enqueue_style( 'roboto' );
	
	wp_register_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', false, '3.5.7' );
	wp_enqueue_style( 'fancybox' );
	
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap' );
	
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
	wp_enqueue_style( 'responsive' );
	
	wp_register_style( 'mmenu', get_template_directory_uri() . '/css/mmenu.css');
	wp_enqueue_style( 'mmenu' );
	
	wp_register_style( 'carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
	wp_enqueue_style( 'carousel' );
	
	wp_register_style( 'custom', get_template_directory_uri() . '/css/custom.css'); 
	wp_enqueue_style( 'custom' );
	
	if (!is_admin()) {
		wp_enqueue_script( 'jquery-min', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', '', '', true );
		wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', '', '', true );
		wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', '', '', true );
		wp_enqueue_script( 'custom-min', get_template_directory_uri() . '/js/custom.js', '', '', true );
		wp_enqueue_script( 'parallax-min', get_template_directory_uri() . '/js/parallax.min.js', '', '', true );
		wp_enqueue_script( 'fancybox-min', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', '', '', true );
		wp_enqueue_script( 'reviews-min', get_template_directory_uri() . '/js/reviews.js', '', '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'mk_scripts' );

//Регистрируем название сайта
function mkvadrat_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ug' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'mkvadrat_wp_title', 10, 2 );

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'main_menu'   => 'Главное меню',
		)
	);
}

//Изображение в шапке сайта
$args = array(
	'width'         => 167,
	'height'        => 80,
	'default-image' => get_template_directory_uri() . '/img/logo.svg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
     add_theme_support( 'post-thumbnails' );
}

//Отключить редактор
add_filter('use_block_editor_for_post', '__return_false');

//Регистрируем sidebar
function register_my_widgets(){
	register_sidebar( array(
		'name' => "Виджет социальных сетей",
		'id' => 'sharing-page',
		'description' => 'Виджет социальных сетей будет показан на страницах в нижней части сайта',
		'before_widget' => '', // по умолчанию виджеты выводятся <li>-списком
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
}
add_action( 'widgets_init', 'register_my_widgets' );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод данных из произвольных полей для всех страниц сайта
function getMeta($meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1", $meta_key) );
	
	return $value;
}

//Вывод изображения для плагина nextgen-gallery
function getNextGallery($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta AS pm JOIN $wpdb->posts AS p ON (pm.post_id = p.ID) AND (pm.post_id = %s) AND meta_key = %s ORDER BY pm.post_id DESC LIMIT 1", $post_id, $meta_key) );
	
	$unserialize_value = unserialize($value);
	
	return $unserialize_value;	
}

//Вывод связанных данных для single.php
function getRelatedMeta($post_id, $meta_key){
	global $wpdb;
	
	$value = array();

	$serialized_object = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %s AND meta_key = %s", $post_id, $meta_key) );
	
	$unserialized_object = unserialize($serialized_object[0]->meta_value);
	
	if($unserialized_object){
		foreach($unserialized_object as $post_id){
			$value[] = get_post( $post_id );
		}
	}
	
	return $value;
}

//Вывод id категории
function getCurrentCatID(){
	global $wp_query;
	if(is_category()){
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************МЕНЮ САЙТА*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// Добавляем свой класс для пунктов меню:
class header_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '<button class="dropdown-toggle" data-toggle="dropdown">►</button><div class="dropdown-menu"><ul>' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '<ul class="subsubmenu">' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '<ul class="subsubsubmenu">' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		
		if($depth == 0){
			$output .= $indent . '<li class="btn-group">';
		}else if($depth == 1){
			$output .= $indent . '<li>';
		}else{
			$output .= $indent . '<li>';
		}

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a class="link__parent" href="'. $link .'"><span>' . $title .'</span></a>';
			}else{
				$item_output = '<a class="link__parent" href="'. $link .'"><span>' . $title .'</span></a>';
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************РАЗДЕЛ "НОМЕРА" В АДМИНКЕ**************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод в админке раздела
function register_post_type_app() {
	$labels = array(
	 'name' => 'Номера',
	 'singular_name' => 'Номера',
	 'add_new' => 'Добавить номер',
	 'add_new_item' => 'Добавить новый номер',
	 'edit_item' => 'Редактировать номер',
	 'new_item' => 'Новые номера',
	 'all_items' => 'Все номера',
	 'view_item' => 'Просмотр номера на сайте',
	 'search_items' => 'Искать номер',
	 'not_found' => 'Номер не найдена.',
	 'not_found_in_trash' => 'В корзине нет номеров.',
	 'menu_name' => 'Номера'
	 );
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-building',
		'menu_position' => 8,
		'supports' => array( 'title','editor', 'thumbnail', 'comments' ),
	);
 	register_post_type('rooms', $args);
}
add_action( 'init', 'register_post_type_app' );

function true_post_type_app( $rooms ) {
	global $post, $post_ID;

	$rooms['rooms'] = array(
			0 => '',
			1 => sprintf( 'Статьи обновлены. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
			2 => 'Статья обновлёна.',
			3 => 'Статья удалёна.',
			4 => 'Статья обновлена.',
			5 => isset($_GET['revision']) ? sprintf( 'Статья восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( 'Статья опубликована на сайте. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
			7 => 'Статья сохранена.',
			8 => sprintf( 'Отправлена на проверку. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( 'Запланирована на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотр</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $rooms;
}
add_filter( 'post_updated_messages', 'true_post_type_app' );
	
function create_taxonomies_app(){
    // Cats Categories
    register_taxonomy('rooms-list',array('rooms'),array(
        'hierarchical' => true,
        'label' => 'Рубрики',
        'singular_name' => 'Рубрика',
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'rooms-list' )
    ));
}
add_action( 'init', 'create_taxonomies_app', 0 );	
	
/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*****************************************************************REMOVE CATEGORY_TYPE SLUG*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Удаление category из url таксономии
function true_remove_slug_from_articles( $url, $term, $taxonomy ){

	$taxonomia_name = 'category';
	$taxonomia_slug = 'category';

	if ( strpos($url, $taxonomia_slug) === FALSE || $taxonomy != $taxonomia_name ) return $url;

	$url = str_replace('/' . $taxonomia_slug, '', $url);

	return $url;
}
add_filter( 'term_link', 'true_remove_slug_from_articles', 10, 3 );

//Перенаправление articles-list в случае удаления category
function parse_request_url_articles( $query ){

	$taxonomia_name = 'category';

	if( $query['attachment'] ) :
		$condition = true;
		$main_url = $query['attachment'];
	else:
		$condition = false;
		$main_url = $query['name'];
	endif;

	$termin = get_term_by('slug', $main_url, $taxonomia_name);

	if ( isset( $main_url ) && $termin && !is_wp_error( $termin )):

		if( $condition ) {
			unset( $query['attachment'] );
			$parent = $termin->parent;
			while( $parent ) {
				$parent_term = get_term( $parent, $taxonomia_name);
				$main_url = $parent_term->slug . '/' . $main_url;
				$parent = $parent_term->parent;
			}
		} else {
			unset($query['name']);
		}

		switch( $taxonomia_name ):
			case 'category':{
				$query['category_name'] = $main_url;
				break;
			}
			case 'post_tag':{
				$query['tag'] = $main_url;
				break;
			}
			default:{
				$query[$taxonomia_name] = $main_url;
				break;
			}
		endswitch;

	endif;

	return $query;

}
add_filter('request', 'parse_request_url_articles', 1, 1 );

//Удаление rooms-list из url таксономии
function true_remove_slug_from_rooms( $url, $term, $taxonomy ){

	$taxonomia_name = 'rooms-list';
	$taxonomia_slug = 'rooms-list';

	if ( strpos($url, $taxonomia_slug) === FALSE || $taxonomy != $taxonomia_name ) return $url;

	$url = str_replace('/' . $taxonomia_slug, '', $url);

	return $url;
}
add_filter( 'term_link', 'true_remove_slug_from_rooms', 10, 3 );

//Перенаправление rooms-list в случае удаления category
function parse_request_url_rooms( $query ){

	$taxonomia_name = 'rooms-list';

	if( $query['attachment'] ) :
		$condition = true;
		$main_url = $query['attachment'];
	else:
		$condition = false;
		$main_url = $query['name'];
	endif;

	$termin = get_term_by('slug', $main_url, $taxonomia_name);

	if ( isset( $main_url ) && $termin && !is_wp_error( $termin )):

		if( $condition ) {
			unset( $query['attachment'] );
			$parent = $termin->parent;
			while( $parent ) {
				$parent_term = get_term( $parent, $taxonomia_name);
				$main_url = $parent_term->slug . '/' . $main_url;
				$parent = $parent_term->parent;
			}
		} else {
			unset($query['name']);
		}

		switch( $taxonomia_name ):
			case 'category':{
				$query['category_name'] = $main_url;
				break;
			}
			case 'post_tag':{
				$query['tag'] = $main_url;
				break;
			}
			default:{
				$query[$taxonomia_name] = $main_url;
				break;
			}
		endswitch;

	endif;

	return $query;

}
add_filter('request', 'parse_request_url_rooms', 1, 1 );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*****************************************************************REMOVE POST_TYPE SLUG*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Удаление sluga из url таксономии 
function remove_slug_from_post( $post_link, $post, $leavename ) {
	if ( 'rooms' != $post->post_type /*&& 'workshop' != $post->post_type*/ || 'publish' != $post->post_status ) {
		return $post_link;
	}
		$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
	return $post_link;
}
add_filter( 'post_type_link', 'remove_slug_from_post', 10, 3 );

function parse_request_url_post( $query ) {
	if ( ! $query->is_main_query() )
		return;

	if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		return;
	}

	if ( ! empty( $query->query['name'] ) ) {
		$query->set( 'post_type', array( 'post', 'rooms', 'page' ) );
	}
}
add_action( 'pre_get_posts', 'parse_request_url_post' );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
******************************************************************КОММЕНТАРИИ НОМЕРА***********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Ajax функция добавления комментариев
function true_add_ajax_comment(){
	global $wpdb;
	$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

	$post = get_post($comment_post_ID);

	if ( empty($post->comment_status) ) {
		do_action('comment_id_not_found', $comment_post_ID);
		exit;
	}

	$status = get_post_status($post);

	$status_obj = get_post_status_object($status);

	/*
	 * различные проверки комментария
	 */
	if ( !comments_open($comment_post_ID) ) {
		do_action('comment_closed', $comment_post_ID);
		wp_die( __('Sorry, comments are closed for this item.') );
	} elseif ( 'trash' == $status ) {
		do_action('comment_on_trash', $comment_post_ID);
		exit;
	} elseif ( !$status_obj->public && !$status_obj->private ) {
		do_action('comment_on_draft', $comment_post_ID);
		exit;
	} elseif ( post_password_required($comment_post_ID) ) {
		do_action('comment_on_password_protected', $comment_post_ID);
		exit;
	} else {
		do_action('pre_comment_on_post', $comment_post_ID);
	}

	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
	$comment_rooms      = ( isset($_POST['rooms']) ) ? trim($_POST['rooms']) : null;

	/*
	 * проверяем, залогинен ли пользователь
	 */
	$error_comment = array();

	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
		$user->display_name=$user->user_login;
		$comment_author       = $wpdb->escape($user->display_name);
		$comment_author_email = $wpdb->escape($user->user_email);
		
		$user_ID = get_current_user_id();
		if ( current_user_can('unfiltered_html') ) {
			if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
				kses_remove_filters(); // start with a clean slate
				kses_init_filters(); // set up the filters
			}
		}
	} else {
		if ( get_option('comment_registration') || 'private' == $status )
			$error_comment['error'] = wp_die( 'Ошибка: Вы должны зарегистрироваться или войти, чтобы оставлять комментарии.' );
	}

	$comment_type = '';

	/*
	 * проверяем, заполнил ли пользователь все необходимые поля
 	 */
	if ( get_option('require_name_email') && !$user->exists() ) {
		if ( 6 > strlen($comment_author_email) || '' == $comment_author ){
			$error_comment['error'] = wp_die( 'Ошибка: заполните необходимые поля (Имя, Email).' );
		}elseif ( !is_email($comment_author_email)){
			$error_comment['error'] = wp_die( 'Ошибка: введенный вами email некорректный.' );
		}
	}
		
	if ( '' == trim($comment_content) ||  '<p><br></p>' == $comment_content ){
		$error_comment['error'] = wp_die( 'Ошибка: Вы забыли про комментарий.' );
	}

	wp_json_encode($error_comment);

	/*
	 * добавляем новый коммент и сразу же обращаемся к нему
	 */
	$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
	$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
	$comment_id = wp_new_comment( $commentdata );
	$comment = get_comment($comment_id);

	die();
}
add_action('wp_ajax_ajaxcomments', 'true_add_ajax_comment'); // wp_ajax_{значение параметра action}
add_action('wp_ajax_nopriv_ajaxcomments', 'true_add_ajax_comment'); // wp_ajax_nopriv_{значение параметра action}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************КОММЕНТАРИИ ПОСЕТИТЕЛЕЙ********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Ajax функция добавления комментариев
function visitor_add_ajax_comment(){
	global $wpdb;
	$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

	$post = get_post($comment_post_ID);

	if ( empty($post->comment_status) ) {
		do_action('comment_id_not_found', $comment_post_ID);
		exit;
	}

	$status = get_post_status($post);

	$status_obj = get_post_status_object($status);

	/*
	 * различные проверки комментария
	 */
	if ( !comments_open($comment_post_ID) ) {
		do_action('comment_closed', $comment_post_ID);
		wp_die( __('Sorry, comments are closed for this item.') );
	} elseif ( 'trash' == $status ) {
		do_action('comment_on_trash', $comment_post_ID);
		exit;
	} elseif ( !$status_obj->public && !$status_obj->private ) {
		do_action('comment_on_draft', $comment_post_ID);
		exit;
	} elseif ( post_password_required($comment_post_ID) ) {
		do_action('comment_on_password_protected', $comment_post_ID);
		exit;
	} else {
		do_action('pre_comment_on_post', $comment_post_ID);
	}

	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;

	/*
	 * проверяем, залогинен ли пользователь
	 */
	$error_comment = array();

	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
		$user->display_name=$user->user_login;
		$comment_author       = $wpdb->escape($user->display_name);
		$comment_author_email = $wpdb->escape($user->user_email);
		
		$user_ID = get_current_user_id();
		if ( current_user_can('unfiltered_html') ) {
			if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
				kses_remove_filters(); // start with a clean slate
				kses_init_filters(); // set up the filters
			}
		}
	} else {
		if ( get_option('comment_registration') || 'private' == $status )
			$error_comment['error'] = wp_die( 'Ошибка: Вы должны зарегистрироваться или войти, чтобы оставлять комментарии.' );
	}

	$comment_type = '';

	/*
	 * проверяем, заполнил ли пользователь все необходимые поля
 	 */
	if ( get_option('require_name_email') && !$user->exists() ) {
		if ( 6 > strlen($comment_author_email) || '' == $comment_author ){
			$error_comment['error'] = wp_die( 'Ошибка: заполните необходимые поля (Имя, Email).' );
		}elseif ( !is_email($comment_author_email)){
			$error_comment['error'] = wp_die( 'Ошибка: введенный вами email некорректный.' );
		}
	}
		
	if ( '' == trim($comment_content) ||  '<p><br></p>' == $comment_content ){
		$error_comment['error'] = wp_die( 'Ошибка: Вы забыли про комментарий.' );
	}

	wp_json_encode($error_comment);

	/*
	 * добавляем новый коммент и сразу же обращаемся к нему
	 */
	$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
	$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
	$comment_id = wp_new_comment( $commentdata );
	$comment = get_comment($comment_id);

	die();
}
add_action('wp_ajax_ajax_vis_comments', 'visitor_add_ajax_comment'); // wp_ajax_{значение параметра action}
add_action('wp_ajax_nopriv_ajax_vis_comments', 'visitor_add_ajax_comment'); // wp_ajax_nopriv_{значение параметра action}