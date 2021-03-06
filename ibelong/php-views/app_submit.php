<?php
// 파일명: app_submit.php
// 설명: 학생이 해당 그룹에 지원서 쓸 수 있도록 display
// Session start 
session_start();

// DB connection
require_once('../php-config/DB_INFO.php');

//로그인 여부 판단
if(!$_SESSION['USER_NAME']){
  header("Location:firstpage.php");      
}

$userid = $_SESSION['USER_NAME'];

if(!$userid){
echo 1;
}

if(!$_GET['name'])
{
 echo 2;
}

$club= $_GET["name"];
$qry="SELECT * FROM application WHERE id='$club'";
$result=mysqli_query($link,$qry);

//Check whether the query was successful or not
if($result) {

    if(mysqli_num_rows($result) > 0) 
    {
      $member = mysqli_fetch_assoc($result);  
    }

    else 
    {
     echo "지원기간이 아닙니다";
    }
}
else 
{
  die("Query failed");
}

$qry="SELECT * FROM student WHERE id='$userid'";
$result=mysqli_query($link,$qry);

//Check whether the query was successful or not
if($result) {

    if(mysqli_num_rows($result) > 0) 
    {
      $user = mysqli_fetch_assoc($result); 
    
    }

    else 
    {
     echo "지원서가 존재하지 않습니다";
    }
}
else 
{
  die("Query failed");
}

//Sanitize the POST values
  $short_info=array("use","use","use","use","use",$member['served'],$member['mail'],$member['activity']);
  $sub_info=array($member['sr1'],$member['sr2'],$member['sr3'],$member['sr4'],$member['sr5'],$member['sr6'],$member['sr7'],$member['sr8'],$member['sr9'],$member['sr10']);
  $label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","학기");
  $question_placeholder= array($user['student_name'],$user['stuid'],"ex) 1전공/2전공","Phone number","남/여","남성인 경우만 해당","ex)ibelong@naver.com","ex)3학기");
  $title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7'],$member['title8'],$member['title9'],$member['title10']);
  $explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7'],$member['explain8'],$member['explain9'],$member['explain10']);
  $pass_name=array("name","stuid","major","p_num","gender","served","mail","activity");
  $text_name=array("content1","content2","content3","content4","content5","content6","content7","content8","content9","content10");
  $stu_number = $user['stuid'];

  $index = $user['index'];

  $my_qry = "SELECT * FROM result WHERE club_name='$club' AND id='$userid'";
  $my_result = mysqli_query($link,$my_qry);

  //Check whether the query was successful or not
  if($my_result) {

      if(mysqli_num_rows($my_result) > 0) //미리 정보 존재
      {
        $my_temp = mysqli_fetch_assoc($my_result);
        $pass_temp = array($my_temp['name'], $my_temp['stu_id'], $my_temp['major'], $my_temp['p_num'], $my_temp['gender'], $my_temp['served'], $my_temp['mail'],$my_temp['activity']);
        $text_temp = array($my_temp['text1'], $my_temp['text2'], $my_temp['text3'], $my_temp['text4'],
        $my_temp['text5'], $my_temp['text6'], $my_temp['text7'], $my_temp['text8'], $my_temp['text9'], $my_temp['text10']);
        $file_temp = $my_temp['file_name'];

        $info = 1;
      }
      else 
      {
       $info = 0;
      }
  }


?>

<!DOCTYPE HTML> 
<html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>application making page</title>

    <!-- Bootstrap -->
    <link href="../css/app_make.css?version=2154" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    
    <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script> 
    <script type="text/javascript">

      function ok(){
        var message = "임시저장 후에는 서버에 내용이 저장되고 제출 되지 않습니다.\n제출 후에는 수정이 불가능합니다. 한번 더 확인후 제출 버튼을 눌러주세요.";
        var result = confirm(message);

        if(result == false){
            return false;
        }
      }
      function disable(){
        alert('이미 제출하셨습니다');
      }
      function help(){
        window.open("help.php","도움말", "left=200, top=200, width=350, height=420 , location=no, scrollbars=no, resizable=yes");
      }
      function ok_submit(){
        var message2 = "임시저장하시겠습니까?";
        var result = confirm(message2);

        if(result == false){
            return false;
        }
      }
      function manager(){
        alert('관리자는 지원이 불가합니다');
        return false;
      }

    </script>

  </head>

<body> 

<?php
if( $info == 1){ // 정보 존재
?>
  <div class="formContentsLayout">
    <form enctype='multipart/form-data' method="POST" action="app_storage.php" class="form-horizontal" onsubmit=" return ok() " > 
       <h3 class = "application">지원서</h3>    
      <div id="divmargin"></div>              
      <h5 class = "club-name"> - <?php echo $club; ?> - </h5> 
      <div id="divmargin"></div>   

      <hr class = "line-bar">
      <div id="submit_container">
        <!-- short text -->
      <?php
      for($i = 0; $i<4; $i++)
      {
      ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$i]; ?>
        <div class="form-input">
          <input type="text" class="form-control short-length"  
          placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $pass_name[$i]; ?>" 
        <?php if($i < 2){?> disabled title="변경 불가한 항목입니다." <?php } ?> 
        name="<?php echo $pass_name[$i]; ?>"
        <?php if($i > 1)?> value = '<?php echo $pass_temp[$i]; ?>' > 
        </div></div>
      </div>  

      <?php
      }
      ?>
      <!-- 성별 -->
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$i]; ?>
        <div class="form-checkbox">
          <?php
          if($pass_temp[$i] == 'man'){ //정보존재 ?>
            <input type="radio" id="man" name="gender" value="man" checked display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" display:"none">
            <label for="woman">여자</label>
          <?php
        }else if($pass_temp[$i] == 'woman'){ ?>
            <input type="radio" id="man" name="gender" value="man" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" checked display:"none">
            <label for="woman">여자</label>
          <?php
        }else{ ?>
            <input type="radio" id="man" name="gender" value="man" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" display:"none">
            <label for="woman">여자</label>
          <?php
        } ?>
        </div></div>
      </div>  
      <!-- 군필여부 -->
      <?php
      $i = 5;
      if($short_info[$i]=="use"){
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label"><?php echo $label_name[$i]; ?>
          <div class="form-checkbox">
            <?php
            if($pass_temp[$i] == 'YES'){ // yes ?>
              <input type="radio" id="served" name="served" checked display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            }else if($pass_temp[$i] == 'NO'){ //no ?>
              <input type="radio" id="served" name="served" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" checked display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            }else{  ?>
              <input type="radio" id="served" name="served" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            } ?>
          </div></div>
        </div>
      <?php
      }

      // 이메일 / 학기
         for($i = 6; $i<8; $i++)
        {
          if($short_info[$i]=="use"){  
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label"><?php echo $label_name[$i]; ?>
          <div class="form-input">
            <input type="text" class="form-control short-length" placeholder="<?php echo $question_placeholder[$i]; ?>" 
                   style="display:block" id="<?php echo $pass_name[$i]; ?>" name="<?php echo $pass_name[$i]; ?>"
                   value = '<?php echo $pass_temp[$i]; ?>' >
             </div></div>
        </div>  
      <?php
          }
        }
      ?>
          
      <!-- long text -->
      <?php
        for($i = 0; $i<10; $i++)
        {
          if($sub_info[$i]=="notuse")
          {
            break;
          }
          if($sub_info[$i]=="use"){
      ?>
          <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
            <div class="form-label"><?php echo $title[$i]; ?></div>
            <textarea class="form-input" rows="3" name="<?php echo $text_name[$i]; ?>"><?php if($text_temp[$i] != '0'){ echo $text_temp[$i]; } ?></textarea>
            <span class="form-help"> <?php echo $explain[$i]; ?></span>    
          </div>  
      <?php
          }
      ?>
      <?php
        }
      ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label">자신이 가장 잘 쓴 코드 혹은 포트폴리오가 있으시면 첨부해주세요! (옵션)<br>
          -파일 업로드는 100M로 제한 됩니다.<br>
          -100M 이상의 파일은 cra.handong@gmail.com 으로 보내주세요
          <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
          <input name="codefile" type="file"/>
          <?php if($file_temp!=NULL){
            echo "현재 서버에 ".$file_temp."이 저장되어 있습니다. 파일을 바꾸시려면 재업로드 해주세요.";
          }
          ?>
          </div>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label">제출기한
        <div class="form-submit">
          <?php echo $member['s_month']; ?>월 <?php echo $member['s_day']; ?>일 까지부터
          <?php echo $member['month'];?>월 <?php echo $member['day'];?>일 오후 11:59 까지
        </p>
        </div>
        </div>
      </div> 

      <input name="club_name" value="<?php echo $club; ?>" type="hidden">
      <?php
        $query = "SELECT * FROM result WHERE id = '$userid' AND storage='0' AND club_name = '$club'";
        $re_query = mysqli_query($link,$query);
        $fetch = mysqli_fetch_array($re_query);

        if( $fetch[0] == NULL ){
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 submit_content">
          <button class = "submit_button" type="submit" name="temp" id = 'temp' onsubmit ="ok_submit()" value="<?php echo $club; ?>">임시저장</button>
          <button class = "submit_button" type="submit" name="real" id ='real' onsubmit ="ok()" value="<?php echo $club; ?>">제출</button>
      </div>
      <?php
        }else{ ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 submit_content"> 
          <button class = "submit_button" type="button" name="temp" id = 'temp' onclick="disable()" value="<?php echo $club; ?>">임시저장</button>
          <button class="submit_button" type="button" name="real" id ='real' onclick="disable()" value="<?php echo $club; ?>">제출</button>
        </div>
      <?php } ?>
      </div>
    </form>
  </div>

<?php 
}else{ //정보 존재하지 않음 
  ?>
  <div class="formContentsLayout">
    <form enctype="multipart/form-data" method="POST" action="app_storage.php" class="form-horizontal" <?php if($index==0){ ?> onsubmit=" return ok() " <?php }else{ ?> onsubmit = "return manager()" <?php } ?>> 
      <h3 class = "application">지원서</h3>    
      <div id="divmargin"></div>              
      <h5 class = "club-name"> - <?php echo $club; ?> - </h5> 
      <div id="divmargin"></div>   

      <hr class = "line-bar">
      <div id="submit_container">
        <!-- short text -->
      <?php
      for($i = 0; $i<4; $i++)
      {
      ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$i]; ?>
        <div class="form-input">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $pass_name[$i]; ?>" 
      <?php if($i < 2){?> disabled title="변경 불가한 항목입니다." <?php } ?> name="<?php echo $pass_name[$i]; ?>"> 
        </div></div>
      </div>  
      <?php  }  ?>

      <!-- 성별 -->
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$i]; ?>
        <div class="form-checkbox">
            <input type="radio" id="man" name="gender" value="man" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" display:"none">
            <label for="woman">여자</label>
        </div></div>
      </div>  

      <!-- 군필여부 -->
      <?php
      $i = 5;
      if($short_info[$i]=="use"){
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label"><?php echo $label_name[$i]; ?>
          <div class="form-checkbox">
              <input type="radio" id="served" name="served" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served"  display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
          </div></div>
        </div>
      <?php
      }

      // 이메일 / 학기
         for($i = 6; $i<8; $i++)
        {
          if($short_info[$i]=="use"){
          
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label"><?php echo $label_name[$i]; ?>
          <div class="form-input">
          <input type="text" class="form-control short-length"   placeholder="<?php echo $question_placeholder[$i]; ?>"
                   style="display:block" id="<?php echo $pass_name[$i]; ?>" name="<?php echo $pass_name[$i]; ?>">
            </div>
            </div>
        </div>  
      
      <?php
          }
        }
      ?>
    
      <!-- long text -->

      <?php
        for($i = 0; $i<10; $i++)
        {
          if($sub_info[$i]=="notuse")
          {
            break;
          }
          if($sub_info[$i]=="use"){
      ?>
          <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
            <div class="form-label"><?php echo $title[$i]; ?></div>
            <textarea class="form-input" rows="3" name="<?php echo $text_name[$i]; ?>"></textarea>
            <span class="form-help"><?php echo $explain[$i]; ?></span>    
          </div>  
      <?php
          }
      ?>
      <?php
        }
      ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
          <div class="form-label">자신이 가장 잘 쓴 코드 혹은 포트폴리오가 있으시면 첨부해주세요! (옵션)<br>
          -파일 업로드는 100M로 제한 됩니다.<br>
          -100M 이상의 파일은 cra.handong@gmail.com 으로 보내주세요
          <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
          <input name="codefile" type="file" />
          </div>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label">제출기한
        <div class="form-submit">
          <?php echo $member['s_month']; ?>월 <?php echo $member['s_day']; ?>일 부터
          <?php echo $member['month'];?>월 <?php echo $member['day']; ?>일 오후 11:59 까지
        </div>
        </div>
      </div>    
      <input name="club_name" value="<?php echo $club; ?>" type="hidden">

        <br>
             <?php
        $query = "SELECT * FROM result WHERE id = '$userid' AND storage='0' AND club_name = '$club'";
        $re_query = mysqli_query($link,$query);
        $fetch = mysqli_fetch_array($re_query);

        if( $fetch[0] == NULL ){
      ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 submit_content">
          <button class = "submit_button" type="submit" name="temp" id = 'temp' onsubmit = "ok_submit()" value="<?php echo $club; ?>" >임시저장</button>
          <button class = "submit_button" type="submit" name="real" id ='real' onsubmit ="ok()" value="<?php echo $club; ?>">제출</button>
       </div> 
      <?php
        }else{ ?>
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 submit_content">  
         <button class = "submit_button" type="button" name="temp" id = 'temp' onclick="disable()" value="<?php echo $club; ?>" class = "save col-lg-4">임시저장</button>
         <button class = "submit_button col-lg-4 col-md-4 col-xs-4" type="button" name="real" id ='real' onclick="disable()" value="<?php echo $club; ?>" class = "save col-lg-4">제출</button>
        </div>
  <?php } ?>
<?php
}
?>
    </div>
    </form>
  </div>


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">autosize(document.getElementsByTagName("textarea"));</script>
</body>
</html>