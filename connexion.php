<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');  

if(isset($_POST['formconnexion'])) 
{
    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);
    
    if(!empty($password) AND !empty($login)) 
    {
       $requser = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
       $requser->execute(array($login, $password));
       $userexist = $requser->rowCount();
       
       if($userexist == 1) 
       {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['login'] = $userinfo['login'];
          $_SESSION['password'] = $userinfo['password'];
        }  
        else 
        {
          $erreur = "Tous les champs doivent être complétés !";
        }
    }       
}
          
?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="YYY.css">
    <title>Connexion</title>
</head>

<body>

    <header>
        <h1>Fan de la Plateforme</h1>
    </header>

    <nav>
        <ul>
            <li><a href="accueil-index.php">Accueil</a></li>
            <?php 
                if (isset ($_SESSION['id'])) 
                {?> 
                    <li class="active"><a href="connexion.php">Connexion</a></li>
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

    <main>
    <div align="center">    
         <h2>Connexion</h2>

        <form method="post" action="connexion.php">
            <div>
            <label for="name">Login</label>
            <input type="text" id="login" name="login" placeholder="Saisir votre identifiant">
            <br><br>
            </div>
            <div>
            <label for="name">Password</label>
            <input type="password" id="password" name="password" placeholder="Saisir votre mot de passe">
            <br><br>
            </div>
            <div>
            <input type="submit" name="formconnexion" value="Se connecter" />
            <br><br>
            </div>
        </form>

         <?php
         if(isset($erreur)) 
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>

    </div>
    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>