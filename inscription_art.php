<?php

session_start();

//Variables nécessaire à la connexion à la base donnée

    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";

//On établit la connexion

$bdd = new PDO("mysql:host=$hostname;dbname=etang_vpt", $username, $password);

if (isset($_POST['btnInscriptionArt'])) {
    
    // On stock les variables saisies

    $mail = $_POST['mail'];

    $mail2 = $_POST['mail2'];

    $nom = $_POST['nom'];

    $prenom = $_POST['prenom'];
    
    $boutique = $_POST['boutique'];

    $adresse = $_POST['adresse'];
        
    $ville = $_POST['ville'];
    
            
    $cp = $_POST['cp'];
    
    $abonnement = $_POST['abonnement'];

    $telephone = $_POST['telephone_artisan'];

    $mdp = sha1($_POST['mdp']);

    $mdp2 = sha1($_POST['mdp2']);


    if (!empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['boutique']) and !empty($_POST['telephone_artisan']) and !empty($_POST['adresse']) and !empty($_POST['ville']) and !empty($_POST['cp'])) {

        if ($mail == $mail2) {
            //validation du mail

            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                $reqmail = $bdd->prepare("SELECT * FROM Artisan WHERE mail_artisan = ?");

                $reqmail->execute(array($mail));

                $mailexist = $reqmail->rowCount();

                if ($mailexist == 0) {

                    if ($mdp == $mdp2) {

                        $insertmbr = $bdd->prepare("INSERT INTO Artisan (nom_artisan, prenom_artisan, mail_artisan, mdp_artisan, nom_boutique, telephone_artisan, adresse, ville, code_postal, abonnement) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        $insertmbr->execute(array($nom, $prenom, $mail, $mdp, $boutique, $telephone, $adresse, $ville, $cp, $abonnement));

                        $erreur = "Compte crée avec succès !". header('Location: https://vosptitsoins.etang.velizy-mmi.o2switch.site/connexion.php');

                        exit();

                    } else {

                        $erreur = "Vos mots de passes ne correspondent pas !";

                    }

                } else {

                    $erreur = "Adresse mail déjà utilisée !";

                }

            } else {

                $erreur = "Votre adresse mail n'est pas valide !";

            }

        } else {

            $erreur = "Vos adresses mail ne correspondent pas !";

        }

    } else {

        $erreur = "Tous les champs doivent être complétés !";

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
    <title>Inscription Artisan - Vos P'tits Soins</title>

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
        <section class="section_bg_inscription">
            
                <div class="container py-5 h-100">
                    
                    <div class="row justify-content-center align-items-center h-100 rounded">
                    
                            <form method="POST" action="">
                                
                            <h1 class="titre_section">Notre <b class="gloss">P'tite</b> Inscription</h1>
                            
                            <div class="row">
                                
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Nom Artisan* :</label>

                                        <input type="text" class="form-control" placeholder="Votre nom" id="nom"

                                            name="nom" minlength="3" maxlength="30" required />
                                            
                                        <small class="small_inscription">(Votre e-mail sera votre nom d'utilisateur)</small>

                                    </div>

                                </div>
                                
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Prénom Artisan* :</label>

                                        <input type="text" class="form-control" placeholder="Votre prénom" id="prenom"

                                            name="prenom" minlength="3" maxlength="30" required />
                                            
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                            
                                    <div class="form-group">

                                        <label>Mail Professionnel* :</label>

                                        <input type="email" class="form-control" required placeholder="exemple@mail.fr" id="mail"

                                            name="mail" value="<?php if (isset($mail)) {echo $mail;} ?>" />

                                    </div>
                                
                                </div>
                                
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Confirmation du mail* :</label>

                                            <input type="email" class="form-control" required placeholder="Confirmez votre mail"

                                                id="mail2" name="mail2"

                                                value="<?php if (isset($mail2)) {echo $mail2;} ?>" />

                                    </div>
                                    
                                </div>
                                    
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label>Adresse postale (Pro.)* :</label>

                                            <input type="text" class="form-control" placeholder="Votre adresse postale"

                                                id="adresse" name="adresse" minlength="10" maxlength="70" required />

                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Ville* :</label>

                                            <input type="text" class="form-control" placeholder="Votre ville"

                                                id="ville" name="ville" minlength="1" maxlength="70" required />

                                    </div>
                                    
                                </div>
                                    
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label>Code Postal* :</label>

                                            <input type="text" class="form-control" placeholder="Votre code postal"

                                                id="cp" name="cp" minlength="1" maxlength="5" required />

                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label>Nom de la boutique* :</label>

                                            <input type="text" class="form-control" placeholder="Votre Raison Sociale"

                                                id="boutique" name="boutique" minlength="1" maxlength="50" required />

                                    </div>
                                    
                                </div>
                                    
                            </div>
                            
                            <div class="row">
                                
                                <div class="col">

                                    <div class="form-group">

                                        <label>Numéro de téléphone* :</label>

                                            <input type="tel" class="form-control"

                                                placeholder="Votre numéro de téléphone" id="telephone_artisan"

                                                name="telephone_artisan" maxlength="10" required />

                                    </div>
                                    
                                </div>
                                    
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Mot de passe* (4 caractères minimum) :</label>

                                        <input type="password" class="form-control" placeholder="Votre mot de passe"

                                            id="mdp" name="mdp" minlength="4" required />

                                    </div>
                                    
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Confirmation du mot de passe* :</label>

                                        <input class="form-control" type="password" placeholder="Confirmez votre mot de passe"

                                            id="mdp2" name="mdp2" minlength="4" required />

                                    </div>
                                    
                                </div>
                                    
                            </div>
                                    
                                    <div class="form-group">

                                        <label>Abonnement : </label>

                                        <label>Light</label>
                                        <input type="radio" class="form-check-input p-0 mx-1" 

                                            id="abonnement" name="abonnement" value="Light" checked />
                                            
                                        <label>Standard</label>
                                        <input type="radio" class="form-check-input p-0 mx-1" 

                                            id="abonnement" name="abonnement" value="Standard" />
                                        
                                        <label>Premium</label>
                                        <input type="radio" class="form-check-input p-0 mx-1" 

                                            id="abonnement" name="abonnement" value="Premium"/>

                                    </div>
                                    
                                    <?php
        
                                    if(isset($erreur)) {
        
                                       echo '<font class="text-center" color="red">'.$erreur."</font>";
        
                                    }
        
                                    ?>

                                    <p class="formulaire-texte">* Champs obligatoires</p>

                                    <input class="btn bouton_connexion" type="submit" name="btnInscriptionArt"

                                        value="S'inscrire" />

                                    <input class="btn bouton_connexion inscr" type="reset" name="btnReset" value="Réinitialiser"

                                        onclick="window.location.reload();" />

                                </form>

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

</body>

</html>