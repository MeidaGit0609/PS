<nav class="navbar navbar-dark bg-primary navbar-expand-lg mb-5">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/">Главная</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php
            if(isset($_COOKIE['user'])) :
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="/pages/profile/profile.php">Профиль <span class="sr-only">(current)</span></a>
            </li>
            <?php
            endif;
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/pages/top10.php">Топ 10 постов</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/registration.php">Регистрация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages/authoriz.php">Авторизация</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>