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
                        if (file_exists("log.html") && filesize("log.html") > 0) {
                            $handle = fopen("log.html", "r");
                            $contents = fread($handle, filesize("log.html"));
                            fclose($handle);

                            echo $contents;
                        }
                        ?>
                    </div>

                    <form name="message" action="">
                        <input name="usermsg" type="text" id="usermsg" size="63" value="" />
                        <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                    </form>
                </div>
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
                <script type="text/javascript">
                    // jQuery Document
                    $(document).ready(function() {
                        $("#submitmsg").click(function() {
                            console.log("писька");
                            var clientmsg = $("#usermsg").val();
                            $("#usermsg").val("");
                            $.post("post.php", {
                                text: clientmsg
                            });
                            return false;
                        });
                        setInterval(loadLog, 1000);
                    });

                    function loadLog() {
                        console.log("писькаq");
                        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
                        $.ajax({
                            url: "log.html",
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
                    <li class="list-group-item list-group-item-action list-group-item-dark title-small-x">ЧАТЫ</li>
                </div>
            </div>
        </div>
    </div>
</div>