<?php

require "./componants/head.php";
require "./componants/header.php";
include_once("./componants/user.php");

if(isset($_SESSION['id'])){
    header('location:index.php');
    exit;
}

$DBB = new connexionDB();
$DBB = $DBB->DB();

$err_pseudo = "";
$err_email = "";
$err_password = "";

if(!empty($_POST)){
    
    extract($_POST);
    $valid = (boolean) true;

    if(isset($_POST['inscription'])){
        $pseudo = ucfirst(trim($pseudo));
        $email = trim($email);
        $email2 = trim($email2);
        $password = trim($password);
        $password2 = trim($password2);
        $pdp = $pdp;
        
        if(empty($pseudo)){
            $valid = false;
            $err_pseudo = "Ce champs est vide";
        }elseif (mb_strlen($pseudo) < 2 ){
            $valid = false;
            $err_pseudo='le pseudo doit faire plus de 2 caracteres';
        }elseif (mb_strlen($pseudo) > 25 ){
            $valid = false;
            $err_pseudo='le pseudo doit faire moins de 26 caracteres (' . grapheme_strlen($pseudo) . "/25)";
        } else{
            $req = $DBB->prepare('SELECT id FROM utilisateur WHERE pseudo = ?');

            $req-> execute(array($pseudo));

            $req = $req->fetch();
            if(isset($req['id'])){
                $valid = false;
                $err_pseudo ="Ce pseudo est deja pris";
            }
        }

        if(empty($email)){
            $valid = false;
            $err_email = "Ce champs est vide";
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $valid = false;
            $err_email = "Format invalid pour le mail";
        }
        elseif ($email <> $email2){
            $valid = false;
            $err_email = "les mails sont different";
        }
        else{
            $req = $DBB->prepare('SELECT id FROM utilisateur WHERE email = ?');

            $req-> execute(array($email));

            $req = $req->fetch();
            if(isset($req['id'])){
                $valid = false;
                $err_pseudo = "Ce pseudo ou l'email est deja pris";
            }
        }

        if(empty($password)){
            $valid = false;
            $err_password = "Le mot de passe est vide";
        }elseif ($password <> $password2){
            $valid = false;
            $err_password="le mot de passe est differents";
        }

        // if(isset($_FILES['pdp']) && !empty($_FILES['pdp']['name'])){
        //     $filename = $_FILES['pdp']['tmp_name'];

        //     $tailleMax = '5242880'; // 5mo
        //     if($_FILES['pdp']['size']<= $tailleMax){
        //         $extensionValides = array('jpg','png','jpeg');

        //         $extensionUpload = strtolower(substr(strrchr($_FILES['pdp']['name'], '.'), 1));
        //         if(in_array($extensionUpload,$extensionValides)){
        //             $dossier = 'public/pdp/' . $_SESSION['id'] . '/';
        //             $nom = md5(uniqid(rand(), true));

        //             $chemin = $dossier . $nom . '.' . $extensionUpload;

        //             $resultat = move_uploaded_file($_FILES['pdp']['tmp_name'], $chemin);
        //         }else{
        //             $valid =false;
        //             $err_pdp ="L'extension de votre image n'est pas valide ";
        //         }
        //     }
        // }else{
        //     $valid =false;
        //     $err_pdp ="Ceci n'est pas un fichier valide";
        // }

        if ($valid){

            #$crypt_password = crypt($password, '$6$rounds=5000$usesomesillystringforsalt$');
            $crypt_password = password_hash($password, PASSWORD_ARGON2ID);
            $date_creation = date('Y-m-d H:i:s');
            
            // $user = new User($_POST);
            // $user = array($user);
            // $user->register();

            $req = $DBB->prepare("INSERT INTO albums (title, Url_POSTER, utilisateur_id) VALUES (?,?,?)");
            $req-> execute(array($title,$Url_POSTER,$req_utilisateur));

            $req = $DBB->prepare("INSERT INTO utilisateur (pseudo, email, password, pdp, date_connexion, date_creation) VALUES (?,?,?,?,?,?)");
            $req-> execute(array($pseudo,$email,$crypt_password,$pdp, $date_creation, $date_creation));
        }
        header('location:index.php');
        exit;
    }   
}
?>
<div class="row">
    <div class="flex flex-col items-center justify-center ">
        <form method="post" class=" w-8/12 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            <h1 class="block text-gray-900 text-6xl font-bold mb-12">Formulaire d'inscription</h1>
            <div class="mb-10">
                <?php  if(isset($err_pseudo)){echo '<div>' . $err_pseudo . '</div>';}?>
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Pseudo</label>
                <input type="text" name="pseudo" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php if(isset($pseudo)){ echo $pseudo;}?>" aria-describedby="passwordHelpBlock">
            </div>
            <div class="mb-10">
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Password</label>
                <?php  if(isset($err_password)){echo '<div>' . $err_password . '</div>';}?>
                <input type="password" name="password" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php if(isset($password)){ echo $password;}?>" aria-describedby="passwordHelpBlock">
                <div id="passwordHelpBlock" class="form-text">
                Votre mot de passe doit compter de 8 à 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d’espaces, de caractères spéciaux ou d’émoticônes.
                </div>
            </div>
            <div class="mb-10">
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Confirmer votre password</label>
                <input type="password" name="password2" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  value="" aria-describedby="passwordHelpBlock">
                <div id="passwordHelpBlock" class="form-text">
                    Écriver les memes mot de passe !
                </div>
            </div>    
            <?php  if(isset($err_email)){echo '<div>' . $err_email . '</div>';}?>
            <div class="mb-10">
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Mail</label>
                <input type="email" name="email" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php if(isset($email)){ echo $email;}?>" aria-describedby="passwordHelpBlock">
            </div>
            <div class="mb-10">
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Confirmer votre e-mail</label>
                <input type="email" name="email2" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php if(isset($email2)){ echo $email2;}?>" aria-describedby="passwordHelpBlock">
            </div>
            <div class="mb-10">    
                <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Photo de profil</label>
                <?php  if(isset($err_pdp)){echo '<div>' . $err_pdp . '</div>';}?>
                <input type="url" name="pdp" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="Modifier" aria-describedby="passwordHelpBlock">
            </div>
            <br>
            <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="inscription" value="Register">
        </form>
    </div>
</div>
<?php 
    require "./componants/footer.php";
?>