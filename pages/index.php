<?php
	$titre = 'Fichiers partagés';

	// Fonction permettant de définir automatiquement l'icône adaptée à un fichier
	function icone_fichier($nom_fichier){
		// On récupère l'extension
		$extension = end(explode('.', $nom_fichier));
		
		switch ($extension){
		    
		    case 'jpg': case 'png': case 'svg': case 'bmp': // Images
			$icone = 'image';
			break;
		    
		    case 'mp3': case 'flac': case 'wav': case 'ogg': // Musique
			$icone = 'musique';
			break;
		    
		    case 'avi': case 'ogv': case 'webm': case 'wmv': case 'mkv': // Vidéo
			$icone = 'video';
			break;
		    
		    default: // Autre...
			$icone = 'autre';
			break;
		    
		}
		
		return $icone;
	}
	
	// Fonction permettant d'afficher des liens hypertextes dans l'arborescence
	function chemin_vers_liens($chemin){
	    $dossiers = explode('/', $chemin);
	    $lien_relatif = '';
	    $liens = '/<a href="?">racine</a>/';
	    
	    foreach($dossiers as $dossier){
		if(!empty($dossier)){
		    $lien_relatif .= $dossier . '/';
		    $liens .= '<a href="?dossier=' . urlencode($lien_relatif) . '">' . strtolower($dossier) . '</a>/';
		}
	    }
	    
	    return $liens;
	}
	
	// Début du code source
	
	// Si on souhaite un sous-dossier
	if(isset($_GET['dossier'])){
		$sous_dossier =  str_replace('..', '', $_GET['dossier']) . '/';
		echo '<h1>Fichiers partagés dans ' . chemin_vers_liens($sous_dossier) . '</h1><div class="liste_fichiers"><div class="zone_upload">Faites glisser des fichiers (ou cliquez) ici pour les envoyer. 50 fichiers de 20 Mo maximum.</div>';
	}
	// Sinon
	else{
		$sous_dossier = '';
		echo '<h1>Fichiers partagés</h1><div class="liste_fichiers">';
	}
	
	// Si le dossier n'existe pas -> page d'erreur
	if(!file_exists('donnees/' . $sous_dossier))
		header('Location: index.php?p=404');
	
	// Le dossier dans lequel on travaille
	$dossier_classe = 'donnees/' . $sous_dossier;
	
	// Si cette variable reste à zéro, c'est que le dossier est vide
	$nombre_elements = 0;
	
	// Utile pour l'upload de fichiers
	$_SESSION['dossier_courant'] = $sous_dossier;	
	
	// Liste des dossiers et des fichiers - Utile pour le tri des données
	$liste_dossiers = array();
	$liste_fichiers = array();
	
	// On ouvre le dossier
	$repertoire = opendir($dossier_classe);
	
	// Et on lis chaque élément
	while($contenu_dossier = readdir($repertoire)){
		
		// Si le nom ne commence pas par un point
		if($contenu_dossier[0] != '.'){
			
			// +1 fichier
			$nombre_elements++;
			
			// Si c'est un fichier
			if(!is_dir($dossier_classe . $contenu_dossier)){
				// On récupère sa date de création
				$date_creation = filectime($dossier_classe . $contenu_dossier);
				
				// Et on le stocke dans le tableau
				$liste_fichiers[filectime($dossier_classe . $contenu_dossier)] = '<a href="?p=telecharger&fichier=' . $sous_dossier . urlencode($contenu_dossier) . '" title="' . $contenu_dossier . '"><div class="fichier"><img src="theme/icones/' . icone_fichier($contenu_dossier) . '.png" /><div class="infos_fichier"><h1>' . $contenu_dossier . '</h1><h2>Envoyé le ' . strftime('%d %B %Y à %H:%M', $date_creation) . '</h2></div><div class="supprimer"><a href="?p=suppr&fichier=' . $sous_dossier . urlencode($contenu_dossier) . '">X</a></div></div></a>';
			}
			// Si c'est un dossier
			else
				// On le stocke dans un tableau
				$liste_dossiers[$contenu_dossier] = '<a href="?dossier=' . $sous_dossier . urlencode($contenu_dossier) . '" title="' . $contenu_dossier . '"><div class="fichier"><img src="theme/icones/dossier.png" /><div class="infos_fichier"><h1>' . $contenu_dossier . '</h1><h2>Dossier</h2></div></div></a>';
			
		}
	}
	
	// Puis on ferme le dossier
	closedir($repertoire);
	
	// Si le dossier est vide
	if($nombre_elements < 1)
		echo '<p>Ce dossier est vide...</p>';
	// Sinon, on trie les données
	else{
		// On trie le tableau contenant les dossiers (par ordre alphabétique)
		ksort($liste_dossiers);
		
		// Puis on les affiche
		foreach($liste_dossiers as $dossier)
			echo $dossier;
			
		// On trie le tableau contenant les fichiers (par date de création, du plus récent au plus ancien)
		krsort($liste_fichiers);
		
		// Puis on les affiche
		foreach($liste_fichiers as $fichier)
			echo $fichier;
		
	}
	
?></div>
