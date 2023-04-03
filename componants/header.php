<?php 
include_once('./include.php');


if (isset($_SESSION['id'])) {
    $utilisateur_id = $_SESSION['id'];

    $stmt = $DBB->prepare("SELECT * FROM albums WHERE utilisateur_id = ?");

    $stmt->bindValue(1, $utilisateur_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        
    } else {
        $stmt = $DBB->prepare("INSERT INTO albums (title, Url_POSTER, utilisateur_id) VALUES (?,?,?)");
        $stmt->bindValue(1, "Liste d'envie", PDO::PARAM_STR);
        $stmt->bindValue(2, "url", PDO::PARAM_STR);
        $stmt->bindValue(3, $utilisateur_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $stmt = $DBB->prepare("INSERT INTO albums (title,Url_POSTER, utilisateur_id) VALUES (?,?,?)");
        $stmt->bindValue(1, "Visionné", PDO::PARAM_STR);
        $stmt->bindValue(2, "url", PDO::PARAM_STR);
        $stmt->bindValue(3, $utilisateur_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}else{

}

?>



<body class="bg-zinc-900">
    <header class="flex items-center justify-around py-11 bg-gradient-to-b from-slate-900 to-zinc-900">
        <div class="">
            <a href="index.php"><img src="img/logo_ligth.png" alt="" class="w-7/12 lg:w-11/12"></a>
        </div>
        <div class="w-0 lg:w-128 lg:border-white lg:border-solid lg:border-2 lg:rounded-full lg:pr-5">
            <form id="search-form" class="flex items-center justify-evenly">
                <input type="text" name="search" id="query" class="h-16 w-full lg:py-2 lg:px-6 rounded-full text-2xl">
                <button type="submit"  class="ml-4">
                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7.5" cy="7.5" r="7" stroke="white"/>
                        <path d="M13.0419 12.6276L12.6884 12.2741L11.9812 12.9812L12.3348 13.3348L13.0419 12.6276ZM20.113 21.1129C20.3082 21.3082 20.6248 21.3082 20.8201 21.1129C21.0153 20.9177 21.0153 20.6011 20.8201 20.4058L20.113 21.1129ZM12.3348 13.3348L20.113 21.1129L20.8201 20.4058L13.0419 12.6276L12.3348 13.3348Z" fill="white"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="flex items-center justify-evenly">
            <div class="lg:hidden h-8 flex flex-col space-y-2.5">
                <div class="line border-b-white border-solid border-b-2 h-2 w-12"></div>
                <div class="line border-b-white border-solid border-b-2 h-2 w-12"></div>
                <div class="line border-b-white border-solid border-b-2 h-2 w-12"></div>
            </div>
            <div class="hidden w-96 lg:flex items-center justify-evenly">
                <?php
                    if(!isset($_SESSION['id'])){
                ?>
                                <a href="./login.php" class="text-white text-2xl ">Se connecter</a>
                    <a href="./register.php" class="text-white text-2xl pl-32">S'inscrire</a>
                <?php }else{ ?>
                    <a class="text-white text-2xl mr-8" href="deconnexion.php">Déconnexion</a>
                    <a href="./profil.php" class="w-24 h-24"><img  src="<?php echo $_SESSION['pdp']?>" alt="" class="profil_img w-full h-full"></a>
                <?php
                    } ?>
            </div>
        </div>    
    </header>