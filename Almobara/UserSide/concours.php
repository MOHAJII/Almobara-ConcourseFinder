<?php
include("conn.php");
$ecole=$_GET['ecole'];
$matiere=$_GET['matiere'];
$concoursql="SELECT * FROM `concours` WHERE ecole=$ecole and matiere=$matiere";
$concourresult= mysqli_query($conn,$concoursql);
$concours= mysqli_fetch_all($concourresult, MYSQLI_ASSOC);
$sqlnameecole="SELECT abbr_nom_ecole FROM `ecole` WHERE id_ecole=$ecole";
$resnameecole= mysqli_query($conn,$sqlnameecole);
$nameecole= mysqli_fetch_all($resnameecole, MYSQLI_ASSOC);
$sqlnamematiere="SELECT nom_matiere FROM `matiere` WHERE id_matiere=$matiere";
$resnamematiere= mysqli_query($conn,$sqlnamematiere);
$namematiere= mysqli_fetch_all($resnamematiere, MYSQLI_ASSOC);
$ecole_infosql="SELECT * FROM `ecole` WHERE id_ecole=$ecole";
$ecole_inforesult= mysqli_query($conn,$ecole_infosql);
$ecole_info= mysqli_fetch_all($ecole_inforesult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./dist/fg9.css" rel="stylesheet">
  <link href="./dist/out16.css" rel="stylesheet">
</head>
<body>
<div class="w-full h-auto bg-white">
  <?php include("navbar.php")?>
</div>
<div class=" h-72 bg-local lg:bg-fixed relative text-white">
  <div style="background-image:url('<?php echo $ecole_info[0]['image'];?>');" class="bg-center bg-cover  w-full h-full z-10">
    <div style="background-color:#00000096;" class="w-full h-full absolute flex items-center">
      <div class="w-pagecontain h-auto mx-auto">
        <h1 class=" text-6xl font-bold text-white"><?php  echo $nameecole[0]['abbr_nom_ecole'].' '.$namematiere[0]['nom_matiere'] ?></h1>
      </div>
    </div>
  </div>
</div>
<div class="">
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">Deploy faster</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Les Concours</p>
            <p class="mt-2 text-base leading-8 text-gray-600">Lorem ipsum, dolor sit amet consectetur</p>
        </div>
        <div class="mt-10">
            <table class="w-full text-left">
                <tr class="p-3 h-20 border-b border-gray-100">
                    <th><h3 class="text-neutral-900 text-lg font-bold">Nom de l'ecole</h3></th>
                    <th><h3 class="text-neutral-700 text-lg">L'annee</h3></th>
                    <th><h3 class="text-neutral-700 text-lg">Matiere</h3></th>
                    <th><h3 class="text-neutral-700 text-lg">Avec/Sans</h3></th>
                    <th></th>
                </tr>
                <?php foreach ($concours as $concour) { ?>
                <tr class="p-3 h-20 border-b border-gray-100">
                    <td><h3 class="text-blue-700 text-lg font-bold"><?php echo htmlspecialchars($ecole_info[0]['nom_ecole']);?> </h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($concour['annee']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($namematiere[0]['nom_matiere']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($concour ['AvSa']);?></h3></td>
                    <td><a target="_blank" href="<?php echo htmlspecialchars($concour['lien']);?>" class="text-blue-700 text-lg cursor-pointer">Voir</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
  </div>
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">Deploy faster</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">A propos de l'ecole</p>
            <p class="mt-6 text-base text-gray-600">Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consectetur Lorem ipsum, dolor sit amet consecteturLorem ipsum, dolor sit amet consectetur</p>
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
