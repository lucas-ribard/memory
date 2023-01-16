<?php
require("Bdd.php");
class Card2 extends Bdd
{
    protected $bdd;
    private $id; //id de la carte
    private $nom; //nom de la carte
    private $lien; //addr de l'image
    private $back; //addr de l'image
    private $status; //retourné ou pas
    private $CarteInfo;

    public function __construct()
    {
        parent::__construct();


    }

    public function CreationCarte($test)
    {

        $CarteInfo = parent::CarteInfo($test);
        $this->id = $CarteInfo["id"];
        $this->nom = $CarteInfo["nom"];
        $this->lien = $CarteInfo["lien"];
        $this->status = 0;

    }


    public function CreerTableaux($Tableaux)
    {

        $Carte = [];
        $Carte["id"] = $this->id;
        $Carte["nom"] = $this->nom;
        $Carte["lien"] = $this->lien;
        $Carte["status"] = $this->status;
        array_push($Tableaux, $Carte);
        //on rajoute la meme carte pour avoir notre paire
        array_push($Tableaux, $Carte);
        return $Tableaux;

    }

    public function Flip(){
        if ($this->status == 1) {
            $this->status = 0;
        } elseif ($this->status == 0) {
            $this->status = 1;
        }
    }
    public function IsFlipped($id)
    {

        //print_r(array_search($id,$Tableaux));
    }

    public function PubliScore($login,$score)
    {
        parent::PubliScore($login,$score);
    }

    //GET  ----------------------
    public function SetId($id)
    {
        $this->id = $id;
    }

    public function SetNom($nom)
    {
        $this->nom = $nom;
    }

    public function SetLien($lien)
    {
        $this->lien = $lien;
    }

    public function SetStatus($status)
    {
        $this->id = $status;
    }

    //SET -----------------------
    public function GetId()
    {
        return $this->id;
    }
    public function GetNom($nom)
    {
        return $this->nom;
    }

    public function GetLien()
    {
        return $this->lien;
    }

    public function GetStatus()
    {
        return $this->status;
    }

}

?>