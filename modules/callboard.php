<?php

if ($_SESSION['user']) {

    echo '
    <div class="row justify-content-end">
        <div class="col-12">
            <div class="row justify-content-end">
                <a href="?newcall" class="btn btn-dark col-auto call-create" role="button"><span class="wt">Новое объявление</span></a>
            </div>
        </div>
    </div>
    ';
}

$result = mysqli_query($db, "SELECT * FROM calls ORDER BY call_id DESC;");

while($row = mysqli_fetch_assoc($result))
{
    $href = "?call=".$row['call_id'];
    print('
    <div class="row justify-content-around m-0 call-row">
        <div class="col-12 call">
            <div class="row">
                <div class="col-12">
                    <p class="title-small">'.$row["call_title"].'</p>
                    <hr width="100%" color="#111" />
                </div>
            </div>
            <div class="row call-text">
                <div class="col-12">
                    <p class="call-text">'.
                        $row["call_short"]
                    .'</p>
                </div>
            </div>
            <div class="row justify-content-end">
                <a href="'.$href.'" class="btn btn-outline-dark col-auto call-open">Открыть</a>
            </div>
        </div>
    </div>
');
}
?>