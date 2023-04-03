<?php 
require './componants/head.php';
require './componants/header.php';
?>

<div  id="LikeAlbum" class=" w-full absolute flex justify-center hidden">
    <div class="flex flex-col items-center w-8/12 bg-gray-700">
        <div class="flex justify-around w-full ">
            <h2 class="mt-10 text-4xl text-white">Ajouter le film a ...</h2>
            <button id="LikeClose" class=" mt-10  px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> x  </button>
        </div>
            <div class="h-40 w-full flex items-center justify-around">
            <?php
                        $utilisateur_id = $_SESSION['id'];

                    // Sélectionner tous les albums de l'utilisateur connecté
                    $sql = "SELECT * FROM albums WHERE utilisateur_id = '$utilisateur_id'";
                    $stmt = $DBB->prepare($sql);
                    $stmt->execute();

                    // Récupérer le résultat de la requête
                    $result = $stmt->fetchAll();

                    // Afficher chaque album
                    if (count($result) > 0) {
                        // Pour chaque ligne
                        foreach($result as $row) {
                            echo  '
                            <div class="albumCase p-10">
                                <button id="ouvrirAlbum" class="">'.$row["title"].' </button>
                            </div>';
                        }
                    } else {
                        echo "L'utilisateur n'a pas encore créé d'albums.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="single_film" >
        
</main>
<div class="flex justify-center">
<button id="likeOpen" type="button" class=" w-2/6 inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-3xl leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Like</button>
</div>

    
<script src="./componants/single_movie.js"></script>
<?php 
    require "./componants/footer.php";
?>