<?php
/*
Theme Name: Premium park
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <title><?php echo mkvadrat_wp_title('','|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <meta name="yandex-verification" content="48b6d3d72b14e768" />
    
    <?php wp_head(); ?>
    <!-- start TL head script -->
    <script type="text/javascript">
        (function(w){
            var q=[
                ['setContext', 'TL-INT-park-mkvadrat', 'ru']
            ];
            var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
            if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
        })(window);
    </script>
    <!-- end TL head script -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/travelline-style.css">
</head>
<body>

<div id="page">
    <div id="header" class="header">
        <div id="hamburger"><span class="hamburger__span"></span></div>
        <div class="header__inner">
            <div class="header__top">
                <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img
                      src="<?php header_image(); ?>"
                      height="<?php echo get_custom_header()->height; ?>"
                      width="<?php echo get_custom_header()->width; ?>"
                      alt="logotype"
                    />
                </a>
                            
                <?php echo getMeta("phone_menu_block_main_page"); ?>
				<div class="soc__list">
					<a href="https://api.whatsapp.com/send?phone=79789243399"><img src="/wp-content/themes/park/img/whatsapp.png" alt="whatsapp"/></a>
					<a href="viber://chat?number=79789243399"><img src="/wp-content/themes/park/img/viber.png" alt="viber"/></a>
				</div>
            </div>
            <div class="header__menu">
                <div>
                    <?php
                        if (has_nav_menu('main_menu')){
                            wp_nav_menu( array(
                                'theme_location'  => 'main_menu',
                                'menu'            => '',
                                'container'       => false,
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'depth'           => 2,
                                'walker'          => new header_menu(),
                            ) );
                        }
                    ?>
                </div>
            </div>
            <div class="header__info">
                <div class="soc__block">
                    <?php echo getMeta("social_links_menu_block_main_page"); ?>
                </div>
                <div class="address"><?php echo getMeta("address_menu_block_main_page"); ?></div>
                
                <?php echo wp_get_attachment_image( getMeta('image_wrapper_menu_block_main_page'), 'full', false, array('class' => 'waves')); ?>
                
                <div class="copy"><?php echo getMeta("wrapper_menu_block_main_page"); ?></div>
				<div class="m2kv"><a href="http://mkvadrat.com" target="_blank"><img src="/wp-content/themes/park/img/m2.jpg" alt="m2"/></a></div>
            </div>
        </div>
    </div>
