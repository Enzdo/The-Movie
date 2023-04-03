<?php
include_once('include.php');

if(isset($_SESSION['id'])){
    header('location:index.php');
    exit;
}
if(!empty($_POST)){
    extract($_POST);

    $valid = (boolean) true;
    if(isset($_POST['connexion'])){
        $pseudo = ucfirst(trim($pseudo));
        $password = trim($password);
        if(empty($pseudo)){
            $valid = false;
            $err_pseudo = "Ce champs est vide";
        }
        if(empty($password)){
            $valid =false;
            $err_password = "Le mot de passe est vide";
        }
        if($valid){
            $req = $DBB->prepare("SELECT password FROM utilisateur WHERE pseudo = ?");

            $req->execute(array($pseudo));

            $req = $req->fetch();

            if(isset($req['password'])){
                if(!password_verify($password,$req['password'])){
                    $valid = false;
                    $err_pseudo="le mot de passe est mauvais";
                }
            }
            else{
                $valid = false;
                $err_pseudo="Le mot de passe est mauvais";
            }
        }
        if ($valid){
            
            $req = $DBB->prepare("SELECT * FROM utilisateur WHERE pseudo = ?");

            $req->execute(array($pseudo));

            $req_utilisateur = $req->fetch();
            if(isset($req_utilisateur['id'])){
                $date_connexion = date('Y-m-d H:i:s');

                $req = $DBB->prepare("UPDATE utilisateur SET date_connexion = ? WHERE  id = ?");
                $req-> execute(array($date_connexion, $req_utilisateur['id']));

                $_SESSION['id']= $req_utilisateur['id'];
                $_SESSION['pseudo']= $req_utilisateur['pseudo'];
                $_SESSION['pdp']= $req_utilisateur['pdp'];
                $_SESSION['date_creation']= $req_utilisateur['date_creation'];

                header('location:index.php');
                exit;
            }else{
                $valid = false;
                $err_pseudo = "aucun id trouver";
            }

        }
    }
}
    require "./componants/head.php";
    require "./componants/header.php";
?>
<div class="row">
    <div class="w-full  flex justify-center">
        <form method="post" class=" w-8/12 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" >
                <h1 class="block text-gray-900 text-6xl font-bold mb-12">Login</h1>
                <div class="mb-10">
                    <?php  if(isset($err_pseudo)){echo '<div>' . $err_pseudo . '</div>';}?>
                    <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Pseudo</label>
                    <input type="text" name="pseudo" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" value="<?php if(isset($pseudo)){ echo $pseudo;}?>" aria-describedby="passwordHelpBlock">
                </div>
                <div class="mb-4">
                    <label for="inputPassword5" class="block text-gray-700 text-4xl font-medium mb-2">Password</label>
                    <?php  if(isset($err_password)){echo '<div>' . $err_password . '</div>';}?>
                    <input type="password" name="password" id="inputPassword5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php if(isset($password)){ echo $password;}?>" aria-describedby="passwordHelpBlock">
                </div>        
                    <br>
                    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="connexion" value="Se connecter">
            </form>
    </div>
</div>
<?php 
    require "./componants/footer.php";
?>