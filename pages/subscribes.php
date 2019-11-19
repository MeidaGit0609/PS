<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/subscribe_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/users.css">
</head>
<body>
<?php require '../includes/header.php'; ?>

    <div class="container">
        <div class="users">
            <h1 class="users__title">Ваши подписки: </h1>
            <?php
            $subscribes = get_subscribes($user['id']);

            foreach($subscribes as $subscribe) :?>
                <div class="users__item">
                    <div class="users__left">
                        <a href="/pages/user.php?id=<?=$subscribe['id'] ?>">
                            <img src="<?=$subscribe['avatar'] ?>" alt="">
                        </a>
                    </div>
                    <div class="users__right">
                        <h3 class="users__name"><a href="/pages/user.php?id=<?=$subscribe['id'] ?>"><?=$subscribe['username'] ?></a></h3>
                        <p class="users__status"><?=$subscribe['status'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>

<?php require '../includes/footer.php'; ?>