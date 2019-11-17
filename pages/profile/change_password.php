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

$user_id = $_COOKIE['user'];
if($user_id) :
    ?>
    <div class="container mt-5">
        <form action="/php/action/change_password-handler.php" class="form" method="post">
            <div class="form-group">
                <?=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно поменяли пароль</div>' : ''?>
                <?=$_GET['change'] == 'pass_repeating' ? '<div class="alert alert-danger">Старый и новый пароли одинаковые</div>' : ''?>
                <input type="password" name="old_pass" class="form-control mb-3" placeholder="Старый пароль" required>
                <?=$_GET['change'] == 'old_pass-fail' ? '<div class="alert alert-danger">Нынешний пароль введйн неверно </div>' : ''?>
                <input type="password" name="new_pass" class="form-control mb-3" placeholder="Новый пароль" required>
                <?=$_GET['change'] == 'pass_repeat-fail' ? '<div class="alert alert-danger">Пароли не совпадают </div>' : ''?>
                <input type="password" name="new_pass-repeat" class="form-control mb-3" placeholder="Повторите новый пароль" required>
                <button class="btn btn-md btn-success">Отправить</button>
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>