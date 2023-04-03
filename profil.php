<?php
    require "./componants/head.php";
    require "./componants/header.php";  

if(!empty($_POST)){
    extract($_POST);

    $valid = (boolean) true;
    if(isset($_POST['new_album'])){
        $title = ucfirst(trim($title));
        $Public = $Public;
        $Url_POSTER = $Url_POSTER;
        $req_utilisateur = $_SESSION['id'];
        if(empty($title)){
            $valid = false;
            $err_title = "Ce champs est vide";
        }elseif (grapheme_strlen($title) < 2 ){
            $valid = false;
            $err_title='le Titre doit faire plus de 2 caracteres';
        }elseif (grapheme_strlen($title) > 25 ){
            $valid = false;
            $err_title='le Titre doit faire moins de 26 caracteres (' . grapheme_strlen($title) . "/25)";
        } else{
            $req = $DBB->prepare('SELECT id FROM albums WHERE title = ?');

            $req-> execute(array($title));

            $req = $req->fetch();
        }

        if(empty($Url_POSTER)){
            $valid=false;
            $Url_POSTER = "Ce champs est vide";
        }
        else{
            $req = $DBB->prepare('SELECT id FROM albums WHERE Url_POSTER = ?');

            $req-> execute(array($Url_POSTER));

            $req = $req->fetch();
        }
        if ($valid){
            $req = $DBB->prepare("INSERT INTO albums (title, Url_POSTER, utilisateur_id,Public) VALUES (?,?,?,?)");
            $req-> execute(array($title,$Url_POSTER,$req_utilisateur,$Public));
            //   header('location:index.php');
            //   exit;
        }
    }   
}


?>
    <div id="popUpAlbum" class="hidden absolute w-full justify-center">
        <div class=" rounded-xl bg-slate-700 flex flex-col justify-center w-8/12">
            <div class=" mt-10 w-full flex flex-col items-center justify-center">
                <h1 class="text-6xl text-white">Un nouvel album ?</h1>
            </div>
            <div class="w-12/12 flex justify-center ">
            <form method="post" class="w-7/12 p-10">
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Titre de l'album
                </label>
                <input name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Titre de l'album">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" >
                Url de photo de l'album
                </label>
                <input name="Url_POSTER" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" placeholder="Url de photo de l'album">
                <p class="text-red-500 text-xs italic">Chercher l'url d'une image sur internet</p>
            </div>
            <div class="flex items-center justify-between">
                <input type="submit" name="new_album" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >
                
                </input>
                <div>
                    <p class="inline-block align-baseline text-xl text-red-500 " href="#"> votre album priver ou publique ? </p>
                    <div>
                        <select name="Public" class="select" multiple>
                            <option value="0">Public</option>
                            <option value="1">Privé</option>
                        </select>
                        <label class="form-check-label inline-block text-white " for="flexCheckChecked">
                        cliquer ici pour priver
                        </label>
                    </div>
                </div>
            </div>
        </form>
</div>
            <button id="fermerAlbum" class=" top-5 left-1/4 absolute inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> x  </button>
        </div>
</div>



    <div class="flex flex-col items-center bg-zinc-900 w-full mt-16">
        <div class="w-8/12 text-left">
            <div class="w-full flex justify-between">
                <img src="<?php echo $_SESSION['pdp']?>" alt="" class=" border rounded-full w-80 h-80 ">
                <a href="http://localhost/Projet-Back-End/user.php" class=" h-min px-10 bg-blue-600 text-2xl text-white">Voir tout les utilisateurs !</a>
                <a href="http://localhost/Projet-Back-End/allAlbum.php" class=" h-min px-10 bg-blue-600 text-2xl text-white">Voir tout les albums !</a>
            </div>
            <h1 class="text-5xl mt-7 mb-2  text-white"><?php echo $_SESSION['pseudo']?></h1>
            <h2 class="text-2xl text-white italic font-thin">Compte crée depuis le : <?php echo $_SESSION['date_creation']?></h2>
        </div>
        <!-- <div class="flex flex-wrap">
            <div class="border h-40 flex items-center justify-center">
                <p class="text-2xl text-white text-center">NOTE</p>
                Mettre Visuel des Notes
            </div>
            <div class="border h-40 flex items-center justify-center">
                <p class="text-2xl text-white text-center">NOTE</p>
                Mettre Visuel des Notes
            </div>
        </div> -->
        <div class="mt-16">
            <h1 class="text-white text-4xl">Vos Albums :</h1>
        </div>
        <div class="mt-20 w-8/12 grid grid-cols-4 gap-52 h-48 mb-60">
            <div class="albumCase">
                <button id="AjoutAlbum">+</button>
            </div>
            <!-- <div class="border rounded-2xl flex items-center justify-center hover:border-2">
                <button id="ouvrirAlbum" class="w-full h-full text-xl text-white text-center">Romance</button>
                <img class="" src="" alt="">
            </div> -->
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
                    <div class="albumCase">
                        <button id="ouvrirAlbum" class="">'.$row["title"].' </button>
                    </div> 
                    <div id="Album" class=" w-8/12 top-64 absolute hidden">
                        <div class="rounded-xl bg-slate-700 flex flex-col items-center w-full">
                            <div class="flex justify-around w-full ">
                                <button id="" class="button inline-block mt-10 px-6 py-2.5">Partager</button>
                                <h2 class="mt-10 text-4xl text-white">'.$row["title"] . '</h2>
                                <button id="closeAlbum" class="button mt-10 px-6 py-2.5">X</button>
                            </div>
                            <section class="flex justify-center w-full pt-24  ">
                                <div id="album-results" class=" film w-10/12 h-full grid grid-cols-4 itemsgrid-rows-5 col-span-6 gap-8">

                                </div>
                            </section>
                        </div>
                    <img class="" src="" alt="">
                    </div>';
                }
            } else {
                echo "L'utilisateur n'a pas encore créé d'albums.";
            }
            ?>
        </div>
    </div>
    <div id="Album" class="justify-center w-full top-40 absolute hidden">
        <div class="rounded-xl bg-slate-700 flex flex-col items-center w-8/12 pt-9">
            <div class="flex justify-around w-full ">
                <button id="" class=" mt-10  inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> Partager  </button>
                <h2 class="mt-10 text-4xl text-white">Titre de l'album</h2>
                <button id="closeAlbum" class=" mt-10  px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> x  </button>
            </div>
            <section class="flex justify-center w-full pt-24  ">
                <div id="album-results" class=" film w-10/12 h-full grid grid-cols-4 itemsgrid-rows-5 col-span-6 gap-8">

                </div>
            </section>
        </div>
    </div>

<?php 
    require "./componants/footer.php";
?>