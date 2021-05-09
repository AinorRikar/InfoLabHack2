<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><span>Info Lab</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" data-placement="bottom" data-html="true" data-toggle="tooltip" title="Главная страница">
                <a class="nav-link btn bold" type="button" href="/">Объявления</a>
            </li>
            <?php
            if(isset($_SESSION['user'])):
            ?>
            <li class="nav-item" data-placement="bottom" data-html="true" data-toggle="tooltip" title="Чаты">
                <a class="nav-link btn bold" type="button" href="?chat">Чаты</a>
            </li>
            <?php
            endif;
            ?>
            <li class="nav-item" data-placement="bottom" data-html="true" data-toggle="tooltip" title="Личный кабинет</br>пользователя">
                <a class="nav-link btn bold" type="button" href="?lk">Личный кабинет</a>
            </li>
        </ul>
    </div>
</nav>