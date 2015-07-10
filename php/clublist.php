


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Club List</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/clublist.css" rel="stylesheet">



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
      <a class="navbar-brand" href="firstpage.html">Form_Zip</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Login</a></li>
        <li><a href="#">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  

   <h2>동아리 검색</h2>

   <!-- Club Search Bar-->
   <div>
    <form  class = "search" action='complete.php' method='GET'>
      <fieldset>
       <select class = "search-category">
        <option value = "perform-cate">공연/음악</option>
        <option value = "sport-cate">스포츠</option>
        <option value = "academic-cate">학술</option>
        <option value = "etc-cate">기타</option>
       </select>
       <input type = "text" class = "search-text" >
       
       <input type = "submit" class = "search-button" value = "검색">

      </fieldset>
    </form>
   </div>
  <!-- Club Search Bar End-->
  <!-- Club List Buttons Start-->
  <table>
    <tr>
      <td>
        <input type ="button" value = "C.R.A"; id = "academic" class = "club-element"/>
      </td>
      <td>
        <input type ="button" value = "God's Fellow"; id = "perform" class = "club-element"/>
      </td>
      <td>
        <input type ="button" value = "천풍해세"; id = "sport" class = "club-element"/>
      </td>            
    </tr>
    <tr>
      <td>
        <input type ="button" value = "피치 파이프"; id = "perform" class = "club-element"/>
      </td>
      <td>
        <input type ="button" value = "어메이징 스토리"; id = "perform" class = "club-element"/>
      </td>
      <td>
        <input type ="button" value = "H 밀란"; id = "sport" class = "club-element">
      </td>      
    </tr>
    <tr>
      <td>
        <input type ="button" value = "네오(NEO)"; id = "perform" class = "club-element">
      </td>
      <td>
        <input type ="button" value = "꾼들"; id = "perform" class = "club-element">
      </td>
      <td>
        <input type ="button" value = "MIC"; id = "perform" class = "club-element">
      </td>      
    </tr>
    <tr>
      <td>
        <input type ="button" value = "고스트"; id = "academic" class = "club-element">
      </td>
      <td>
        <input type ="button" value = "G.O."; id = "perform" class = "club-element">
      </td>
      <td>
        <input type ="button" value = "즉새두"; id = "perform" class = "club-element">
      </td>      
    </tr>
  </table>
  <!-- Club List Buttons End-->





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


