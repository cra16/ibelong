<?php
  // Session start 
  session_start();

  // DB connection
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "gksehdeo357";    //수정할 부분->비밀번호입력
  $mysql_database = "formzip";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database"); 
  $club_name= $_POST['name'];
  echo $club_name;
  $qry="SELECT * FROM clubstorage WHERE id='$club_name'";   //대체 가능한 부분
  $result=mysql_query($qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysql_num_rows($result) > 0) 
      {
        $member = mysql_fetch_assoc($result);
        
      }

      else 
      {
       echo "Data call failed";
      }
  }
  else 
  {
    die("Query failed");
  }
echo $member['id'];
echo $member['title'];
echo $member['img_name'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> 동아리페이지 변경 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_page.css" rel="stylesheet">
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
        <li><a href="#">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
   
  
  
  <div id = "wrap">
    <div id = "navigation">Formzip </div>
    <!-- 동아리 수정 Start-->
    <div id = "section">
      <form class = "content" method = "POST" action="clubexec.php" enctype="multipart/form-data">
        <img class = "picture" src = "../clubimg/<?php echo $member['img_name']; ?>">   <!-- *그림 가져오기 -->
        
      <div class="containerbox">
        <div class="form-group">
          <label for="inputEmail" class="col-lg-3 control-label">파일 업로드</label>
          <div class="col-lg-10">
          <input type="file" class="form-control" name="upload_file">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Title</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" name="title" placeholder="동아리 제목을 입력해주세요">
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">동아리 설명</label>
            <div class="col-lg-10">
            <textarea class="form-control" rows="3" name="text"></textarea>   
            </div>
        </div>  
      </div>
    </div>
   
    <!-- 동아리 소개 End-->

    <!-- 동아리 프로필 Start-->
    <div id = "aside">
      <table class = "profile">
        <tr>
          <input class = "club-logo" type ="text" value = "<?php echo $club_name; ?>">  <!-- *동아리 이름 (로고)-->
        </tr>
        <tr>
          <button class = "club-apply-bt" type="submit" name="name" value="<?php echo $club_name; ?>">수정하기</button>
        </tr>
      </table>
    </div>
    </form>
    <!-- 동아리 프로필 End-->
  </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

