<?php

    // Pas besoin de thème ici
    $pas_de_header = true;
    
    // On simplifie l'écriture de la variable $_GET['fichier']
    $fichier = './donnees/' . str_replace('..', '', $_GET['fichier']);
        
    // On vérifie que le fichier existe
    if(file_exists($fichier)){
        // Taille du fichier
        $size = filesize($fichier);
        
        // On force le téléchargement en utilisant des header adaptés
        header('Content-Type: application/force-download; name="' . basename($fichier) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . $size);
        header('Content-Disposition: attachment; filename="' . basename($fichier) . '"');
        header('Expires: 0');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        
        // On met le contenu du fichier
        readfile($fichier);
    }
    else
        // Si le fichier n'existe pas, on met une page d'erreur
        header('Location: index.php?p=404');
        
?>