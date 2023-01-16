<?php
class Bdd{
    protected $bdd;
    public function __construct(){
        $db_username = 'root';
        $db_password = '';

        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=memory;charset=utf8', $db_username, $db_password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "connecté à la base de donnés <br><br>";
        }
        catch(PDOException $e){
            echo "<error>Error : " . $e->getMessage(),"</error>";
        }
    }
    //récupere les infos de la carte ( id, nom, lien d'image )
    public function CarteInfo($Id){
        $sql = "SELECT * FROM `Carte` WHERE `id`=:id";
        $req = $this->bdd->prepare($sql);
        $req->execute(array(':id' => $Id));
        $CarteInfo=$req->fetch();
        
        return $CarteInfo;

    }

    public function PubliScore($login,$score){
    
        $req = $this->bdd->prepare("INSERT INTO `Score` (`User`, `Score`) VALUES (:user, :Score)");
        $req->execute(array("user" => $login, "Score" => $score));
    }

    public function GetTop10(){
        $sql = "SELECT * FROM `Score` order by `Score` desc limit 10";
        $req = $this->bdd->prepare($sql);
        $req->execute(array());
        $Top=$req->fetch();
        
        return $Top;
    }
}
?>




