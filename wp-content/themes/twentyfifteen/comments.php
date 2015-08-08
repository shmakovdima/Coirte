<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
i
?>



<?php if (comments_open()) { ?>
   <h2 class="comments_caption" id="comments"><?php comments_number( 'Нет комментариев', 'Один комментарий', 'Кол-во комментариев: % ' ); ?></h2> 
      <?php
        function verstaka_comment($comment, $args, $depth){
          $GLOBALS['comment'] = $comment; ?>

          <div class="media comment_section" id="li-comment-<?php comment_ID() ?>">
				<div class="pull-left post_comments">
                     <?php echo get_avatar($comment,$size='85' ); ?>
                </div>
			  	 <div class="media-body post_reply_comments">
                                <h3><?php printf(__('%s'), get_comment_author_link()) ?></h3>
                                <h4><?php printf(__('%1$s в %2$s'), get_comment_date(),  get_comment_time()) ?></h4>
					 			<?php if ($comment->comment_approved == '0') : ?>
                					<em><?php _e('Ваш отзыв ожидает модерацию.') ?></em>
                					<br>
              					<?php endif; ?>
                                <?php comment_text() ?>
                 </div>
            </div>
		  
      <?php }?>



<?
        $args = array(
          'reply_text' => 'Ответить',
          'callback' => 'verstaka_comment'
        );
        wp_list_comments($args);
      ?>


<div id="contact-page clearfix">
                            <div class="status alert alert-success" style="display: none"></div>
                            <div class="message_heading">
                                <h4>Оставьте ответ</h4>
                                <p>Вы должны заполнить обязательные поля (*)</p>
                            </div> 
      						 <div class="row">
                            
								 
                             <?php
    								$fields = array(
      'author' => '<div class="col-sm-5"> <div class="form-group"> <label>Имя *</label><input type="text" id="author" name="author" class="author form-control" value="' . esc_attr($commenter['comment_author']) . '" placeholder="" pattern="[A-Za-zА-Яа-я]{3,}" maxlength="30" autocomplete="on" tabindex="1" required' . $aria_req . '></div>',
      'email' => '<div class="form-group"><label>Email *</label><input type="email" id="email" name="email" class="email form-control" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="example@example.com" maxlength="30" autocomplete="on" tabindex="2" required' . $aria_req . '></div>',
      'url' => '<div class="form-group"> <label>URL</label><input type="url" id="url" name="url" class="site form-control" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="www.example.com" maxlength="30" tabindex="3" autocomplete="on"></p></div></div>     '
    );
 
    $args = array(
      'comment_notes_after' => '',
      'comment_field' => ' <div class="col-xm-12"><div class="form-group"><label>Сообщение *</label><textarea id="comment" name="comment" class="comment-form form-control" cols="45" rows="8" aria-required="true" placeholder="Текст сообщения..."></textarea></div>',
      'label_submit' => 'Отправить',
      'fields' => apply_filters('comment_form_default_fields', $fields)
    );
    comment_form($args);
  ?>

                                    </div>
                                
                       
							</div>
                        </div><!--/#contact-page-->
 

 

  <?php } else { ?>
  <h3>Обсуждения закрыты для данной страницы</h3>
  <?php }
  ?>



                            
                           
                        

