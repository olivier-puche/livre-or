<?php
session_start();

// PENSEZ À FAIRE DES VAR DUMP POUR CONTRÔLER

$baseddonnees = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="YYY.css">
    <title>Accueil : Fan de la Plateforme</title>
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
                    <li class="active"><a href="profil.php">Modifier profil</a></li>
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
    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>
<script src="jquery.min.js"></script>
<script src="bootstrap.bundle.min.js"></script>
</body>

</html>