<?php require_once '../includes/head.php';  ?>
</head>
<body>
<?php require_once '../includes/header.php';  ?>
<div class="form">
    <div class="container">
        <div class="row">
            <div class="card card-primary">
                <div class="card-body">
                    <?php if($_GET['regist'] == 'code') : ?>
                        <form action="/php/action/registr_code-handler.php" class="form-group" method="post">
                            <h3>Введите отправленный на вашу почту код подтверждения</h3>
                            <?=$_GET['regist'] == 'code_false' ? '<div class="alert alert-danger">Вы неправильно ввели код подтверждения </div>' : ''?>
                            <input name="code" type="text" class="form-control" required>

                            <button id="signupSubmit" type="submit" class="btn btn-info">Отправить код подтверждения</button>
                        </form>
                    <?php else: ?>
                        <form method="POST" action="/php/action/registr-handler.php" role="form">
                            <div class="form-group">
                                <h2>Создайте аккаунт</h2>
                            </div>
                            <div class="form-group">

                                <?=$_GET['regist'] == 'happy' ? '<div class="alert alert-success">Поздравляем вы зарегистрированы </div>' : ''?>

                                <?=$_GET['regist'] == 'user_repeat' ? '<div class="alert alert-warning">Вы уже зарегистрированы </div>' : ''?>

                                <?=$_GET['regist'] == 'name_surname-fail' ? '<div class="alert alert-danger">Неправильно введены имя и фамилия </div>' : ''?>

                                <label class="control-label" for="signupName">Ваше имя и фамилия</label>
                                <input id="signupName" type="text" name="name_and_surname" class="form-control" required>
                            </div>
                            <div class="form-group">


                                <?=$_GET['regist'] == 'email-fail' ? '<div class="alert alert-danger">Email введён неверно </div>' : ''?>

                                <label class="control-label" for="signupEmail">Email</label>
                                <input id="signupEmail" name="email" type="text" maxlength="50" class="form-control" required>
                            </div>
                            <div class="form-group">

                                <?=$_GET['regist'] == 'username-fail' ? '<div class="alert alert-danger">Имя пользователя введено неверно </div>' : ''?>

                                <label class="control-label" for="signupEmailagain">Имя пользователя</label>
                                <input id="signupEmailagain" name="user_name" type="text" maxlength="50" class="form-control" required>
                            </div>
                            <div class="form-group">

                                <?=$_GET['regist'] == 'password-fail' ? '<div class="alert alert-danger">Пароль слишком короткий </div>' : ''?>

                                <label class="control-label" for="signupPassword">Пароль</label>
                                <input id="signupPassword" name="password" type="password" maxlength="25" class="form-control" placeholder="от 6 символов" length="40" required>
                            </div>
                            <div class="form-group">

                                <?=$_GET['regist'] == 'password_repeat-fail' ? '<div class="alert alert-danger">Пароли не совпадают </div>' : ''?>

                                <label class="control-label" for="signupPasswordagain">Повторите пароль</label>
                                <input id="signupPasswordagain" name="password-repeat" type="password" maxlength="25" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button id="signupSubmit" name="enter" type="submit" class="btn btn-info btn-block">Создать аккаунт</button>
                            </div>
                            <hr>
                            <p></p>Есть аккаунт? <a href="/pages/authoriz.php">Авторизоваться</a></p>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<?
require_once '../includes/footer.php';
?>