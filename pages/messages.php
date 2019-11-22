<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/message_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/messages.css">
    </head>
    <body>
<?php
require '../includes/header.php';


?>

    <div class="container">
            <?php
            $dialogs_users = get_dialogs($user_id);
            ?>

            <div class="messages">
                <?php foreach($dialogs_users as $dialogs_user) :?>
                    <div class="messages__item">
                        <a class="messages__avatar" href="/pages/user.php?id=<?=$dialogs_user['id'] ?>">
                            <img src="<?=$dialogs_user['avatar'] ?>" alt="">
                        </a>
                        <div class="messages__right" >
                            <a class="messages__name" href="/pages/user.php?id=<?=$dialogs_user['id'] ?>"><?=$dialogs_user['username'] ?></a>
                        </div>
                        <a href="/pages/dialog.php?id=<?=$dialogs_user['id'] ?>" class="messages__link"></a>
                    </div>
                <?php endforeach; ?>
            </div>


    </div>

<?php require '../includes/footer.php'; ?>