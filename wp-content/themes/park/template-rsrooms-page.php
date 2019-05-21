<?php
/*
Template name: Reviews rooms page
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

            <div class="section">
                <div class="max__wrap-text">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>

            <div class="section__tabs">
                <div class="max__wrap">
                    <div class="header__tabs">
                        <ul class="nav nav-tabs">
                            <li><a href="<?php echo get_permalink(194); ?>" class="link">ОБЩИЕ ОТЗЫВЫ</a></li>
                            <li><a href="<?php echo get_permalink(177); ?>" class="link">ОТЗЫВЫ О НОМЕРАХ</a></li>
                        </ul>
                        <a href="#to-comment" class="btn btn__gold btn__4 scrollto">ОСТАВИТЬ ОТЗЫВ</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active">
                            <?php 
                            
                                define( 'DEFAULT_COMMENTS_PER_PAGE', $GLOBALS['wp_query']->query_vars['comments_per_page']);
                            
                                $page = (get_query_var('page')) ? get_query_var('page') : 1;
                            
                                $limit = DEFAULT_COMMENTS_PER_PAGE;
                            
                                $offset = ($page * $limit) - $limit;
                            
                                $param = array(
                                    'status'	=> 'approve',
                                    'offset'	=> $offset,
                                    'number'	=> $limit,
                                    'post_type' => 'rooms'
                                );
                            
                                $total_comments = get_comments(array(
                                    'orderby' => 'comment_date',
                                    'order'   => 'ASC',
                                    'status'  => 'approve',
                                    'parent'  => 0
                            
                                ));
                            
                                $pages = ceil(count($total_comments)/DEFAULT_COMMENTS_PER_PAGE);
                            
                                $comments = get_comments( $param );
                            
                                $args = array(
                                    'base'         => @add_query_arg('page','%#%'),
                                    'format'       => '?page=%#%',
                                    'total'        => $pages,
                                    'current'      => $page,
                                    'show_all'     => false,
                                    'mid_size'     => 4,
                                    'prev_next'    => false,
                                    'prev_text'    => __('&laquo; В начало'),
                                    'next_text'    => __('В конец &raquo;'),
                                    //'type'         => 'comment'
                                    'type' => 'array'
                                );
                                
                                if($comments){
                                foreach($comments as $comment){
                                    $author = $comment->comment_author;
                                    $descr = strip_tags( $comment->comment_content );
                                    $rooms = get_comment_meta($comment->comment_ID, 'rooms', true);
                                    
                                    global $cnum;
                            
                                    // определяем первый номер, если включено разделение на страницы
                            
                                    $per_page = $limit;
                            
                                    if( $per_page && !isset($cnum) ){
                                        $com_page = $page;
                                        if($com_page>1)
                                            $cnum = ($com_page-1)*(int)$per_page;
                                    }
                                    // считаем
                                    $cnum = isset($cnum) ? $cnum+1 : 1;
                            ?>

                            <div class="testimonial__item">
                                <div class="testimonial__header">
                                    <span class="testimonial__name"><?php echo $author; ?></span>
                                    <span class="testimonial__date"><strong>Номер: <i><?php echo $rooms; ?></i></strong><?php comment_date( 'd.m.y', $comment->comment_ID ); ?></span>
                                </div>
                                <div class="testimonial__body">
                                    <p><?php echo $descr; ?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                            
                            <?php $pagination = paginate_links($args);
                                
                            if($pagination){
                            ?>
                            <ul class="paggination">
                                <?php foreach ($pagination as $pag){ ?>
                                    <li><?php echo $pag; ?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form__block form__contacts form__testimonials" id="to-comment">
                <form id="commentform">
                    <h3>Оставить отзыв</h3>
                    <div class="fields__group">
                        <span><input type="text" name="author" id="author" placeholder="Ваше имя*"></span>
                        <span><input type="email" name="email" id="email" placeholder="E-mail*"></span>
                        <span>
                            <?php 
                                $args = array(
                                    'post_type' => 'rooms',
                                    'numberposts' => -1,
                                    'orderby'     => 'date',
                                    'order'       => 'ASC',
                                );
                    
                                $posts = get_posts( $args );
                                if($posts){
                            ?>

                            <select name="rooms" id="rooms">
                                <?php foreach($posts as $post){ ?>
                                <option value="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </span>
                    </div>
                    <div class="fields__group">
                        <textarea name="comment" id="comment" placeholder="Отзыв*"></textarea>
                    </div>
                    <?php echo comment_id_fields(); ?>
                    <div class="respond"></div>
                </form>
                
                <div class="check__block">
                    <label><input type="checkbox" name="confirm" class="confirm" value="1">&nbsp; Я согласен на обработку персональных данных.</label>
                </div>
                <div class="button__group">
                    <input type="submit" onclick="submit();" class="btn btn__gold btn__2 submit" value="ОТПРАВИТЬ" disabled="disabled">
                </div>
            </div>

            <div class="section pb0">
                <div class="max__wrap-text">
                    <p>Ваш отзыв появится на сайте после модерации.</p>
                </div>
            </div>

        </div>
    </div>
    
    <script language="javascript">
        function submit(){
            $("#commentform").submit();
        }
    </script>
    
<?php get_footer(); ?>