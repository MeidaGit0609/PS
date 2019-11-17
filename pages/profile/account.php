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
    <p>Ваше имя и фамилия: <?=$user['name_surname'] ?> <a href="change_password.php">изменить имя и фамилию</a>  </p>
    <p>Ваш ник: <?=$user['username'] ?> <a href="change_password.php">изменить ник</a>  </p>
    <p>
    <?PHP
    if($user['phone'] == 'Телефон не указан') echo "${user['phone']}";
    else echo "Ваш номер телефона: ${user['phone']} ";
    ?>
    <a href="change_password.php">изменить номер телефона</a>
    </p>
    <p>Ваш электронный адрес: <?=$user['email'] ?> <a href="change_password.php">изменить email</a></p>
    <a href="change_password.php">изменить пароль</a>
</div>
<?php else : ?>
    <div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>
