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
    <p>Ваше имя и фамилия: <?=$user['name_surname'] ?></p>
    <p>Ваш ник: <?=$user['username'] ?></p>
    <?PHP
    if($user['phone'] == 'Телефон не указан') {
        echo "<p>${user['phone']}</p>";
    }
    else {
        echo "<p>Ваш номер телефона: ${user['phone']}</p>";
    }
    ?>
    <p>Ваш электронный адрес: <?=$user['email'] ?></p>
    <a href="change_password.php">Изменить пароль</a>
</div>
<?php else : ?>
    <div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>
