<?php
include("conn.php");
$ecole=$_GET['ecole'];
$matieresql="SELECT matiere.* FROM matiere , ecole, ecolematiere WHERE ecolematiere.id_ecole=ecole.id_ecole AND matiere.id_matiere=ecolematiere.id_matiere and ecole.id_ecole=$ecole";
$matiereresult= mysqli_query($conn,$matieresql);
$matieres= mysqli_fetch_all($matiereresult, MYSQLI_ASSOC);
$ecolesql="SELECT * FROM `ecole` WHERE id_ecole=$ecole";
$ecoleresult= mysqli_query($conn,$ecolesql);
$ecoles= mysqli_fetch_all($ecoleresult, MYSQLI_ASSOC);
// $ecole_infosql="SELECT * FROM `ecole` WHERE id_ecole=$ecole";
// $ecole_inforesult= mysqli_query($conn,$ecole_infosql);
// $ecole_info= mysqli_fetch_all($ecole_inforesult, MYSQLI_ASSOC);
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
  <div style="background-image:url('<?php echo $ecoles[0]['image'];?>');" class="bg-center bg-cover w-full h-full z-10">
    <div style="background-color:#00000096;" class="w-full h-full absolute flex items-center">
      <div class="w-pagecontain h-auto mx-auto">
        <h1 class=" text-6xl font-bold text-white"><?php echo $ecoles[0]['nom_ecole'].' '.$ecoles[0]['ville'];?></h1>
      </div>
    </div>
  </div>
</div>
<div class="">
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">Deploy faster</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Les Matieres </p>
            <p class="mt-2 text-base leading-8 text-gray-600">Lorem ipsum, dolor sit amet consectetur</p>
        </div>
          <form action="" method="post">
            <div class="grid grid-cols-3 gap-8 mt-10">
              <?php foreach ($matieres as $matiere) { ?>
              <a href="./concours.php?ecole=<?php echo $ecole?>&matiere=<?php echo($matiere['id_matiere']);?>">
                <!-- <div class="relative h-96 overflow-hidden bg-center bg-cover bg-[url('https://news.harvard.edu/wp-content/uploads/2022/11/iStock-mathproblems.jpg')] shadow-md rounded-xl cursor-pointer"> -->
                <div class="relative h-96 overflow-hidden bg-center bg-cover shadow-md rounded-xl cursor-pointer" style="background-image: url('<?php echo $matiere["image"]; ?>');">
                  <div class="absolute bg-gradient-to-t from-black via-black-75 to-transparent bottom-0 left-0 px-5 py-8">
                    <h3 class="text-2xl font-bold tracking-tight text-white"><?php echo htmlspecialchars($matiere['nom_matiere'])?></h3>
                    <p class="mt-1 text-sm text-white">Lorem ipsum, dolor sit amet consectetur lorem ipsum</p>
                  </div>
                </div>
              </a>
              <?php } ?>
            </div>
          </form>
    </div>
  </div>
  <div class="w-full h-auto">
    <div class="w-9/12 mx-auto h-auto py-10">
        <div class="">
            <h2 class="text-sm font-semibold leading-7 text-indigo-600">Deploy faster</h2>
            <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">A propos de l'ecole</p>
            <p class="mt-6 text-base text-gray-600"><?php echo $ecoles[0]['about_ecole'];?></p>
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
