<?php
/*
Theme Name: Premium park
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header(); ?>
	
    <div id="content" class="main">
        <div class="wrapper">

            <div class="banner__top">
                <?php
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full'); 
                ?>
                <div class="bg__slider" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/massandra.jpg' ?>">
                    <div class="slider__description">
                        <div class="slider__text"><h3><?php the_title(); ?></h3></div>
                    </div>
                </div>
            </div>

            <div class="section pb10">
                <div class="max__wrap-p">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
