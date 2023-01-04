<?php
/*// On prolonge la session
session_start();

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:login.php');
    exit();
}
*/
function connexion() {
    $hostname = "localhost";
    $username = "etang_adminvpt";
    $password = "Quentinntm92!";
    $dbname = "etang_vpt";
    //Connexion à la base de données
    $con = mysqli_connect($hostname, $username, $password, $dbname);
    return $con;
}
// Si l'utilisateur appuie sur le bouton ajouter au panier
                                 if (isset($_POST['ajouter_panier'])) {
                                     $con=connexion();
                                     // L'utilisateur doit être connecté afin d'ajouter dans son panier
                                   if (empty($_SESSION['id_client']) && empty($_SESSION['mdp_client'])) {
                                       // Si inexistante ou nulle, on redirige vers le formulaire de login
                                       header('Location:connexion.php');
                                       exit();
                                   }
                                   // On stock l'id du prduit sélectionné'
                                   $id_produit = $_POST['id_produit_check'];
                                   $id_client = $_SESSION['id_client'];
                                   $query = "INSERT INTO Commande (id_paiement, id_produit, id_client) VALUES ('1', '$id_produit', '$id_client')";
                                   mysqli_query($con, "SET NAMES 'utf8'");
                                   $result = mysqli_query($con, $query);
                                   header('Location:panier.php');
                                    exit();
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
    <title>Du soins près de chez vous - Vos P'tits Soins</title>

    <!-- Fichier CSS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="documents/css/style.css">

</head>
<body>
    <?php include 'header2.php';?>
    <main class="cd_fiche_produit">
        <section class="fiche_produit">
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <?php
                    $con=connexion();
                        $url = $_SERVER['REQUEST_URI']; 
                        $a=explode("id_produit=", $url);
                        $b=$a[1];
                        $query = "SELECT * FROM Produit WHERE id_produit=$b";
                    mysqli_query($con, "SET NAMES 'utf8'");
                    $result = mysqli_query($con, $query);
                    //On parcours la table ligne par ligne
                    while ($ligne = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="carousel-item active">
                        <img src="documents/img/<?php echo $ligne['img_produit_1']?>" alt="<?php echo $ligne['nom_produit']?>" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="documents/img/<?php echo $ligne['img_produit_2']?>" alt="<?php echo $ligne['nom_produit']?>" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="documents/img/<?php echo $ligne['img_produit_3']?>" alt="<?php echo $ligne['nom_produit']?>" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="documents/img/<?php echo $ligne['img_produit_4']?>" alt="<?php echo $ligne['nom_produit']?>" class="d-block w-100">
                    </div>
                    <?php }?>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            <div class="img_produit">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="produits.php">Produits</a></li>
                        <?php
                        $con=connexion();
                        $url = $_SERVER['REQUEST_URI']; 
                        $a=explode("id_produit=", $url);
                        $b=$a[1];
                        $query = "SELECT * FROM Produit WHERE id_produit=$b";
                        mysqli_query($con, "SET NAMES 'utf8'");
                        $result = mysqli_query($con, $query);
                        //On parcours la table ligne par ligne
                        while ($ligne = mysqli_fetch_assoc($result)) {?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $ligne['nom_produit']?></li>
                        <?php }?>
                    </ol>
                </nav>
                <div class="grid_image_produit">
                    <?php
                    $con=connexion();
                    $url = $_SERVER['REQUEST_URI']; 
                    $a=explode("id_produit=", $url);
                    $b=$a[1];
                    $query = "SELECT * FROM Produit WHERE id_produit=$b";
                    mysqli_query($con, "SET NAMES 'utf8'");
                    $result = mysqli_query($con, $query);
                    //On parcours la table ligne par ligne
                    while ($ligne = mysqli_fetch_assoc($result)) {
                ?>
                    <img src="documents/img/<?php echo $ligne['img_produit_1']?>" class="one">
                    <img src="documents/img/<?php echo $ligne['img_produit_2']?>" class="two">
                    <img src="documents/img/<?php echo $ligne['img_produit_3']?>" class="three">
                    <img src="documents/img/<?php echo $ligne['img_produit_4']?>" class="four">
                    
                </div>
            </div>
            <div class="des_produit">
                <div class="cd_titre_produit">
                    <h2><?php echo $ligne['nom_produit']?></h2>
                    <h3>Prix : <?php echo $ligne['prix_produit']?>€</h3>
                </div>
                <hr>
                <p class="text-justify"><?php echo $ligne['desc_produit']?></p>
                    <?php }?>
                    <div class="d-flex justify-content-end">
                <?php
                   $con=connexion();
                    $url = $_SERVER['REQUEST_URI']; 
                    $a=explode("id_produit=", $url);
                    $b=$a[1];
                    $query = "SELECT * FROM Produit WHERE id_produit=$b";
                    mysqli_query($con, "SET NAMES 'utf8'");
                    $result = mysqli_query($con, $query);
                    //On parcours la table ligne par ligne
                    while ($ligne = mysqli_fetch_assoc($result)) {
                           ?>
                            <form class="form_ajouter_panier"method="post" action="produits.php" enctype="multipart/form-data">
                               <input type="checkbox" class="novisible" name="id_produit_check" value="<?php echo $ligne['id_produit']?>" checked>
                               <input type="submit" class="btn bouton mt-3" id="btn_ajouter_panier" value="Acheter 🛒" name="ajouter_panier">
                            </form>
            <?php }?>
                </div>
        </section>
        <hr class="hr_general hr_bigzoo">
        <section class="section-products taille_bigzoo">
            <h3 class="titre_suggestion">Nos <b class="gloss">P'tites</b> Suggestions</h3>
            <div class="container">
                <div class="row">
                    <?php
                    $con=connexion();
                    $query = "SELECT * FROM Produit WHERE id_produit=2";
                    mysqli_query($con, "SET NAMES 'utf8'");
                    $result = mysqli_query($con, $query);
                    //On parcours la table ligne par ligne
                    while ($ligne = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1">
                                <span class="discount">15 % Réduction</span>
                                <ul>
                                    <li><a href="#"><i class="bi bi-cart"></i></a></li>
                                    <li><a href="#"><i class="bi bi-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $ligne['nom_produit']?></h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit [...]</p>
                                <h4 class="product-old-price"><?php echo $ligne['prix_produit']?>€</h4>
                                <h4 class="product-price">7,65€</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1">
                                <span class="discount">15 % Réduction</span>
                                <ul>
                                    <li><a href="#"><i class="bi bi-cart"></i></a></li>
                                    <li><a href="#"><i class="bi bi-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $ligne['nom_produit']?></h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit [...]</p>
                                <h4 class="product-old-price"><?php echo $ligne['prix_produit']?>€</h4>
                                <h4 class="product-price">7,65€</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1">
                                <span class="discount">15 % Réduction</span>
                                <ul>
                                    <li><a href="#"><i class="bi bi-cart"></i></a></li>
                                    <li><a href="#"><i class="bi bi-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $ligne['nom_produit']?></h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit [...]</p>
                                <h4 class="product-old-price"><?php echo $ligne['prix_produit']?>€</h4>
                                <h4 class="product-price">7,65€</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1">
                                <span class="discount">15 % Réduction</span>
                                <ul>
                                    <li><a href="#"><i class="bi bi-cart"></i></a></li>
                                    <li><a href="#"><i class="bi bi-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $ligne['nom_produit']?></h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit [...]</p>
                                <h4 class="product-old-price"><?php echo $ligne['prix_produit']?>€</h4>
                                <h4 class="product-price">7,65€</h4>
                            </div>
                        </div>
                    </div>
                    <?php }?>
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

    <script src="documents/js/main.js"></script>

</body>

</html>