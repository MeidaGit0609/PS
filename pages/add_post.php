<?php
require_once '../php/config.php';
require_once '../includes/head.php';
?>
</head>
<body>
<?php require_once '../includes/header.php';  ?>
    <div class="form mt-5">
        <div class="container">
            <div class="row">
                <div class="card card-primary w-100">
                    <div class="card-body">
                        <form method="POST" action="/php/action/add_post-handler.php" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <h1>Добавить пост</h1>
                            </div>
                            <?=$_GET['upload'] == 'img_false' ? '<div class="alert alert-danger">Файлы данного типа нельзя загружать в целях безопастости</div>' : '';?>

                            <?=$_GET['upload'] == 'img_very-mini' ? '<div class="alert alert-danger">Фото слишком мало весит</div>' : '';?>

                            <?=$_GET['upload'] == 'img_very-big' ? '<div class="alert alert-danger">Фото слишком много весит</div>' : '';?>

                            <?=$_GET['upload'] == 'input_false' ? '<div class="alert alert-danger">Заполните все поля</div>' : '';?>

                            <?=$_GET['upload'] == 'happy' ? '<div class="alert alert-success">Ваш пост добавлен!!</div>' : '';?>

                            <?=$_GET['upload'] == 'false' ? '<div class="alert alert-primary">Неизвестная ошибка, попробуйте позже...</div>' : '';?>

                            <div class="form-group">
                                <label class="control-label">Загрузите фото</label> <br>
                                <input name="post_image" type="file" required>
                            </div>
                            <input name="user_id" type="hidden" maxlength="50" value="<?=$user['id'] ?>">
                            <div class="form-group">
                                <label class="control-label" for="signupPassword">Описание</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button name="enter" type="submit" class="btn btn-info btn-block">Добавить</button>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? require_once '../includes/footer.php';  ?>