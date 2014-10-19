<?php

    // Pas besoin de thème ici
    $pas_de_header = true;
    
    // On simplifie l'écriture de la variable $_GET['fichier'], en sécurisant le nom (on supprime les « .. » et « / »)
    $fichier = './donnees/' . str_replace(array('..', '/'), '', $_GET['fichier']);
        
    // On vérifie que le fichier existe
    if(file_exists($fichier)){
        // On le copie de nom.ext vers .nom.ext
        copy($fichier, str_replace(basename($fichier), '', $fichier) . '.' . basename($fichier));
        
        // On supprime l'original
        unlink($fichier);
        
        // Et on redirige l'utlisateur
        header('Location: ?dossier=' . str_replace(array(basename($fichier), './donnees/'), '', $fichier));
    }
    else
        // Si le fichier n'existe pas, on redirige l'utlisateur vers une page d'erreur
        header('Location: index.php?p=404');
        
?>