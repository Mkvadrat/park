<?php
/*
Template name: Contacts page
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

            <div class="section__contacts">
                <div class="grid__contacts text__left">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                    <div class="form__block form__contacts">
                        <?php
                            $forms_a = getMeta('callback_contacts_page');
                            if($forms_a){
                                echo do_shortcode('[contact-form-7 id=" ' . $forms_a . ' "]'); 
                            }
                        ?>
                    </div>
                    
                    <?php echo get_post_meta( get_the_ID(), 'title_map_contacts_page', $single = true ); ?>
                </div>
                <div class="section__map">
                    <?php echo get_post_meta( get_the_ID(), 'map_contacts_page', $single = true ); ?>
                </div>
            </div>

        </div>
    </div>
    
<?php get_footer(); ?>