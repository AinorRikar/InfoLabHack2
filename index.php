<!DOCTYPE html>
<html lang="en">

<?php

session_start();
$login = " ";
if (isset($_SESSION['user'])) {
    $user_hash = $_SESSION['user']['hash'];
    $querry = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$user_hash';");
    $user = mysqli_fetch_assoc($querry);
    $login = $user['user_login'];
}

include_once "modules/bd.php";

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>САЙТ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css" />
</head>

<body class="background">
    <div class="container-fluid m-0 p-0">

        <?php include "modules/navbar-top.php"; ?>

        <?php include "modules/page.php"; ?>

    </div>

    <!--СКРИПТЫ-->
    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>