<?php

if ($_POST) {
    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];
    $mentor = $_POST['mentor'];
    $isMentor = 0;
    if($mentor)
    {
        $isMentor = 1;
    }

    $error = [];

    if (!preg_match("#^[aA-zZ0-9\-_]+$#", $login)) {
        $error[] = "Неверный формат логина!";
    }
    if (!preg_match("#^[aA-zZ0-9\-_]+$#", $pass)) {
        $error[] = "Неверный формат пароля!";
    }
    if ($pass !== $pass_confirm) {
        $error[] = "Пароли не совпадают!";
    }

    if (count($error) < 1) {
        $pass = md5(md5($pass));
        $hash = md5($login + time());

        if (!$querry = mysqli_query($db, "INSERT INTO users(user_login, user_email, user_password, user_hash, user_type, user_rating, user_full_name) VALUES ('$login', '$email', '$pass', '$hash', '$isMentor', 0, '$full_name'); ")) {
            $error[] = "Ошибка базы данных!";
        }

        if (count($error) < 1) header("Location: /?lk");
    }
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title">РЕГИСТРАЦИЯ</p>
    </div>
</div>
<?php

if (count($error) > 0) {
    echo $error[0];
}

?>
<div class="row justify-content-center">
    <form action="" method="post" class="col-10">
        <div class="form-group" class="form-row">
            <label for="inptLogin">ФИО</label>
            <input type="text" name="full_name" class="form-control" id="inptLogin" placeholder="Введите ФИО" required>
        </div>
        <div class="form-group" class="form-row">
            <label for="inptLogin">Логин</label>
            <input type="text" name="login" class="form-control" id="inptLogin" placeholder="Введите логин" required>
        </div>
        <div class="form-group" class="form-row">
            <label for="emailLogin">Почта</label>
            <input type="email" name="email" class="form-control" id="emailLogin" placeholder="Введите email" required>
        </div>
        <div class="form-group" class="form-row">
            <label for="inptPass">Пароль</label>
            <input type="password" name="pass" class="form-control" id="inptPass" placeholder="Введите пароль" required>
        </div>
        <div class="form-group" class="form-row">
            <label for="inptPassConf">Подтверждение пароля</label>
            <input type="password" name="pass_confirm" class="form-control" id="inptPassConf" placeholder="Повторите пароль" required>
        </div>
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            <input type="checkbox" name="mentor" class="custom-control-input" id="inptMantor">
            <label class="custom-control-label" for="inptMantor">Зарегистрироваться как ментор</label>
        </div>
        <div class="form-group" class="form-row justify-content-center">
            <button type="submit" class="btn btn-success col-auto">Зарегистрироваться</button>
            <a href="?lk" class="btn btn-secondary col-auto">Войти</a>
        </div>
    </form>
</div>