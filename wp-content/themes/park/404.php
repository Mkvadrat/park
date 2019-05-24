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

            <div class="slider slider__room slider__404">
                <div class="slider__description">
                    <div class="rooms__info">
                        <div class="rooms__info-inner">
                            <h3>Ошибка 404</h3>
                            <hr>
                            <div class="room__price">Данная страница не найдена</div>
                        </div>
                    </div>
                    <div class="btns__block">
                        <a href="javascript:void(0)" class="btn btn__gold back">Назад</a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn__gold">На главную</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.back').click(function(){
            parent.history.back();
            return false;
        });
    });
    </script>
            
<?php get_footer(); ?>