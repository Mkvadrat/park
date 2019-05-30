<?php
/*
Template name: Main page
*/

get_header(); 
?>
    
    <div id="content" class="main">
        <div class="wrapper">
            <div class="slider slider__room">
                <div class="owl-carousel">
                    <?php
                        global $nggdb;
                        $gallery_id = getNextGallery(get_the_ID(), 'slider_block_main_page');
                        $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
                        if($gallery_image){
                            foreach($gallery_image as $image) { 
                        ?>
                            <div class="bg__slider" style="background-image: url('<?php echo nextgen_esc_url($image->imageURL); ?>')">
                                <div class="slider__description">
                                    <div class="slider__text"><h3><?php echo $image->alttext; ?></h3></div>
                                    <?php echo htmlspecialchars_decode($image->description, ENT_QUOTES); ?>
                                </div>
                            </div>
                        <?php
                            }
                        }
                    ?>
                </div>
        </div>
            
        <?php $block_a = get_field('text_a_block_main_page'); ?>
        <div class="section">
            <div class="max__wrap-text text__center">
                <?php echo $block_a['text_a_subblock_main_page']; ?>
            </div>
        </div>

        <div class="section__img">
            <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $block_a['image_a_b_subblock_main_page']['url']; ?>">
                <?php echo $block_a['text_b_subblock_main_page']; ?>
            </div>
        </div>
        
        <?php $rooms = getRelatedMeta(get_the_ID(), 'choice_numbers_main_page'); ?>
        <?php if($rooms){ ?>
        <div class="section__rooms">
            <div class="max__wrap-text text__center">
                <?php echo get_post_meta( get_the_ID(), 'text_b_block_main_page', $single = true ); ?>
            </div>
            <div class="grid__rooms">
                <?php $i = 0; ?>
                <?php foreach($rooms as $room){ ?>
                <?php $i++; ?>
                <?php if($i >3) break; ?>
                <?php
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($room->ID), 'full');
                    $price = get_post_meta( $room->ID, 'price_room_single_rooms_page', $single = true );
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
            <a href="<?php echo get_category_link( 3 ); ?>" class="btn btn__gold btn__4">СМОТРЕТЬ ВСЕ НОМЕРА</a>
        </div>
        <?php } ?>
    
        <?php $block_c = get_field('text_c_block_main_page'); ?>
        <div class="section__img">
            <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $block_c['image_a_subblock_main_page']['url']; ?>">
                <?php echo $block_c['text_a_subblock_main_page']; ?>
            </div>
        </div>

        <?php $services = getRelatedMeta(get_the_ID(), 'choice_services_main_page'); ?>
        <?php if($services){ ?>
        <div class="section__services">
            <div class="max__wrap-text text__center">
                <?php echo get_post_meta( get_the_ID(), 'text_d_block_main_page', $single = true ); ?>
            </div>
            <div class="grid__services">
                <?php $i = 0; ?>
                <?php foreach($services as $service){ ?>
                <?php $i++; ?>
                <?php if($i >3) break; ?>
                <?php
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($service->ID), 'full');
                ?>
                <a href="<?php echo get_permalink($service->ID); ?>" class="service__item">
                    <div class="service__item-inner">
                        <div class="bg__service" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>')"></div>
                        <div class="service__info">
                            <h3><?php echo $service->post_title; ?></h3>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php $block_e = get_field('text_e_block_main_page'); ?>
        <div class="section__img">
            <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $block_e['image_a_subblock_main_page']['url']; ?>">
                <?php echo $block_e['text_a_subblock_main_page']; ?>
            </div>
        </div>
        
        <?php $block_f = get_field('text_f_block_main_page'); ?>
        <div class="section__half">
            <div class="max__wrap-text">
                <?php echo $block_f['title_a_subblock_main_page']; ?>
            </div>
            <div class="grid__half">
                <div class="img__half"><img src="<?php echo $block_f['image_a_subblock_main_page']['url']; ?>" alt=""></div>
                <div class="text__half">
                    <?php echo $block_f['text_a_subblock_main_page']; ?>
                </div>
            </div>
        </div>

        <?php $block_h = get_field('text_h_block_main_page'); ?>
        <div class="section__why">
            <div class="max__wrap-text">
                <?php echo $block_h['title_a_subblock_main_page']; ?>
            </div>
            <div class="grid__why" data-parallax="scroll" data-image-src="<?php echo $block_h['image_a_subblock_main_page']['url']; ?>">
                <div class="why__item">
                    <?php echo $block_h['text_a_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_b_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_c_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_d_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_e_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_f_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_g_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_h_subblock_main_page']; ?>
                </div>
                <div class="why__item">
                    <?php echo $block_h['text_i_subblock_main_page']; ?>
                </div>
            </div>
        </div>

        <div class="section__gallery">
            <div class="max__wrap-text">
                <?php echo get_post_meta( get_the_ID(), 'text_i_block_main_page', $single = true ); ?>
            </div>
            <div class="grid__gallery">
                <?php
                    global $nggdb;
                    $gallery_id = getNextGallery(get_the_ID(), 'gallery_main_page');
                    $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'DESC', false, 0, 0);
                    if($gallery_image){
                        $i = 0;
                        foreach($gallery_image as $image) {
                        $i++;
                        if($i > 6) break;
                    ?>
                        <div class="gallery__item">
                            <a href="<?php echo nextgen_esc_url($image->imageURL); ?>" data-fancybox="gallery"
                               style="background-image: url('<?php echo nextgen_esc_url($image->imageURL); ?>')"></a>
                        </div>
                    <?php
                        }
                    }
                ?>
            </div>
            <a href="<?php echo get_permalink( 175 ); ?>" class="btn btn__gold btn__4">ПЕРЕЙТИ В ГАЛЕРЕЮ</a>
        </div>
        
        <?php $block_j = get_field('text_j_block_main_page'); ?>
        <div class="section__img section__testimonials">
            <div class="bg__img" data-parallax="scroll" data-image-src="<?php echo $block_j['image_a_subblock_main_page']['url']; ?>">
                <?php echo $block_j['titile_a_subblock_main_page']; ?>
                <div class="testimonial__carousel">
                    <?php
                        $args = array(
                            'status' => 'approve',
                            'number' => 10,
                            'post_id' => 194,
                        );
                   
                        $comments = get_comments( $args );
                   
                        if($comments){
                    ?>
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
                    <?php } ?>
                    </div>
                </div>
                <a href="<?php echo get_permalink( 194 ); ?>" class="btn btn__gold btn__4">ЧИТАТЬ ВСЕ ОТЗЫВЫ</a>
            </div>
        </div>

        <div class="section__map">
            <div class="max__wrap-text">
                <?php echo get_post_meta( get_the_ID(), 'text_k_block_main_page', $single = true ); ?>
            </div>
            <?php echo get_post_meta( get_the_ID(), 'maps_main_page', $single = true ); ?>
        </div>

    </div>
            
<?php get_footer(); ?>