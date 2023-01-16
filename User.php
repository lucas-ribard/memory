<!-- module de connexion en classes avec PDO -->
<?php
session_start();
require("Bdd.php");
class User extends Bdd
{
    private $id;
    public $login;
    public $password;

    protected $bdd;

    public function __construct(){
        parent::__construct();
   
    }
    // Récupere les infos du formulaire , vérifie que l'identifiant n'est pas déja utilisé et crée l'utilisateur dans la base de donné
    public function register($login,$password){
        //echo "fonction egister<br>";
        $this->$login=$login;
        ;
        $this->$password=$password;
        //$this->login="TEST";
        $sql = "SELECT * FROM `User` WHERE login=:login";
        
        // Check si un utilisateur n'a pas le meme login
        $req = $this->bdd->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();

        // si l'user est dispo
        if($row <= 0) {
            //echo "login dispo<br>";

            $sql="INSERT INTO `User` (`login`, `password`) VALUES (:login, :password)";
            $req = $this->bdd->prepare($sql);
            $req->execute(array('login' => $this->$login,'password' => $this->$password));
            //echo "<error>Requete envoyé</error><br>";
            header('Location:/memory/connexion.php');
        } 
        // si l'user n'est pas dispo     
        else{
            //echo "login existe déja<br>";
            $message="Ce Login est déja utilisé";
        }
        return $message;
   
    }


    
    public function connect($login,$password){
        //echo 'fonction connect<br>';
        if(!empty($login) AND !empty($password) ){   
            $sql = "SELECT * FROM `User` WHERE login=:login AND password=:password";
    
            // Check si un utilisateur n'a pas le meme login
            $req = $this->bdd->prepare($sql);
            $req->execute(array(':login' => $login,':password' => $password));

            $row = $req->rowCount();
            // si l'user est dispo
            if($row >= 1) {
                $res = $req->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $res['id'];
                $_SESSION['login'] = $login; 
                $_SESSION['password'] = $password; 
             
                header('Location:http://localhost/memory/profil.php'); 
            }
            else{
                $message="<error>utilisateur ou mot de passe incorrect</error>";
                return $message;
            }
            
        }

    } 

    public function disconnect(){
        session_destroy();
    }

    public function delete($login,$password){
        $sql = "SELECT `id` FROM `User` WHERE login=:login AND password=:password";
    
            $req = $this->bdd->prepare($sql);
            $req->execute(array(':login' => $login,':password' => $password));

            $row = $req->rowCount();
            // si l'user existe
            if($row >= 1) {
                $res = $req->fetch(PDO::FETCH_ASSOC);
                $id=$res['id'];
                //on le détruit
                $sql = "DELETE FROM `User` WHERE `id`= :id";
                $req = $this->bdd->prepare($sql);
                $req->execute(array(':id' => $id));
                // on ferme la session
                session_destroy();
                header('Location:http://localhost/memory/connexion.php'); 

            }

    }

}
?>
