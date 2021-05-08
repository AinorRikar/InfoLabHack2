<div class="row justify-content-center m-0">
    <div class="col-12 col-md-10 page">
        <?php

        if (isset($_GET['lk'])) {
            include "profile.php";
        }
        else
        {
            include "callboard.php";
        }

        ?>
    </div>
</div>