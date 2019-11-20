<?php require_once '../php/config.php'; ?>
<?php require_once '../php/functions/message_functions.php'; ?>
<?php require_once '../php/functions/user_functions.php'; ?>
<?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="/resource/styles/messages.css">
    </head>
    <body>
<?php
require '../includes/header.php';

$messages = get_dialogs($user_id);
?>

    <div class="container">
        <pre>
            <?php

            // Записываю в отдельный массив id всех оппонентов переписок
            for($i = 0;$i < count($messages);$i++) {
                if($messages[$i]['sender_id'] == $user_id) {
                    $apponent_id[] = $messages[$i]['recipient_id'];
                }
                else {
                    $apponent_id[] = $messages[$i]['sender_id'];
                }
            }

            $apponent_id = array_unique($apponent_id); // Удаляю повторяющиеся id

            // Записываю с нормальными ключами
            foreach($apponent_id as $apponent_id_i) {
                $dialogs[] = $apponent_id_i;
            }
            // Записываю данные пользователей
            for($i = 0;$i < count($dialogs);$i++) {
                $dialogs_users[] = user_by_id($dialogs[$i]);
            }
            ?></pre>

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