<?php

    // Pas besoin de thème ici
    $pas_de_header = true;
    
    // On détruit la session
    $_SESSION['connecte'] = false;
    $_SESSION['mdp'] = uniqid();
    session_destroy();
    
    // On redirige l'utilisateur
    header('Location: index.php');
    
?>