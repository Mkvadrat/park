<?php
/*
Theme Name: Premium park
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header(); 
?>
    
    <?php $category = get_the_category(); ?>
    <div id="content" class="main">
        <div class="wrapper">

            <div class="banner__top">
                <?php $image_url = wp_get_attachment_image_src( get_term_meta(get_queried_object()->term_id, 'image_rubriс_page', true), 'full'); ?>
                <div class="bg__slider" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/massandra.jpg'; ?>">
                    <?php if($category[0]->cat_name) { ?>
                    <div class="slider__description">
                        <div class="slider__text"><h3><?php echo $category[0]->cat_name; ?></h3></div>
                    </div>
                    <?php }else{ ?>
                    <div class="slider__description">
                        <div class="slider__text"><h3>Статьи не найдены!</h3></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <?php
                $args = array(
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => array( get_queried_object()->term_id )
                        )
                    ),
                        'post_type' => 'post',
                        'numberposts' => -1,
                        'post_status' => 'publish',
                        'orderby'     => 'date',
                        'order'       => 'DESC'
                );
    
                $posts = get_posts( $args );
                
                if($posts){
            ?>
            <div class="section pb0">
                <div class="grid__gallery grid__services-list">
                    <?php foreach($posts as $post){ ?>
                        <?php
                            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
                        ?>
                        <div class="gallery__item">
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <div class="services__img" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg'; ?>')"></div>
                                <div class="service__name"><p><?php echo $post->post_title; ?></p></div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php }else{ ?>
            <div class="section pb0">
                <div class="grid__gallery grid__services-list">
                    <p style="text-align: center;">Статьи не найдены!</p>
                </div>
            </div>
            <?php } ?>
            
            <div class="section">
                <div class="max__wrap-text">
                   <?php echo html_entity_decode(get_term_meta(get_queried_object()->term_id, 'description_rubriс_page', true)); ?>
                </div>
            </div>

            <?php if(get_term_meta(get_queried_object()->term_id, 'enable_add_block_rubric_page', true) == 'yes'){ ?>
            <div class="section__img">
                <?php $image_url = wp_get_attachment_image_src( get_term_meta(get_queried_object()->term_id, 'image_action_rubriс_page', true), 'full'); ?>
                <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>">
                    <?php echo html_entity_decode(get_term_meta(get_queried_object()->term_id, 'description_action_rubriс_page', true)); ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
<?php get_footer(); ?>