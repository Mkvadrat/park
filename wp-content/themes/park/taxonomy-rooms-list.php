<?php
/*
Theme Name: Premium park
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header();
?>
	
	<?php $category = get_queried_object(); ?>
	<div id="content" class="main">
        <div class="wrapper">
            <div class="banner__top">
				<?php $image_url = wp_get_attachment_image_src( get_term_meta(get_queried_object()->term_id, 'image_rooms_list_page', true), 'full'); ?>
                <div class="bg__slider" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/massandra.jpg'; ?>">
                    <div class="slider__description">
                    <?php if($category->name) { ?>
                    <div class="slider__description">
                        <div class="slider__text"><h3><?php echo $category->name; ?></h3></div>
                    </div>
                    <?php }else{ ?>
                    <div class="slider__description">
                        <div class="slider__text"><h3>Статьи не найдены!</h3></div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="max__wrap-text">
					<?php echo html_entity_decode(get_term_meta(get_queried_object()->term_id, 'description_rooms_list_page', true)); ?>
				</div>
            </div>
	
			<?php
				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'rooms-list',
							'field' => 'id',
							'terms' => array( get_queried_object()->term_id )
						)
					),
						'post_type' => 'rooms',
						'numberposts' => -1,
						'post_status' => 'publish',
						'orderby'     => 'date',
						'order'       => 'DESC',
				);
	
				$rooms_list = get_posts( $args );
				
				if($rooms_list){
			?>
            <div class="section">
                <div class="list__rooms">
					<?php foreach($rooms_list as $rooms){ ?>
					<?php
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($rooms->ID), 'full');
						$price = get_post_meta( $rooms->ID, 'price_room_single_rooms_page', $single = true );
					?>
                    <div class="room__item">
                        <div class="room__item-inner">
                            <div class="bg__room flex__center" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg'; ?>')">
                                <div class="rooms__info">
                                    <div class="rooms__info-inner">
                                        <h3><?php echo $rooms->post_title; ?></h3>
                                        <hr>
                                        <div class="room__price"><?php echo $price ? $price : 0; ?></div>
                                    </div>
                                </div>
                                <a href="<?php echo get_permalink($rooms->ID); ?>" class="btn btn__gold btn__3">ПОДРОБНЕЕ</a>
                            </div>
                        </div>
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

			<?php if(get_term_meta(get_queried_object()->term_id, 'enable_add_block_rooms_list_page', true) == 'yes'){ ?>
            <div class="section__img">
				<?php $image_url = wp_get_attachment_image_src( get_term_meta(get_queried_object()->term_id, 'image_action_rooms_list_page', true), 'full'); ?>
                <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>">
                    <?php echo html_entity_decode(get_term_meta(get_queried_object()->term_id, 'description_action_rooms_list_page', true)); ?>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
	
<?php get_footer(); ?>
