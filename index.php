<?php 
session_start();
require 'init.php';



if(isset($_POST['reset'])){
   session_destroy();
}

$pos = checkImage();
if($pos != null){
   $_SESSION['left'] = $pos[0];
   $_SESSION['top'] = $pos[1];
   $_SESSION['sourceImage'] = $pos[2];
   
}

if(isset($_SESSION['left']) && isset($_SESSION['top']) && isset($_SESSION['sourceImage'])){
   $left = $_SESSION['left'];
   $top = $_SESSION['top'];
   $sourceImage = $_SESSION['sourceImage'];
}else{
   $left = 0;
   $top = 0;
   $sourceImage = "";
}



?>
<!DOCTYPE html>
<html>
   <head>
      <style>
         body{
            text-align:center;
         }
         .image-ole{
            background-size:cover;
            background-position: center;
            width: 800px;
            height: 444px;
            margin:0 auto;
            float: left;
         }

         .image-ole-result{
            width:50px;
            height: 50px;
            border: 4px solid red;
            position: relative;
            z-index: 10;
         }

         .source-image{
            background-position: center;
            float: right;
            width: 350px;
            height: 444px;
            background-size: cover;
            background-repeat: no-repeat;
         }

         .form{
            clear: both;
         }
      
      </style>
      <script type="text/javascript">
         function actualizar(){location.reload(true);}
         setInterval("actualizar()",5000);
      </script>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div>
         <h1>¿Dónde estoy?</h1>
         <div>
         <div class="image-ole" style="background-image:url('img/target.png');">
         <div class="image-ole-result" style="left:<?=$left?>px;top:<?= $top ?>px"></div> 
         </div>
         <div class="source-image" style="background-image:url('img/sources/<?= $sourceImage ?>');"></div>
      
      </div>
      <div>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="submit" value="resetear" name="reset" >
         </form>
      </div>
   </div>
   </body>
</html>


   