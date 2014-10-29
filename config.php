<?php
    
    // Pour afficher les dates en français
    setlocale (LC_TIME, 'fr_FR.utf8','fra');     

    // Le salt pour le mot de passe
    $config['salt_mdp'] = '';
    
    // Le SHA-1 du mot de passe pour accéder à la classe
    // sha1($salt . $mdp . $salt)
    $config['mot_de_passe_classe'] = '';
    
    // Le mail de l'administrateur (sera rendu public, sur la page d'aide)
    $config['admin_mail'] = '';

?>
