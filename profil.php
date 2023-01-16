<?php
    //on ouvre et récupere les variables sessions
    session_start();
    require_once("User.php");

    $id=$_SESSION['id'] ;
    $login=$_SESSION['login'];
    $password=$_SESSION['password'] ;
 
    
   //logique bouton supprimer l'user
    if(!empty($_POST['delete'])) {
        $USER = new User();
        $message=$USER->delete($login,$password);
    }
        
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/profil.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>
 
   <!-- Menu de naviguation -->
   <?php include 'Nav/Nav.php' ?>

    
    <div id="form"> 
        <div id="box">
            <h2>Bienvenue <?php echo $loginSession; ?></h2><br>

            scores<br>
            scores<br>
            scores<br>
            scores<br>
            <br>
            <?php 
                if (isset($message)){
                    echo $message;  //affiche un message d'erreur si probleme
                }   
            ?>
            <!-- bouton pour supprimer l'user (si j'ai le temps ajouter une pop up (modal) )-->
            <form action="" method="post">
            <input type="submit" name="delete" value="supprimer le compte"><br>
            </form>
            
        </div>
    </div>



</body>


</html>
