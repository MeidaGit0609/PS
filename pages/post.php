<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/posts_functions.php'; ?>
<?php require_once '../php/functions/comment_functions.php'; ?>
<?php require_once '../php/functions/views_functions.php'; ?>
<?php require_once '../php/functions/like_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/post.css">
</head>
<body>
<?php
require '../includes/header.php';


$post_id  = $_GET['id'];
$post = get_post_by_id($post_id); // Массив с информацией о посте
$comments = get_post_comment($post_id); // Массив со всеми комментариями
$author = get_user_id_by_id($post['user_id']);


// Добавляем просмотр
$views = add_views($post['views'], $post_id);
$comments_num = count($comments);
$likes = $post['likes'];
?>

<div class="post">
    <div class="post__content">
        <div class="post__img">
            <img src="<?=$post['image'] ?>" alt="">
        </div>
        <div class="post-stat stat-one">

            <span class="post-stat__item">
                <img src="/resource/img/icons/eye.svg" width="30">
                <?=$post['views'] ?>
            </span>
            <span class="post-stat__item">
                <img src="/resource/img/icons/comment.svg" width="30">
                <?=$comments_num ?>
            </span>


            <?php if(isset($_COOKIE['user'])) : ?>
                <div class="like post-stat__item">
                    <form action="/php/action/like.php" method="post">
                        <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                        <input type="hidden" name="post_id" value="<?=$post['id']  ?>">
                        <input type="hidden" name="user_id" value="<?=$user_id ?>">
                        <button type="submit" class="no-btn">
                            <?php if(is_like($post['id'], $user_id)) :?>
                                <img src="/resource/img/icons/like.svg" alt="" WIDTH="30">
                            <?php else :?>
                                <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30">
                            <?php endif; ?>
                        </button>
                        <?=like_num($post['id'] ) ?>
                    </form>

                    <div class="like-users">
                        <?php
                        $like_users = get_like_users($post['id']);
                        foreach($like_users as $like_user) : ?>
                            <a class="like-users__item" href="user.php?id=<?=$like_user['id'] ?>">
                                <img src="<?=$like_user['avatar'] ?>" alt="" class="like-users__avatar">
                                <div class="like-users__name"><?=$like_user['username'] ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>
            <?php else: ?>
                <button class="like post-stat__item no-btn" data-toggle="modal" data-target="#account_fail">
                    <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30"><?=like_num($post['id'] ) ?>

                    <div class="like-users">
                        <?php
                        $like_users = get_like_users($post['id']);
                        foreach($like_users as $like_user) : ?>
                            <a class="like-users__item" href="user.php?id=<?=$like_user['id'] ?>">
                                <img src="<?=$like_user['avatar'] ?>" alt="" class="like-users__avatar">
                                <div class="like-users__name"><?=$like_user['username'] ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="account_fail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Вы не зарегистрированы</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ок</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>
    <div class="post__right">

        <div class="author">
            <div class="author__avatar">
                <img src="<?=$author['avatar'] ?>" alt="">
            </div>
            <div class="author__username">
                <b><?=$author['username'] ?> &middot;</b>
                <a href="">Подписаться</a>
            </div>
        </div>

    <!--        Статистика для мобильной версии-->
        <div class="post-stat stat-mobile">

            <span class="post-stat__item">
                <img src="/resource/img/icons/eye.svg" width="30">
                <?=$post['views'] ?>
            </span>
            <span class="post-stat__item">
                <img src="/resource/img/icons/comment.svg" width="30">
                <?=$comments_num ?>
            </span>

            <?php if(isset($_COOKIE['user'])) : ?>
                <div class="like post-stat__item">
                    <form action="/php/action/like.php" method="post">
                        <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                        <input type="hidden" name="post_id" value="<?=$post['id']  ?>">
                        <input type="hidden" name="user_id" value="<?=$user_id ?>">
                        <button type="submit" class="no-btn">
                            <?php if(is_like($post['id'], $user_id)) :?>
                                <img src="/resource/img/icons/like.svg" alt="" WIDTH="30">
                            <?php else :?>
                                <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30">
                            <?php endif; ?>
                        </button>
                        <?=like_num($post['id'] ) ?>
                    </form>

                    <div class="like-users">
                        <?php
                        $like_users = get_like_users($post['id']);
                        foreach($like_users as $like_user) : ?>
                        <a class="like-users__item" href="user.php?id=<?=$like_user['id'] ?>">
                            <img src="<?=$like_user['avatar'] ?>" alt="" class="like-users__avatar">
                            <div class="like-users__name"><?=$like_user['username'] ?></div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                </div>
            <?php else: ?>
            <div class="like post-stat__item">
                <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30">
                <?=like_num($post['id'] ) ?>

                <div class="like-users">
                    <?php
                    $like_users = get_like_users($post['id']);
                    foreach($like_users as $like_user) : ?>
                        <a class="like-users__item" href="user.php?id=<?=$like_user['id'] ?>">
                            <img src="<?=$like_user['avatar'] ?>" alt="" class="like-users__avatar">
                            <div class="like-users__name"><?=$like_user['username'] ?></div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>


        </div>

<!--        Форма для мобильной версии-->
        <?php if(isset($_COOKIE['user'])) :?>
            <form class="comments-form_mobile" action="/php/action/comment-handler.php?post_id=<?=$post['id'] ?>" method="post">
                <input type="text" name="text"  placeholder="Ваш комментарий" class="comments-form__input">
                <button type="submit" class="comments__btn d-inline">Отправить</button>
            </form>
        <?php else: ?>

        <?php endif; ?>


        <div class="comments">
            <div class="comments__item">
                <div class="comments__avatar">
                    <img src="<?=$author['avatar'] ?>" alt="">
                </div>
                <div class="comments__right">
                    <p class="comments__text">
                        <b class="comments__name"><?=$author['username'] ?></b>
                        <?=$post['description'] ?>
                    </p>
                </div>
            </div>
            <?php
            foreach($comments as $comment) :
                $user_info = user_by_id($comment['user_id']);
                if($user_info == null) :
                    continue;

                else :
            ?>

            <div class="comments__item">
                <div class="comments__avatar">
                    <img src="<?=$user_info['avatar'] ?>" alt="">
                </div>
                <div class="comments__right">
                    <p class="comments__text">
                        <b class="comments__name"><?=$user_info['username'] ?></b>
                        <?=$comment['text'] ?>
                    </p>
                    <?php if($comment['user_id'] == $user['id']) :?>
                        <a href="/php/action/delete-comment.php?comment_id=<?=$comment['id'] ?>">
                            <img src="/resource/img/icons/rubbish-bin.svg" alt="" height="20">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>

        <?php if(isset($_COOKIE['user'])) :?>
            <form class="comments-form" action="/php/action/comment-handler.php?post_id=<?=$post['id'] ?>" method="post">
                <input type="text" name="text"  placeholder="Ваш комментарий" class="comments-form__input">
                <button type="submit" class="comments__btn d-inline">Отправить</button>
            </form>
        <?php else: ?>

        <?php endif; ?>
    </div>
</div>




<!--<div class="container" style="margin-top: 200px;">-->
<!--    <div class="--><?//=$comments_num > 4 ? 'post-modal row flex-row' : 'post-modal-mini ' ?><!--">-->
<!--            <div class="--><?//=$comments_num > 4 ? 'col-6' : '' ?><!-- modal__img">-->
<!--                <div class="photo">-->
<!--                    <img src="--><?//=$post['image'] ?><!--" alt="" class="block">-->
<!--                </div>-->
<!--                <div class="stat row mt-3 ml-2">-->
<!--                    <span class="views stat_item"><i class="fas fa-eye"></i> --><?//=$post['views'] ?><!-- </span>-->
<!--                    <span class="views stat_item"><i class="fas fa-comments"></i> --><?//=$comments_num ?><!--</span>-->
<!---->
<!--                    <div class="like stat_item">-->
<!--                        <form action="/php/action/like.php" method="post">-->
<!--                            <input type="hidden" name="likes" value="--><?//=$post['likes'] ?><!--">-->
<!--                            <input type="hidden" name="post_id" value="--><?//=$post['id']  ?><!--">-->
<!--                            <input type="hidden" name="user_id" value="--><?//=$user_id ?><!--">-->
<!--                            <button type="submit" class="no-btn --><?//=is_like($post['id'] , $user_id)  ? 'active' : '' ?><!--"><i class="fas fa-heart"></i></button>-->
<!--                            --><?//=like_num($post['id'] ) ?>
<!--                        </form>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <p class="post-description">-->
<!--                    --><?//=$post['description'] ?>
<!--                </p>-->
<!--            </div>-->
<!--            --><?php //if($comments_num < 4) : ?>
<!--                <div class="comments">-->
<!--                    --><?php
//                    // $comments это Массив со всеми комментариями
//                    foreach($comments as $comment) :
//                        $user_info = user_by_id($comment['user_id']);
//                        if($user_info == null) {
//                            continue;
//                        }
//                        else {
//                    ?>
<!--                            <div class="comment">-->
<!--                                <div class="comment__avatar">-->
<!--                                    <img src="--><?//=$user_info['avatar'] ?><!--" alt="">-->
<!--                                </div>-->
<!--                                <div class="comment__body">-->
<!--                                    <h3 class="comment__name">--><?//=$user_info['username'] ?>
<!--                                    </h3>-->
<!--                                    <p class="comment__text">--><?//=$comment['text'] ?><!--</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <hr>-->
<!--                            --><?php
//                        }
//                    endforeach;
//                    ?>
<!--                    <form class="comments-form" action="/php/action/comment-handler.php?post_id=--><?//=$post['id'] ?><!--" method="post">-->
<!--                        --><?//=$_GET['comment'] == 'login_fail' ? "Вы не авторизованы <br>" : '' ?>
<!--                        --><?//=$_GET['comment'] == 'text_fail' ? "Слишком короткий комментарий (минимум 2 символа) <br>" : '' ?>
<!--                        --><?//=$_GET['comment'] == 'happy' ? "Спасибо за комментарий <br>" : '' ?>
<!--                        <input type="text" name="text"  placeholder="Ваш комментарий" class="form-control d-inline w-auto h-100">-->
<!--                        <button type="submit" class="btn btn-md btn-primary d-inline mh-100">Отправить</button>-->
<!--                    </form>-->
<!--                </div>-->
<!--            --><?php //else : ?>
<!--            <div class="post-comments col-5">-->
<!--                        <div class="comments">-->
<!--                            --><?php
//                            // $comments это Массив со всеми комментариями
//                            foreach($comments as $comment) :
//                                $user_info = user_by_id($comment['user_id']);
//                                if($user_info == null) {
//                                    continue;
//                                }
//                                else {
//                                ?>
<!--                                    <div class="comment">-->
<!--                                        <div class="comment__avatar">-->
<!--                                            <img src="--><?//=$user_info['avatar'] ?><!--" alt="">-->
<!--                                        </div>-->
<!--                                        <div class="comment__body">-->
<!--                                            <h3 class="comment__name">--><?//=$user_info['username'] ?>
<!--                                            </h3>-->
<!--                                            <p class="comment__text">--><?//=$comment['text'] ?><!--</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <hr>-->
<!--                                --><?php
//                                }
//                                endforeach;
//                                ?>
<!--                        </div>-->
<!---->
<!--                        <form class="comments-form" action="/php/action/comment-handler.php?post_id=--><?//=$post['id'] ?><!--" method="post">-->
<!--                            --><?//=$_GET['comment'] == 'login_fail' ? "Вы не авторизованы <br>" : '' ?>
<!--                            --><?//=$_GET['comment'] == 'text_fail' ? "Слишком короткий комментарий (минимум 2 символа) <br>" : '' ?>
<!--                            --><?//=$_GET['comment'] == 'happy' ? "Спасибо за комментарий <br>" : '' ?>
<!--                            <input type="text" name="text"  placeholder="Ваш комментарий" class="form-control d-inline w-auto h-100">-->
<!--                            <button type="submit" class="btn btn-md btn-primary d-inline mh-100">Отправить</button>-->
<!--                        </form>-->
<!--            </div>-->
<!--            --><?php
//            endif;
//            ?>
<!--    </div>-->
<!--</div>-->

<?php require '../includes/footer.php'; ?>