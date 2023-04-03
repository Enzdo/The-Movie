<?php 
require './componants/head.php';
require './componants/header.php';
?>

<h1 class="text-5xl text-white ml-24 my-16">Voici Tout les Albums Publiques :</h1>
<div class="flex justify-center">
    <ul id="users" class="w-8/12">
        <!-- Template -->
        <!-- <li class="border-y border-white py-12 px-6 flex flex-row justify-between items-center">
            <img class="profil_img w-36 h-36" src="https://th.bing.com/th/id/OIP.OE8G_hsblGXLBww_k_bdAgHaE8?pid=ImgDet&rs=1" alt='${original_title}'>
            <a class="px-12 text-3xl text-white font-bold uppercase ml-[-550px]" href="">Asasa</a>
            <p class="text-xl text-white italic">Membre depuis : 2022-12-18 19:28:08</p>
        </li> -->
    <?php
    $DB = mysqli_connect('localhost', 'root', '', 'dev_back');

    if (!$DB) {
        die("Connection failed : " . mysqli_connect_error());
    }

    $query = "SELECT a.title, a.public, a.utilisateur_id, u.pdp, u.id, u.pseudo FROM albums AS a INNER JOIN utilisateur AS u ON a.utilisateur_id = u.id WHERE a.public=1";
    $result = mysqli_query($DB, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <li class="border-y border-white py-12 px-6 flex flex-row justify-between items-center">
            <img class="profil_img w-36 h-36" src="'.$row['pdp'].'" alt="Photo de Profil">
            <a class="px-12 text-3xl text-white font-bold uppercase ml-[-550px]" href="">'.$row['title'].'</a>
            <p class="text-xl text-white italic">crée par : '.$row['pseudo'].'</p>
        </li>
        ';
    }
    ?>
    </ul>
</div>
<?php 
    require "./componants/footer.php";
?>