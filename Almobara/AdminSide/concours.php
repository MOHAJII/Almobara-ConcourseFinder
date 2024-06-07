<?php
require_once('Includes/DB.php');
require_once('Includes/Functions.php');
require_once('Includes/Functions_sfn.php');
// require_once('Includes/Sessions.php');

$_SESSION['TrackingURL'] = $_SERVER['PHP_SELF'];


Confirm_login();

    // session_start();
    // if(!isset($_SESSION['User_ID'])){
    //     header('Location: login.php');
    //     exit();
    // }
    require_once("includes/DB.php");
    require_once("includes/functions_sfn.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almubarat | Concours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    *,
    *::before,
    *::after {
        font-family: "Poppins";
    }
</style>
<body>
    <!-- NAVBAR -->
        <div class="bg-primary" style="height: 10px;"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-family: 'Times New Roman', Times, serif !important; font-size: 20px;">
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
                            <a href="concours.php" class="nav-link active">Concours</a>
                        </li>
                        <li class="nav-item m-1">
                            <a href="Historique.php" class="nav-link">Historique</a>
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
                    <h4 style="display: inline-block;"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="22" viewBox="0 0 384 512"><path fill="#ffffff" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM96 64H288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32zm32 160a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM96 352a32 32 0 1 1 0-64 32 32 0 1 1 0 64zM64 416c0-17.7 14.3-32 32-32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM192 256a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zm64-64a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 448a32 32 0 1 1 0-64 32 32 0 1 1 0 64z"/></svg> 
                        Concours</h4>
                    <!-- Button trigger modal -->
                    <span style="display: inline-block; margin-left: 10px;">
                        <div class="d-flex justify-content-end px-2"><button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalAjouterConcours"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#000000" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg> Ajouter</button></div>
                    </span>
                </div>

            </div>
        </div>
    </header>
    <br>
    <!-- END HEADER -->
<?php
if(isset($_SESSION['supprimer']) && $_SESSION['supprimer']==1){
  echo '<div class="alert alert-success alert-dismissible fade show w-75 m-auto" role="alert">
        Le concours a été supprimé avec succès.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $_SESSION['supprimer'] = null;
}
else if(isset($_SESSION["supprimer"]) && $_SESSION["supprimer"]==0){
    echo '<div class="alert alert-danger alert-dismissible fade show w-75 m-auto" role="alert">
        Une erreur s\'est produit!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    $_SESSION["supprimer"]=null;
}
if(isset($_SESSION['modifier']) && $_SESSION['modifier']==1){
  echo '<div class="alert alert-success alert-dismissible fade show w-75 m-auto" role="alert">
        Le concours a été modifié avec succès.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $_SESSION['modifier'] = null;
}
else if(isset($_SESSION["modifier"]) && $_SESSION["modifier"]==0){
    echo '<div class="alert alert-danger alert-dismissible fade show w-75 m-auto" role="alert">
        Une erreur s\'est produit!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    $_SESSION["modifier"]=null;
}
if(isset($_SESSION["ajouter"]) && $_SESSION["ajouter"]==1){
  echo '<div class="alert alert-success alert-dismissible fade show w-75 m-auto" role="alert">
        Le concours a été ajouté avec succès.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $_SESSION['ajouter'] = null;

}
else if(isset($_SESSION["ajouter"]) && $_SESSION["ajouter"]==0){
    echo '<div class="alert alert-danger alert-dismissible fade show w-75 m-auto" role="alert">
        Une erreur s\'est produit!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    $_SESSION["ajouter"]=null;
}
?>
    <main class="mt-4 mx-4 d-flex flex-column">
        <!---------------------------------------- Ajouter un Concours -->
        <!-- <div class="d-flex justify-content-end px-2"><button type="button" class="btn btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#modalAjouterConcours"><svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg><span class="ms-2">Ajouter un Concours</span></button></div> -->
        <div class="modal" id="modalAjouterConcours">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
						<h3 class="modal-title">Ajouter un Concours</h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
                    <div class="modal-body p-4">
                        <form class="form-group w-100 my-2 mx-auto" action="./includes/functions_sfn.php" method="post">
                            <input type="text" class="form-control mt-4 w-100" placeholder="Lien" name="lien" required>
                            <input type="text" class="form-control mt-4" placeholder="Libelle" name="libelle" required>
                            <select class="form-select mt-4" name="ecole" id="ecole" required>
                            <option disabled selected>Choisissez une école</option>
                                <?php
                                require_once('includes/DB.php');
                                $requete = $bd->query("SELECT * FROM ecole");
                                $ecoles = $requete->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($ecoles as $ecole) {
                                    echo '<option value="' . $ecole['id_ecole'] . '">' . $ecole['nom_ecole'] . " " . $ecole["ville"] . '</option>';
                                }
                                ?>
                            </select>
                            <select class="form-select mt-4" name="matiere" required>
                            <option disabled selected>Choisissez une matière</option>
                                <?php
                                require_once('includes/DB.php');
                                $requete = $bd->query("SELECT * FROM matiere");
                                $ecoles = $requete->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($ecoles as $ecole) {
                                    echo '<option value="' . $ecole['id_matiere'] . '">' . $ecole['nom_matiere'] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="number" class="form-control mt-4" placeholder="Année" step="1" min="2000" max=<?php echo date('Y');?> name="annee" required>
                            <input type="submit" class="form-control mt-4 btn btn-primary" value="Ajouter" name="add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------------------ Modifier un Concours -->
        <div class="modal" id="modalModifierConcours">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
						<h3 class="modal-title">Modifier le Concours</h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
                    <div class="modal-body p-4">
                        <form class="form-group w-100 my-2 mx-auto" action="./includes/functions_sfn.php" method="post">
                            <input hidden type="text" name="idUpdate" id="idUpdate">
                            <input type="text" class="form-control mt-4 w-100" placeholder="Lien" name="lienUpdate" required>
                            <input type="text" class="form-control mt-4" placeholder="Libelle" name="libelleUpdate" required>
                            <select class="form-select mt-4" name="ecoleUpdate" required>
                            <option disabled selected>Choisissez une école</option>
                                <?php
                                require_once('includes/DB.php');
                                $requete = $bd->query("SELECT * FROM ecole");
                                $ecoles = $requete->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($ecoles as $ecole) {
                                    echo '<option value="' . $ecole['id_ecole'] . '">' . $ecole['nom_ecole'] . " " . $ecole["ville"] . '</option>';
                                }
                                ?>
                            </select>
                            <select class="form-select mt-4" name="matiereUpdate" required>
                            <option disabled selected>Choisissez une matière</option>
                                <?php
                                require_once('includes/DB.php');
                                $requete = $bd->query("SELECT * FROM matiere");
                                $ecoles = $requete->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($ecoles as $ecole) {
                                    echo '<option value="' . $ecole['id_matiere'] . '">' . $ecole['nom_matiere'] . '</option>';
                                }
                                ?>
                            </select>
                            <!-- <input type="text" class="form-control mt-4" placeholder="Matière" name="nvMatiere"> -->
                            <input type="number" class="form-control mt-4" placeholder="Année" step="1" min="2000" max=<?php echo date('Y');?> name="anneeUpdate" required>
                            <input type="submit" class="form-control mt-4 btn btn-primary" value="Modifier" name="updateConcours">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------->
        <div class="container-fluid my-4 px-2">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="myTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr class="border-2">
                            <th scope="col">id</th>
                            <th scope="col" style="min-width: 150px!important">Ajouté par</th>
                            <th scope="col">Libelle</th>
                            <th scope="col">Ecole</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Matiere</th>
                            <th scope="col">Année</th>
                            <th scope="col">Lien</th>
                            <th scope="col" style="min-width: 150px!important">Date d'ajout</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("includes/DB.php");
                        $resultsPerPage = 5;
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($currentPage - 1) * $resultsPerPage;
                        $totalRecordsQuery = $bd->query("SELECT COUNT(*) as total FROM concours");
                        $totalRecords = $totalRecordsQuery->fetch()['total'];
                        $totalPages = ceil($totalRecords / $resultsPerPage);
                        $concoursQuery = $bd->query("SELECT concours.*, ecole.nom_ecole, ecole.ville, matiere.nom_matiere FROM concours, ecole, matiere WHERE concours.ecole=ecole.id_ecole AND concours.matiere=matiere.id_matiere order by id_cnc asc LIMIT $offset, $resultsPerPage");
                        $concours = $concoursQuery->fetchAll();
                        foreach ($concours as $cnc) {
                            echo '<tr class="border-2">';
                            echo '<td>' . $cnc['id_cnc'] . "</td>";
                            echo '<td>' . $cnc['id_user'] . "</td>";
                            echo '<td>' . $cnc['libelle'] . "</td>";
                            echo '<td>' . $cnc['nom_ecole'] . "</td>";
                            echo '<td>' . $cnc['ville'] . "</td>";
                            echo '<td>' . $cnc['nom_matiere'] . "</td>";
                            echo '<td>' . $cnc['annee'] . "</td>";
                            echo '<td><a target="_blank" href="' . $cnc['lien'] . '">Voir</a></td>';
                            echo '<td>' . $cnc['created_at'] . "</td>";
                            echo '<td style="vertical-align: middle;">
                            <div class="d-flex justify-contenr-center">
                            <button class="bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#modalModifierConcours" onclick="updateConcours(' . $cnc['id_cnc'] . ')"><svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512"><path fill="#007bff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></button>
                            <button class="bg-transparent border-0"><a href="./includes/functions_sfn.php?action=delete&id='.$cnc['id_cnc'].'"><svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 448 512"><path fill="#ff0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a></button>
                            </div>
                            </td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <nav aria-label="Page navigation" class="d-flex justify-content-end">
                    <ul class="pagination">
                        <?php
                        if ($currentPage > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Précédent</a></li>';
                        } else {
                            echo '<li class="page-item disabled"><span class="page-link">Précédent</span></li>';
                        }
                        
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item' . ($currentPage == $i ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                        
                        if ($currentPage < $totalPages) {
                            echo '<li class="page-item me-1"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Suivant</a></li>';
                        } else {
                            echo '<li class="page-item me-1 disabled"><span class="page-link">Suivant</span></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
    
		
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        function updateConcours(cncId){
            document.getElementById("idUpdate").value = parseInt(cncId);
            document.querySelector("#modalModifierConcours h3").innerHTML = "Modifier le concours";
            document.querySelector("#modalModifierConcours h3").innerHTML += " "+cncId ;
        }
    </script>

</body>
</html>