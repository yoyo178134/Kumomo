<?php
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
        
        .card {
            border-radius: 10px;
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
        <br>
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel card">
                    <table class="striped">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <p class="center-align"><i class="large material-icons">account_circle</i></p>
                                    <p class="center-align" id="id" >###</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td colspan="2">Account : </td>
                                <td id="account"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Name : </td>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <td colspan="2">BirthDate : </td>
                                <td id="birthdate"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Gender : </td>
                                <td id="gender"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Career : </td>
                                <td id="career"></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p class="right-align">
                                        <a class="btn waves-effect waves-light" href="profileUpdate.php">編輯個人資料<i
                                                class="material-icons right">edit</i></a>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.sidenav').sidenav();
            $('.fixed-action-btn').floatingActionButton();
            $('.tooltipped').tooltip();
            $(".dropdown-trigger").dropdown();

            $.ajax({
                type: "GET",
                url: "php/userProfile.php",
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    $("#id").text("ID : " + data.id)
                    $("#account").text(data.account)
                    $("#name").text(data.name)
                    $("#birthdate").text(data.birthdate)
                    $("#gender").text(data.gender)
                    $("#career").text(data.career)
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
            return false;
        })
    </script>
</body>

</html>