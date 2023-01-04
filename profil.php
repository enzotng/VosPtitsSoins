<?php

// On prolonge la session
session_start();

// // On teste si la variable de session existe et contient une valeur
 if (empty($_SESSION['id_client']) && empty($_SESSION['mdp_client'])) {
     // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:connexion.php');
    exit();
}

//Variables nécessaire à la connexion à la base donnée

    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";

//On établit la connexion

$db = new PDO("mysql:host=$hostname;dbname=etang_vpt", $username, $password);
$db->query('SET NAMES utf8');

// Si l'utilisateur appuie sur le bouton sauvegarder
      if (isset($_POST['sauvegarde_modif'])) {
          
        // On stock les variables saisies par l'utilisateur
        $nom_client2 = $_POST['nom_client'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $nom_client = addslashes($nom_client2);
        
        $prenom_client2 = $_POST['prenom_client'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $prenom_client = addslashes($prenom_client2);
        
        $telephone_client2 = $_POST['telephone_client'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $telephone_client = addslashes($telephone_client2);
        
        $adresse2 = $_POST['adresse'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $adresse = addslashes($adresse2);
        
        $mail_client2 = $_POST['mail_client'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $mail_client = addslashes($mail_client2);
        
        $code_postal2 = $_POST['code_postal'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $code_postal = addslashes($code_postal2);
        
        $id_client=$_SESSION['id_client'];
        $requser = $db->prepare("UPDATE Client SET prenom_client = '$prenom_client', nom_client = '$nom_client', adresse = '$adresse', code_postal = '$code_postal', telephone_client='$telephone_client', mail_client='$mail_client' WHERE id_client = $id_client");
        $requser->execute();
      }




    $id_client=$_SESSION['id_client'];
    $requser = $db->prepare("SELECT * FROM Client WHERE id_client = $id_client");

    $requser->execute();

    $userinfo = $requser->fetch();
    
    // On sélectionne les commandes du client
    $requser2 = "SELECT * FROM Paiement WHERE id_client = $id_client;";
    
    $userinfo2 = $db->query($requser2);
    

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Configuration générale -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/img" href="documents/img/logo.png">
    <title>Espace Client - Vos P'tits Soins</title>

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
    <main style="height: auto; display: flex; justify-content: center; align-items: center">

            <div class="container-xl px-4 mt-4 rounded-sm">

                <div class="row">

                    <div class="col">

                        <div class="card mb-4">
                            
                        <div class="profil_header">Détails du compte</div>

                            <div class="card2">

                                <form class="p-4" method="post" action="profil.php" enctype="multipart/form-data">

                                    <div class="row gx-3 mb-3">

                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputFirstName">Votre Prénom :</label>

                                            <input name="prenom_client"class="form-control activation" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userinfo['prenom_client']; ?>" disabled>

                                        </div>
                                        
                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputLastName">Votre Nom :</label>

                                            <input name="nom_client"class="form-control activation" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userinfo['nom_client']; ?>" disabled>

                                        </div>

                                    </div>

                                    <div class="row gx-3 mb-3">


                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputLocation">Adresse postale :</label>

                                            <input name="adresse"class="form-control activation" id="inputLocation" type="text" placeholder="San Francisco, CA" value="<?php echo $userinfo['adresse']; ?>" disabled>

                                        </div>
                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputLastName">Code Postal :</label>

                                            <input name="code_postal"class="form-control activation" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userinfo['code_postal']; ?>" disabled>

                                        </div>

                                    </div>

                                    <div class="row gx-3 mb-3">

                                    <div class="col-md-6">

                                        <label class="small mb-1" for="inputEmailAddress">Adresse mail :</label>

                                        <input name="mail_client"class="form-control activation" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $userinfo['mail_client']; ?>" disabled>

                                    </div>

                                    <div class="col-md-6">

                                            <label class="small mb-1" for="inputLastName">Numéro de téléphone (+33) :</label>

                                            <input name="telephone_client"class="form-control activation" id="inputLastName" type="tel" placeholder="Enter your last name" value="<?php echo $userinfo['telephone_client']; ?>" disabled>

                                    </div>
                                    
                                    </div>
                                    <div class="bouton_profil">
                                        <input type="submit" class="btn bouton_general mt-3" id="btn-modifier-valider-admin" value="Sauvegarder" name="sauvegarde_modif">
                                    </div>
                                </form>
                                <button class="btn bouton_general m-4" id="btn-modifier-admin" aria-label="Modifier">Modifier le profil</button>

                                <div class="profil_header2">Vos commandes</div>
                                <div class="wrap-cd-commande list-wrapper p-1">
                                <?php
                                   while($row = $userinfo2->fetch(PDO::FETCH_ASSOC)) :?>
                                       <div class="cd-commande list-item shadow">
                                       <div class="cd-commande-ligne">
                                        
                                        <p>Commande : n°<?php echo $row['id_paiement'];?></p>
                                        <div class="produit_quentintm">
                                        <hr class="hr_footer">
                                       <?php
                                       // On recupère prdouitxprix dans laquelle se trouve tous les produits et les prix associés séparés par une virgule sur une suele et même ligne
                                       $wesh = $row['produitxprix'];
                                       // On récupère tous les éléments de la chaîne séparé par une virgule et on les stock dans unn tableau
                                       $tab = explode(",",$wesh);
                                       // On parcours ce tableau et on affiche les valeurs une par une après les avoir préalablement encodées 
                                       foreach ($tab as $ligne2) {
                                           ?>
                                    <p>Produit : <?php echo htmlspecialchars($ligne2);?> €</p>
                                <?php }?>
                                </div>
                                <p>Prix Livraison : <?php echo $row['livraison'];?> €</p>
                                <p>Prix HT : <?php echo $row['prixht'];?> €</p>
                                <p>Prix Total : <?php echo $row['prix_total'];?> €</p>
                                </div>
                                    <!-- lien de téléchargement de la facture générée dans panier.php -->
                                    <a class="a_commande" href="../public/facture-<?php echo $row['id_paiement'];?>.pdf" download>Télécharger votre facture</a>
                                </div>
                                <?php endwhile; ?>
                                </div>
                                <div id="pagination-profil" class="mt-5"></div>
                                <a href="produits.php"><button class="btn bouton_general m-4" id="btn-modifier-admin" aria-label="Modifier">Accéder aux produits</button></a>
                            </div>

                        </div>

                </div>
            </div>
            </div>
            <! -- Back to top -->
        <a class='arrow-up' id="up" href="#top"><span class='left-arm' id='down-left'></span><span class='right-arm' id='down-right'></span></a>
</main>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f8f8f8" fill-opacity="1"
                d="M0,192L80,192C160,192,320,192,480,213.3C640,235,800,277,960,288C1120,299,1280,277,1360,266.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
    
    <script src="documents/js/pagination_profil.js"></script>

    <script src="documents/js/main.js"></script>

</body>

</html>