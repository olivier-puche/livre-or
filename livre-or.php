<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Livre d'or</title>
</head>

<body>

    <header>
        <h1>Fan de la Plateforme</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="livre-or.php">Livre dor</a></li>
            <li><a href="commentaire.php">Commentaire</a></li>
            <li><a href="profil.php">Modifier profil</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>
   
    <main>
        <div align="center">    
            <h2>Livre d'or</h2>
        </div>     
    </main>

    <?php
    if(isset($_SESSION['id'])) 
    {
    $dataquerycom = $baseddonnees->prepare("SELECT c.commentaire, u.login, c.date FROM commentaires AS c INNER JOIN utilisateurs AS u ON c.id_utilisateur = u.id ORDER BY date DESC");
    $dataquerycom->execute();

    $resultcoms = $dataquerycom-> fetchAll(PDO::FETCH_ASSOC);
    // var_dump($resultcoms);

    foreach ($resultcoms as $commentaire)
    {
        echo 'Posté le : '.$commentaire['date'].'<br>';
        echo 'Utilisateur : '.$commentaire['login'].'<br>';
        echo 'Commentaire : '.$commentaire['commentaire'].'<br><br>';
    }   

    //Autre manière de la faire
     
    //$resultcoms = $dataquerycom-> fetchAll(PDO::FETCH_OBJ);

    //foreach ($resultcoms as $commentaire)
    //{
    //      echo 'Utilisateur : '.$commentaire->login.'<br>';
    //      echo 'Date : '.$commentaire->date.'<br>';
    //      echo 'Commentaire : '.$commentaire->commentaire.'<br><br>';
    //}   

    ?>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>

<?php   
}
?>