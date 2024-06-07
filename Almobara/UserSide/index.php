<?php
include("conn.php");
$sql="SELECT * FROM `ecole`";
$result= mysqli_query($conn,$sql);
$ecoles= mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($ecoles as $ecole) {
  $id = $ecole['id_ecole'];
  $sql="SELECT matiere.nom_matiere FROM ecole, matiere, ecolematiere WHERE matiere.id_matiere=ecolematiere.id_matiere AND ecole.id_ecole = ecolematiere.id_ecole AND ecole.id_ecole=$id";
  $result= mysqli_query($conn,$sql);
  $matier= mysqli_fetch_all($result, MYSQLI_ASSOC);
  $mat[$id] = "";
  foreach ($matier as $matie) {
    $mat[$id] = $mat[$id]." ".$matie["nom_matiere"];
  }
}
/*if(isset($_POST["getE"])){
  session_start();
  $idE= $_POST['getE'];
  $_SESSION["Ecole"]=$idE;
  header("location: ecole.php");
}*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./dist/fg9.css" rel="stylesheet">
  <link href="./dist/out16.css" rel="stylesheet">
</head>
<body>
<div class="w-full h-auto">
  <?php include("navbar.php")?>
</div>
<!--
<div class="parallax h-96 bg-local lg:bg-fixed relative text-white">
  <div class="bg-graytr w-full h-full flex items-center relative  lg:fixed z-10">
    <div class="w-pagecontain h-auto dir-rtl mx-auto ">
        
    </div>
  </div>
</div>
-->
<div class="">
  <div class="w-full h-120 mt-10 from-bottom-to-top flex items-center">
    <div class="w-full text-center">
        <h2 class="relative text-lg font-semibold leading-7 text-indigo-600 z-20">ALMOBARA</h2>
        <h1 class="relative mt-4 text-6xl font-bold tracking-tight text-gray-900 z-20">Votre allié pour la réussite au concours</h1>
        <p class="relative mt-8 text-xl leading-8 text-gray-600 w-2/3 mx-auto z-20">Ce site Web propose des ressources et des conseils pour vous aider à préparer le concours supérieur. Vous trouverez des cours en ligne, des exercices, des tests blancs et des conseils d'experts.</p>
        <button class="mx-auto mt-8 w-32 text-xl bg-blue-700 text-white p-2 rounded shadow-blue shadow-sm">Enregistre</button>
        <div class="absolute top-1/4 left-40 w-10 floating h-10 bg-blue-100 rounded-full z-0"></div>
        <div class="absolute top-1/3 right-1/4 w-6 floating h-6 bg-blue-200 rounded-full z-0"></div>
        <div class="absolute bottom-10 right-1/3 w-4 floating h-4 bg-blue-100 rounded-full z-0"></div>
        <div class="absolute bottom-20 left-96 w-3 floating h-3 bg-blue-300 rounded-full z-0"></div>  
    </div>
  </div>
  <div class=" w-pagecontain mx-auto h-auto py-10">
    <!--<div id="id_ecoles" class="w-9/12 mt-16 sm:w-pagecontain mx-auto grid grid-cols-3 gap-10">
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top">
        <img class="w-full" src="https://www.tawjihmaroc.com/media/cache/size_730_450/front/images/schools/16/b7d9e78c0f29418df303fe81dadd91d3.jpeg" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSET Mohammedia</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top-500">
        <img class="w-full" src="https://mastercours.ma/wp-content/uploads/2023/06/226920265_104772735200588_8083286030947647259_n.jpg" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSAM Casa</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top-1000">
        <img class="w-full" src="https://blogger.googleusercontent.com/img/a/AVvXsEjCYpbW_j-WvkAtYg8FASMSTTSfJOhN2H9AkwZYkvXXXjZ1FXbW4zzMv-sDZqAZqfnqXftBnOpyk1AvHcPBJNgJy9qnIONYZyVmO4wMI0Xe4OC0CD1wdmp33xmiiO9hmkDKJw66vlWWT34--I8olfNgvgJqQep4OjhnL94Vhy9EvuDp3qH6xyM8vzPP=w1200-h630-p-k-no-nu" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSEM Casa</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top">
        <img class="w-full" src="https://www.tawjihmaroc.com/media/cache/size_730_450/front/images/schools/16/b7d9e78c0f29418df303fe81dadd91d3.jpeg" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSET Mohammedia</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top-500">
        <img class="w-full" src="https://mastercours.ma/wp-content/uploads/2023/06/226920265_104772735200588_8083286030947647259_n.jpg" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSAM Casa</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
      <div class="max-w-sm h-max rounded overflow-hidden shadow-lg hidden from-bottom-to-top-1000">
        <img class="w-full" src="https://blogger.googleusercontent.com/img/a/AVvXsEjCYpbW_j-WvkAtYg8FASMSTTSfJOhN2H9AkwZYkvXXXjZ1FXbW4zzMv-sDZqAZqfnqXftBnOpyk1AvHcPBJNgJy9qnIONYZyVmO4wMI0Xe4OC0CD1wdmp33xmiiO9hmkDKJw66vlWWT34--I8olfNgvgJqQep4OjhnL94Vhy9EvuDp3qH6xyM8vzPP=w1200-h630-p-k-no-nu" alt="Sunset in the mountains">
        <div class="px-6 py-6">
          <div class="font-bold text-xl mb-2">ENSEM Casa</div>
          <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
          </p>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
      </div>
    </div>-->
    <div class="mt-10" id="ecoles">
          <form action="" method="post">
            <table class="w-full text-left">
                <tr class="p-3 h-20 border-b border-gray-100">
                    <th><h3 class="text-neutral-900 text-xl font-bold">Nom de l'ecole</h3></th>
                    <th><h3 class="text-neutral-700 text-xl">Ville</h3></th>
                    <th><h3 class="text-neutral-700 text-xl">Matieres</h3></th>
                    <th></th>
                </tr>
                <?php foreach ($ecoles as $ecole) { ?>
                <tr class="p-3 h-20 border-b border-gray-100">
                    <td><h3 class="text-blue-700 text-lg font-bold"><?php echo htmlspecialchars($ecole['nom_ecole']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($ecole['ville']);?></h3></td>
                    <td><h3 class="text-neutral-700 text-lg"><?php echo htmlspecialchars($mat[$ecole["id_ecole"]]);?></h3></td>
                    <td><a href="./ecole.php?ecole=<?php echo($ecole['id_ecole']);?>" class="text-blue-700 text-lg cursor-pointer">Voir</a></td>
                </tr>
                <?php } ?>
            </table>
          </form>
        </div>
  </div>

  <div id="id_say" class="w-full">
    <section class="relative isolate overflow-hidden px-6 py-24 sm:py-32 lg:px-8">
      <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),white)] opacity-20"></div>
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
        <img class="mx-auto h-12" src="https://tailwindui.com/img/logos/workcation-logo-indigo-600.svg" alt="">
        <figure class="mt-10">
          <blockquote class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9">
            <p>“Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo expedita voluptas culpa sapiente alias molestiae. Numquam corrupti in laborum sed rerum et corporis.”</p>
          </blockquote>
          <figcaption class="mt-10">
            <img class="mx-auto h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            <div class="mt-4 flex items-center justify-center space-x-3 text-base">
              <div class="font-semibold text-gray-900">Judith Black</div>
              <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="fill-gray-900">
                <circle cx="1" cy="1" r="1" />
              </svg>
              <div class="text-gray-600">CEO of Workcation</div>
            </div>
          </figcaption>
        </figure>
      </div>
    </section>
  </div>

  <div id="id_about" class="w-full">
    <div class="w-9/12 sm:w-pagecontain mx-auto">
        <div class="overflow-hidden py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                      <h2 class="text-base font-semibold leading-7 text-indigo-600">Deploy faster</h2>
                      <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">A better workflow</p>
                      <p class="mt-6 text-lg leading-8 text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>
                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                        <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />
                            </svg>
                            Push to deploy.
                        </dt>
                        <dd class="inline">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</dd>
                        </div>
                        <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                            </svg>
                            SSL certificates.
                        </dt>
                        <dd class="inline">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.</dd>
                        </div>
                        <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" />
                            <path fill-rule="evenodd" d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z" clip-rule="evenodd" />
                            </svg>
                            Database backups.
                        </dt>
                        <dd class="inline">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</dd>
                        </div>
                    </dl>
                    </div>
                </div>
                <img src="https://tailwindui.com/img/component-images/dark-project-app-screenshot.png" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" width="2432" height="1442">
                </div>
            </div>
        </div>

    </div>
  </div>
  <div class="w-full py-24 h-auto">
    <div class="rounded-2xl w-pagecontain 2xl:w-3/4 overflow-hidden mx-auto h-96 bg-center bg-cover bg-[url('https://www.albajiacademy.app/_next/static/media/lastBackHome.46c32470.webp')]">
      <div class="w-full h-full flex items-center bg-graytrlight">
        <div id="appear-6" class="mx-auto w-11/12 sm:w-full">
          <h3 class="text-2xl sm:text-4xl font-cairo font-bold text-white text-center">lorem ipusum</h3>
          <h3 class="text-2xl sm:text-4xl font-cairo font-bold text-white text-center mt-0 sm:mt-3">debuter votre science</h3>
          <button class="text-neutral-900 dir-rtl mx-auto mt-6 flex font-cairo py-2 px-4 rounded-lg bg-white"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 svgelect2 ml-2" viewBox="0 0 448 512"><style>.svgelect2{fill:black}</style><path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/></svg>New account</button>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full h-auto mt-10">
    <?php include("footer.php")?>
  </div>
</div>
<script>
  let first_appear=document.getElementById("id_ecoles");
  let second_appear=document.getElementById("id_say");
  let about_appear=document.getElementById("id_about");
  console.log(first_appear);
  window.addEventListener("scroll", function () {
      first_appear.children[2].classList.remove("hidden");
      first_appear.children[1].classList.remove("hidden");
      first_appear.children[0].classList.remove("hidden");
      first_appear.children[5].classList.remove("hidden");
      first_appear.children[4].classList.remove("hidden");
      first_appear.children[3].classList.remove("hidden");
      console.log(first_appear);
    
  });

</script>
</body>
</html>
