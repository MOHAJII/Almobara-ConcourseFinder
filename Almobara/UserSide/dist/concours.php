<?php
  include("conn.php");
  session_start();

  $idEcole = intval($_GET["ecole"]);
  $idMatiere = intval($_GET["mat"]);
  
  $sql = "SELECT * FROM `concour` WHERE idE = $idEcole AND idM = $idMatiere";
  $reqMatiere="SELECT * FROM `matiere` WHERE idM = $idMatiere";
  $reqEcole = "SELECT * FROM `ecole` WHERE idE = $idEcole";
  $resEcole= $conn->query($reqEcole);
  $ecole=$resEcole->fetch_assoc();
  $resMatiere=$conn->query($reqMatiere);
  $matiere=$resMatiere->fetch_assoc();
  $resConcour = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./dist/fg8.css" rel="stylesheet">
  <link href="./dist/out12.css" rel="stylesheet">
</head>
<body>
<div class="w-full h-auto bg-white">
  <?php include("navbar.php")?>
</div>
<div class=" h-72 bg-local lg:bg-fixed relative text-white">
  <div class="bg-black w-full h-full flex items-center z-10">
    <div class="w-pagecontain h-auto mx-auto">
      <h1 class="text-6xl font-bold text-white"><?php echo $ecole["nom"];?> <?php echo $matiere["nomM"];?></h1>
    </div>
  </div>
</div>
<div class="">
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">Almobara</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Les Concours ,  <?php echo $matiere["nomM"]?> : </p>
            <p class="mt-2 text-base leading-8 text-gray-600">Reviser bien</p>
        </div>
        <div class="mt-10">
            <table class="w-full text-left">
                <tr class="p-3 h-20 border-b border-gray-100">
                    <th><h3 class="text-neutral-900 text-lg font-bold">Nom de l'ecole</h3></th>
                    <th><h3 class="text-neutral-700 text-lg">L'annee</h3></th>
                    <th><h3 class="text-neutral-700 text-lg">Matiere</h3></th>
                    <!-- <th><h3 class="text-neutral-700 text-lg">Avec/Sans</h3></th> -->
                    <th></th>
                </tr>
                <?php while($concour=$resConcour->fetch_assoc()) { ?>
                <tr class="p-3 h-20 border-b border-gray-100">
                    <td><h3 class="text-blue-700 text-lg font-bold"><?php echo htmlspecialchars($ecole['nom']);?> <?php echo htmlspecialchars($ecole['ville']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($concour['annee']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($matiere['nomM']);?></h3></td>
                    <!-- <td><h3 class="text-neutral-700 text-lg"><?php //echo htmlspecialchars($concour['AvSa']);?></h3></td> -->
                    <td><a href="<?php echo htmlspecialchars($concour['lien']);?>" class="text-blue-700 text-lg cursor-pointer">Voir</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
  </div>
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">ALMOBARA</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">A propos de l'ecole</p>
            <p class="mt-6 text-base text-gray-600"><?php echo $ecole["description"];?></p>
            <h6 class="mt-4 text-base underline underline-offset-3 font-semibold text-indigo-600">Voir plus</h6>
        </div>
    </div>
  </div>
  <div class="w-full h-auto mt-10">
    <?php include("footer.php")?>
  </div>
</div>

</body>
</html>
