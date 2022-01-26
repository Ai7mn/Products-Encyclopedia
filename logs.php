<?php
include_once "Nav.php";
if ( isset($_POST['reset']) ) {
    $_SESSION['log'] = Array();
    header("Location: logs.php");
    return;
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log</title>
    <script type="text/javascript" src="jquery.min.js">
    </script>
    <style media="screen">

      #logContent{
        position: absolute;
        top: 50%;
        left: 40%;
        margin: -25px 0 0 -25px;
      }
    </style>
  </head>
  <body>
    <h1 style="position: absolute; top: 40%; left: 35%;  margin: -25px 0 0 -25px;">Products You have Visited</h1>


    <div id="logContent">
        <img src="spinner.gif" alt="Loading..."/>
    </div>


   <script type="text/javascript" src="jquery.min.js">
   </script>
  <script type="text/javascript">
  function updateLog() {
      window.console && console.log('Requesting JSON');
      $.getJSON('json.php', function(rowz){
       window.console && console.log('JSON Received');
         window.console && console.log(rowz);
         $('#logContent').empty();
        for (var i = 0; i < rowz.length; i++) {
            entry = rowz[i];
              $('#logContent').append('<p>'+entry[0] +
                '<br/>&nbsp;&nbsp;'+entry[1]+"</p><br>\n");
         }
         if (rowz.length > 0) {
           $('#logContent').append('<form method="post"><input class="btn btn-danger" type="submit" name="reset" value="Reset"></form>');
           setTimeout('updateLog()', 4000);
         }

    });
  }

  // Make sure JSON requests are not cached
  $(document).ready(function() {
    $.ajaxSetup({ cache: false });
    updateLog();
  });
  </script>
  </body>
</html>
