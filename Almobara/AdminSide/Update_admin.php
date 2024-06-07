<?php
require_once('Includes/DB.php');
require_once('Includes/Functions.php');
require_once('Includes/Sessions.php');
?>


<?php
$_SESSION['TrackingURL'] = $_SERVER['PHP_SELF'];


Confirm_login();

$current = time();
$DateTime = new DateTime();
$DateTime->setTimestamp($current);
$DateTime = $DateTime->format('Y-m-d H:i:s');

if (isset($_POST['SubmitUpdate'])) {
    $SearchQueryParameter= isset($_POST['idName']) ? $_POST['idName'] : null;
    $FirstNameUpdate = $_POST['PrenomUpdate'];
    $LastNameUpdate = $_POST['NomUpdate'];
    $UsernameUpdate = $FirstNameUpdate[0] . $LastNameUpdate . '_' . mt_rand(1, 1000);
    $PasswordUpdate = $_POST['PasswordUpdate'];
    $ConfirmPasswordUpdate = $_POST['ConfirmPasswordUpdate'];
    $EmailUpdate = $_POST['EmailUpdate'];

    if (empty($FirstNameUpdate) || empty($LastNameUpdate) || empty($EmailUpdate)) {
        $_SESSION['ErrorMessage'] = "Veuillez remplir tous les champs!";
        Redirect_to('Users.php');
    } elseif (!empty($PasswordUpdate) && (strlen($PasswordUpdate) < 8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $PasswordUpdate))) {
        $_SESSION['ErrorMessage'] = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial!";
        Redirect_to('Users.php');
    } elseif (!empty($PasswordUpdate) && $PasswordUpdate !== $ConfirmPasswordUpdate) {
        $_SESSION['ErrorMessage'] = "Les mots de passe ne correspondent pas!";
        Redirect_to('Users.php');
    } elseif (!empty($PasswordUpdate) && !preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $PasswordUpdate)) {
        $_SESSION["ErrorMessage"] = "Format de mot de passe invalide";
        Redirect_to("Users.php");
    } elseif (checkUsernameIfExistsOrNot($UsernameUpdate)) {
        $_SESSION["ErrorMessage"] = "Admin déjà existant, veuillez en choisir un autre";
        Redirect_to("Users.php");
    } else {
        global $bd;
        $sql = "UPDATE users SET nom = :nom, prenom = :prenom, username = :username, email = :email";
        if (!empty($PasswordUpdate)) {
            $sql .= ", mot_de_passe = :mot_de_passe";
        }
        $sql .= " WHERE id_user = :id_user";

        $stmt = $bd->prepare($sql);
        $stmt->bindValue(':nom', $LastNameUpdate);
        $stmt->bindValue(':prenom', $FirstNameUpdate);
        $stmt->bindValue(':username', $UsernameUpdate);
        $stmt->bindValue(':email', $EmailUpdate);
        if (!empty($PasswordUpdate)) {
            $stmt->bindValue(':mot_de_passe', password_hash($PasswordUpdate, PASSWORD_BCRYPT));
        }
        $stmt->bindValue(':id_user', $SearchQueryParameter);

        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Opération réussie, l'administrateur avec l'id : " . $SearchQueryParameter . " a été modifié avec succès";
            Redirect_to("Users.php");
        } else {
            $_SESSION["ErrorMessage"] = "Quelque choses ne va pas, essayer plus tard!";
            Redirect_to("Users.php");
        }
    }
} ?>