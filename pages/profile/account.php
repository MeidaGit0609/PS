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

$user_info = user_by_id($_GET['user_id']); // массив пользователя информацию которого мы выводим
if($user_info) :
?>
<div class="container">
    <?php if($user['is_admin'] == 1 || $user_info['id'] == $user['id']) :?>
        <p>Ваше имя и фамилия: <?=$user_info['name_surname'] ?> <a href="change_name-surname.php?user_id=<?=$user_info['id'] ?>">изменить имя и фамилию</a>  </p>
        <p>Ваше имя пользователя: <?=$user_info['username'] ?> <a href="change_username.php?user_id=<?=$user_info['id'] ?>">изменить имя пользователя</a>  </p>
        <p>
        <?PHP
        if($user['phone'] == 'Телефон не указан') echo "${user['phone']}";
        else echo "Ваш номер телефона: ${user['phone']} ";
        ?>
        <a href="change_phone.php?user_id=<?=$user_info['id'] ?>">изменить номер телефона</a>
        </p>
        <p>Ваш электронный адрес: <?=$user_info['email'] ?> <a href="change_email.php?user_id=<?=$user_info['id'] ?>">изменить email</a></p>
        <a href="change_password.php?user_id=<?=$user_info['id'] ?>">изменить пароль</a>
        <br>
        <?php if($user_info['id'] == $user_id) :?>
            <button class="btn btn-md btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">Выйти из аккаунта</button>
        <?php endif; ?>
    <?php else: ?>
    <p>Вы не являетесь адмиином, чтобы видеть эту информацию</p>
    <?php endif; ?>
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
    <div class="alert">Информации о таком пользователе не существует</div>
<?php endif; ?>


<script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>
