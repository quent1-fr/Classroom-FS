<?php
        $pas_de_header = true;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Connexion - Classroom FS</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="theme/css/polices.css" />
		<link type="text/css" rel="stylesheet" href="theme/css/connexion.css" />
		<link rel="shortcut icon" type="image/png" href="theme/icones/favicon.png" />
	</head>
	<body>
                <form action="connexion.php" method="get">
                        <?php
                                if(isset($_GET['erreur']))
                                        echo '<label>Mauvais mot de passe...</label>';
                                else
                                        echo '<label>Connectez-vous à Classroom FS</label>';
                        ?>
                        <input type="password" name="mdp" required placeholder="Mot de passe de la classe..." />
                        <input type="submit" value="Connexion" />
                </form>
	</body>
</html>