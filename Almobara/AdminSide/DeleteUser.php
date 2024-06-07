<?php
require_once('Includes/DB.php');
require_once('Includes/Functions.php');
require_once('Includes/Sessions.php');
?>

<?php
$_SESSION['TrackingURL'] = $_SERVER['PHP_SELF'];

Confirm_login();

if(isset($_GET['id'])){
    $SearchQueryParameter = $_GET['id'];
    global $bd;
    $sql = "Delete from Users where id_user = {$SearchQueryParameter}";
    $Execute = $bd->query($sql);
    if($Execute){
        $_SESSION['SuccessMessage'] = 'Admin/user suprimé(e) avec succès!';
        redirect_to('Users.php');
    }else{
        $_SESSION['ErrorMessage'] = 'Quelque chose ne va pas, essaye ultérieurement!';
        Redirect_to('Users.php');
    }
}
?>