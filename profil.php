<?php
session_start();
 
$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', ''); 
 
if(isset($_SESSION['id'])) 
{
   $requser = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   
   //var_dump($user);
   //var_dump($user['login']);

   if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']) 
   {
      $newlogin = htmlspecialchars($_POST['newlogin']);
      $id_utilisateur = $_SESSION['id'];
      $insertlogin = $baseddonnees->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
      $insertlogin->execute(array($newlogin, $id_utilisateur));
   }
   //var_dump($_POST['newpassword2']);
   
   if(isset($_POST['newpassword1']) AND !empty($_POST['newpassword1']) AND isset($_POST['newpassword2']) AND !empty($_POST['password2']) != $user['password']) 
   {
      //var_dump($_POST['newpassword1']);

      if($_POST['newpassword1'] == $_POST['newpassword2']) 
      {
         $password1 = sha1($_POST['newpassword1']);
         $insertpassword = $baseddonnees->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
         $insertpassword->execute(array($password1, $_SESSION['id']));
      } 
      else 
      {
         $msg = "Vos deux mots de passes ne correspondent pas !";
      }
   } 
?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Mon profil</title>
</head>

<body>

    <header>
        <h1>Fan de la Plateforme</h1>
    </header>

    <nav>
         <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php 
               if (isset ($_SESSION['id'])) 
               {?> 
                  <li class="active"><a href="profil.php">Modifier profil</a></li>
                  <li class="active"><a href="livre-or.php">Livre d'or</a></li>
                  <li class="active"><a href="commentaire.php">Commentaires</a></li>
                  <li class="active"><a href="deconnexion.php">Déconnexion</a></li>
               <?php }  
               else 
               {?>
                  <li class="active"><a href="inscription.php">Formulaire Inscription</a></li>
                  <li class="active"><a href="connexion.php">Connexion</a></li> 
               <?php }
            ?> 
        </ul>
    </nav>
   <body>

      <main>  
        <div align="center">
            <h2>Edition de mon profil</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                <label>Login</label>
                <input type="text" name="newlogin" placeholder="login" /><br /><br />
                <label>Password</label>
                <input type="password" name="newpassword1" placeholder="Mot de passe"/><br /><br />
                <label>Confirmer password</label>
                <input type="password" name="newpassword2" placeholder="Confirmer mot de passe" /><br /><br />
                <input type="submit" value="Mettre à jour mon profil !" />
                </form>
                <?php if(isset($msg)) 
                {echo $msg; } 
                ?>
        </div>
     </main>

     <footer
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>
   </body>

</html>

<?php   
}
?>