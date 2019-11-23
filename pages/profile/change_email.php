<?php
require_once '../../php/config.php';
require_once '../../php/functions/posts_functions.php';
require_once '../../php/functions/user_functions.php';
require_once '../../php/functions/comment_functions.php';
require_once '../../php/functions/like_functions.php';
require_once '../../includes/head.php';
?>
    <style>
        .form {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
    </head>
    <body>
<?php
require_once '../../includes/header.php';

$user_id = $_GET['user_id'];
if($user_id && $user['id'] == $user_id || $user['is_admin'] == 1) : // Может ли пользователь менять эту информацию
?>
    <div class="container mt-5">
        <?php if($_GET['change'] == 'give_code') : ?>
            <form action="/php/action/changes/change_email-code_handler.php?user_id=<?=$user_id ?>" class="form" method="post">
                <div class="form-group">
<!--                    --><?//=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно изменили email</div>' : ''?>
                    <input type="text" name="code" class="form-control mb-3" placeholder="Введите код отправленный на почту" required>
                    <button class="btn btn-md btn-primary">Отправить</button>
                </div>
            </form>
        <?php else : ?>
            <form action="/php/action/changes/change_email-handler.php?user_id=<?=$user_id ?>" class="form" method="post">
                <div class="form-group">
                    <?=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно изменили email</div>' : ''?>
                    <?=$_GET['change'] == 'email-fail' ? '<div class="alert alert-danger">Email Введён неверно</div>' : ''?>
                    <?=$_GET['change'] == 'input_fail' ? '<div class="alert alert-danger">Заполните поле</div>' : ''?>
                    <?=$_GET['change'] == 'very_big' ? '<div class="alert alert-danger">Email слишком длинноый</div>' : ''?>
                    <?=$_GET['change'] == 'uncorrect' ? '<div class="alert alert-danger">Это ваш нынешний email</div>' : ''?>
                    <?=$_GET['change'] == 'code_false' ? '<div class="alert alert-danger">Вы ввели неверный код</div>' : ''?>
                    <input type="text" name="new_email" class="form-control mb-3" placeholder="Новый email" required>
                    <button class="btn btn-md btn-success">Отправить</button>
                </div>
            </form>
        <?php endif; ?>

    </div>
<?php else : ?>
    <div class="alert">Неправильный адрес</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>