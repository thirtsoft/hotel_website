<?php
    require_once('db.php'); 
    $message = isset($_GET['message'])?$_GET['message']:"Erreur";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/monStyle.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
        <div class="panel panel-danger margetop60">
            <div class="panel-heading"><h4>Erreur:</h4></div>
            <div class="panel-body">
                <h3><?php echo $message ?> </h3>
                <h4><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour >>>></a></h4>       
            </div>
        </div>
    </div>
</body>
</html>