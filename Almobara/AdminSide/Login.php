<?php
require_once('Includes/DB.php');
require_once('Includes/Functions.php');
require_once('Includes/Sessions.php');
?>

<?php
if(isset($_SESSION['User_ID'])) {
    Redirect_to('Login.php');
}

if(isset($_POST['Submit'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    if(empty($Username) || empty($Password)) {
        $_SESSION['ErrorMessage'] = "Tous les champs doivent etre remplis";
        Redirect_to('Login.php');
    } else {
        $Found_Account = Login_Attempt($Username, $Password);
        if($Found_Account) {
            $_SESSION['User_ID'] = $Found_Account['id_user'];
            $_SESSION['Username'] = $Found_Account['username'];
            $_SESSION['AdminName'] = $Found_Account['nom'] . ' ' . $Found_Account['prenom'];

            $_SESSION['SuccessMessage'] = 'Bienvenue '.$_SESSION['Username']."!";
            if(isset($_SESSION['TrackingURL'])) {
                Redirect_to($_SESSION['TrackingURL']);
            } else {
                Redirect_to('index.php');
            }
        } else {
            $_SESSION['ErrorMessage'] = "Incorrect Username/Password";
            Redirect_To("Login.php");
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
    <title>Login</title>
</head>

<body style="font-family: 'Times New Roman', Times, serif !important;
   font-size: 20px;">
    <!-- NAVBAR -->
    <div class="bg-primary" style="height: 10px;"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="#" class="navbar-brand"><img src="images/logo.png" width="200px" alt="logo"></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCNC">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="#navbarcollapseCNC"></div>
        </div>
    </nav>
    <div class="bg-primary" style="height: 10px;"></div>
    <!-- END NAVBAR -->


    <!-- HEADER -->
    <header class="bg-white text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1></h1>
                </div>
            </div>
        </div>
    </header>
    <br>
    <!-- END HEADER -->

    <!-- Main AREA START -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-sm-3 col-sm-6" style="min-height: 458px;">
                <br><br>
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <div class="card bg-primary text-dark">
                    <div class="card-header">
                        <h4>Bienvenue</h4>
                    </div>
                    <div class="card-body bg-white">
                        <form action="Login.php" method="post">
                            <div class="form-group">
                                <label for="username"><span class="FieldInfo">Username</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white bg-primary"><svg xmlns="http://www.w3.org/2000/svg" height="29" width="17.5" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg> </span>
                                    </div>
                                    <input type="text" class="form-control" name="Username" id="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password"><span class="FieldInfo">Password</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white bg-primary"><svg xmlns="http://www.w3.org/2000/svg" height="22" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg></span>
                                    </div>
                                    <input type="password" class="form-control" name="Password" id="password">
                                </div>
                            </div>
                            <input type="submit" name="Submit" class="btn btn-primary btn-block" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main AREA END -->
</body>

</html>