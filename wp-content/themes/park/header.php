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
    
    <?php wp_head(); ?>
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
            </div>
        </div>
    </div>
