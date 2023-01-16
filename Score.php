<?php
session_start();
$loginSession = $_SESSION['login'];
$passwordSession = $_SESSION['password'];

include_once('Bdd.php');

$BDD = new Bdd;
$Top10=$BDD->GetTop10();

?>
<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Memory</title>
    <link href="CSS/index.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

</head>

<body>

    <!-- Menu de naviguation -->
    <?php include 'Nav/Nav.php' ?>

    <!-- contenu principal -->

    <section id="jeux">
      
    <?php
        foreach ($Top as $score){
            
            echo $score['User'];
            echo $score['Score'];
            echo "<br>";
        }
    ?>
    

    </section>


</body>

<?php //include 'Footer/Footer.php' 



?>



</html>