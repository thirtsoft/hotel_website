<?php
  session_start();
  require_once('dp.php');
  
  $login = isset($_POST['user'])?$_POST['user']:"";
  $password = isset($_POST['pass'])?$_POST['pass']:"";

  $requete = "select * from utilisateur where username='$login' and password='$password'";
  $resultat = $pdo->query($requete);

  if($utilisateur = $resultat->fetch()){
      if($utilisateur['actived']==1){
          $_SESSION['utilisateur']=$utilisateur;
          header('location:accueil.php');
          if($utilisateur['poste']=='admin')
            $_SESSION['admin']=$utilisateur['poste'];
          else if($utilisateur['poste']=='Dev')
            $_SESSION['Dev']=$utilisateur['poste'];
          else if($utilisateur['poste']=='Analyste')
            $_SESSION['Analyste']=$utilisateur['poste'];
          else if($utilisateur['poste']=='compta')
            $_SESSION['compta']=$utilisateur['poste'];
      }else {
        $_SESSION['erreurLogin']="<strong>Erreur!!</strong>Votre compte est désactiver.<br> Veuillez contacter l'administrateur";
          header('location:index.php');
      }
    }else{
        //echo "<strong>Erreur!!</strong>Votre compte est désactiver.<br> Veuillez contacter l'administrateur";
      $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou mot de passe incorrect";
      header('location:index.php');
    }

  
?>