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
        <form action="/php/action/changes/change_name_surname-handler.php" class="form" method="post">
            <div class="form-group">
                <?=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно изменили имя и фамилию</div>' : ''?>
                <?=$_GET['change'] == 'name_surname-fail' ? '<div class="alert alert-danger">Поле заполнено неверно</div>' : ''?>
                <?=$_GET['change'] == 'input_fail' ? '<div class="alert alert-danger">Заполните поле</div>' : ''?>
                <input type="text" name="new_name_surname" class="form-control mb-3" placeholder="Новые имя и фамилия" required>
                <button class="btn btn-md btn-success">Отправить</button>
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>