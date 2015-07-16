<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Signup</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/signup.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <div id="header">
          <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
      </div>
    </div>
    
    <div id="containbox">
      <div class="join_content">
        <form action="../php/data_change.php?mode=insert"  method="POST">
            <div class="form-group">
                <h2>회원가입</h2>
                
          <div id="divmargin"></div>
                <input class="form-control" id="name" name="name" type="text" placeholder="Name" maxlength="20" onblur="NameCheck()">
                <div id="divmargin"></div>
                <div id="idMsg" class="error" style="display:none"></div>
                
                <input class="form-control" id="userid" name="userid" type="text" placeholder="User ID" maxlength="20" onblur="UserIdCheck()">
                <div id="divmargin"></div>
                <div id="userIdMsg" class="error" style="display:none"></div>
                
                <input class="form-control" id="pw" name="pw" type="password" placeholder="Password" maxlength="15" onblur="PWCheck()">
                <div id="divmargin"></div>
                <div id="pwMsg" class="error" style="display:none"></div>
              
                <input class="form-control" id="confirm" name="condfirm" type="password" placeholder="Password Confirm" maxlength="15" onblur="PsCfCheck()">
                <div id="divmargin"></div>
                <div id="pscfMsg" class="error" style="display:none"></div>
        
            </div>
          </div>

          <div id="divmargin"></div>

          <div class="submit_content">
                     <div id="sbMsg" class="error" style="display:none" ></div>
                     <button type="submit" onclick="IsFilled()">Submit</button>
          </div>
          
        </form>
    </div>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- 자체제작 js -->
    <script src="../js/signup.js"></script>
  </body>
</html>