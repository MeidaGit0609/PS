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
        <form action="/php/action/changes/change_password-handler.php?user_id=<?=$user_id ?>" class="form" method="post">
            <div class="form-group">
                <?=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно поменяли пароль</div>' : ''?>
                <?=$_GET['change'] == 'pass_repeating' ? '<div class="alert alert-danger">Старый и новый пароли одинаковые</div>' : ''?>
                <?=$_GET['change'] == 'very_big' ? '<div class="alert alert-danger">Пароль слишком длинный</div>' : ''?>

                <?php
                if($user['is_admin'] == 1 && $user_id != $user['id']) : // Если ты админ и это не твой аккаунт тебе не придётся вводить старый пароль?>
                    <input type="password" name="new_pass" class="form-control mb-3" placeholder="Новый пароль" required>
                    <?=$_GET['change'] == 'pass_repeat-fail' ? '<div class="alert alert-danger">Пароли не совпадают </div>' : ''?>
                    <input type="password" name="new_pass-repeat" class="form-control mb-3" placeholder="Повторите новый пароль" required>

                <?php else: ?>
                    <input type="password" name="old_pass" class="form-control mb-3" placeholder="Старый пароль" required>
                    <?=$_GET['change'] == 'old_pass-fail' ? '<div class="alert alert-danger">Нынешний пароль введйн неверно </div>' : ''?>
                    <input type="password" name="new_pass" class="form-control mb-3" placeholder="Новый пароль" required>
                    <?=$_GET['change'] == 'pass_repeat-fail' ? '<div class="alert alert-danger">Пароли не совпадают </div>' : ''?>
                    <input type="password" name="new_pass-repeat" class="form-control mb-3" placeholder="Повторите новый пароль" required>
                <?php endif;?>
                <button class="btn btn-md btn-success">Отправить</button>
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="alert">Неправильный адрес</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>