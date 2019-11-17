<?php require_once 'php/config.php'; ?>
<?php require_once 'php/functions/user_functions.php'; ?>
<?php require_once 'php/functions/posts_functions.php'; ?>
<?php require_once 'php/functions/comment_functions.php'; ?>
<?php require_once 'php/functions/like_functions.php'; ?>
<?php require_once 'includes/head.php'; ?>
</head>
<body>
<?php require 'includes/header.php'; ?>
<div class="container mt-5">
    <div class="row">
        <?php
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }



        $user_id = $_COOKIE['user'];

        $posts = get_posts($page);
        foreach($posts as $post) :
        $comments = get_post_comment($post['id']);
        $comments_num = count($comments);
        ?>
            <div class="col-md-4 col-sm-6 col-12 mini-post post mb-4">
                <a class="post_img w-100" href="/pages/post.php?id=<?=$post['id'] ?>">
                    <img class="w-100 d-block" src="<?=$post['image'] ?>" alt="">

                    <div class="stat w-100 h-100 post_sub">
                        <span class="views stat_item"><i class="fas fa-comments"></i> <?=$comments_num ?></span>
                        <!-- like  -->
                        <form action="/php/action/like.php" method="post" class="like stat_item">
                            <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                            <input type="hidden" name="post_id" value="<?=$post['id'] ?>">
                            <input type="hidden" name="user_id" value="<?=$user_id ?>">
                            <button type="submit" class="no-btn <?=is_like($post['id'] , $user_id)  ? 'active' : '' ?>"><i class="fas fa-heart"></i> </button>
                            <?=like_num($post['id'] ) ?>
                        </form>
                    </div>

                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row justify-content-center">
        <div class="pagination">
            <?php if($page < 2) :?>

            <?php else : ?>
                <a href="?page=<?=$page - 1;?>" class="pageBtn mr-3">Предыдущая страница </a>
            <?php endif; ?>


            <?php
            $forLimit = posts_num() / $postsOnePage;
            $forLimit = ceil($forLimit);
            ?>

            <?php if($forLimit == 1) : ?>

            <?php else : ?>
                <?php for($i = 1; $i <= $forLimit;$i++) : ?>
                    <a href="?page=<?=$i;?>" class="mr-2"><?=$i;?> </a>
                <?php endfor; ?>
            <?php endif; ?>


            <?php if($page == $forLimit) :?>

            <?php else : ?>
                <a href="?page=<?=$page + 1;?>" class="pageBtn ml-3">Следующая страница </a>
            <?php endif; ?>


        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<?php require 'includes/footer.php'; ?>