<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/posts_functions.php'; ?>
<?php require_once '../php/functions/comment_functions.php'; ?>
<?php require_once '../php/functions/like_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>

    <style>
        .pageBtn {
            padding: 5px;
            transform: translateY(-5px);

            border: #d2d2d2;
            background-color: #d2d2d2;
        }

        .like {
            display: inline-block;
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
            margin-left: 10px;
        }
        .stat_item:first-child {
            margin-left: 0;
        }

        /*.like i {*/
        /*    color: #d2d2d2;*/
        /*    font-size: 20px;*/
        /*}*/

        /*.like.active i {*/
        /*    color: #ed4956;*/
        /*}*/
    </style>
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
                <div class="col-md-4 col-sm-6 col-12 post mb-4">
                    <a class="post_img w-100" href="/pages/post.php?id=<?=$post['id'] ?>">
                        <img class="w-100" src="<?=$post['image'] ?>" alt="">
                    </a>
                    <div class="stat mt-1">
                        <span class="views stat_item"><i class="fas fa-eye"></i> <?=$post['views'] ?></span>
                        <span class="views stat_item"><i class="fas fa-comments"></i> <?=$comments_num ?></span>
                        <form action="/php/action/like.php" method="post" class="like">
                            <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                            <input type="hidden" name="post_id" value="<?=$post['id'] ?>">
                            <input type="hidden" name="user_id" value="<?=$user_id ?>">
                            <button type="submit" class="no-btn <?=is_like($post['id'] , $user_id)  ? 'active' : '' ?>"><i class="fas fa-heart"></i> </button>
                            <?=like_num($post['id'] ) ?>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<?php require '../includes/footer.php'; ?>