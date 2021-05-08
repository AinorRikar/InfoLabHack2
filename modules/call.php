<?php

$id = $_GET['call'];
$querry = mysqli_query($db, "SELECT * FROM calls WHERE call_id = '$id';");
$call = mysqli_fetch_assoc($querry);

$title = $call['call_title'];
$full = $call['call_full'];

$login = "";
if ($_SESSION['user'])
{
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
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