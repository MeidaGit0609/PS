<?php
require_once '../../php/config.php';
require_once '../../php/functions/posts_functions.php';
require_once '../../php/functions/user_functions.php';
require_once '../../php/functions/comment_functions.php';
require_once '../../php/functions/like_functions.php';
require_once '../../includes/head.php';
?>
</head>
<body>
<?php
require_once '../../includes/header.php';

$user_id = $_COOKIE['user'];
if($user_id) :
?>
<div class="container">
    <p>Ваше имя и фамилия: <?=$user['name_surname'] ?> <a href="change_name-surname.php">изменить имя и фамилию</a>  </p>
    <p>Ваше имя пользователя: <?=$user['username'] ?> <a href="change_username.php">изменить имя пользователя</a>  </p>
    <p>
    <?PHP
    if($user['phone'] == 'Телефон не указан') echo "${user['phone']}";
    else echo "Ваш номер телефона: ${user['phone']} ";
    ?>
    <a href="change_phone.php">изменить номер телефона</a>
    </p>
    <p>Ваш электронный адрес: <?=$user['email'] ?> <a href="change_email.php">изменить email</a></p>
    <a href="change_password.php">изменить пароль</a>
    <br>
    <button class="btn btn-md btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">Выйти из аккаунта</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Вы точно хотите выйти из аккаунта?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                <a href="../exit.php" type="button" class="btn btn-dark">Да</a>
            </div>
        </div>
    </div>
</div>

<?php else : ?>
    <div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>
