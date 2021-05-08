<?php

$login = " ";
if (isset($_SESSION['user'])) {
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
}

if(isset($_POST['title']))
{
    $title = $_POST['title'];
    $short = $_POST['short'];
    $full = $_POST['full'];

    $querry = mysqli_query($db, "INSERT INTO calls(call_title, call_short, call_full, call_author) VALUES('$title', '$short', '$full', '$login');");
    header("Location: /");
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title">НОВОЕ ОБЪЯВЛЕНИЕ</p>
    </div>
</div>
<div class="row justify-content-center">
    <form action="" method="post" class="col-10">
        <div class="form-group">
            <label for="titleInput">Заголовок</label>
            <input type="text" name="title" class="form-control" id="titleInput" placeholder="Новое объявление" required>
        </div>
        <div class="form-group">
            <label for="shortInput">Кратко содержание</label>
            <textarea name="short" class="form-control" id="shortInput" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="fullInput">Полный текст объявление</label>
            <textarea name="full" class="form-control" id="fullInput" rows="6" required></textarea>
        </div>
        <input type="hidden" name="author" value=<?php echo $login; ?>>
        <button type="submit" class="btn btn-primary">Опубликовать</button>
    </form>
</div>