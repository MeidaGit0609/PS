<?php
require_once '../php/functions/user_functions.php';
require_once '../php/functions/posts_functions.php';
$page = !isset($_GET['page']) ? 1 : $_GET['page'];

if(isset($_GET['query'])) {
    $query = htmlspecialchars(trim($_GET['query']));

    if(strlen($query) > 0) {
        $users = get_users_by_search($query, $page);
    }
}

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

require_once '../php/config.php';
require_once '../php/functions/message_functions.php';
require_once '../php/functions/user_functions.php';
require_once '../includes/head.php';
?>
    <link rel="stylesheet" href="/resource/styles/users.css">
    </head>
    <body>
<?php require '../includes/header.php';?>

    <div class="container">
        <div class="users">
            <?php if(!empty($users)) :?>
                <?php foreach($users as $user) :?>
                    <div class="users__item">
                        <div class="users__left">
                            <a href="/pages/user.php?id=<?=$user['id'] ?>">
                                <img src="<?=$user['avatar'] ?>" alt="">
                            </a>
                        </div>
                        <div class="users__right">
                            <h3 class="users__name"><a href="/pages/user.php?id=<?=$user['id'] ?>"><?=$user['username'] ?></a></h3>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
            <div class="alert alert-warning">
                С вашим запросом что-то не так введите его снова
            </div>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php
            $prevPage = $page - 1;
            $nextPage = $page + 1;

            if($page < 2) :?>

            <?php else : ?>
                <a href="<?=str_ireplace("page=$page", "page=$prevPage", $current_url); ?>" class="pageBtn mr-3">Предыдущая страница </a>
            <?php endif; ?>


            <?php
            $forLimit = count($users) / $postsOnePage;
            $forLimit = ceil($forLimit);
            ?>
            <?php if($forLimit == 1) : ?>

            <?php else : ?>
                <?php for($i = 1; $i <= $forLimit;$i++) : ?>
                    <a href="<?=str_ireplace("page=$page", "page=$i", $current_url); ?>" class="mr-2"><?=$i;?> </a>
                <?php endfor; ?>
            <?php endif; ?>


            <?php if($page == $forLimit) :?>

            <?php else : ?>
                <?php
                ?>
                <a href="<?php
                if(isset($_GET['page'])) {
                    echo str_ireplace("page=$page", "page=$nextPage", $current_url);
                }
                else {
                    echo $current_url . "&page=$nextPage";
                }
                ?>" class="pageBtn ml-3">Следующая страница </a>
            <?php endif; ?>


        </div>

    </div>

<?php require '../includes/footer.php'; ?>