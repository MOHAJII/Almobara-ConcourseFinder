<?php
require_once('Includes/DB.php');
require_once('Includes/Functions.php');
require_once('Includes/Sessions.php');
?>


<?php
$_SESSION['TrackingURL'] = $_SERVER['PHP_SELF'];

Confirm_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style1.css" />
    <script src="https://kit.fontawesome.com/d2a0a9da83.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            font-family: "Poppins";
        }

        h1,
        h2,
        h3,
        p {
            font-size: inherit;
            /* or you can specify the font size you want for these elements */
        }
    </style>
    <title>Historique</title>

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
                    <li class="nav-item m-1">
                        <a href="Users.php" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item m-1">
                        <a href="concours.php" class="nav-link">Concours</a>
                    </li>
                    <li class="nav-item active m-1">
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
                    <h4 style="display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#ffffff" d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg> 
                    Historique
                    </h4>

                </div>

            </div>
        </div>
    </header>
    <br>
    <!-- END HEADER -->
    <section class="container py-0 mb-0  border border-light">
        <div class="row">
            <div class="col-lg-12" style="min-height : 400px;">

                <h2 class="mt-5 mb-3">Historique des opérations</h2>
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Admin</th>
                            <th>Type d'action</th>
                            <th>Table affectées</th>
                            <th>Updated_fields</th>
                            <th>Date d'action</th>
                        </tr>
                    </thead>
                    <?php
                    global $bd;

                    if (isset($_GET['Page'])) {
                        $Page = isset($_GET['Page']) && is_numeric($_GET['Page']) ? (int) $_GET['Page'] : 1;
                        $ShowHistoriqueFrom = ($Page - 1) * 4; // Corrected calculation
                        $ShowHistoriqueFrom = max(0, $ShowHistoriqueFrom); // Ensure the starting point is not less than 0
                        $sql = "SELECT * FROM historique ORDER BY id_action DESC LIMIT $ShowHistoriqueFrom, 8;";
                        $stmt = $bd->query($sql);
                        $SrNo = $ShowHistoriqueFrom; // Adjust SrNo initialization
                    } else {
                        $sql = "SELECT * FROM historique ORDER BY id_action DESC LIMIT 0, 4;";
                        $stmt = $bd->query($sql);
                        $SrNo = 0; // Adjust SrNo initialization
                    }

                    while ($DataRows = $stmt->fetch()) {
                        $ActionID = $DataRows['id_action'];
                        $UserID = $DataRows['id_user'];
                        $Actiontype = $DataRows['action_type'];
                        $AffectedTable = $DataRows['affected_table'];
                        $UserUsername = $DataRows['updated_fields'];
                        $CreatedAt = $DataRows['created_at'];
                        $SrNo++;
                        $sqlUser = "SELECT username from users where id_user = $UserID";
                        $stmtUser = $bd->query($sqlUser);
                        $UserName = $stmtUser->fetchColumn();
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo htmlentities($SrNo); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserID); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($Actiontype); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($AffectedTable); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($UserUsername); ?>
                                </td>
                                <td>
                                    <?php echo htmlentities($CreatedAt); ?>
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
                        <a href="Historique.php?Page=<?php echo $_GET['Page'] - 1; ?>" class="page-link"><svg
                                xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                viewBox="0 0 512 512">
                                <path
                                    d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z"
                                    fill="#007bff" />
                            </svg></a>
                    </li>
                    <?php
                }
                ?>

                <?php
                global $bd;
                $sql = "SELECT Count(*) AS Count FROM Historique;";
                $stmt = $bd->query($sql);
                $RowPagination = $stmt->fetch();
                $TotalUsers = array_shift($RowPagination);
                $PostPagination = ceil($TotalUsers / 4);

                for ($i = 1; $i <= $PostPagination; $i++) {
                    ?>
                    <li class="page-item <?php echo isset($_GET['Page']) && $_GET['Page'] == $i ? 'active' : ''; ?>">
                        <a href="Historique.php?Page=<?php echo $i; ?>" class="page-link">
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
                        <a href="Historique.php?Page=<?php echo $_GET['Page'] + 1; ?>" class="page-link"><svg
                                xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                viewBox="0 0 512 512">
                                <path
                                    d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"
                                    fill="#007bff" />
                            </svg></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </section>