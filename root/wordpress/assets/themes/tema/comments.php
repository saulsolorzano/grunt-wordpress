<?php // Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if (!empty($post->post_password)) { // if there's a password
        if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
            ?>

            <p class="nocomments">This post is password protected. Enter the password to view comments.</p>

            <?php
            return;
        }
    }

?>
<?php if ($comments) : ?>
                <div id="comments" class="comments-list">
                        <h6 class="comments-head"><?php comments_number('Sin Comentarios', 'Un Comentario', '% Comentarios' );?></h6>
                        <ul class="comlist clearfix">
                            <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
                        </ul>
                </div>
                        <?php else : // this is displayed if there are no comments so far ?>
                        <?php if ('open' == $post->comment_status) : ?>
                        <!-- If comments are open, but there are no comments. -->
                        <div><h6 class="comments-head">No hay comentarios en este momento, sé el primero</h6></div>
                        <?php else : // comments are closed ?>
                        <!-- If comments are closed. -->
                        <p class="nocomments">Los comentarios están cerrados.</p>
    <?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<h6 class="comments-head">Escribir un comentario</h6>
                    <div id="respond" class="respond-form">
                        <span id="cancel-comment-reply">
                            <p class="small"><?php cancel_comment_reply_link(); ?></p>
                        </span>
                        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                            <p>Debes estar <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logeado</a> para poder comentar.</p>
                            <?php else : ?>
                        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="clearfix comment-form">
                            <?php if ( $user_ID ) : ?>
                                <p>Logeado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Cerrar sesión &raquo;</a></p>
                            <?php else : ?>
                            <div>
                                <label for="author">Nombre <?php if ($req) echo "*"; ?></label>
                                <input type="text" name="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                            </div>
                            <div>
                                <label for="email">Correo <?php if ($req) echo "*"; ?> (No será publicado)</label>
                                <input type="email" name="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                            </div>
                            <div>
                                <label for="url">Página Web</label>
                                <input type="url" name="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" <?php if ($req) echo "aria-required='true'"; ?> />
                            </div>
                            <?php endif; ?>
                            <div class="full">
                                <label for="comentario">Comentario</label>
                                <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
                            </div>
                            <div class="submit">
                                <input name="submit" type="submit" tabindex="5" value="Enviar" />
                                <?php comment_id_fields(); ?>
                            </div>
                            <?php do_action('comment_form', $post->ID); ?>
                        </form>
                        <?php endif; // If registration required and not logged in ?>
                    </div>
<?php endif; // if you delete this the sky will fall on your head ?>
