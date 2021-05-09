<?php

$login_me = " ";
$login = " ";
$name = " ";
$mentor = 0;
$rating = 0;
$email = " ";
$user_id = 0;

if (isset($_SESSION['user'])) {
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
    $login_me = $user['user_login'];
    $name = $user['user_full_name'];
    $mentor = $user['user_type'];
    $rating = $user['user_rating'];
    $email = $user['user_email'];
}

if (isset($_GET['user']) && $_GET['user'] !== $login) {
    $l = $_GET['user'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_login = '$l';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
    $name = $user['user_full_name'];
    $mentor = $user['user_type'];
    $rating = $user['user_rating'];
    $email = $user['user_email'];
    $user_id = $user['user_id'];
}

if (isset($_POST['logout'])) {
    $logout = $_POST['logout'];

    if ($logout) {
        unset($_SESSION['user']);
        header("Location: /");
    }
}

if (isset($_POST['rate']) && $user_id > 0) {
    $rate = $_POST['rate'];
    $author = $_POST['author'];
    $text = $_POST['text'];

    $result = mysqli_query($db, "INSERT INTO rates(rate_author, rate_text, rate_user, rate_value) VALUES('$author', '$text', '$user_id', '$rate');");
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
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

<?php
if ($mentor > 0) :
?>
    <?php

    $l = $_GET['user'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_login = '$l';");
    $user = mysqli_fetch_assoc($querry);
    $querry = mysqli_query($db, "SELECT * FROM rates WHERE rate_user = '$user_id';");
    $count = mysqli_num_rows($querry);
    $rate_summ = 0;
    while ($rrr = mysqli_fetch_assoc($querry)) {
        $rate_summ += $rrr['rate_value'];
    }
    if ($count > 0) {
        $rate_summ /= $count;
        $rating = $rate_summ;
        $querry = mysqli_query($db, "UPDATE users SET user_rating = '$rating' WHERE user_id = '$user_id';");
    }

    ?>
    <div class="row justify-content-center">
        <div class="col-10 justify-content-center">
            <div class="row justify-content-start">
                <div class="col-auto">
                    <span class="title-small-x">Рейтинг: </span>
                    <?php
                    for ($i = 0.5; $i < 5; $i++) {
                        $type = "";
                        if ($rating >= $i) {
                            $type = "checked";
                        }
                        echo '<span class="fa fa-star ' . $type . '"></span>';
                    }
                    ?>
                    <span><?= $rating ?> <span class="title-small-x">Отзывов: </span><?= $count ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <hr width="100%" color="#111" />
            <div class="row justify-content-center">
                <p class="title-small col-auto">Отзывы</p>
            </div>
        </div>
    </div>


    <?php
    if ($_GET['user'] !== $login_me && isset($_GET['user']) && isset($_SESSION['user'])) :
    ?>

        <div class="row justify-content-center">
            <form action="" method="post" class="col-10">
                <div class="form-group">
                    <label for="shortInput" class="title-small-x">Новый отзыв</label>
                    <textarea name="text" class="form-control" id="shortInput" rows="2" required></textarea>
                    <label class="title-small-x">Оценка:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio4" value="4">
                        <label class="form-check-label" for="inlineRadio4">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio5" value="5" checked>
                        <label class="form-check-label" for="inlineRadio5">5</label>
                    </div>
                </div>
                <input type="hidden" name="author" value=<?php echo $login_me; ?>>
                <button type="submit" class="btn btn-secondary">Написать</button>

            </form>
        </div>
    <?php
    endif;
    ?>

    <?php

    $result = mysqli_query($db, "SELECT * FROM rates WHERE rate_user = '$user_id' ORDER BY rate_id DESC;");
    while ($rrr = mysqli_fetch_assoc($result)) :
        $value = $rrr['rate_value'];
    ?>
        <div class="row justify-content-center">
            <div class="col-10 justify-content-center comm">
                <div class="row justify-content-start">
                    <div class="col-12">
                        <span class="title-small-x">Оценка: </span>
                        <?php
                        for ($i = 0.5; $i < 5; $i++) {
                            $type = "";
                            if ($value >= $i) {
                                $type = "checked";
                            }
                            echo '<span class="fa fa-star ' . $type . '"></span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row justify-content-start call-text">
                    <div class="col-12">
                        <p class="comm-text"><?= $rrr["rate_text"] ?></p>
                    </div>
                </div>
                <hr width="100%" color="#111" />
            </div>
        </div>
    <?php
    endwhile;
    ?>


<?php
endif;
?>