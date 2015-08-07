function PopUp(){
  document.getElementById("pop_up").style.display="none";
}

function wrapWindowByMask(i){
  //화면의 높이와 너비를 구한다.
  var maskHeight = window.innerHeight;  
  var maskWidth = window.innerWidth;  
      
  //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
  $('#mask').css({'width':maskWidth,'height':maskHeight});  
  //애니메이션 효과 - 일단 0초동안 까맣게 됐다가 60% 불투명도로 간다.
  $('#mask').fadeIn(0);      
  $('#mask').fadeTo("slow",0.6);    
  //윈도우 같은 거 띄운다.
  $('.window'+i).show();
}

$(document).ready(function(){
  //검은 막 띄우기


  //닫기 버튼을 눌렀을 때
  $('.layer .cbtn').click(function (e) {  
      //링크 기본동작은 작동하지 않도록 한다.
      e.preventDefault();  
      $('#mask, .layer').hide();  
  });
  //닫기 버튼을 눌렀을 때

});