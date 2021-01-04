<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');  

if(isset($_POST['forminscription']))
{
    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);

    if(!empty($_POST['login']) AND !empty($_POST['password'])AND !empty($_POST['password2']))
    {  
        /*if(preg_match("(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$", $_POST['password'])) 
                        { 
                            echo 'Mot de passe accepté';
                        }
                        else
                        {
                            echo 'Saisir au moins, 1 majusucle, 1 chiffre et un caractère spécial';
                        }*/

        $loginlength = strlen($login);

        if ($loginlength <= 255)
             {
                $reqlogin = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                $reqlogin->execute(array($login));
                $loginexist = $reqlogin->rowCount();
                
                if($loginexist == 0) 
                { 
                   if($password == $password2)
                   {
                      $insertuser = $baseddonnees->prepare("INSERT INTO utilisateurs(login, password) VALUES(?, ?)");
                      $insertuser->execute(array($login, $password));
                      $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                   } 
                   else 
                   {
                      $erreur = "Votre mots de passes ne correspondent pas !";
                   }
                }
            }   
       else 
       {
          $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
       }
    } 
    else 
    {
        $erreur = "Tous les champs doivent être complétés !";
    }
 } 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="YYY.css">
    <title>Inscription</title>
</head>

<body>

    <header>
        <h1>FAN DE LA PLATEFORME</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php 
                if (isset ($_SESSION['id'])) 
                {?> 
                    <li class="active"><a href="profil.php">Modifier profil</a></li>
                    <li class="active"><a href="deconnexion.php">Déconnexion</a></li>
                <?php }  
                else 
                { ?>
                    <li class="active"><a href="inscription.php">Formulaire Inscription</a></li>
                    <li class="active"><a href="connexion.php">Connexion</a></li> 
                <?php }
            ?> 
        </ul>
    </nav>

    <main>
    <div align="center">    
         <h2>Inscription</h2>

        <form method="post" action="inscription.php">
            <div>
            <label for="name">Login</label>
            <input type="text" id="login" name="login" placeholder="Saisir un pseudo unique">
            <br><br>
            </div>
            <div>
            <label for="name">Password</label>
            <input type="password" id="password" name="password" placeholder="10 caractères minimum">
            <br><br>
            </div>
            <div>
            <label for="name">Confirmer Password</label>
            <input type="password" id="password2" name="password2">
            <br><br>
            </div>
            <div>
            <input type="submit" name="forminscription" value="Je m'inscris"/>
            </div>
        </form>

<?php
    if(isset($erreur))
     
        {echo '<font color="red">'.$erreur."</font>";}
?>

    </div>
    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>

<!-- placeholder="nomutilisateur@beststartupever.com" pattern=".+@beststartupever.com"  
title="Merci de fournir uniquement une adresse Best Startup Ever"  -->
         