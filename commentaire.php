<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

if(isset($_SESSION['id'])) 
{
   $requser = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE login = ?");
   $requser->execute(array($_SESSION['login']));
   $user = $requser->fetch();
   
   //var_dump($user);

   if(isset($_POST['submit_commentaire'])) 
   {
       $commentaire = $_POST['commentaire'];
       $id_utilisateur = $_SESSION['id'];

       if(isset($commentaire) AND !empty($_POST['commentaire']))
       {
           date_default_timezone_set('Europe/Paris');
           $date = date("Y-m-d");
           $insertioncom = $baseddonnees->prepare("INSERT INTO commentaires(commentaire, id_utilisateur, date) VALUES(?, ?, ?)");
           $insertioncom->execute(array($commentaire, $id_utilisateur, $date));
           $c_msg ="Votre commentaire a bien été posté";
           
           //var_dump($insertioncom);
           //header("location:livre-or.php");
       }
       else 
       {
           $c_msg = "<span style='color:green'>Nous n'avons pas pu publier votre commentaire</span>";
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
    <title>Commentaire</title>
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

    <main>
    <div align="center">    
         <h2>Commentaire</h2>

         <form method="post" action="commentaire.php">
            <textarea name="commentaire" placeholder="Veuillez saisir votre commentaire..."></textarea><br /><br>
            <input type="submit" name="submit_commentaire" value="Publier votre commentaire" />
        </form>

        <?php
        if(isset($c_msg ))
            {echo '<font color="red">'.$c_msg."</font>";}
        ?>
        
    </div>
    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>