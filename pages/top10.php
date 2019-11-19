<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/posts_functions.php'; ?>
<?php require_once '../php/functions/comment_functions.php'; ?>
<?php require_once '../php/functions/like_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/index-page.css">
</head>
<body>
<?php require '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <?php



            $user_id = $_COOKIE['user'];

            $posts = get_top_posts(10);
            foreach($posts as $post) :
                $comments = get_post_comment($post['id']);
                $comments_num = count($comments);
                ?>
                <div class="col-md-4 col-sm-6 col-12 mini-post post mb-4">
                    <a class="post_img w-100" href="/pages/post.php?id=<?=$post['id'] ?>">
                        <img class="w-100 d-block" src="<?=$post['image'] ?>" alt="">

                        <div class="stat w-100 h-100 post_sub">
                        <span class="views stat_item">
                            <img src="/resource/img/icons/comment-white.svg" width="50" class="comment_icon">
                            <?=$comments_num ?>
                        </span>
                            <!-- like  -->
                            <?php if(isset($_COOKIE['user'])) : ?>
                                <form action="/php/action/like.php" method="post" class="like stat_item">
                                    <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                                    <input type="hidden" name="post_id" value="<?=$post['id'] ?>">
                                    <input type="hidden" name="user_id" value="<?=$user_id ?>">
                                    <button type="submit" class="no-btn">
                                        <?php if(is_like($post['id'], $user_id)) :?>
                                            <img src="/resource/img/icons/like.svg" alt="" WIDTH="45">
                                        <?php else :?>
                                            <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="45">
                                        <?php endif; ?>
                                    </button>
                                    <?=like_num($post['id'] ) ?>
                                </form>
                            <?php else: ?>
                                <div class="like stat_item">
                                    <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="45">
                                    <?=like_num($post['id'] ) ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php require '../includes/footer.php'; ?>