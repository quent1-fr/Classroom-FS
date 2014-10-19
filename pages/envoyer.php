<?php

    // Pas besoin de thème ici
    $pas_de_header = true;
    
    // On défini le lieu de stockage du fichier
    $dossier_stockage = './donnees/' . $_SESSION['dossier_courant'];
    
    // Si il y a quelquechose à envoyer, et si le fichier n'existe pas encore
    if(!empty($_FILES) && !file_exists($dossier_stockage . $_FILES['file']['name'])){
        
        // On récupère le nom temporaire
        $nom_temporaire = $_FILES['file']['tmp_name'];
        
        // Et on le déplace, en supprimant les « .. » et « / »
        move_uploaded_file($nom_temporaire, $dossier_stockage . str_replace(array('..', '/'), '', $_FILES['file']['name']));
    }
    
?>   