<?php
session_start();
if(!isset($_SESSION['User_ID'])){
    header('Location: login.php');
    exit();
}

if(isset($_POST["add"])) {
    require_once('DB.php');
    $requete = $bd->prepare("INSERT INTO concours (id_cnc,id_user,libelle,lien,ecole,matiere,annee,created_at) VALUES(null,?,?,?,?,?,?,?)");
    if ($requete->execute([$_SESSION['User_ID'], $_POST["libelle"], $_POST["lien"], intval($_POST["ecole"]), intval($_POST["matiere"]), $_POST["annee"], date("Y-m-d H:i:s")])) {
        $bd->prepare("INSERT INTO historique VALUES (null,?,?,?,?,?)")->execute([$_SESSION['User_ID'],"ajout","concours","all",date("Y-m-d H:i:s")]);
        header("Location: ../concours.php");
        $_SESSION["ajouter"]=1;
        exit();
    } else {
        header("Location: ../concours.php");
        $_SESSION["ajouter"]=0;
        exit();
    }
}

if(isset($_POST["updateConcours"])) {
    require_once('DB.php');
    $requete = $bd->prepare("UPDATE concours SET id_user=? , libelle=? , lien=? ,  ecole=? , matiere=? , annee=? WHERE id_cnc=?");
    if ($requete->execute([$_SESSION['User_ID'],$_POST["libelleUpdate"],$_POST["lienUpdate"],intval($_POST["ecoleUpdate"]),intval($_POST["matiereUpdate"]),$_POST["anneeUpdate"],$_POST['idUpdate']])) {
        $bd->prepare("INSERT INTO historique VALUES (null,?,?,?,?,?)")->execute([$_SESSION['User_ID'],"Update","concours","all",date("Y-m-d H:i:s")]);
        header("Location: ../concours.php");
        $_SESSION["modifier"]=1;
        exit();
    } else {
        header("Location: ../concours.php");
        $_SESSION["modifier"]=0;
        exit();
    }
}

if(isset($_GET["action"], $_GET["id"]) && $_GET["action"] == "delete") {
    require_once('DB.php');
    $requete = $bd->prepare("DELETE FROM concours WHERE id_cnc=?");
    if ($requete->execute(([htmlspecialchars($_GET['id'])]))) {
        $bd->prepare("INSERT INTO historique VALUES (null,?,?,?,?,?)")->execute([$_SESSION['User_ID'],"Delete","concours","all",date("Y-m-d H:i:s")]);
        header("Location: ../concours.php");
        $_SESSION["supprimer"]=1;
        exit();
    } else {
        header("Location: ../concours.php");
        $_SESSION["supprimer"]=0;
        exit();
    }
}




function getConcours($id) {
    require_once('DB.php');
    $requete = $bd->prepare("SELECT * FROM concours WHERE id = ?");
    $requete->bindValue(1, htmlspecialchars($id));
    $requete->execute();
    $concours = $requete->fetch();
    $requete->closeCursor(); 
    if ($concours){
        return $concours;
    } else {
        return null; 
    }
}

function getNombreUsers(){
    require('DB.php');
    $requete = $bd->prepare("SELECT COUNT(*) NombreUsers FROM Users");
    $requete->execute();
    $user = $requete->fetch(PDO::FETCH_ASSOC);
    $nombreUsers = $user["NombreUsers"];
    $bd = null;
    return $nombreUsers;
}

function getNombreConcours(){
    require('DB.php');
    $requete = $bd->prepare("SELECT COUNT(*) NombreConcours FROM Concours");
    $requete->execute();
    $cnc = $requete->fetch(PDO::FETCH_ASSOC);
    $nombreConcours = $cnc["NombreConcours"];
    $bd = null;
    return $nombreConcours;
}

?>