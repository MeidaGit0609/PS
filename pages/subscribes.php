<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/subscribe_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../php/functions/subscribe_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/users.css">
</head>
<body>
<?php require '../includes/header.php'; ?>

    <div class="container">
        <?php if(user_by_id($user['id']) != null): ?>
            <div class="users">
                <h1 class="users__title">Подписки: </h1>
                <?php
                $subscribes = get_subscribes($user['id']);
                if(is_array($subscribes) && count($subscribes) > 0) {
                    foreach ($subscribes as $subscribe) :?>
                        <div class="users__item">
                            <div class="users__left">
                                <a href="/pages/user.php?id=<?= $subscribe['id'] ?>">
                                    <img src="<?= $subscribe['avatar'] ?>" alt="">
                                </a>
                            </div>
                            <div class="users__right">
                                <h3 class="users__name"><a
                                            href="/pages/user.php?id=<?= $subscribe['id'] ?>"><?= $subscribe['username'] ?></a>
                                </h3>
                                <p class="users__status"><?= $subscribe['status'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>

            </div>
        <?php else: ?>
            <div class="alert alert-info">Вы не зарегистрированы</div>
        <?php endif; ?>
    </div>

<?php require '../includes/footer.php'; ?>