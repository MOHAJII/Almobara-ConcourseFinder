<?php
require_once("Includes/DB.php");

function Redirect_To($newLocation){
    header("Location: ".$newLocation);
    exit;
}

function checkUsernameIfExistsOrNot($username){
    global $bd;
    $sql = 'SELECT username FROM users where username = :username';
    $stmt = $bd->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $Result = $stmt->rowCount();
    if($Result == 1){
        return true;
    } else{
        return false;
    }
}

function Login_Attempt($username, $login){
    global $bd;
    $sql = "SELECT * FROM users WHERE username = :username AND mot_de_passe = :login LIMIT 1";
    $stmt = $bd->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindvalue(':login', $login);
    $stmt->execute();
    $Result = $stmt->rowCount();
    if($Result == 1){
        return $Found_Account = $stmt->fetch();
    }else{
        return null;
    }
}

function Confirm_login(){
    if(isset($_SESSION['User_ID'])){
        return true;
    } else{
        $_SESSION['ErrorMessage'] = "Login Required";
        Redirect_to("Login.php");
    }
}
?>