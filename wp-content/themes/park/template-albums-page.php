<?php
/*
Template name: Albums page
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
                        
                        $albums = $nggdb->find_all_album();
                        
                        if($albums){
                            foreach($albums as $album){
                                $gal_info = $nggdb->find_gallery($album->sortorder[0]);
                                if($gal_info->previewpic){
                                    $previewpic = nggdb::find_image($gal_info->previewpic)->cached_singlepic_file(728, 728, 'crop');
                                }else{
                                    $previewpic = esc_url( get_template_directory_uri() ) . '/img/no_image.jpg';
                                }   
                    ?>
                            <div class="gallery__item">
                                <a href="<?php echo $gal_info->pageid ? get_permalink($gal_info->pageid) : '/#/'; ?>">
                                    <img src="<?php echo $previewpic; ?>"><?php echo $album->name; ?>
                                </a>
                            </div>
                        <?php } ?>
                    <?php }else{ ?>
                        <p>Альбомов не найдено!</p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
  
<?php get_footer(); ?>