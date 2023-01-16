<!-- MEMORY -->

<?php
//on ouvre et récupere les variables sessions

if (isset($_SESSION['Selection'])) {
    $Selection = $_SESSION['Selection'];
} else {
    $Selection = [];
}

require('Card2.php');

$PosArray = [];

//echo $_SESSION['Tentatives'];

if (empty($_SESSION['Tableaux'])) {
    $_SESSION['Tentatives'] = 0;
    $Tableaux = [];
    for ($i = 1; $i <= $nbPaires; $i++) {

        //genere un chiffre random entre 0 et 22 (car on a 22 cartes) il choisira les cartes au hasard
        $randId = rand(1, 22);

        //verifie que la carte n'a pas déja été choisie ; évite les doublons
        if (in_array($randId, $PosArray)) {
            $i--;
        } else {
            array_push($PosArray, $randId);
            $Card = new Card2;
            $Card->CreationCarte($randId);
            $Tableaux = $Card->CreerTableaux($Tableaux);
        }

    }

    shuffle($Tableaux);
    shuffle($Tableaux);

    $_SESSION['Tableaux'] = $Tableaux;

} else {
    $Tableaux = $_SESSION['Tableaux'];
}

//determine l'image cliqué
if ($_POST['rateButton']) {
    $keys = array_keys($_POST['rateButton']);
    $clicked = $keys[0];

    $Tableaux[$clicked] = array_replace($Tableaux[$clicked], array('status' => 1));
    $_SESSION['Tableaux'] = $Tableaux;



    array_push($Selection, $clicked);
    $_SESSION['Selection'] = $Selection;

    if (empty($_SESSION['Tentatives'])) {
        $_SESSION['Tentatives'] = 1;
    } else {
        $_SESSION['Tentatives']++;
    }

    if ($_SESSION['Tentatives'] >= 3 and $Tableaux[$_SESSION['Selection'][0]]['nom'] != $Tableaux[$_SESSION['Selection'][1]]['nom']) {

        //re-retourne la carte
        $Tableaux[$_SESSION['Selection'][0]] = array_replace($Tableaux[$_SESSION['Selection'][0]], array('status' => 0));
        array_shift($_SESSION['Selection']); //et la supprime de la selection

        //la nouvelle carte en pos 0 est celle choisie en seconde, retourné
        $Tableaux[$_SESSION['Selection'][0]] = array_replace($Tableaux[$_SESSION['Selection'][0]], array('status' => 0));
        array_shift($_SESSION['Selection']); //et supprimé de la liste
        //la troisieme carte choisie arrive maintenant en premiere position
        $_SESSION['Tableaux'] = $Tableaux;
        //reset les tentatives
        $_SESSION['Tentatives'] = 1;
        $_SESSION['Essais'] = $_SESSION['Essais'] + 1;

    } elseif ($_SESSION['Tentatives'] >= 3 and $Tableaux[$_SESSION['Selection'][0]]['nom'] == $Tableaux[$_SESSION['Selection'][1]]['nom']) {
        array_shift($_SESSION['Selection']); //et la supprime de la selection
        array_shift($_SESSION['Selection']); //et la supprime de la selection
        $_SESSION['Tentatives'] = 1;
        
    }

}


