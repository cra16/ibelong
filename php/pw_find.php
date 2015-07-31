<?php
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> 비밀번호  찾기</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/id_find.css" rel="stylesheet">
  </head>
<body>

  <!-- Menubar start-->  

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="firstpage.php">Form_Zip</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li>
          <?php
            if($_SESSION['USER_NAME'])
              echo '<a href="logout.php">Logout</a>';
            else
              echo '<a href="login.php">Login</a>';
          ?>
        </li>
        <li><a href="signup.php">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  

  <!-- Logo Start -->
  <div class="container" class = "col-lg-12 col-xs-12">
      
      <div id="header" class = "col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
          <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
      </div>
  </div>
  <!-- Logo End -->
 
  <div class="containbox">
    <div class = "join_content">
    <form method="POST" action="pw_find.php" class="form-horizontal"> 
    <div class = "form-group">
     <div id="title"> <h2> 비밀번호 찾기 </h2> </div>
        <table>
          <tr>
            <td><label> 아이디</label></td>
            <td><input type="text" class="form-control short-length" name="userid"  placeholder="User ID"></td>
          </tr>
          <tr>
            <td><label >이름</label></td>
            <td><input type="text" class="form-control short-length" name="name"  placeholder="Name">  </td>
          </tr>
          <tr>
            <td> <label>학번</label></td>
            <td> <input type="text" class="form-control short-length" name="stuid" placeholder="Stuid ex)21200000" maxlength="8"> </td>
          </tr>
          <tr>
            <td> <label>생년월일</label></td>
            <td> <input type="text" class="form-control short-length" name="birth" placeholder="6자리 입력 ex)930102" maxlength="6"></td>
          </tr>
        </table>
      </div>
    </div>
      <div id="divmargin"></div>
      <div class="submit_content">
        <button type="submit" value="id_find" name="id_find" onclick="myFunction()">확인</button>
      </div>
    </form>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



<?php
$user_id=$_POST['userid'];
$name= $_POST['name'];
$stuid=$_POST['stuid'];
$birth=$_POST['birth'];
$qry="SELECT * FROM student WHERE id='$user_id'";
$result=mysqli_query($bd,$qry);

//student table이 존재할때
if($result) {
  if(mysqli_num_rows($result) > 0) {
    $member = mysqli_fetch_assoc($result);

// DB에 입력한 값이 존재하면 display
    if($name==$member['student_name'] && $member['stuid']==$stuid && $member['birth']==$birth){
      
      $key = KEY;
      $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

      $password = mysqli_real_escape_string($bd,$member['password']);

      ### 복호화 ####
      $de_str = pack("H*", $password); //hex로 변환한 ascii를 binary로 변환
      $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv);

     
      echo "<script>alert('".$decoding."')</script>";

    }
  }
}
?>
</body>
</html>