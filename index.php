<?php
session_start();
$loginSession = $_SESSION['login'];
$passwordSession = $_SESSION['password'];
$nbPaires = $_SESSION['nbPaires'];

function AfficherCarte($Tableaux)
{
    $j = -1;
    foreach ($Tableaux as $carte) {
        if ($carte != 0) {
            $j = $j + 1;

            echo '<form method="post">';
            //Affiché
            if ($carte['status'] === 1) {
                echo '<input type="image"  src="', $carte['lien'], ' "width="250" );>&ensp;';

            } elseif ($carte['status'] === 0) {
                echo '&nbsp;<input type="image" class="img" name="rateButton[', $j, ']" src="Cartes/back.gif" width="250" height="500" "value="1");>  &ensp;  ';

            }
        }
    }
}
//si un nombre de paire a été choisit on lance le jeux
if (isset($nbPaires)) {
    include_once('Jeux.php');
}

//logique bouton nouvelle partie
if (!empty($_POST['GenCarte'])) {
    //détruit toute les var de session mais on garde login et password
    $TempL = $_SESSION['login'];
    $TempP = $_SESSION['password'];
    session_destroy();
    session_start();
    $_SESSION['login'] = $TempL;
    $_SESSION['password'] = $TempP;
    header('Location:/memory/index.php');

}

//logique bouton acces scores
if (!empty($_POST['Score'])) {
    header('Location:/memory/Score.php');
}
//on regarde le status de toutes les carte pour voir si la partie est finie
$_SESSION['FINPartie'] = 0;
foreach ($Tableaux as $carte) {
    if ($carte != 0) {
        if ($carte['status'] == 1) {
            $_SESSION['FINPartie'] = $_SESSION['FINPartie'] + 1;
        }

    }
    //si partie finie on calcule le score
    if ($_SESSION['FINPartie'] == $nbPaires * 2) {
        $_SESSION['SCORE'] = (1000 * $nbPaires) - (100 * $_SESSION['Essais']);
        $message1 = "VOTRE SCORE :";
        if (isset($_SESSION['login']) and isset($_SESSION['password'])) {
            $BDD = new Bdd;
            $login = $_SESSION['login'];
            $score = $_SESSION['SCORE'];
            $BDD->PubliScore($login, $score);
        } else {
            $message2 = "<br>Vous devez être connecté pour enregistrer votre score";
        }
    }
}

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

    <section id="boutons">

        <form action="" method="post">
            <button class="cybr-btn">
                <input class="cybr-btn" type="submit" name="GenCarte" value="Nouvelle Partie">
                <span aria-hidden class="cybr-btn__glitch">Buttons</span>
            </button>

            <button class="cybr-btn">
                <input class="cybr-btn" type="submit" name="Score" value="Score">
                <span aria-hidden class="cybr-btn__glitch">Buttons</span>
            </button>

        </form>


    </section>

    <section id="jeux">
        <div id='menu'>
            <?php
            if (isset($message1)) {
                echo $message1, $_SESSION["SCORE"];
            }
            if (isset($message1)) {
                echo $message2;
            }
            ?>
            <?php
            if (!isset($nbPaires)) {
                include_once 'ChoixDiff.php';

            }

            ?>
        </div>


        <?php AfficherCarte($Tableaux); ?>

    </section>


</body>

<?php //include 'Footer/Footer.php' 



?>



</html>