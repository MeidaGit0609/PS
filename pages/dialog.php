<?php
require_once '../php/config.php';
require_once '../php/functions/message_functions.php';
require_once '../php/functions/user_functions.php';
require_once '../includes/head.php';
?>
    <link rel="stylesheet" href="/resource/styles/dialog.css">
    </head>
    <body>
<?php require_once '../includes/header.php';?>
<?php
$recipient_id    = $_GET['id'];
$sender_id       = $user_id;

$opponent = user_by_id($recipient_id);

if($user_id) : ?>

<div class="container-mini">
    <div class="dialog">
        <header class="dialog__header">
            <div class="dialog__opponent">
                <a class="avatar d-block" href="/pages/user.php?id=<?=$opponent['id'] ?>">
                    <img src="<?=$opponent['avatar'] ?>" alt="">
                </a>
                <a class="dialog__opponent-name d-block" href="/pages/user.php?id=<?=$opponent['id'] ?>"><?=$opponent['username'] ?></a>
            </div>
        </header>
        <div class="dialog__body">

            <?php
            $messages = get_message($recipient_id, $sender_id);
            foreach($messages as $message) :

            $user_info = user_by_id($message['sender_id']);
            ?>
            <div class="message">
                <div class="message__avatar">
                    <img src="<?=$user_info['avatar'] ?>" alt="">
                </div>
                <div class="message__text">
                    <div class="message__name"><?=$user_info['username'] ?></div>
                    <div class="message__message"><?=$message['text'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <form class="dialog__footer" action="/php/action/message-handler.php" method="post">
            <input type="text" name="message" class="text-input" placeholder="Ваше сообщение">
            <input type="hidden" name="sender_id" value="<?=$sender_id ?>">
            <input type="hidden" name="recipient_id" value="<?=$recipient_id ?>">
            <button type="submit" class="btn btn-md btn-primary">Отправить</button>
        </form>
    </div>
</div>

<?php else : ?>
    <div class="alert">Вы не зарегистрированы</div>
<?php endif; ?>



<? require_once '../includes/footer.php'; ?>