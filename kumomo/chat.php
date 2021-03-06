<?php
    $id = $_GET['id'];
    session_start() ;
    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
    {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kumomo</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Icon CSS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">

    </script>

    <style type="text/css">
        body {
            min-height: 100vh;
            background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
        }

        h6 {
            margin-top: 0px;
            margin-bottom: 1em;
            text-align:center;
        }
        
        .message {
            /*border: 1px solid #9e9e9e;*/
            background-color: #fafafa;
            border-radius: 10px;
            padding: 1em;
            z-index: 1;
            height: calc(100vh - 95px);
        }

        .messageList {
            /*border: 1px solid #bdbdbd;*/
            background-color: #fafafa;
            overflow-y: auto;
            height: calc(100% - 100px);
        }

        .messageList .row{
            margin-bottom: 0px;
        }

        .messageBox {
            border: 2px solid #80cbc4;
            background-color: #e0f2f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            max-width: 40%;
        }

        .messageBox span {
            word-break: break-all;
        }

        .messageInput .row {
            margin-bottom: 0px;
        }

        #message {
            margin-bottom: 0px;
        }

        @media #{$small-and-down} {
            .messageBox {
                max-width: 60%;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper teal lighten-2">
            <div class="container">
                <a href="#!" class="brand-logo hide-on-med-and-down">Kumomo 聊一下</a>
                <a href="#!" class="brand-logo hide-on-large-only">Kumomo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="article.php">文章</a></li>
                    <li><a href="chatroom.php">聊天室</a></li>
                    <li><a href="profile.php">個人頁面</a></li>
                    <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="article.php">文章</a></li>
        <li><a href="chatroom.php">聊天室</a></li>
        <li><a href="profile.php">個人頁面</a></li>
        <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
    </ul>

    <div class="container">
        <br>
        <div class="message">
            <h6 id="targetName" class="title truncate">###</h6>
            <div class="messageList">
                <div id="recvId" class="hide"><?php echo $id ?></div>

                <template class="messageReceived">
                    <div class="row">
                        <div class="messageBox left">
                            <span id="RecvMsg" class="msg">##########</span>
                        </div>
                    </div>
                    <div class="row">
                        <span id="ResvTime" class="left tiny grey-text msgtime">##########</span>
                    </div>
                </template>
                
                <template class="messageSend"> 
                    <div class="row">
                        <div class="messageBox right"> 
                            <span id="SendMsg" class="msg tiny">##########</span>
                        </div>
                    </div>
                    <div class="row">
                        <span id="SendTime" class="right tiny grey-text msgtime">##########</span>
                    </div>
                </template>

            </div>

            <div class="messageInput">
                <div class="row">
                    <form id="messageInputForm" class="col s12">
                        <div class="row">
                            <div class="input-field col s10 m9 offset-m1">
                                <i class="material-icons prefix">mode_edit</i>
                                <input id="message" type="text" class="validate" maxlength="255" data-length="255">
                                <label for="message">Message</label>
                            </div>
                            <div class="input-field col s2 m1">
                                <button class="btn waves-effect waves-light right" type="submit">
                                    <i class="material-icons">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var userid;
        var userName;
        var userAccount;
        var recvid;
        function getRecvTemp() {
            return $($("template.messageReceived").html()).clone();
        }

        function  getSendTemp() {
            return $($("template.messageSend").html()).clone();
        }

        function writeMessage(text,time,isOwner) {
            //console.log(text+time+isOwner)
            var temp = (isOwner)?getSendTemp():getRecvTemp();
            temp.find(".msg").text(text);
            temp.find(".msgtime").text(time);
            $(".messageList").append(temp);
        }


        $(document).ready(function () {
            $('.sidenav').sidenav();
            $('.fixed-action-btn').floatingActionButton();
            $('.tooltipped').tooltip();
            $(".dropdown-trigger").dropdown();
            $('.modal').modal();
            $('input#message').characterCounter();

            recvid = $("#recvId").text();
            $.ajax({
                type: "GET",
                url: "php/userProfile.php",
                dataType: "json",
                success: function (data) {
                    userid =  data.id;
                    userName = data.name;
                    userAccount = data.account;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
            $.ajax({
                    type: "GET",
                    url: "php/findName.php",
                    dataType : "text",
                    data: {
                    id : recvid
                    },
                    success: function (data) {
                         $("#targetName").text(data);
                    
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    }
                })
            $.ajax({
                type: "GET",
                url: "php/msgAllSendRsv.php",
                dataType : "json",
                data: {
                receive_id : $("#recvId").text()
                },
                success: function (data) {
                    
                    $.each(data, function (key,ele){
                        //console.log(ele);
                        writeMessage(ele.text,ele.time,(ele.isOwner == "1"))
                    })
                    $(".messageList").animate({scrollTop:$(".messageList").get(0).scrollHeight});
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })

            var websocket = new WebSocket('ws://course.clipfetcher.com:8080'); 
            websocket.onopen = function(event) { 
                
                if(websocket.readyState==1){
                    //console.log(websocket.readyState)
                    let msg = {
                        text : "ok",
                        send_id: userid,
                        receive_id : -1
                    }
                   // console.log(JSON.stringify(msg))
                    websocket.send(JSON.stringify(msg))
                } 
                    
            }

            websocket.onmessage = function(event) {
                var Data = JSON.parse(event.data);
                //console.log(Data);
                if(recvid == Data.receive_id){
                    writeMessage(Data.text,Data.time,(Data.isOwner == "1"))
                    $(".messageList").animate({scrollTop:$(".messageList").get(0).scrollHeight});
                }else{
                    var recvName;
                    $.ajax({
                        type: "GET",
                        url: "php/findName.php",
                        dataType : "text",
                        data: {
                        id : Data.receive_id
                        },
                        success: function (data) {
                            recvName = data;
                            //console.log(recvName)
                            M.toast({html: recvName+" : "+Data.text, displayLength: 2000, completeCallback: function () { }})
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        }
                    })
                    
                }
                
            };
            
            websocket.onerror = function(event){
                //showMessage("<div class='error'>Problem due to some Error</div>");
                console.log("ws error")
            };

            websocket.onclose = function(event){
                //showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
                console.log("ws close")
            }; 
            
            
            $('#messageInputForm').on("submit",function(event){
                event.preventDefault();      
                var messageJSON = {
                    text: $("#message").val(),
                    send_id: userid,
                    receive_id: recvid
                };
                websocket.send(JSON.stringify(messageJSON));
                $("#message").val("");
                $("#message").focus();
                $('input#message').characterCounter();
                return false;
            });
            
        });

    </script>
</body>

</html>