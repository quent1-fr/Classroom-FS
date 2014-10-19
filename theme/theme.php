<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $titre; ?> - Classroom FS</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="theme/css/polices.css" />
		<link type="text/css" rel="stylesheet" href="theme/css/style.css" />
		<link rel="shortcut icon" type="image/png" href="theme/icones/favicon.png" />
	</head>
	<body>
		<header>
			<div class="conteneur">
				
				<h1 class="logo">Classroom FS</h1>
				
				<nav>
					<ul>
						<li><a href="index.php" <?php if($_GET['p'] == 'index') echo 'class="actif"'; ?>>Fichiers partagés</a></li><li><a href="?p=aide" <?php if($_GET['p'] == 'aide') echo 'class="actif"'; ?>>Aide</a><li><a href="?p=deconnexion">Déconnexion</a></li>
					</ul>
				</nav>
				
			</div>
		</header>
		<article>
			<div class="conteneur"><?php echo $contenu; ?></div>
		</article>
		<script src="theme/js/jquery.js"></script>
		<script src="theme/js/dropzone.js"></script>
		<script src="theme/js/envoi_glisser_deposer.js"></script>
	</body>
</html>
