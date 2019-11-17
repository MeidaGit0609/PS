<?php
require_once '../../php/config.php';
require_once '../../php/functions/posts_functions.php';
require_once '../../php/functions/user_functions.php';
require_once '../../php/functions/comment_functions.php';
require_once '../../php/functions/like_functions.php';
require_once '../../includes/head.php';
?>
    <style>
        b {
            font-weight: 600;
        }

        .stat_item {
            margin-left: 10px;
        }
        .stat_item:first-child {
            margin-left: 0;
        }

        .user__username {
            color: rgba(38, 38, 38, 0.38);
            font-weight: 300;
        }
        .avatar {
            width: 200px;
            max-width: 100%;
            height: auto;
        }
        .avatar img {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .user__username {
            color: rgba(38,38,38,0.3);
        }

        .user__public-count {
            color: #262626;
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
    </style>
</head>
<body>
<?php
require_once '../../includes/header.php';

$user_id = $_COOKIE['user'];
if($user_id) :
?>
<header class="profile-header mt-5">
    <div class="container">
        <div class="row mb-5">
            <? $user_info = user_by_id($user_id); ?>
            <div class="col-2 mr-2">
                <div class="avatar">
                    <img src="<?=$user_info['avatar'] ?>" alt="">
                </div>
            </div>
            <div class="col">
                <h1 class="user__username"><?=$user_info['username'] ?></h1>
                <div class="user__public-count mt-4 mb-4">
                    <?php $posts_counter = user_posts_counter($user_id); ?>
                    <b><?=$posts_counter ?></b> Публикация
                </div>
                <div class="user__name"><b><?=$user_info['name_surname'] ?></b></div>

                <form action="/php/action/add_avatar.php?user_id=<?=$user_id ?>" method="post" enctype="multipart/form-data" class="mt-2">
                    Загрузить аватар <br>
                    <?=$_GET['upload'] == 'expansion_false' ? 'Невозможно загружпть файлы такого типа в целях безопасности<br>' : '' ?>
                    <?=$_GET['upload'] == 'mime_false' ? 'Невозможно загружпть файлы такого типа в целях безопасности<br>' : '' ?>
                    <?=$_GET['upload'] == 'happy' ? 'Аватар успешно сменён<br>' : '' ?>
                    <?=$_GET['upload'] == 'big' ? 'Фото весит слишком много<br>' : '' ?>
                    <input type="file" name="avatar">
                    <button type="submit" name="enter">Загрузить</button>
                </form>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Аккаунт</a>
                    </li>
                </ul>
            </div>
        </nav>
        <hr>
        <div class="user_posts mt-5">
            <a class="btn btn-md btn-primary" href="/pages/add_post.php">Добавить пост</a>
            <div class="row mt-5">
                <?php
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                else {
                    $page = 1;
                }


                $posts = get_user_posts($page, $user_id);
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
                                <button type="submit" class="no-btn stat_item <?=is_like($post['id'] , $user_id)  ? 'active' : '' ?>"><i class="fas fa-heart"></i> </button>
                                <?=like_num($post['id'] ) ?>
                            </form>

                        </div>
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
                    $forLimit = user_posts_counter($user_info['id']) / $postsOnePage;
                    $forLimit = ceil($forLimit);
                    ?>

                    <?php if($forLimit == 1) : ?>

                    <?php else : ?>
                        <?php for($i = 1; $i <= $forLimit;$i++) : ?>
                            <a href="?page=<?=$i;?>" class="mr-2"><?=$i;?> </a>
                        <?php endfor; ?>
                    <?php endif; ?>


                    <?php if($page == $forLimit || $page > $forLimit) :?>

                    <?php else : ?>
                        <a href="?page=<?=$page + 1;?>" class="pageBtn ml-3">Следующая страница</a>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
</header>
<?php else : ?>
<div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>

<? require_once '../../includes/footer.php'; ?>