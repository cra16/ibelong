<?php
//Excel download를 받을 수 있도록 header 설정
  session_start();
  require_once('DB_INFO.php');
  require_once('../php-config/auth.php');
  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=utf-8");
  header("Content-Disposition: attachment; filename=Download.xls");
  Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");
//db connect
  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");
  mysqli_set_charset($connect, "utf8");
  $connect=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
  
  mysqli_set_charset($connect, "utf8");
  mysqli_select_db($connect,DB_NAME);

$id = $_SESSION["USER_NAME"]; //$id => 아이디
$qry = "SELECT * FROM student WHERE id = '$id'";
$result = mysqli_query($link,$qry);
$check = mysqli_fetch_assoc($result);

$club_name=$check['c_name'];
 //db에 있는 질문 목록과 답변 목록 가져오기
$result = mysqli_query($connect,"SELECT * FROM result WHERE club_name = '$club_name'"); 
  $qry = mysqli_query($connect,"SELECT * FROM application WHERE id = '$id'");
  
  $check = mysqli_fetch_array($qry);
  //표의 형식으로 html 문서 작성하기
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
<table border=1 cellpadding=2 cellspacing=5>

<tr>
<td>name</td>
<td>student_id</td>
<td>major</td>
<td>phone_number</td>
<td>gender</td>
<?php 
 if($check['served']=="use")
  echo '<td>served</td>';
 if($check['mail']=="use")
  echo '<td>mail</td>';
 if($check['activity']=="use")
  echo '<td>activity</td>';
 if($check['sr1']=="use")
  echo '<td>Answer1</td>';
 if($check['sr2']=="use")
  echo '<td>Answer2</td>';
 if($check['sr3']=="use")
  echo '<td>Answer3</td>';
 if($check['sr4']=="use")
  echo '<td>Answer4</td>';
 if($check['sr5']=="use")
  echo '<td>Answer5</td>';
 if($check['sr6']=="use")
  echo '<td>Answer6</td>';
 if($check['sr7']=="use") 
  echo '<td>Answer7</td>';
if($check['sr8']=="use") 
  echo '<td>Answer8</td>';
if($check['sr9']=="use") 
  echo '<td>Answer9</td>';
if($check['sr10']=="use") 
  echo '<td>Answer10</td>';
 
  echo '</tr>';

while($array = mysqli_fetch_array($result)){
?>
    <tr>
        <td width=70>
            <p align=center><?php echo $array['name'];?></p>
        </td>
        <td width=100>
            <p align=center><?php echo $array['stu_id'];?></p>
        </td>
        <td width=70>
            <p align=center><?php echo $array['major'];?></p>
        </td> 
        <td width=100>
            <p align=center><?php echo $array['p_num'];?></p>
        </td> 
        <td width=50>
            <p align=center><?php echo $array['gender'];?></p>
        </td> 
        <?php
        if($check['served']=="use"){?>
        <td width=50>
            <p align=center><?php echo $array['served'];?></p>
        </td>
        <?php }
        if($check['mail']=="use"){?>
        <td width=150>
            <p align=center><?php echo $array['mail'];?></p>
        </td>
        <?php }
        if($check['activity']=="use"){?> 
        <td width=50>
            <p align=center><?php echo $array['activity'];?></p>
        </td>
        <?php } 
        if($check['sr1']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text1'];?></p>
        </td> 
        <?php }
        if($check['sr2']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text2'];?></p>
        </td> 
        <?php }
         if($check['sr3']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text3'];?></p>
        </td>
        <?php }
        if($check['sr4']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text4'];?></p>
        </td>
        <?php }
        if($check['sr5']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text5'];?></p>
        </td>
        <?php }
        if($check['sr6']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text6'];?></p>
        </td> 
        <?php }
        if($check['sr7']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text7'];?></p>
        </td> 
        <?php }
        if($check['sr8']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text8'];?></p>
        </td>
        <?php }
        if($check['sr9']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text9'];?></p>
        </td>
        <?php }
        if($check['sr10']=="use"){?>
        <td width=100>
            <p align=center><?php echo $array['text10'];?></p>
        </td>
         <?php } ?>    
    </tr>      
<?php
   }
?>
  </body>
</html>