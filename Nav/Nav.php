<?php
  session_start();
  $loginSession=$_SESSION['login'];
  $passwordSession=$_SESSION['password'];
  
?>


<link rel="stylesheet" type="text/css" href="Nav/Nav.css"/>
 <!-- menu nav -->
  <ul id="nav">  
      
        </form>
        <li><a href="/memory/Temp.php">Acceuil</a></li>
        
       
        <!-- cette partie de menu nav change si l'utilisateur est connecté-->
        <?php 
        //si l'utilisateur est connecté
        if (!empty($loginSession) ){
            echo "<li><a href=",'/memory/profil.php',">Bienvenue ",$loginSession,"</a></li>"; //affiche bienvenu $Utilisateur
            echo "<li><a href=",'/memory/connexion.php',">Se déconnecter</a></li>";      //affiche se déconnecter (envoie a la page de login car il déco automatiquement)
            } 
            //si l'utilisateur n'est pas connecté
            else{
                echo "<li><a href=","/memory/inscription.php",">S'inscrire</a></li>";// affiche s'inscire
                echo "<li><a href=",'/memory/connexion.php',">Se Connecter</a></li>";//affiche se conecter
            }
        ?>
    </ul>
    <!--  fin menu nav -->