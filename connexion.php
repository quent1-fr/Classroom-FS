<?php
    // Si un mot de passe est envoyé
    if(isset($_GET['mdp'])){
        include 'config.php';
        
        // On démarre la session.
        session_start();
    
        // On chiffre le mot de passe, pour pouvoir le comparer
        $mdp_chiffre = sha1($config['salt_mdp'] . $_GET['mdp'] . $config['salt_mdp']);
    
        // Si c'est le bon mot de passe
        if($mdp_chiffre == $config['mot_de_passe_classe']){
            // On le confirme dans la session
            $_SESSION['connecte'] = true;
            $_SESSION['mdp'] = $mdp_chiffre;
    
            // Et on redirige vers la page d'accueil
            header('Location: index.php');
        }
        else
            // Sinon, on redirige vers la page de login, avec un message d'erreur
            header('Location: index.php?erreur');
    }
?>