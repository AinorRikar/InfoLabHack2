<div class="row no-gutters justify-content-center">
    <div class="col-12 col-md-10 page">
        <?php

        $query = mysqli_query($link, "SELECT user_id FROM users;");
        echo $name;
        
        ?>
        <?php include "modules/auth.php"; ?>
    </div>
</div>