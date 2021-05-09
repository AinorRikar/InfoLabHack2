<div class="row justify-content-center">
    <div class="col-11">
        <div class="row">
            <div class="col-12 col-md-9">
                <div id="wrapper">
                    <div id="menu">
                        <p class="welcome">Вы вошли как <b><?php echo $_SESSION['user']['name']; ?></b></p>
                        <div style="clear:both"></div>
                    </div>

                    <div id="chatbox">
                        <?php
                        if (file_exists("log" . $_GET['chat'] . ".html") && filesize("log" . $_GET['chat'] . ".html") > 0) {
                            $handle = fopen("log". $_GET['chat'] .".html", "r");
                            $contents = fread($handle, filesize("log" . $_GET['chat'] . ".html"));
                            fclose($handle);

                            echo $contents;
                        }
                        ?>
                    </div>

                    <form name="message" action="">
                        <input name="usermsg" type="text" id="usermsg" size="63" value="" />
                        <input name="chat" type="hidden" id="chath" size="63" value="<?= $_GET['chat'] ?>" />
                        <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                    </form>
                </div>
                </br>
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
                <script type="text/javascript">
                    // jQuery Document
                    $(document).ready(function() {
                        $("#submitmsg").click(function() {
                            var chat_id = $("#chath").val();
                            var clientmsg = $("#usermsg").val();
                            $("#usermsg").val("");
                            $.post("post.php", {
                                text: clientmsg,
                                chat: chat_id
                            });
                            return false;
                        });
                        setInterval(loadLog, 1000);
                    });

                    function loadLog() {
                        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
                        var chat_id = $("#chath").val();
                        var u = "log" + chat_id + ".html";
                        console.log(u);
                        $.ajax({
                            url: "log" + chat_id + ".html",
                            cache: false,
                            success: function(html) {
                                $("#chatbox").html(html); //Insert chat log into the #chatbox div	

                                //Auto-scroll			
                                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                                if (newscrollHeight > oldscrollHeight) {
                                    $("#chatbox").animate({
                                        scrollTop: newscrollHeight
                                    }, 'normal'); //Autoscroll to bottom of div
                                }
                            },
                        });
                    }
                </script>
            </div>
            <div class="col-12 col-md-3">
                <div class="list-group">
                    <a href="?chat" class="list-group-item list-group-item-action list-group-item-dark title-small-x">ЧАТЫ</a>
                    <?php
                    $hash = $_SESSION['user']['hash'];
                    $d = mysqli_query($db, "SELECT * FROM users WHERE user_hash = '$hash';");
                    $res = mysqli_fetch_assoc($d);
                    $user_id = $res['user_id'];
                    $q = mysqli_query($db, "SELECT * FROM uic WHERE uic_user = '$user_id';");

                    while ($row = mysqli_fetch_assoc($q)) :
                        $call_id = $row['uic_call'];
                        $r = mysqli_query($db, "SELECT * FROM calls WHERE call_id = '$call_id';");
                        $call = mysqli_fetch_assoc($r);
                    ?>
                        <a href="?chat=<?=$call_id?>" class="list-group-item list-group-item-action title-small-x"><?=$call['call_title']?></a>

                    <?php
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>