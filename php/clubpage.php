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

  if($_GET['name']!=""){
   $club_name= $_GET['name'];
   $_SESSION["GROUP"] = $club_name;
  }
  else {
    $club_name=$_SESSION['GROUP'];
    $_GET['name']=$club_name;
  }
  
  $qry="SELECT * FROM club WHERE c_name='$club_name'";   
  $result=mysqli_query($bd,$qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysqli_num_rows($result) > 0) 
      {
        $member = mysqli_fetch_assoc($result);
        
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
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> 동아리 페이지 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_page.css" rel="stylesheet">

    <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=250, height=100 , scrollbars=no, resizable=yes");
      }
    function warning(){
      alert("지원을 원하실 경우 로그인을 해 주세요");
    }
    function notexist(){
      alert("지원기간이 아닙니다");
      return false;
    }
    </script>

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
        <li><a href="#" onclick = "help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
  

<!--관리자 여부에 따른 action 위치 변경  -->
<?php
//관리자여부 확인
$id = $_SESSION['USER_NAME'];
$sql = "SELECT * FROM student WHERE id = '$id'";
$check_result = mysqli_query($bd,$sql);
$check = mysqli_fetch_array($check_result);
$cname = $check['c_name'];

  if($cname==$club_name){
    $IsManager="true";
  }

  else{
    $IsManager="false";
  }

?>
  
  <div id = "wrap">
    <div id = "navigation">동아리 소개:: </div>
    <!-- 동아리 소개 Start-->
    <div id = "section">
      <div class = "content">
        <div class="form-group">
          <img class = "picture" src = "../clubimg/<?php echo $member['img_name']; ?>">   <!-- *그림 가져오기 -->
        </div>
        <div >
          <h3 class = "title"><?php echo $member['title']; ?></h3>
        </div>    
        <div >
          <p class = "intro"> 
            <?php echo $member['text']; ?>
          </p>
        </div>    
     </div>
    </div>

    <!-- 동아리 소개 End-->
  
    <!-- 동아리 프로필 Start-->
 
    <div id = "aside">
      <table class = "profile">
        <tr>
         <p class = "club-logo"><?php echo $club_name; ?></p> <!-- *동아리 이름 (로고)-->
        </tr>
        <?php
        if($IsManager=="true")  //현재 로그인 한 사람이 관리자인 경우 실행
        {
        ?>
        <tr>
          <form action="clubmodify.php" method="GET">
           <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">페이지 수정</button>
          </form>
        </tr>
        <tr>
          <form action="app_make.php" method="GET">
            <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원서 만들기</button>
          </form>
        </tr>
        <tr>
          <form action="app_preview.php" method="GET">
           <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원서 미리보기</button>
          </form>
        </tr>
        <tr>
          <form action="app_list.php" method="GET">
            <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원자 현황</button>
          </form>
        </tr>
        <?php
        }
        else if($IsManager=="false")  //현재 로그인 개정이 관리자가 아닐경우 실행
        {
          $qry_e = "SELECT * FROM application WHERE id='$club_name'";
          $exist = mysqli_query($bd,$qry_e);
          echo"$exist";
          if ($exist != NULL){ //지원서가 있을 경우
              if($id != "") // 로그인을 한 경우 지원하기 가능
              {    
            ?>  
              <form action="app_submit.php" method="GET">
              <tr>
                <button class = "club-apply-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원하기</button>
              </tr>
            </from>
              <?php
              }
              else // 로그인을 하지 않은경우 지원하기 불가능
              {    
              ?>  
              <form action="login.php" method="POST">
              <tr>
                <td><input class = "club-apply-bt" type ="submit" onclick = "warning()" value = "지원하기" ></td>
              </tr>
            </from>
              <?php
              }
         }else{ //지원서가 없을 경우
          ?>
          <form>
            <tr>
              <td><input class = "club-apply-bt" type = "submit" onclick = "notexist()" value = "지원하기"></td>
            </tr>
          </form>
        <?php
         }
        }
        ?>
      </table>
    </div>





    <!-- 동아리 프로필 End-->
  </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
