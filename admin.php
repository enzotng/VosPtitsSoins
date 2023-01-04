<?php
// On prolonge la session
session_start();

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['id_artisan']) && empty($_SESSION['mdp_artisan'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:connexion.php');
    exit();
}
// fonction permettant de se connecter à la base
function connexion()
{
    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";
    $dbname = "etang_vpt";
    //Connexion à la base de données
    $con = mysqli_connect($hostname, $username, $password, $dbname);
    return $con;
}

// Si l'utilisateur appuie sur le bouton ajouter
if (isset($_POST['valider_ajouter'])) {
    // On se connecte à la base
    $con = connexion();
    // On récupère les données saisies par l'utilisateur
    $nom_produit2 = $_POST['nom_produit'];
    // On fait en sorte que les apostrophes, guillemets, slash et anti-slash soient acceptés
    $nom_produit = addslashes($nom_produit2);
    $description2 = $_POST['description'];
    // On fait en sorte que les apostrophes, guillemets, slash et anti-slash soient acceptés
    $description = addslashes($description2);
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $id_art = $_SESSION['id_artisan'];

    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['image_produit_1']) && $_FILES['image_produit_1']['error'] == 0) {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image_produit_1']['size'] <= 1000000) {
            // Testons si l'extension est autorisée
            $fileInfo = pathinfo($_FILES['image_produit_1']['name']);
            $extension = $fileInfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($extension, $allowedExtensions)) {
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['image_produit_1']['tmp_name'], 'documents/img/' . basename($_FILES['image_produit_1']['name']));
                $image1 = $_FILES['image_produit_1']['name'];
            }
            // On fait la même chose pour toutes les images
            if (isset($_FILES['image_produit_2']) && $_FILES['image_produit_2']['error'] == 0) {
                if ($_FILES['image_produit_2']['size'] <= 1000000) {
                    $fileInfo2 = pathinfo($_FILES['image_produit_2']['name']);
                    $extension2 = $fileInfo['extension'];
                    $allowedExtensions2 = ['jpg', 'jpeg', 'gif', 'png'];
                    if (in_array($extension2, $allowedExtensions2)) {
                        move_uploaded_file($_FILES['image_produit_2']['tmp_name'], 'documents/img/' . basename($_FILES['image_produit_2']['name']));
                        $image2 = $_FILES['image_produit_2']['name'];
                    }

                    if (isset($_FILES['image_produit_3']) && $_FILES['image_produit_3']['error'] == 0) {
                        if ($_FILES['image_produit_3']['size'] <= 1000000) {
                            $fileInfo3 = pathinfo($_FILES['image_produit_2']['name']);
                            $extension3 = $fileInfo['extension'];
                            $allowedExtensions3 = ['jpg', 'jpeg', 'gif', 'png'];
                            if (in_array($extension3, $allowedExtensions3)) {
                                move_uploaded_file($_FILES['image_produit_3']['tmp_name'], 'documents/img/' . basename($_FILES['image_produit_3']['name']));
                                $image3 = $_FILES['image_produit_3']['name'];
                            }

                            if (isset($_FILES['image_produit_4']) && $_FILES['image_produit_4']['error'] == 0) {
                                if ($_FILES['image_produit_4']['size'] <= 1000000) {
                                    $fileInfo4 = pathinfo($_FILES['image_produit_4']['name']);
                                    $extension4 = $fileInfo['extension'];
                                    $allowedExtensions4 = ['jpg', 'jpeg', 'gif', 'png'];
                                    if (in_array($extension4, $allowedExtensions4)) {
                                        move_uploaded_file($_FILES['image_produit_4']['tmp_name'], 'documents/img/' . basename($_FILES['image_produit_4']['name']));
                                        $image4 = $_FILES['image_produit_4']['name'];


                                        $query = "INSERT INTO Produit (nom_produit, desc_produit, prix_produit, stock_produit, img_produit_1, img_produit_2, img_produit_3, img_produit_4, id_artisan) VALUES ('$nom_produit', '$description', '$prix', '$stock', '$image1', '$image2', '$image3', '$image4', '$id_art')";
                                        mysqli_query($con, "SET NAMES 'utf8'");
                                        $result = mysqli_query($con, $query);
                                        $message_ajouter5 = "Votre produit a bien été ajouté !";
                                        echo '<script type="text/javascript">window.alert("' . $message_ajouter5 . '");</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $message_ajouter3 = "C'est moi ou vous avez essayé d'envoyer autre chose qu'une image ? Pour rappel les extensions autorisées sont jpg, jpg, gif et png";
                echo '<script type="text/javascript">window.alert("' . $message_ajouter3 . '");</script>';
            }
        } else {
            $message_ajouter2 = "Votre fichier est bien trop lourd, je ne peux accepter un tel présent. Veuillez choisir un fichier moins lourd !";
            echo '<script type="text/javascript">window.alert("' . $message_ajouter2 . '");</script>';
        }
    } else {
        $message_ajouter1 = "Vous n'avez même pas upload de fichier, faite un effort !";
        echo '<script type="text/javascript">window.alert("' . $message_ajouter1 . '");</script>';
    }
}
// Si l'utilisateur appuie sur le bouton supprimer
if (isset($_POST['valider_supprimer'])) {
    // On teste si une checkbox à été sélectionné
    if (isset($_POST['check'])) {
        // On se connecte à la base
        $con = connexion();
        // On parcours les valeurs des checkbox (après avoir donné en nom un tableau à la checkbox)
        foreach ($_POST['check'] as $value) {
            // requete SQL pour supprimer les terrain dont la value est égal à leur id
            $query = "DELETE FROM Produit WHERE id_produit=$value";
            // On encode pour que les accents soient acceptés
            mysqli_query($con, "SET NAMES 'utf8'");
            // On exécute la requête
            $result = mysqli_query($con, $query);
        }
    }
    // Si aucune checkbox est cochées on envoie une alerte javascript informant qu'aucune checkbox n'a été cochée
    else {
        $message_supprimer = "Erreur, aucun élément n'a été supprimé ! Veuillez sélectionner au moins une case.";
        echo '<script type="text/javascript">window.alert("' . $message_supprimer . '");</script>';
    }
}
//Variables nécessaire à la connexion à la base donnée

    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";

//On établit la connexion

$db = new PDO("mysql:host=$hostname;dbname=etang_vpt", $username, $password);

// Si l'utilisateur appuie sur le bouton sauvegarder
      if (isset($_POST['sauvegarde_modif'])) {
          
        // On stock les variables saisies par l'utilisateur
        $nom_artisan2 = $_POST['nom_artisan'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $nom_artisan = addslashes($nom_artisan2);
        
        $prenom_artisan2 = $_POST['prenom_artisan'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $prenom_artisan = addslashes($prenom_artisan2);
        
        $telephone_artisan2 = $_POST['telephone_artisan'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $telephone_artisan = addslashes($telephone_artisan2);
        
        $adresse2 = $_POST['adresse'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $adresse = addslashes($adresse2);
        
        $mail_client2 = $_POST['mail_client'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $mail_client = addslashes($mail_client2);
        
        $code_postal2 = $_POST['code_postal'];
        // On fait en sorte que les apostrophes, guillemts, slash et anti-slash soient acceptés
        $code_postal = addslashes($code_postal2);
        
        $id_artisan=$_SESSION['id_artisan'];
        $requser = $db->prepare("UPDATE Artisan SET prenom_artisan = '$prenom_artisan', nom_artisan = '$nom_artisan', adresse = '$adresse', code_postal = '$code_postal', telephone_client='$telephone_artisan', mail_client='$mail_artisan' WHERE id_artisan = $id_artisan");
        $requser->execute();
      }




    $id_artisan=$_SESSION['id_artisan'];
    // On Sélectionne les données de l'artisan connecté
    $requser = $db->prepare("SELECT * FROM Artisan WHERE id_artisan = $id_artisan");

    $requser->execute();

    $userinfo = $requser->fetch();

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Configuration générale -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/img" href="documents/img/logo.png">
    <title>Espace Artisan - Vos P'tits Soins</title>

    <!-- Fichier CSS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    <link rel="stylesheet" href="documents//css/owl.carousel.css">
    <link rel="stylesheet" href="documents/css/style.css">

</head>


<body>

    <main>
        <!--<div class="area"></div>-->

        <nav class="main-menu">
            <ul>
                <li class="accueilli">
                    <a href="index.php">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Accueil
                        </span>
                    </a>

                </li>
                <li class="has-subnav vosproduits">
                    <a href="#">
                        <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            Vos P'tits Produits
                        </span>
                    </a>

                </li>
                <li class="has-subnav addproduit">
                    <a href="#">
                        <i class="fa fa-book fa-2x"></i>
                        <span class="nav-text">
                            Ajouter un P'tit Produit
                        </span>
                    </a>
                </li>
                <li class="statartisan">
                    <a href="#">
                        <i class="fa fa-chart-line fa-2x"></i>
                        <span class="nav-text">
                            Statistiques du mois
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                    <a href="contact.php">
                        <i class="fa fa-message fa-2x"></i>
                        <span class="nav-text">
                            Contacter admin
                        </span>
                    </a>
                </li>
                <li>
                    <a href="deconnexion.php">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Se déconnecter
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="dashboard">
            <img class="mt-5" src="documents/img/logo.png" alt="Logo Vos P'tits Soins">
            <form class="add_art_form" method="post" action="admin.php" enctype="multipart/form-data">
                <h1 class="addprodtitle pb-5">Ajouter un produit</h1>
                <div class="cd_input">
                    <input type="text" placeholder="Nom du produit" name="nom_produit" id="nom_produit" maxlength="50" required aria-required="true">
                    <label for="nom_produit">Nom du produit</label>
                </div>
                <div class="cd_input">
                    <input type="text" placeholder="Description" name="description" id="description" minlength="20" maxlength="255" required aria-required="true">
                    <label for="description">Description du produit</label>
                </div>
                <div class="cd_input">
                    <input type="text" placeholder="Prix" name="prix" id="prix" required aria-required="true">
                    <label for="prix">Prix du produit (€)</label>
                </div>
                <div class="cd_input">
                    <input type="text" placeholder="Stock" name="stock" id="stock" required aria-required="true">
                    <label for="prix">Stock produit</label>
                </div>
                <label for="image_produit_1">Image produit n°1 :</label>
                <input type="file" class="form-control" placeholder="Image 1" name="image_produit_1" id="image_produit_1" required aria-required="true">
                <label for="image_produit_2">Image produit n°2 :</label>
                <input type="file" class="form-control" placeholder="Image 2" name="image_produit_2" id="image_produit_2" required aria-required="true">
                <label for="image_produit_3">Image produit n°3 :</label>
                <input type="file" class="form-control" placeholder="Image 3" name="image_produit_3" id="image_produit_3" required aria-required="true">
                <label for="image_produit_4">Image produit n°4 :</label>
                <input type="file" class="form-control" placeholder="Image 4" name="image_produit_4" id="image_produit_4" required aria-required="true">
                <br>
                <input type="submit" class="btn bouton_general mt-3" id="btnAjouter" name="valider_ajouter" value="Ajouter le produit">
            </form>

            <h1 class="titre_section ptitprdotitle">Vos <b class="gloss">P'tits</b> Produits</h1>

            <form class="cd_produit_admin" method="post" action="admin.php" enctype="multipart/form-data">
                <div class="wrap_produit_admin">
                    <?php
                    $con = connexion();
                    $id_art = $_SESSION['id_artisan'];
                    // On sélectionne les produits de l'artisan
                    $query = "SELECT * FROM Produit WHERE id_artisan=$id_art";
                    mysqli_query($con, "SET NAMES 'utf8'");
                    $result = mysqli_query($con, $query);
                    while ($ligne = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="column">
                            <img onmouseover="this.src='documents/img/<?php echo $ligne['img_produit_1'] ?>'" onmouseout="this.src='documents/img/<?php echo $ligne['img_produit_2'] ?>'" src="documents/img/<?php echo $ligne['img_produit_2'] ?>" id="row-pic">
                            <h6 class="titre_produit"><?php echo $ligne['nom_produit'] ?></h6>
                            <p><?php echo $ligne['desc_produit'] ?></p>
                            <p>Prix : <?php echo $ligne['prix_produit'] ?> €</p>
                            <button class="btn bouton" type="submit">Modifier le produit</button>
                            <!-- Important de donner un tableau en nom à la checkbox afin de pouvoir en parcouir les valeurs et de pouvoir supprimer le produit associer à l'id de la checkbox dans sa valeur -->
                            <input type="checkbox" name="check[]" value="<?php echo $ligne['id_produit']; ?>" /><br>
                        </div>
                    <?php } ?>
                </div>
                <input type="submit" class="btn bouton_connexion mt-3" id="btnModifier" value="Supprimer" name="valider_supprimer">
            </form>
        </section>

    <div class="container-xl px-4 mt-4 rounded-sm cd_info_artisan">
        <h1 style="font-weight: bold" class="donneesmgl">Vos Données Personnelles</h1>

                <div class="row">

                    <div class="col">

                        <div class="card mb-4">

                            <div class="card-header">Détails du compte</div>

                            <div class="card2">

                                <form class="p-4" method="post" action="admin.php" enctype="multipart/form-data">

                                    <div class="row gx-3 mb-3">

                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputFirstName">Votre Prénom :</label>

                                            <input name="prenom_artisan"class="form-control activation" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userinfo['prenom_artisan']; ?>" disabled>

                                        </div>
                                        
                                        <div class="col-md-6">

                                            <label class="small mb-1" for="inputLastName">Votre Nom :</label>

                                            <input name="nom_artisan"class="form-control activation" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userinfo['nom_artisan']; ?>" disabled>

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

                                        <input name="mail_artisan"class="form-control activation" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $userinfo['mail_artisan']; ?>" disabled>

                                    </div>

                                    <div class="col-md-6">

                                            <label class="small mb-1" for="inputLastName">Numéro de téléphone (+33) :</label>

                                            <input name="telephone_artisan"class="form-control activation" id="inputLastName" type="tel" placeholder="Enter your last name" value="<?php echo $userinfo['telephone_artisan']; ?>" disabled>

                                    </div>
                                    
                                    <div class="col-md-12">
                                            <p class="small mb-1">Abonnement :</p>

                                            <p><?php echo $userinfo['abonnement'];?></p>
                                    </div>
                                    
                                    </div>
                                    <div class="bouton_profil">
                                        <input type="submit" class="btn bouton_general m-4" id="btn-modifier-valider-admin" value="Sauvegarder" name="sauvegarde_modif">
                                    </div>
                                </form>
                                <button class="btn bouton_general m-4" id="btn-modifier-admin" aria-label="Modifier">Modifier le profil</button>
                            </div>
    

                        </div>

                    </div>

                </div>

            </div>
            <! -- Back to top -->
        <a class='arrow-up' id="up" href="#top"><span class='left-arm' id='down-left'></span><span class='right-arm' id='down-right'></span></a>
    </main>
    
    <!-- Footer -->
    <footer class="footer-container">
        <hr class="hr_footer">
        <h3 class="footer-copyright">
            Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>
            Vos P'tits Soins. All Rights Reserved.
        </h3>
    </footer>
    <!-- Fin Footer -->

    <!-- Fichier JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="documents/js/owl.carousel.min.js"></script>

    <script src="documents/js/main.js"></script>

</body>

</html>