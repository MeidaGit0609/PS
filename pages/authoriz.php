<?php
require '../includes/head.php';
?>
    <style>
        .form .container {
            max-width: 400px;
            margin: 30px auto 0;
        }
        .card {
            width: 100%;
        }
    </style>
</head>
<body>
<?php
require '../includes/header.php';
?>
<div class="form">
    <div class="container">
        <div class="row">
            <div class="card card-primary">
                <div class="card-body">
                    <form method="POST" action="/php/action/auth-handler.php" role="form">
                        <div class="form-group">
                            <h2>Войдите</h2>
                        </div>
                        <div class="form-group">
                            <?=$_GET['auth_total'] == 'error' ? '<div class="alert alert-warning">Такого пользователя не существует, проверьте поля</div>' : ''?>
                            <?=$_GET['auth_total'] == 'happy' ? '<div class="alert alert-success">Вы успешно вошли в свой аккаунт</div>' : ''?>
                            <label class="control-label" for="signupEmailagain">Имя пользователя</label>
                            <input id="signupEmailagain" name="user_name" type="text" maxlength="50" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="signupPassword">Пароль</label>
                            <input id="signupPassword" name="password" type="password" maxlength="25" class="form-control" length="40" required>
                        </div>
                        <div class="form-group">
                            <button id="signupSubmit" name="enter" type="submit" class="btn btn-info btn-block">Войти</button>
                        </div>
                        <hr>
                        <p></p>Нет аккаунта? <a href="/pages/registration.php">Зарегистрироваться</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<? require '../includes/footer.php';  ?>