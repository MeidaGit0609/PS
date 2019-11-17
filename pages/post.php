<?php require_once '../php/functions/posts_functions.php'; ?>
<?php require_once '../php/functions/comment_functions.php'; ?>
<?php require_once '../php/functions/views_functions.php'; ?>
<?php require_once '../php/functions/like_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <style>
        .like {
            transform: translateY(-4px);
        }

        .like button {
            padding: 0;

            background: none;
            border: none;

            color: #d2d2d2;
            font-size: 20px;
        }

        .like .active {
            color: #ed4956;
        }

        .stat_item {
            margin-left: 20px;
        }
        .stat_item:first-child {
            margin-left: 0;
        }

        .modal-dialog {
            max-width: 100% !important;
        }

        .post-modal {
            min-width: 60vw;
            max-width: 95vw;
        }

        .post-modal-mini {
            max-width: 600px;
        }

        .modal__img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .comments {
            /*max-height: 100%;*/
        }

        .post-comments {
            min-height: 100px;
            max-height: 600px;
            position: relative;
        }

        .comments-wrapper {
            overflow: auto;
            max-height: calc(100% - 30px);
        }

        .comments-form {
            height: 30px;

            position: absolute;
            bottom: 16px;
            left: 15px;
        }

        .comment {
            padding-left: 65px;

            position: relative;
        }

        .comment__avatar {
            width: 50px;
            height: 50px;

            position: absolute;
            top: 0;
            left: 0;
        }

        .comment__avatar img {
            width: 100%;
            height: auto;
            display: block;

            border-radius: 50%;
        }

        .comment__name {
            margin: 0;
            font-weight: 600;
            font-size: 17px;
            color: #000000a3;
        }
    </style>
</head>
<body>
<?php require '../includes/header.php'; ?>

<?php
$user_id = isset($_COOKIE['user']) ? $_COOKIE['user'] : null;
$post_id  = $_GET['id'];
$post = get_post_by_id($post_id); // Массив с информацией о посте
$comments = get_post_comment($post_id); // Массив со всеми комментариями

$likes = $post['likes'];

// Добавляем просмотр
$views = add_views($post['views'], $post_id);
$comments_num = count($comments);
?>

<div class="">
    <div class="modal-dialog row justify-content-center" role="document">
        <div class="modal-content <?=$comments_num > 4 ? 'post-modal row flex-row' : 'post-modal-mini ' ?>">
            <div class="modal-body <?=$comments_num > 4 ? 'col-6' : '' ?> modal__img">
                <div class="photo">
                    <img src="<?=$post['image'] ?>" alt="" class="block">
                </div>
                <div class="stat row mt-3 ml-2">
                    <span class="views stat_item"><i class="fas fa-eye"></i> <?=$post['views'] ?> </span>
                    <span class="views stat_item"><i class="fas fa-comments"></i> <?=$comments_num ?></span>

                    <div class="like stat_item">
                        <form action="/php/action/like.php" method="post">
                            <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                            <input type="hidden" name="post_id" value="<?=$post['id']  ?>">
                            <input type="hidden" name="user_id" value="<?=$user_id ?>">
                            <button type="submit" class="no-btn <?=is_like($post['id'] , $user_id)  ? 'active' : '' ?>"><i class="fas fa-heart"></i></button>
                            <?=like_num($post['id'] ) ?>
                        </form>

                    </div>
                </div>
                <p class="post-description">
                    <?=$post['description'] ?>
                </p>
            </div>
            <?php if($comments_num < 4) : ?>
                <div class="comments modal-body">
                    <?php
                    // $comments это Массив со всеми комментариями
                    foreach($comments as $comment) :
                        $user_info = user_by_id($comment['user_id']);
                        if($user_info == null) {
                            continue;
                        }
                        else {
                            ?>
                            <div class="comment">
                                <div class="comment__avatar">
                                    <img src="<?=$user_info['avatar'] ?>" alt="">
                                </div>
                                <div class="comment__body">
                                    <h3 class="comment__name"><?=$user_info['username'] ?>
                                    </h3>
                                    <p class="comment__text"><?=$comment['text'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                    endforeach;
                    ?>
                    <form class="" action="/php/action/comment-handler.php?post_id=<?=$post['id'] ?>" method="post">
                        <?=$_GET['comment'] == 'login_fail' ? "Вы не авторизованы <br>" : '' ?>
                        <?=$_GET['comment'] == 'text_fail' ? "Слишком короткий комментарий (минимум 2 символа) <br>" : '' ?>
                        <?=$_GET['comment'] == 'happy' ? "Спасибо за комментарий <br>" : '' ?>
                        <input type="text" name="text" placeholder="Ваш комментарий" class="form-control d-inline">
                        <button type="submit" class="btn btn-md btn-primary mt-2">Отправить</button>
                    </form>
                </div>
            <?php else : ?>
            <div class="post-comments modal-body col-5">
                    <div class="comments-wrapper">
                        <div class="comments">
                            <?php
                            // $comments это Массив со всеми комментариями
                            foreach($comments as $comment) :
                                $user_info = user_by_id($comment['user_id']);
                                if($user_info == null) {
                                    continue;
                                }
                                else {
                                ?>
                                    <div class="comment">
                                        <div class="comment__avatar">
                                            <img src="<?=$user_info['avatar'] ?>" alt="">
                                        </div>
                                        <div class="comment__body">
                                            <h3 class="comment__name"><?=$user_info['username'] ?>
                                            </h3>
                                            <p class="comment__text"><?=$comment['text'] ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                }
                                endforeach;
                                ?>
                        </div>

                        <form class="comments-form" action="/php/action/comment-handler.php?post_id=<?=$post['id'] ?>" method="post">
                            <?=$_GET['comment'] == 'login_fail' ? "Вы не авторизованы <br>" : '' ?>
                            <?=$_GET['comment'] == 'text_fail' ? "Слишком короткий комментарий (минимум 2 символа) <br>" : '' ?>
                            <?=$_GET['comment'] == 'happy' ? "Спасибо за комментарий <br>" : '' ?>
                            <input type="text" name="text"  placeholder="Ваш комментарий" class="">
                            <button type="submit">Отправить</button>
                        </form>
                    </div>
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<?php require '../includes/footer.php'; ?>