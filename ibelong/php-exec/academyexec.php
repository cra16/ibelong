<?php
// 파일명: academyexec.php
// 설명: 학회 관리자가 학회 페이지 변경할 경우 실제 처리 담당
// Session start 
session_start();

 // Manager judge
require_once('../php-config/auth.php');
// DB connection
require_once('../php-config/DB_INFO.php');

//  이미지 저장 
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];


$s_file_name=iconv('UTF-8','EUC-KR',$file_name); 
$file_path = '../clubimg/'.$s_file_name;

$move_file = move_uploaded_file($tmp_file, $file_path);


// title, text 정보 불러오기
$title= addslashes($_POST['title']);
$text= addslashes($_POST['text']);
$academy_name= $_POST['name'];

//update photo
if ($move_file == true)
{
    $sql = "UPDATE academy
    SET img_name='$file_name'
    WHERE a_name='$academy_name'";
    if ($link->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}
else 
{
    echo "ERROR: File not moved correctly";
}

//update title
if ($title != "") 
{
    $sql = "UPDATE academy
    SET title='$title'
    WHERE a_name='$academy_name'";
    if ($link->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}

//update content
if ($text !="") 
{
    $sql = "UPDATE academy
    SET text ='$text'
    WHERE a_name='$academy_name'";
    if ($link->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}
$link->close();

//back to academypage
header("Location: ../php-views/academypage.php");    
