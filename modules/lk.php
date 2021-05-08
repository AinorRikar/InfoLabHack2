<?php

if ($_POST) {
    $logout = $_POST['logout'];

    if($logout)
    {
        unset($_SESSION['user']);
        header("Location: /");
    }
    
}

?>

<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <p class="title">ЛИЧНЫЙ КАБИНЕТ</p>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-10 justify-content-center">
        <?php echo $_SESSION['user']['name']; ?>
    </div>
</div>
<div class="row justify-content-center">
    <form action="" method="post" class="col-10">
        <input type="hidden" name="logout" value="true">
        <div class="form-group" class="form-row justify-content-between">
            <button type="submit" class="btn btn-danger col-auto">ВЫЙТИ</button>
        </div>
    </form>
</div>