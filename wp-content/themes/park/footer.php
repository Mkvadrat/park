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
    <?php $page_main_search = parse_url($_SERVER['REQUEST_URI']);
    if (strpos($page_main_search['path'],'/booking') === false) : ?>
    <div class="booking__block">
        <?php echo getMeta('booking_footer_block_main_page'); ?>
    </div>
    <?php endif; ?>
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

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53935621, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53935621" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>