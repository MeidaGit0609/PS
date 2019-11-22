<?php
require_once '../php/functions/user_functions.php';

if(isset($_GET['query'])) {
    $query = htmlspecialchars(trim($_GET['query']));

    if(strlen($query) > 0) {
        $users = get_users_by_search($query);
    }
}


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
    </div>

<?php require '../includes/footer.php'; ?>