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

    <div class="booking__block">
        <?php echo getMeta('booking_footer_block_main_page'); ?>
    </div>
</div>

<div style="display: none;">
    <div class="form__block form__callback" id="inline1">
        <?php
            $forms_a = getMeta('callback_menu_block_main_page');
            if($forms_a){
                echo do_shortcode('[contact-form-7 id=" ' . $forms_a . ' "]'); 
            }
        ?>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>