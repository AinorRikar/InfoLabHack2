<?php

$login_me = " ";
$login = " ";
$name = " ";
$mentor = 0;
$rating = 0;
$email = " ";

if (isset($_SESSION['user'])) {
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
    $login_me = $user['user_login'];
    $name = $user['user_full_name'];
    $mentor = $user['user_type'];
    $rating = $user['rating'];
    $email = $user['user_email'];
}

if (isset($_GET['user']) && $_GET['user'] !== $login) {
    $l = $_GET['user'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_login = '$l';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
    $name = $user['user_full_name'];
    $mentor = $user['user_type'];
    $rating = $user['rating'];
    $email = $user['user_email'];
}

if (isset($_POST['logout'])) {
    $logout = $_POST['logout'];

    if ($logout) {
        unset($_SESSION['user']);
        header("Location: /");
    }
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title">ЛИЧНЫЙ КАБИНЕТ</p>
        <hr width="100%" color="#111" />
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <div class="row justify-content-start">
            <div class="col-auto"><span class="title-small-x">Имя: </span><?= $name ?></div>
        </div>
        <div class="row justify-content-start">
            <div class="col-auto"><span class="title-small-x">Логин: </span><?= $login ?></div>
        </div>
        <div class="row justify-content-start">
            <div class="col-auto"><span class="title-small-x">Email: </span><?= $email ?></div>
        </div>
        <div class="row justify-content-start">
            <div class="col-auto"><span class="title-small-x">Класс: </span><?php if ($mentor > 0) : ?>Ментор<?php else : ?>Студент<?php endif; ?></div>
        </div>
    </div>
</div>

<?php
if ($_GET['user'] === $login_me || !isset($_GET['user'])) :
?>
    <div class="row justify-content-center">
        <form action="" method="post" class="col-10">
            <input type="hidden" name="logout" value="true">
            <div class="form-group" class="form-row justify-content-between">
                <button type="submit" class="btn btn-danger col-auto">ВЫЙТИ</button>
            </div>
        </form>
    </div>
<?php
endif;
?>