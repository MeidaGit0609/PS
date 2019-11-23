<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/posts_functions.php'; ?>
<?php require_once '../php/functions/comment_functions.php'; ?>
<?php require_once '../php/functions/views_functions.php'; ?>
<?php require_once '../php/functions/subscribe_functions.php'; ?>
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
$author = user_by_id($post['user_id']);


// Добавляем просмотр
$views = add_views($post['views'], $post_id);
$comments_num = count($comments);
$likes = $post['likes'];
?>

<?php if(isset($post)) : ?>
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

                    <?php if(like_num($post['id']) > 0) :?>
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
                    <?php endif; ?>

                </div>
            <?php else: ?>
                <button class="like post-stat__item no-btn" data-toggle="modal" data-target="#account_fail">
                    <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30"><?=like_num($post['id'] ) ?>

                    <?php if(like_num($post['id']) > 0) :?>
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
                    <?php endif; ?>
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

            <?php if($post_id == $user['id'] || $user['is_admin'] == 1) :?>
                <form class="post-stat__item" method="post" action="/php/action/delete-post.php">
                    <input type="hidden" name="post_id" value="<?=$post_id ?>">
                    <button type="submit">Удалить пост</button>
                </form>
            <?php endif;?>

        </div>

    </div>
    <div class="post__right">

        <div class="author">
            <a class="author__avatar" href="/pages/user.php?id=<?=$author['id'] ?>">
                <img src="<?=$author['avatar'] ?>" alt="">
            </a>
            <a class="author__username" href="/pages/user.php?id=<?=$author['id'] ?>">
                <b><?=$author['username'] ?> &middot;</b>
<!--                Проверка не подписаны ли вы уже-->
                <?php if($user['id'] != $author['id'] && is_subscribe($user['id'], $author['id']) != true) : ?>
                <a href="/php/action/subscribe.php?subscriber_id=<?=$user['id'] ?>&subscribe_object=<?=$author['id'] ?>">Подписаться</a>
                <?php endif; ?>

                <?php if(is_subscribe($user['id'], $author['id']) == true) : ?>
                    <a href="/php/action/subscribe.php?subscriber_id=<?=$user['id'] ?>&subscribe_object=<?=$author['id'] ?>&unsubscribe=1">Отписаться</a>
                <?php endif; ?>

            </a>
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

                    <?php if(like_num($post['id']) > 0) :?>
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
                    <?php endif; ?>

                </div>
            <?php else: ?>
            <div class="like post-stat__item">
                <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="30">
                <?=like_num($post['id'] ) ?>

                <?php if(like_num($post['id']) > 0) :?>
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
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if($post_id == $user['id'] || $user['is_admin'] == 1) :?>
                <form class="post-stat__item" method="post" action="/php/action/delete-post.php">
                    <input type="hidden" name="post_id" value="<?=$post_id ?>">
                    <button type="submit">Удалить пост</button>
                </form>
            <?php endif;?>


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
<!--            Описание поста-->
            <?php if(strlen($post['description']) > 1) : ?>
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
            <?php else: ?>
                <div class="comments__item">
                    <p>Описание отсутствует</p>

                </div>
            <?php endif; ?>

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
                        <b class="comments__name"><i><?=substr($comment['datetime'], 0, 10)  ?></i> <?=$user_info['username'] ?></b>
                        <?=$comment['text'] ?>
                    </p>
                    <div class="comments__stat">

                        <?php if(isset($user_id)) : ?>
                        <form action="/php/action/comment_like.php" method="post">
                            <input type="hidden" name="user_id" value="<?=$user_id ?>">
                            <input type="hidden" name="comment_id" value="<?=$comment['id'] ?>">
                            <button type="submit" class="no-btn no-padding">
<!--                            Проверка не лайкнул пользователь этот комментарий-->

                                <?php if(he_like_comment($user_id, $comment['id'])): ?>
                                    <img src="/resource/img/icons/like.svg" alt="" WIDTH="20">
                                <?php else: ?>
                                    <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="20">
                                <?php endif; ?>

                            </button>
                            <?=comments_like_num($comment['id'], $user_id) ?>
                        </form>
                        <?php else: ?>
                        <div>
<!--                        Проверка не лайкнул пользователь этот комментарий-->

                            <?php if(he_like_comment($user_id, $comment['id'])): ?>
                                <img src="/resource/img/icons/like.svg" alt="" width="20">
                            <?php else: ?>
                                <img src="/resource/img/icons/like_dis.svg" alt="" width="20">
                            <?php endif; ?>

                            <?=comments_like_num($comment['id'], $user_id) ?>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($comment['user_id'] == $user['id']) :?>
                            <a href="/php/action/delete-comment.php?comment_id=<?=$comment['id'] ?>" class="delete-icon">
                                <img src="/resource/img/icons/rubbish-bin.svg" alt="" width="20">
                            </a>
                        <?php endif; ?>
                    </div>

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
    </div> <!--/ .post__right-->
</div> <!--/ .post-->
<?php else: ?>
<div class="alert alert-danger">Пост не найден</div>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>