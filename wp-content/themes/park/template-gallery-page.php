<?php
/*
Template name: Gallery page
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

            <div class="section section__gallery pb0">
                <div class="max__wrap-text">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
                
                <div class="grid__gallery">
                    <?php
                        global $nggdb;
                        $gallery_id = getNextGallery(get_the_ID(), 'next_gen_gallery_page');
                        $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'DESC', false, 0, 0);
                        if($gallery_image){
                            foreach($gallery_image as $image) {
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
            </div>

        </div>
    </div>
  
<?php get_footer(); ?>