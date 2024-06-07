<?php
    require_once("includes/functions_sfn.php");
    // session_start();
    if(!isset($_SESSION['User_ID'])){
        header('Location: login.php');
        exit();
    }
    require_once("includes/DB.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/style1.css">
        <link rel="stylesheet" href="./css/sb-admin-2.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

            *,
            *::before,
            *::after {
                box-sizing: border-box;
                font-family: "Poppins";
                /* font-size: 14px; */
            }
            a{
                cursor: pointer;
            }
            .sb-sidenav-menu-nested a{
                font-size: 15px;
            }
            .bg-info{
                background-color: #e6f1ff!important;
                border-bottom: 0.3px solid rgb(220, 220, 220)!important;
                /* border-right: 1px solid gray!important; */
            }
            #tableUsers{
                font-size: 13px!important;
            }
            tr{
                border:0!important;
            }
            main,footer{
                /* border-top: 2px solid gray!important;  */
                border-left: 0.3px solid rgb(220, 220, 220)!important;
            }
            .sb-sidenav-footer{
                border-top: 1px solid gray;
                background-color: #e6f1ff!important;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info position-fixed top-0 d-flex justify-content-between">
            <button class="btn btn-link btn-sm  me-4 me-lg-0" id="sidebarToggle" href="#!"><svg xmlns="http://www.w3.org/2000/svg" height="26" width="24" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></button>
            <a class="navbar-brand ps-3" href="index.php"><img src="./images/logo.png" width="200px" alt="Logo"></a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light bg-info" id="sidenavAccordion">
                    <div class="sb-sidenav-menu pt-5">
                        <div class="nav">
                            <a class="nav-link mt-1" href="index.php">
                                <div class="sb-nav-link-icon text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>
                                </div>
                                <span class="me-2 mt-1">Dashboard</span>
                            </a>
                            <a class="nav-link mt-1" href="users.php">
                                <div class="sb-nav-link-icon text-dark"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></div>
                                <span class="me-2 mt-1">Users</span>
                            </a>
                            <a class="nav-link mt-1" href="concours.php">
                                <div class="sb-nav-link-icon text-dark"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM96 64H288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32zm32 160a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM96 352a32 32 0 1 1 0-64 32 32 0 1 1 0 64zM64 416c0-17.7 14.3-32 32-32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM192 256a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zm64-64a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 448a32 32 0 1 1 0-64 32 32 0 1 1 0 64z"/></svg></div>
                                <span class="me-2 mt-1">Concours</span>
                            </a>
                            <a class="nav-link mt-1" href="historique.php">
                                <div class="sb-nav-link-icon text-dark"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg></div>
                                <span class="me-2 mt-1">Historique</span>
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small text-center">
                            <a class="nav-link text-decoration-none text-dark fw-bold p-0" href="logout.php">
                                <span class="me-2">Déconnexion</span><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="fw-bold mt-4 mb-4"><?php echo $_SESSION['SuccessMessage'] ?></h2>

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Nombre de Concours</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo getNombreConcours() ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="26" width="24"
                                                    viewBox="0 0 384 512">
                                                    <path
                                                        d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM96 64H288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32zm32 160a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM96 352a32 32 0 1 1 0-64 32 32 0 1 1 0 64zM64 416c0-17.7 14.3-32 32-32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM192 256a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zm64-64a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 448a32 32 0 1 1 0-64 32 32 0 1 1 0 64z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Nombre d'utilisateurs</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo getNombreUsers() ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="26" width="24"
                                                    viewBox="0 0 448 512">
                                                    <path
                                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!------------------------------------ Table de users --------->
                        <div class="card shadow mb-4 p-0">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="16" viewBox="0 0 448 512">
                                        <path fill="#4e73df"
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg><span class="ms-4">Les Utilisateurs</span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableUsers" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">User</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Mot de passe</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Date de création</th>
                                                <th scope="col">Dernière connexion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once("includes/DB.php");
                                            $resultsPerPage = 5;
                                            $currentPage = isset($_GET['pageUser']) ? $_GET['pageUser'] : 1;
                                            $offset = ($currentPage - 1) * $resultsPerPage;
                                            $totalRecordsQuery = $bd->query("SELECT COUNT(*) as total FROM users");
                                            $totalRecords = $totalRecordsQuery->fetch()['total'];
                                            $totalPages = ceil($totalRecords / $resultsPerPage);
                                            $concoursQuery = $bd->query("SELECT * FROM users order by id_user asc LIMIT $offset, $resultsPerPage");
                                            $users = $concoursQuery->fetchAll();
                                            foreach ($users as $user) {
                                                echo '<tr class="border-2">';
                                                echo '<td>' . $user['id_user'] . "</td>";
                                                echo '<td>' . $user['nom'] . "</td>";
                                                echo '<td>' . $user['prenom'] . "</td>";
                                                echo '<td>' . $user['username'] . "</td>";
                                                echo '<td>' . $user['mot_de_passe'] . "</td>";
                                                echo '<td>' . $user['email'] . "</td>";
                                                echo '<td>' . $user['date_creation'] . "</td>";
                                                echo '<td>' . $user['derniere_connexion'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Page navigation" class="d-flex justify-content-end">
                                        <ul class="pagination">
                                            <?php
                                            if ($currentPage > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="?pageUser=' . ($currentPage - 1) . '">Précédent</a></li>';
                                            } else {
                                                echo '<li class="page-item disabled"><span class="page-link">Précédent</span></li>';
                                            }

                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<li class="page-item' . ($currentPage == $i ? ' active' : '') . '"><a class="page-link" href="?pageUser=' . $i . '">' . $i . '</a></li>';
                                            }

                                            if ($currentPage < $totalPages) {
                                                echo '<li class="page-item me-1"><a class="page-link" href="?pageUser=' . ($currentPage + 1) . '">Suivant</a></li>';
                                            } else {
                                                echo '<li class="page-item me-1 disabled"><span class="page-link">Suivant</span></li>';
                                            }
                                            ?>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
<!------------- End table users ----------------->
<!------------------------ table concours -------------------------------->
                        <div class="card shadow mb-4 p-0">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512">
                                        <path fill="#4e73df"
                                            d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM96 64H288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32zm32 160a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM96 352a32 32 0 1 1 0-64 32 32 0 1 1 0 64zM64 416c0-17.7 14.3-32 32-32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM192 256a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zm64-64a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm32 64a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zM288 448a32 32 0 1 1 0-64 32 32 0 1 1 0 64z" />
                                    </svg><span class="ms-4">Les Concours</span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col" style="min-width: 150px!important">Ajouté par</th>
                                                <th scope="col">Libelle</th>
                                                <th scope="col">Ecole</th>
                                                <th scope="col">Ville</th>
                                                <th scope="col">Matiere</th>
                                                <th scope="col">Année</th>
                                                <th scope="col">Lien</th>
                                                <th scope="col" style="min-width: 150px!important">Date d'ajoute</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once("includes/DB.php");
                                            $resultsPerPage = 5;
                                            $currentPage = isset($_GET['pageConcours']) ? $_GET['pageConcours'] : 1;
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
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Page navigation" class="d-flex justify-content-end">
                                        <ul class="pagination">
                                            <?php
                                            if ($currentPage > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="?pageConcours=' . ($currentPage - 1) . '">Précédent</a></li>';
                                            } else {
                                                echo '<li class="page-item disabled"><span class="page-link">Précédent</span></li>';
                                            }

                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<li class="page-item' . ($currentPage == $i ? ' active' : '') . '"><a class="page-link" href="?pageConcours=' . $i . '">' . $i . '</a></li>';
                                            }

                                            if ($currentPage < $totalPages) {
                                                echo '<li class="page-item me-1"><a class="page-link" href="?pageConcours=' . ($currentPage + 1) . '">Suivant</a></li>';
                                            } else {
                                                echo '<li class="page-item me-1 disabled"><span class="page-link">Suivant</span></li>';
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
<!------------------------- End Table concours --------------------------------->
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="foot d-flex align-items-center justify-content-center small">
                            <div>Copyright &copy; Almobara 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="./js/script_1.js"></script>
        <script>
            function updateUser(userId) {
                document.getElementById('idUpdateModif').value=parseInt(userId);
            }
            function updateConcours(cncId){
                document.getElementById("idUpdate").value = parseInt(cncId);
                document.querySelector("#modalModifierConcours h3").innerHTML = "Modifier le concours";
                document.querySelector("#modalModifierConcours h3").innerHTML += " "+cncId ;
            }
        </script>
    </body>
</html>
