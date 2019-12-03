<?php
    session_start();
    if(isset($_SESSION['erreurLogin'])){
        $erreurLogin = $_SESSION['erreurLogin']; 
    }else{
        $erreurLogin = "";
    }
    session_destroy();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>KADIANDOUMAN ADMIN</title>
     
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>

 <div class="container">
    <div id="login">
      <form method="post" action="seConnecter.php">
        <?php if(!empty($erreurLogin)){?>
            <div class="alert alert-danger">
              <?php echo $erreurLogin ?>
            </div>
        <?php }?>
        <fieldset class="clearfix">

          <p><span class="fontawesome-user"></span><input type="text" name="user" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
          <p><span class="fontawesome-lock"></span><input type="password" name="pass" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
          <p><input type="submit" name="sub"  value="Login"></p>

        </fieldset>
      </form>
    </div> <!-- end login -->

  </div>
  <div class="bottom">  <h3><a href="./index.php">KADIANDOUMAN HOMEPAGE</a></h3></div>
  
  
</body>
</html>


   