

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>kumomo</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="text/javascript">

  </script>
</head>

<body>

  <div class="container">
    <br>
    <br>
    <div class="row">
      <div class="col s12 m8 offset-m2">
        <div class="card-panel">
          <form id="login">
            <div class="row">
              <div class="input-field col s12">
                <input id="account" name="account" type="text" class="validate" required="required">
                <label for="account">account</label>
                <span data-error="Account not allow" data-success="Account allow" class="helper-text"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate" minlength="6" required="required">
                <label for="password">password</label>
                <span data-error="Password not allow" data-success="Password allow" class="helper-text"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="passwordConfirm" name="passwordConfirm" type="password" class="validate" required="required">
                <label for="passwordConfirm">passwordConfirm</label>
                <span data-error="Password not match" data-success="Password Match" class="helper-text"></span>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="name" name="name" type="text" class="validate" required="required">
                <label for="name">name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="email" name="email" type="email" class="validate" required="required">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="birthdate" name="birthdate" type="text" class="datepicker" required="required">
                <label for="birthdate">birthdate</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="career" name="career" type="text" class="validate" required="required">
                <label for="career">career</label>
              </div>
            </div>
            <span><label>gender</label></span>
            <div class="row">
              <div class="input-field col s4">
                <label>
                  <input name="gender" type="radio" value="m" required />
                  <span>male</span>
                </label>
              </div>
              <div class="input-field col s4">
                <label>
                  <input name="gender" type="radio" value="f" />
                  <span>female</span>
                </label>
              </div>
              <div class="input-field col s4">
                <label>
                  <input name="gender" type="radio" />
                  <span>secret</span>
                </label>
              </div>
            </div>

            <br>
            <div class="row">
              <div class="col s6">
                <p class="left-align"><button class="btn waves-effect waves-light" type="reset">clear
                    <i class="material-icons right">clear</i></button></p>
              </div>
              <div class="col s6">
                <p class="right-align"> <button class="btn waves-effect waves-light" type="submit">Submit
                    <i class="material-icons right">send</i></button></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function () {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
      });

      $("#passwordConfirm").on("focusout", function (e) {
        if ($("#passwordConfirm").val() != "") {
          if ($("#password").val() != $(this).val()) {
            $(this).removeClass("valid").addClass("invalid");
          } else {
            $(this).removeClass("invalid").addClass("valid");
          }
        }
      });

      $("#account").on("focusout", function (e) {
        $.ajax({
          url: "php/checkAccount.php",
          type: "post",
          data: {
            account: $(this).val()
          },
          dataType: "text",
          success: function (data) {
            if (data == "true") {
              $("#account").removeClass("invalid").addClass("valid");
            } else {
              $("#account").removeClass("valid").addClass("invalid");
            }

          }
        })
      })

      $("#login").submit(function (e) {

        var form = $(this);
        $.ajax({
          type: "POST",
          url: "php/signup.php",
          data: form.serialize(),
          success: function (data) {
            if (data == "true") {
              alert("registration success")
              location = "login.php"
            } else if (data == "false") {
              alert("registration fail")
            } else {
              alert("unexpecded")
            }
          }
        })
        return false;
      })

    })


  </script>
</body>

</html>