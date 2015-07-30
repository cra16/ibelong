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


<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: 마이 페이지 ::</title>

    <!-- Bootstrap -->
    <link href="../css/mypage.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

   

  </head>

<body> 
  <!-- Logo Start -->
  <div class="container">
    <div id="header-logo">
        <a href="firstpage.php" class="h_logo">
        <img src="../img/title.png" class = "h_logo">
      </a>
    </div>
  </div>
  <!-- Logo End -->
 
  <div class="formContentsLayout">
 
    
 <!-- 로그인 여부 판단 -->
 <?php
  $id = $_SESSION['USER_NAME'];
   if(!$id){
     header("location: login.php");
     exit();
    }
  $qry="SELECT * FROM student WHERE id='$id'";   
  $result=mysqli_query($bd,$qry);
  $list = mysqli_fetch_array($result);
 
 ?> 


    //기본정보 Start
   <div class = "title">
    <h4> 기본 정보</h4>
   </div>

   <?php 
    //비밀번호 체크
    $key = KEY;
      $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

      $password = mysqli_real_escape_string($bd,$list['password']);

      ### 복호화 ####
      $de_str = pack("H*", $password); //hex로 변환한 ascii를 binary로 변환
      $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv); 
   ?>




   <form action="data_change.php?mode=modify" method="POST" onsubmit="return validateForm()">
    <input type="hidden" id="now" name = "now" value ="<?php echo $decoding; ?>" >
    
      <label class="header">기존 비밀번호</label>
      <input class = "content" type="password" id="current" name="current" class="password" onblur="passWord()">    
      <div id="pw_cur" class="error" style="display:none"></div> 
      <div id="divmargin"></div>

      <label class="header">새 비밀번호</label>
      <input class = "content" type="password" id="newp" name="newp" class="new-password" onblur="PWCheck()">
      <div id="pw_new" class="error" style="display:none"></div>
      <div id="divmargin"></div>

      <label class="header">비밀번호 재입력</label>
      <input class = "content" type="password" id="pw" name="pw" class="new-password" onblur="PsCfCheck()">
      <div id="ps_ck" class="error" style="display:none"></div>
      <div id="divmargin"></div>
   

   <div class = "submit">
      <input type = "submit" value = "저장" class = "save">
   </div>
   </form>    



<hr class = "line-bar">



<!-- 기본 정보 End -->




 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mypage.js"></script>
</body>
</html>