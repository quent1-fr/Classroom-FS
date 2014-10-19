<?php

    // On active la compression GZIP
    ob_start('ob_gzhandler');
    
    // On défini l'encodage (UTF-8)
    header('Content-Type: text/html; charset=utf-8');
    
    // On inclu la configuration
    include 'config.php';
    
    // On démarre la session.
    session_start();
    
    // On active la temporisation de sortie
    ob_start();
    
        // Si rien n'est défini, on redirige vers l'index
        if(!isset($_GET['p']))
            $_GET['p'] = 'index';
    
        // Si la page n'existe pas, on affiche l'erreur 404
        if(!file_exists('./pages/' . $_GET['p'] . '.php'))
            $_GET['p'] = '404';
        
        // Si la personne n'est pas connectée, on affiche la page de connexion
        if(!isset($_SESSION['connecte'], $_SESSION['mdp']) or $_SESSION['mdp'] != $config['mot_de_passe_classe'] or $_SESSION['connecte'] == false)
            $_GET['p'] = 'connexion';
        
        // On inclu la bonne page
        include './pages/' . $_GET['p'] . '.php';
        
        // On stocke le contenu dans une variable
        $contenu = ob_get_contents();
    
    // Fin de la temporisation
    ob_end_clean();
    
    // Si la page nécéssite un header, on charge le thème
    if(!isset($pas_de_header))
        include './theme/theme.php';
    // Sinon, on affiche seulement le contenu
    else
        echo $contenu;
    
?>