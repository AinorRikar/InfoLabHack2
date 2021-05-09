<?php

$id = $_GET['call'];
$querry = mysqli_query($db, "SELECT * FROM calls WHERE call_id = '$id';");
$call = mysqli_fetch_assoc($querry);

$title = $call['call_title'];
$full = $call['call_full'];
$author = $call['call_author'];

$login = " ";
if (isset($_SESSION['user'])) {
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
    $user_id = $user['user_id'];
}

if (isset($_POST['leave'])) {
    $leave = $_POST['leave'];

    if ($leave) {
        $d = mysqli_query($db, "DELETE FROM uic WHERE uic_user = '$user_id' AND uic_call = '$id';");
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }
}
if (isset($_POST['enter'])) {
    $enter = $_POST['enter'];

    if ($enter) {
        $d = mysqli_query($db, "INSERT INTO uic(uic_user, uic_call) VALUES('$user_id', '$id');");
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title"><?php echo $title; ?></p>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p><?php echo $full; ?></p>
    </div>
</div>
<div class="row justify-content-end">
    <div class="col-auto justify-content-center">
        <p>Автор: <a href="?lk&user=<?php echo $author; ?>" class="author"><?php echo $author; ?></a></p>
    </div>
</div>
<!--УЧАСТНИКИ-->
<hr width="100%" color="#111" />
<div class="row justify-content-center">
    <p class="title-small col-auto">Участники</p>
</div>
<?php
$q = mysqli_query($db, "SELECT * FROM uic WHERE uic_call = '$id' AND uic_user = '$user_id';");
$isInCall = false;
$c = mysqli_fetch_assoc($q);
if ($c) {
    $isInCall = true;
}
$querry = mysqli_query($db, "SELECT * FROM uic WHERE uic_call = '$id';");
$uic_count = mysqli_num_rows($querry);
if ($uic_count > 0) :
?>
    <div class="row justify-content-center">
        <div class="list-group">
            <?php
            $querry_m = mysqli_query($db, "SELECT * FROM uic INNER JOIN users ON users.user_id = uic.uic_user WHERE uic.uic_call = '$id' AND users.user_type = 1;");
            $querry_u = mysqli_query($db, "SELECT * FROM uic INNER JOIN users ON users.user_id = uic.uic_user WHERE uic.uic_call = '$id' AND users.user_type = 0;");
            while ($row = mysqli_fetch_assoc($querry_m)) :
                $href = "?lk&user=" . $row['user_login'];
            ?>
                <a href="<?= $href ?>" class="list-group-item list-group-item-action active"><?= $row['user_login'] ?></a>
            <?php
            endwhile;
            while ($row = mysqli_fetch_assoc($querry_u)) :
                $href = "?lk&user=" . $row['user_login'];
            ?>
                <a href="<?= $href ?>" class="list-group-item list-group-item-action"><?= $row['user_login'] ?></a>
            <?php
            endwhile;
            ?>
        </div>
    </div>
<?php
endif;
?>
</br>
<?php
if ($isInCall == true) :
?>
    <div class="row justify-content-center">
        <form action="" method="post" class="col-auto">
            <input type="hidden" name="leave" value="true">
            <div class="form-group" class="form-row justify-content-center">
                <button type="submit" class="btn btn-danger col-auto">Покинуть объявление</button>
            </div>
        </form>
    </div>
<?php
else :
?>
    <div class="row justify-content-center">
        <form action="" method="post" class="col-auto">
            <input type="hidden" name="enter" value="true">
            <div class="form-group" class="form-row justify-content-center">
                <button type="submit" class="btn btn-success col-auto">Присоединиться к объявлению</button>
            </div>
        </form>
    </div>
<?php
endif;
?>
<!--КОММЕНТАРИИ-->
<hr width="100%" color="#111" />
<div class="row justify-content-center">
    <p class="title-small col-auto">Комментарии</p>
</div>
<div class="row justify-content-center">
    <form action="" method="post" class="col-10">
        <div class="form-group">
            <label for="shortInput">Новый комментарий</label>
            <textarea name="text" class="form-control" id="shortInput" rows="2" required></textarea>
        </div>
        <input type="hidden" name="author" value=<?php echo $login; ?>>
        <button type="submit" class="btn btn-secondary">Написать</button>
    </form>
</div>
<?php

if (isset($_POST['author'])) {
    $comm_author = $_POST['author'];
    $comm_text = $_POST['text'];

    $result = mysqli_query($db, "INSERT INTO comms(comm_author, comm_text, comm_call) VALUES('$comm_author', '$comm_text', '$id');");
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

$result = mysqli_query($db, "SELECT * FROM comms WHERE comm_call = '$id' ORDER BY comm_id DESC;");

while ($row = mysqli_fetch_assoc($result)) {
    $href = "?lk&user=" . $row['comm_author'];
    $class = "";
    if ($row["comm_author"] === $author) {
        $class = "author";
    } else {
        $class = "author-comm";
    }
    print('
        <div class="row justify-content-center">
            <div class="col-10 justify-content-center comm">
                <div class="row justify-content-start">
                    <div class="col-12">
                        <p class="title-small-x"><a href=' . $href . ' class="' . $class . '">' . $row["comm_author"] . '</a></p>
                        <hr width="100%" color="#111" />
                    </div>
                </div>
                <div class="row justify-content-start call-text">
                    <div class="col-12">
                        <p class="comm-text">' . $row["comm_text"] . '</p>
                    </div>
                </div>
            </div>
        </div>
        ');
}

?>