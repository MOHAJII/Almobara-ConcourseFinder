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
// Check if idUpdate is set in the URL

if (isset($_POST['Submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $FirstName = $_POST['Nom'];
    $LastName = $_POST['Prenom'];
    $Username = $_POST['Prenom'][0] . $_POST['Nom'] . '_' . mt_rand(1, 1000);
    $Password = $_POST['Password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];
    $Email = $_POST['Email'];
    $DateCreation = $DateTime;
    $DateConnexion = $DateTime;

    if (empty($FirstName) || empty($LastName) || empty($Password) || empty($_POST['ConfirmPassword']) || empty($Email)) {
        $_SESSION['ErrorMessage'] = "Veuillez remplir tous les champs!";
        Redirect_to('Users.php');
    } elseif (strlen($Password) < 4) {
        $_SESSION['ErrorMessage'] = "Le mot de passe doit contenir plus de 4 caractères!";
        Redirect_to('Users.php');
    } elseif ($Password !== $ConfirmPassword) {
        $_SESSION['ErrorMessage'] = "Les mots de passe ne correspondent pas!";
        Redirect_to('Users.php');
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $Password)) {
        $_SESSION["ErrorMessage"] = "Invalid Password format";
        Redirect_to("Users.php");
    } elseif (checkUsernameIfExistsOrNot($Username)) {
        $_SESSION["ErrorMessage"] = "Admin already exists, Try another one";
        Redirect_to("Users.php");
    } else {
        global $bd;

        $sql = "INSERT INTO Users(nom, prenom, username,mot_de_passe, email, date_creation, derniere_connexion)";

        $sql .= " VALUES(:nom, :prenom, :username, :mot_de_passe, :email, :date_creation, :derniere_connexion);";

        $stmt = $bd->prepare($sql);
        $stmt->bindValue(':nom', $LastName);
        $stmt->bindValue(':prenom', $FirstName);
        $stmt->bindValue(':username', $Username);
        $stmt->bindValue(':mot_de_passe', $Password);
        $stmt->bindValue(':email', $Email);
        $stmt->bindValue(':date_creation', $DateCreation);
        $stmt->bindValue(':derniere_connexion', $DateConnexion);

        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION['SuccessMessage'] = "Création avec Succès, Un Nouveau Admin ayant comme Nom : {$Username} a été ajouté ";
            Redirect_to('Users.php');
        } else {
            $_SESSION["ErrorMessage"] = "Quelque chose ne va pas, essayez à nouveau!";
            Redirect_to('Users.php');
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/Styles.css" />
    <script src="https://kit.fontawesome.com/d2a0a9da83.js" crossorigin="anonymous"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        font-family: "Poppins";
    }
     h1, h2, h3, p{
        font-size: inherit; /* or you can specify the font size you want for these elements */
    }
</style>
    <title>Admins/Users</title>

</head>

<body style="font-family: 'Times New Roman', Times, serif !important;
   font-size: 20px;">
    <!-- NAVBAR -->
    <div class="bg-primary" style="height: 10px;"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="#" style="font-size: 30px;" class="navbar-brand">
                <img src="images/logo.png" width="150px" alt="logo">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCNC">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarcollapseCNC">
                <div></div>
                <ul class="navbar-nav">
                    <li class="nav-item m-1">
                        <a href="index.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item active m-1">
                        <a href="Users.php" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item m-1">
                        <a href="concours.php" class="nav-link">Concours</a>
                    </li>
                    <li class="nav-item m-1">
                        <a href="historique.php" class="nav-link">Historique</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li>
                        <a href="Logout.php" class="nav-link text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#ff0000" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>  Logout
                        </a>
                    </li>
                </ul>
                <!-- <form class="form-inline">
                    <input type="search" for="Search" class="form-control mr-sm-2" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="Submit"><span><i
                                class="fas fa-search"></i></span> Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <div class="bg-primary" style="height: 10px;"></div>
    <!-- END NAVBAR -->


    <!-- HEADER -->
    <header class="bg-primary text-white py-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <h4 style="display: inline-block;"><svg xmlns="http://www.w3.org/2000/svg" height="30" width="17.5" viewBox="0 0 448 512"><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> 
                        Admins</h4>
                    <!-- Button trigger modal -->
                    <span style="display: inline-block; margin-left: 10px;">
                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#000000" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg> Ajouter
                        </button>
                    </span>
                </div>

            </div>
        </div>
    </header>
    <br>
    <!-- END HEADER -->

    <!-- ADD ADMIN/USER AREA START-->
    <section class="container py-0 mb-0  border border-light">
        <div class="row">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <!-- Modal -->
            <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Admin/Utilisateur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="Users.php" method="post" class="">
                                <div class="card-body bg-white">
                                    <div class="form-group">
                                        <label for="Nom"><span class="FieldInfo">Nom : </span></label>
                                        <input class="form-control" type="text" name="Nom" id="Nom" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Prenom"><span class="FieldInfo">Prenom : </span></label>
                                        <input class="form-control" type="text" name="Prenom" id="Prenom" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="MotDePasse"><span class="FieldInfo">Mot de passe : </span></label>
                                        <input class="form-control" type="password" name="Password" id="MotDePasse"
                                            value="">
                                        <small class="text-muted" style="font-size: 10px;">
                                            Les critères pour un mot de passe conformes sont les suivants :
                                            <ul style="list-style-type: none; padding-left: 0;">
                                                <li>&#8226; Au moins 8 caractères de long,</li>
                                                <li>&#8226; Doit inclure au moins une lettre minuscule,</li>
                                                <li>&#8226; Doit inclure au moins une lettre majuscule,</li>
                                                <li>&#8226; Doit inclure au moins un chiffre,</li>
                                                <li>&#8226; Doit inclure au moins un caractère spécial parmi : @, $, !,
                                                    %, , #, ?, &.</li>
                                            </ul>
                                        </small>

                                    </div>
                                    <div class="form-group">
                                        <label for="ConfirmMotDePasse"><span class="FieldInfo">Confirmer le mot de passe
                                                :
                                            </span></label>
                                        <input class="form-control" type="password" name="ConfirmPassword"
                                            id="ConfirmMotDePasse" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email"><span class="FieldInfo">Email : </span></label>
                                        <input class="form-control" type="email" name="Email" id="Email" value="">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <a href="index.php" class="btn btn-warning btn-block">
                                                Retour à l'acceuil</a>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <button type="submit" name="Submit" class="btn btn-success btn-block">Créer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade " id="myModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Modifier les infos d'un Admin_utilisateur
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- <?php
                        if (!empty($SearchQueryParameter)) {
                            global $bd;
                            $sql = "SELECT * FROM USERS WHERE id_user = $SearchQueryParameter";
                            $stmt = $bd->query($sql);
                            if ($stmt) {
                                if ($stmt->rowCount() > 0) {
                                    while ($DataRows = $stmt->fetch()) {
                                        $NomtoBeUpdated = $DataRows['nom'];
                                        $PrenomtoBeUpdated = $DataRows['prenom'];
                                        $PasswordtoBeUpdated = $DataRows['mot_de_passe'];
                                        $UsernametoBeUpdated = $DataRows['username'];
                                        $EmailtoBeUpdated = $DataRows['email'];
                                    }

                                } else {
                                    echo "No records found for id_user = $SearchQueryParameter";
                                }
                            } else {
                                die("Database query failed.");
                            }
                        }
                        ?> -->

                        <div class="modal-body">
                            <form action="Update_admin.php" method="post"
                                class="" enctype="multipart/form-data">
                                <div class="card-body bg-white">
                                    <input type="hidden" id='idUpdateModif' name="idName" >
                                    <div class="form-group">
                                        <label for="NomUpdate"><span class="FieldInfo">Nom : </span></label>
                                        <input class="form-control" type="text" name="NomUpdate" id="NomUpdate"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="PrenomUpdate"><span class="FieldInfo">Prenom : </span></label>
                                        <input class="form-control" type="text" name="PrenomUpdate" id="PrenomUpdate"
                                           >
                                    </div>
                                    <div class="form-group">
                                        <label for="MotDePasseUpdate"><span class="FieldInfo">Mot de passe :
                                            </span></label>
                                        <input class="form-control" type="password" name="PasswordUpdate"
                                            id="MotDePasseUpdate" value="">
                                        <small class="text-muted" style="font-size: 10px;">
                                            Les critères pour un mot de passe conformes sont les suivants :
                                            <ul style="list-style-type: none; padding-left: 0;">
                                                <li>&#8226; Au moins 8 caractères de long,</li>
                                                <li>&#8226; Doit inclure au moins une lettre minuscule,</li>
                                                <li>&#8226; Doit inclure au moins une lettre majuscule,</li>
                                                <li>&#8226; Doit inclure au moins un chiffre,</li>
                                                <li>&#8226; Doit inclure au moins un caractère spécial parmi : @, $, !,
                                                    %, , #, ?, &.</li>
                                            </ul>
                                        </small>

                                    </div>
                                    <div class="form-group">
                                        <label for="ConfirmMotDePasseUpdate"><span class="FieldInfo">Confirmer le mot de
                                                passe
                                                :
                                            </span></label>
                                        <input class="form-control" type="password" name="ConfirmPasswordUpdate"
                                            id="ConfirmMotDePasseUpdate" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailUpdate"><span class="FieldInfo">Email : </span></label>
                                        <input class="form-control" type="email" name="EmailUpdate" id="EmailUpdate"
                                           >
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <a href="index.php" class="btn btn-warning btn-block"> Retour à l'acceuil</a>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <button type="submit" name="SubmitUpdate"
                                                class="btn btn-success btn-block">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="min-height : 400px;">

                <h2 class="mt-5 mb-3">Les admins/utilisaturs existants</h2>
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Username</th>
                            <th style="max-width: 280px !important;">Email</th>
                            <th>Date création</th>
                            <th>D. connexion</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    global $bd;

                    if (isset($_GET['Page'])) {
                        $Page = isset($_GET['Page']) && is_numeric($_GET['Page']) ? (int) $_GET['Page'] : 1;
                        $ShowPostFrom = ($Page - 1) * 4; // Corrected calculation
                        $ShowPostFrom = max(0, $ShowPostFrom); // Ensure the starting point is not less than 0
                        $sql = "SELECT * FROM Users ORDER BY id_user DESC LIMIT $ShowPostFrom, 4;";
                        $stmt = $bd->query($sql);
                        $SrNo = $ShowPostFrom; // Adjust SrNo initialization
                    } else {
                        $sql = "SELECT * FROM Users ORDER BY id_user DESC LIMIT 0, 4;";
                        $stmt = $bd->query($sql);
                        // $SrNo = 0; // Adjust SrNo initialization
                    }

                    while ($DataRows = $stmt->fetch()) {
                        $UserID = $DataRows['id_user'];
                        $UserLastName = $DataRows['nom'];
                        $UserFirstName = $DataRows['prenom'];
                        $UserUsername = $DataRows['username'];
                        $UserEmail = $DataRows['email'];
                        $UserDateCreation = $DataRows['date_creation'];
                        $UserDerniereConnexion = $DataRows['derniere_connexion'];
                        // $SrNo++;
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo htmlentities($UserID); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserFirstName); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserLastName); ?>
                                </td>
                                <td  style="max-width: 150px; word-wrap: break-word;">
                                    <?php echo htmlentities($UserUsername); ?>
                                </td>
                                <td style="max-width: 230px; word-wrap: break-word;">
                                    <?php echo htmlentities($UserEmail); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserDateCreation); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserDerniereConnexion); ?>
                                </td>
                                <td style="display: flex !important; flex-direction: row !important; min-width: 100px !important;">
                                    <button  class="bg-transparent border-0" data-toggle="modal" id="modifierBtn" data-target="#myModalUpdate"
                                        onclick="updateUrl(<?php echo $UserID; ?>)"><svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512"><path fill="#007bff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></button>

                                    <a href="DeleteUser.php?id=<?php echo $UserID; ?>" class="btn bg-transparent border-0"><svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 448 512"><path fill="#ff0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                                </td>

                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>
    <!-- ADD ADMIN/USER AREA FINISH-->
    <section class="container py-0 mb-0 border border-light">
        <!-- Dynamic Pagination -->
        <nav>
            <ul class="pagination pagination-lg">
                <!-- Creating a Backward button -->
                <?php
                if (isset($_GET['Page']) && $_GET['Page'] > 1) {
                    ?>
                    <li class="page-item">
                        <a href="Users.php?Page=<?php echo $_GET['Page'] - 1; ?>" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z" fill="#007bff"/></svg></a>
                    </li>
                    <?php
                }
                ?>

                <?php
                global $bd;
                $sql = "SELECT Count(*) AS Count FROM Users;";
                $stmt = $bd->query($sql);
                $RowPagination = $stmt->fetch();
                $TotalUsers = array_shift($RowPagination);
                $PostPagination = ceil($TotalUsers / 4);

                for ($i = 1; $i <= $PostPagination; $i++) {
                    ?>
                    <li class="page-item <?php echo isset($_GET['Page']) && $_GET['Page'] == $i ? 'active' : ''; ?>">
                        <a href="Users.php?Page=<?php echo $i; ?>" class="page-link">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>

                <!-- Creating a forward Button -->
                <?php
                if (isset($_GET['Page']) && $_GET['Page'] < $PostPagination) {
                    ?>
                    <li class="page-item">
                        <a href="Users.php?Page=<?php echo $_GET['Page'] + 1; ?>" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z" fill="#007bff"/></svg></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </section>



</body>

<script>
    function updateUrl(userId) {
        // Update the URL to include the userId
        document.getElementById('idUpdateModif').value=parseInt(userId);
    }
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>