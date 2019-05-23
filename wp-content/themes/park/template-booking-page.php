<?php
/*
Template name: Booking page
*/

get_header(); 
?>
    
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
            
            <?php $block_a = get_field('form_booking_page'); ?>
            <div class="section section__btns pb0">
                <div class="max__wrap-text">
                    <?php echo $block_a['text_a_subblock_booking_page']; ?>
                    <div class="btns__block">
                        <?php echo $block_a['text_b_subblock_booking_page']; ?>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="max__wrap-text max__wrap">
                    <?php echo $block_a['text_c_subblock_booking_page']; ?>
                </div>
            </div>

            <div class="section__booking-form" id="to-form">
                <div class="max__wrap">
                    <?php echo $block_a['code_subblock_booking_page']; ?>
                </div>
            </div>

            <div class="section__blockquote">
                <div class="max__wrap-text max__wrap text__left">
                    <div class="blockquote">
                        <div class="blockquote__text">
                            <?php echo $block_a['text_d_subblock_booking_page']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section pb0 section__pul">
                <div class="max__wrap-text max__wrap text__left">
                    <?php echo $block_a['text_e_subblock_booking_page']; ?>
                </div>
            </div>

            <div class="section__half">
                <div class="grid__half">
                    <div class="text__half">
                        <?php echo $block_a['text_f_subblock_booking_page']; ?>
                    </div>
                    <div class="img__half"><img src="<?php echo $block_a['image_a_f_subblock_main_page']['url']; ?>" alt=""></div>
                </div>
            </div>

            <div class="section pb0 uli">
                <div class="max__wrap-text max__wrap text__left">
                    <?php echo $block_a['text_g_subblock_booking_page']; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div style="display: none;">
        <div class="form__block form__light-book" id="inline2">
            <?php
                $forms_a = getMeta('easy_form_booking_page');
                if($forms_a){
                    echo do_shortcode('[contact-form-7 id=" ' . $forms_a . ' "]'); 
                }
            ?>
        </div>
    </div>
    
<?php get_footer(); ?>