<?php

if ($_POST) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $error = [];

    if (!preg_match("#^[aA-zZ0-9\-_]+$#", $login)) {
        $error[] = "Неверный формат логина!";
    }
    if (!preg_match("#^[aA-zZ0-9\-_]+$#", $pass)) {
        $error[] = "Неверный формат пароля!";
    }

    if (count($error) < 1) {
        $pass = md5(md5($pass));

        if (!$querry = mysqli_query($db, "SELECT * FROM users WHERE user_login = '$login' AND user_password = '$pass';")) {
            $error[] = "Ошибка базы данных!";
        }

        if (count($error) < 1) {
            $user = mysqli_fetch_assoc($querry);

            if (mysqli_num_rows($querry) > 0) {
                $_SESSION['user'] = [
                    "id" => $user['user_id'],
                    "hash" => $user['user_hash'],
                    "name" => $user['user_full_name']
                ];
            } else {
                $error[] = "Неверный логин или пароль!";
            }
        }

        if (count($error) < 1) {
            header("Location: /");
        }
    }
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title">АВТОРИЗАЦИЯ</p>
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
            <label for="inptLogin">Логин</label>
            <input type="text" name="login" class="form-control" id="inptLogin" placeholder="Введите логин" required>
        </div>
        <div class="form-group" class="form-row">
            <label for="inptPass">Пароль</label>
            <input type="password" name="pass" class="form-control" id="inptPass" placeholder="Введите пароль" required>
        </div>
        <div class="form-group" class="form-row justify-content-between">
            <button type="submit" class="btn btn-success col-auto">Войти</button>
            <a href="?lk=register" class="btn btn-secondary col-auto">Зарегистрироваться</a>
        </div>
    </form>
</div>