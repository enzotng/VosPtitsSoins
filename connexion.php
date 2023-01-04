<?php

session_start();

//Variables nécessaire à la connexion à la base donnée

    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";

//On établit la connexion

$db = new PDO("mysql:host=$hostname;dbname=etang_vpt", $username, $password);
//On sélectionne la table utilisateur dans notre base de données, on prépare la requête puis on l'exécute
$sql = "SELECT * FROM Client";
$result = $db->prepare($sql);
$result->execute();

// Connexion Client

//Si l'utilisateur appuie sur le bouton connexion
if (isset($_POST['btnConnexionClient'])) {
    //On récupère les valeurs du formulaire
    $email = $_POST['mailconnect'];
    $pass = $_POST['mdpconnect'];
    //On parcourt la table
    while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
        //On verifie que l'email et le mot de passe decrypté correspondent
        $hash = substr( $ligne['mdp_client'], 0, 60 );
        $ligne['id_client'];
        if ($ligne['mail_client'] == $email and crypt($pass, $hash)) {
            // On ouvre la session
            session_start();

            // On enregistre le login en session
            $_SESSION['id_client'] = $ligne['id_client'];
            $_SESSION['mdp_client'] = $pass;
            //Redirection vers une page différente du même dossier
            header("Location: profil.php");
            exit();
        } else {
            //Sinon on affiche le mot de passe incorrect
            $erreur = "Mauvais e-mail ou mot de passe !";
        }
    }
}

//On sélectionne la table utilisateur dans notre base de données, on prépare la requête puis on l'exécute
$sql = "SELECT * FROM Artisan";
$result = $db->prepare($sql);
$result->execute();
// Connexion Artisan

//Si l'utilisateur appuie sur le bouton connexion
if (isset($_POST['btnConnexionArt'])) {
    //On récupère les valeurs du formulaire
    $email2 = $_POST['mailconnect2'];
    $pass2 = $_POST['mdpconnect2'];
    //On parcourt la table
    while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
        //On verifie que l'email et le mot de passe decrypté correspondent
        $hash = substr( $ligne['mdp_artisan'], 0, 60 );
        if ($ligne['mail_artisan'] == $email2 and crypt($pass2, $hash)) {
            // On ouvre la session
            session_start();

            // On enregistre le login en session
            $_SESSION['id_artisan'] = $ligne['id_artisan'];
            $_SESSION['mdp_artisan'] = $pass2;
            //Redirection vers une page différente du même dossier
            header("Location: admin.php");
            exit();
        } else {
            //Sinon on affiche le mot de passe incorrect
            $erreur = "Mauvais e-mail ou mot de passe !";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Configuration générale -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/img" href="documents/img/logo.png">
    <title>Connexion - Vos P'tits Soins</title>

    <!-- Fichier CSS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="documents//css/owl.carousel.css">
    <link rel="stylesheet" href="documents/css/style.css">

</head>

<body>
    <?php 
    include("header2.php");
    ?>
    
    <main>
        
        <section class="section_connexion">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Espace Client
            </div>
            <div class="title signup">
                Espace Artisan
            </div>
        </div>
        <div class="form-container">
            <div class="connexion-controls">
                <input class="radio_connexion" type="radio" name="connexion" id="login" checked>
                <input class="radio_connexion" type="radio" name="connexion" id="signup">
                <label for="login" class="connexion login">Espace Client</label>
                <label for="signup" class="connexion signup">Espace Artisan</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                
                <!-- Inscription Client -->
                
                <form action="#" method="post" class="login">
                    
                    <div class="field">
                        <input type="email" name="mailconnect" placeholder="Email">
                    </div>
                    
                    <div class="field">
                        <input type="password" name="mdpconnect" placeholder="Mot de passe">
                    </div>
                    
                    <input class="btn bouton_connexion mt-2" name="btnConnexionClient" type="submit" value="Se connecter">
                                            
                    <div class="php_connexion">
                        <?php

                        if (isset($erreur)) {

                            echo '<font class="text-center" color="red">' . $erreur . "</font>";
                        }

                        ?>
                    </div>
                        
                    <div class="signup1-link">
                        <a class="signup1-link" href="inscription.php">Créer un compte client ?</a>
                    </div>
                </form>
                
                <!-- Inscription Artisan -->
                
                <form action="#" method="post" class="signup">
                <div class="field">
                        <input type="email" name="mailconnect2" placeholder="Email">
                    </div>
                    <div class="field">
                        <input type="password" name="mdpconnect2" placeholder="Mot de passe">
                    </div>
                        <input class="btn bouton_connexion mt-2" name="btnConnexionArt" type="submit" value="Se connecter">
                        
                    
                    <div class="php_connexion">
                        <?php

                        if (isset($erreur)) {

                            echo '<font class="text-center" color="red">' . $erreur . "</font>";
                        }

                        ?>
                    </div>
                    <div class="signup2-link">
                        <a class="signup2-link" href="inscription_art.php">Créer un compte artisan ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
    <! -- Back to top -->
        <a class='arrow-up' id="up" href="#top"><span class='left-arm' id='down-left'></span><span class='right-arm' id='down-right'></span></a>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f8f8f8" fill-opacity="1"
                d="M0,192L80,192C160,192,320,192,480,213.3C640,235,800,277,960,288C1120,299,1280,277,1360,266.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
    </main>
        <!-- Footer -->
        <?php include 'footer.php';?>
        <!-- Fin Footer -->

    <!-- Fichier JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="documents/js/owl.carousel.min.js"></script>
    
    <script src="documents/js/main.js"></script>
    
    <script src="documents/js/connexion.js"></script>

</body>

</html>