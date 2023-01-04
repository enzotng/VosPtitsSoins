<?php
   // On prolonge la session
   session_start();
   
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
                                 }
                                 // Si l'utilisateur appuie sur le bouton voir produit
                                 if (isset($_GET['voir_produit'])) {
                                     $con=connexion();
                                   // On stock l'id du prduit sélectionné'
                                   $id_produit = $_GET['id_produit_check'];
                                   //On redirige vers la fiche produite correspondonte qui sera générée en récupérant l'id du produit stocké au préalable dans l'url
                                   header("Location: fiche_produit.php?id_produit=" . $id_produit);
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
      <title>Produits - Vos P'tits Soins</title>
      
      <!-- Fichier CSS -->
      
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
      <link rel="stylesheet" href="documents/css/style.css">

   </head>
   
   <body>
      <?php include 'header.php';?>
      <main>
         <div class="tri_filtre">
            <div class="tri_phone">
               <h4>Trier</h4>
               <div class="triangle-down"></div>
            </div>
            <div class="filtre_phone">
               <h4>Filtrer</h4>
            </div>
            <div class="pop_up_filtre">
               <div class="triangle-up"></div>
               <form action="">
                  <ul>
                     <li>
                        <input type="radio" id="f-option" name="selector">
                        <label for="f-option" class="no_border">Tri 1</label>
                        <div class="check"></div>
                     </li>
                     <li>
                        <input type="radio" id="s-option" name="selector">
                        <label for="s-option">Tri 1</label>
                        <div class="check">
                           <div class="inside"></div>
                        </div>
                     </li>
                     <li>
                        <input type="radio" id="t-option" name="selector">
                        <label for="t-option">Tri 1</label>
                        <div class="check">
                           <div class="inside"></div>
                        </div>
                     </li>
                     <li>
                        <input type="radio" id="r-option" name="selector">
                        <label for="r-option">Tri 1</label>
                        <div class="check">
                           <div class="inside"></div>
                        </div>
                     </li>
                  </ul>
                  <button class="btn bouton form_pop_filtre_btn" type="submit">Appliquer</button>
               </form>
            </div>
         </div>
         <aside class="pop_up_tri">
            <div class="cd_croix_filtre">
               <p class="croix_filtre">X</p>
            </div>
            <form action="">
               <div class="titre_filtre">
                  <h4>Filtre</h4>
               </div>
               <div class="cd_liste_filtre">
                  <ul>
                     <li class="categorie1">
                        Catégorie 1
                     </li>
                     <li class="categorie2">
                        Catégorie 2
                     </li>
                     <li class="categorie3">
                        Catégorie 3
                     </li>
                     <li class="categorie4">
                        Catégorie 4
                     </li>
                  </ul>
               </div>
               <div class="space_form_filtre"></div>
               <div class="cd_button_filtre">
                  <button class="btn bouton form_pop_filtre_btn" type="submit">Appliquer les filtres</button>
               </div>
            </form>
         </aside>
         <aside class="pop_up_tri pop_up_tri1 nobackground">
            <form action="">
               <div class="titre_filtre">
                  <i style="font-size: 1.5rem" class="bi bi-arrow-left"></i>
                  <h4>Catégorie n°1</h4>
               </div>
               <div class="cd_liste_filtre">
                  <ul>
                     <li>
                        Produit n°1
                     </li>
                     <li>
                        Produit n°2
                     </li>
                     <li>
                        Produit n°3
                     </li>
                     <li>
                        Produit n°4
                     </li>
                  </ul>
               </div>
               <div class="space_form_filtre"></div>
               <div class="cd_button_filtre">
                  <button class="btn bouton form_pop_filtre_btn" type="submit">Appliquer les filtres</button>
               </div>
            </form>
         </aside>
         <aside class="pop_up_tri pop_up_tri2 nobackground">
            <form action="">
               <div class="titre_filtre">
                  <i style="font-size: 1.5rem" class="bi bi-arrow-left"></i>
                  <h4>Catégorie n°2</h4>
               </div>
               <div class="cd_liste_filtre">
                  <ul>
                     <li>
                        Produit n°1
                     </li>
                     <li>
                        Produit n°2
                     </li>
                     <li>
                        Produit n°3
                     </li>
                     <li>
                        Produit n°4
                     </li>
                  </ul>
               </div>
            </form>
         </aside>
         <div class="dark_overlay"></div>
         <div class="dark_overlay2"></div>
         <div class="dark_overlay3"></div>
         <aside class="pop_up_tri pop_up_tri3 nobackground">
            <form action="">
               <div class="titre_filtre">
                  <i style="font-size: 1.5rem" class="bi bi-arrow-left"></i>
                  <h4>Catégorie n°3</h4>
               </div>
               <div class="cd_liste_filtre">
                  <ul>
                     <li>
                        Produit n°1
                     </li>
                     <li>
                        Produit n°2
                     </li>
                     <li>
                        Produit n°3
                     </li>
                     <li>
                        Produit n°4
                     </li>
                  </ul>
               </div>
               <div class="space_form_filtre"></div>
               <div class="cd_button_filtre">
                  <button class="btn bouton form_pop_filtre_btn" type="submit">Appliquer les filtres</button>
               </div>
            </form>
         </aside>
         <aside class="pop_up_tri pop_up_tri4 nobackground">
            <form action="">
               <div class="titre_filtre">
                  <i style="font-size: 1.5rem" class="bi bi-arrow-left"></i>
                  <h4>Catégorie n°4</h4>
               </div>
               <div class="cd_liste_filtre">
                  <ul>
                     <li>
                        Produit n°1
                     </li>
                     <li>
                        Produit n°2
                     </li>
                     <li>
                        Produit n°3
                     </li>
                     <li>
                        Produit n°4
                     </li>
                  </ul>
               </div>
               <div class="space_form_filtre"></div>
               <div class="cd_button_filtre">
                  <button class="btn bouton form_pop_filtre_btn" type="submit">Appliquer les filtres</button>
               </div>
            </form>
         </aside>
         <section class="section_produits">
            <aside>
               <div class="input-group">
                  <div class="form-outline">
                     <input type="search" id="form1" placeholder="Rechercher..." class="form-control rechercher_form" />
                     <label class="form-label rechercher" for="form1">Barre de recherche</label>
                  </div>
                  <button type="button" class="btn btn-primary">
                  <i class="bi bi-search"></i>
                  </button>
               </div>
               <!-- <h4>Filtres</h4> -->
               <form action="#" method="post" class="form_filtre_produit">
                  <select class="form-select" name="tri" id="tri">
                     <option value="tri test">Trier par :</option>
                     <option value="tri test">Nouveautés</option>
                     <option value="tri test">Prix croissant</option>
                     <option value="tri test">Prix décroissant</option>
                     <option value="tri test">Les mieux notés</option>
                     <option value="tri test">Meilleures ventes</option>
                  </select>
                  <nav>
                     <ul>
                        <li class="li_filtre_first">
                           <div class="cd_arrow_line">
                              <a class='arrow-up list_arrow la1'><span class='left-arm'></span><span
                                 class='right-arm'></span></a>
                              <div class="cd_line">
                                 <h3>Cosmétiques</h3>
                              </div>
                           </div>
                           <ul class="ul_filtre_before ul1">
                              <li class="li_filtre_before">
                                 <label for="">Produit n°1</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Produit n°2</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Produit n°3</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                           </ul>
                        </li>
                        <li class="li_filtre_first">
                           <div class="cd_arrow_line">
                              <a class='arrow-up list_arrow la2'><span class='left-arm'></span><span
                                 class='right-arm'></span></a>
                              <div class="cd_line">
                                 <h3>Soins & Savons</h3>
                              </div>
                           </div>
                           <ul class="ul_filtre_before ul2">
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                           </ul>
                        </li>
                        <li class="li_filtre_first">
                           <div class="cd_arrow_line">
                              <a class='arrow-up list_arrow la3'><span class='left-arm'></span><span
                                 class='right-arm'></span></a>
                              <div class="cd_line">
                                 <h3>Hygiène</h3>
                              </div>
                           </div>
                           <ul class="ul_filtre_before ul3">
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Test</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                           </ul>
                        </li>
                        <li class="li_filtre_first">
                           <div class="cd_arrow_line">
                              <a class='arrow-up list_arrow la4'><span class='left-arm'></span><span
                                 class='right-arm'></span></a>
                              <div class="cd_line">
                                 <h3>Box Vos P'tits Soins</h3>
                              </div>
                           </div>
                           <ul class="ul_filtre_before ul4">
                              <li class="li_filtre_before">
                                 <label for="">Box Huile</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Crème</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Savon</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Makeup</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                           </ul>
                           <div class="cd_arrow_line">
                              <a class='arrow-up list_arrow la4'><span class='left-arm'></span><span
                                 class='right-arm'></span></a>
                              <div class="cd_line">
                                 <h3>Coffret Vos P'tits Soins</h3>
                              </div>
                           </div>
                           <ul class="ul_filtre_before ul4">
                              <li class="li_filtre_before">
                                 <label for="">Box Huile</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Crème</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Savon</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                              <li class="li_filtre_before">
                                 <label for="">Box Makeup</label>
                                 <input type="checkbox" class="form-check" name="">
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </nav>
                  <button class="btn bouton" type="submit">Appliquer les filtres</button>
               </form>
            </aside>
            <div class="giga_wrap">
            <div class="list-wrapper">
                <?php
                //Affichage des produits
                   $con=connexion();
                   $query = "SELECT * FROM Produit";
                   mysqli_query($con, "SET NAMES 'utf8'");
                   $result = mysqli_query($con, $query);
                   //On parcours la table ligne par ligne
                   while ($ligne = mysqli_fetch_assoc($result)) {
                           ?>
                
                   <div class="list-item">
                      <div class="column">
                         <img onmouseover="this.src='documents/img/<?php echo $ligne['img_produit_1']?>'"
                            onmouseout="this.src='documents/img/<?php echo $ligne['img_produit_2']?>'"
                            src="documents/img/<?php echo $ligne['img_produit_2']?>" id="row-pic">
                         <h6 class="titre_produit"><?php echo $ligne['nom_produit']?></h6>
                         <p><?php echo $ligne['desc_produit']?></p>
                         <p>Prix : <?php echo $ligne['prix_produit']?> €</p>
                         <div class="cd_form_ajouter_panier_voir_produit">
                             <form class="form_ajouter_panier"method="get" action="produits.php" enctype="multipart/form-data">
                                 <input type="checkbox" class="novisible" name="id_produit_check" value="<?php echo $ligne['id_produit']?>" checked>
                                <input type="submit" class="btn bouton mt-3" id="btn_ajouter_panier" value="Voir le produit" name="voir_produit">
                            </form>
                            <form class="form_ajouter_panier"method="post" action="produits.php" enctype="multipart/form-data">
                               <input type="checkbox" class="novisible" name="id_produit_check" value="<?php echo $ligne['id_produit']?>" checked>
                               <input type="submit" class="btn bouton mt-3" id="btn_ajouter_panier" value="Acheter 🛒" name="ajouter_panier">
                            </form>
                         </div>
                      </div>
                   </div>

            <?php }?>
            </div>
            <div id="pagination-container"></div>
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
      <script src="documents/js/pagination.js"></script>
      <script src="documents/js/livraison.js"></script>
      <script src="documents/js/main.js"></script>
   </body>
</html>