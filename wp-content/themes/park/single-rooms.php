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

	<div id="content" class="main">
        <div class="wrapper">

			<?php
				global $nggdb;
				$gallery_id = getNextGallery(get_the_ID(), 'slider_room_single_rooms_page');
				$gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'DESC', false, 0, 0);
				if($gallery_image){
			?>
            <div class="slider slider__room">
                <div class="slider__description">
                    <div class="rooms__info">
                        <div class="rooms__info-inner">
                            <h3><?php the_title(); ?></h3>
                            <hr>
                            <div class="room__price">
								<?php
									$price = get_post_meta( get_the_ID(), 'price_room_single_rooms_page', $single = true );
									echo $price ? $price : 0;
								?>
							</div>
                        </div>
                    </div>
					<?php
						$tl_id = get_post_meta( get_the_ID(), 'tl_id_room_single_rooms_page', $single = true );
					?>
                    <a href="/booking/?room-type=<?php echo $tl_id ? $tl_id : 0; ?>" class="btn btn__gold">Забронировать номер</a>
                </div>
                <div class="owl-carousel">
					<?php foreach($gallery_image as $image) { ?>
						<div class="bg__slider" style="background-image: url('<?php echo nextgen_esc_url($image->imageURL); ?>')"></div>
					<?php } ?>
                </div>
            </div>
			<?php } ?>

            <div class="section__gallery gallery__room">
                <div class="max__wrap-text">
					<?php if (have_posts()): while (have_posts()): the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</div>
				
				<?php
					global $nggdb;
					$gallery_id = getNextGallery(get_the_ID(), 'gallery_room_single_rooms_page');
					$gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'DESC', false, 0, 0);
					if($gallery_image){
				?>
                <div class="grid__gallery">
					<?php foreach($gallery_image as $image) { ?>
						<div class="gallery__item">
							<a href="<?php echo nextgen_esc_url($image->imageURL); ?>" data-fancybox="gallery" style="background-image: url('<?php echo nextgen_esc_url($image->imageURL); ?>')"></a>
						</div>
					<?php } ?>
                </div>
            </div>
			<?php } ?>
			
			<?php if(get_post_meta( get_the_ID(), 'enable_service_room_single_rooms_page', $single = true ) == 'yes'){ ?>
            <div class="section__why section__dopinf">
                <div class="max__wrap-text">
                    <h2>Дополнительная информация о номере</h2>
                </div>
				
				<?php
					$image_url = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'serviceimg_room_single_rooms_page', $single = true ), 'full')
				?>
                <div class="grid__why" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/bg-why.png' ?>">
                    <?php echo get_post_meta( get_the_ID(), 'service_room_single_rooms_page', $single = true ); ?>
                </div>
            </div>
			<?php } ?>
		
			<?php
				$args = array(
					'status' => 'approve',
					'number' => 10,
					'post_id' => get_the_ID(),
				);
		   
				$comments = get_comments( $args );
		   
				if($comments){
			?>
            <div class="section__img section__testimonials testimonials__room">
				<?php
					$image_url = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'reviewsimg_room_single_rooms_page', $single = true ), 'full')
				?>
                <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/bg-testim.jpg' ?>">
                    <h3>Отзывы о номере</h3>
                    <div class="testimonial__carousel">
                        <div class="owl-carousel">
							<?php
								foreach ($comments as $comment) {
									$author = $comment->comment_author;
									$descr = mb_substr( strip_tags( $comment->comment_content ), 0, 152 );
							 ?>
                            <div class="testimonial__item">
                                <div class="testimonial__header">
                                    <span class="testimonial__name"><?php echo $author; ?></span>
                                    <span class="testimonial__date"><?php comment_date( 'd.m.y', $comment->comment_ID ); ?></span>
                                </div>
                                <div class="testimonial__body"><p><?php echo $descr; ?></p></div>
                            </div>
							<?php wp_reset_postdata(); ?>
							<?php } ?>
                        </div>
                    </div>
                    <a href="<?php echo get_permalink( 177 ); ?>" class="btn btn__gold btn__4">ОСТАВИТЬ ОТЗЫВ О НОМЕРЕ</a>
                </div>
            </div>
			<?php } ?>
			
			<?php if(get_post_meta( get_the_ID(), 'enable_service_room_single_rooms_page', $single = true ) == 'yes'){ ?>
            <div class="section__img">
				<?php
					$image_url = wp_get_attachment_image_src(get_post_meta( get_the_ID(), 'actionimg_room_single_rooms_page', $single = true ), 'full')
				?>
                <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/banner-bottom.jpg' ?>">
                    <?php echo get_post_meta( get_the_ID(), 'action_room_single_rooms_page', $single = true ); ?>
                </div>
            </div>
			<?php } ?>
			
			<?php
				$args = array(
						'post_type'   => 'rooms',
						'numberposts' => -1,
						'orderby'     => 'date',
						'order'       => 'DESC',
				);
	
				$rooms_list = get_posts( $args );
				
				if($rooms_list){
			?>
            <div class="section__related">
                <div class="grid__rooms owl-carousel">
					<?php foreach($rooms_list as $room){ ?>
					<?php
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($room->ID), 'full');
						$price = get_post_meta( get_the_ID(), 'price_room_single_rooms_page', $single = true );		
					?>
                    <a href="<?php echo get_permalink($room->ID); ?>" class="room__item">
                        <div class="room__item-inner">
                            <div class="bg__room" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>')"></div>
                            <div class="room__info">
                                <h3><?php echo $room->post_title; ?></h3>
                                <hr>
                                <div class="room__price"><?php echo $price ? $price : 0; ?></div>
                            </div>
                        </div>
                    </a>
					<?php } ?>
                </div>
            </div>
			<?php } ?>

        </div>
    </div>

<?php get_footer(); ?>
