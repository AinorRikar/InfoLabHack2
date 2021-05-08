<div class="row justify-content-center m-0">
    <div class="col-12 col-md-10 page">
        <?php

        if (isset($_GET['lk'])) {
            include "profile.php";
        }
        else if (isset($_GET['newcall']))
        {
            include "newcall.php";
        }
        else if (isset($_GET['call']))
        {
            include "call.php";
        }
        else
        {
            include "callboard.php";
        }

        ?>
    </div>
</div>