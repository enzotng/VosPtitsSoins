<?php
   // On prolonge la session
   session_start();
   if (empty($_SESSION['id_client']) && empty($_SESSION['mdp_client'])) {
       // Si inexistante ou nulle, on redirige vers le formulaire de login
       header('Location:connexion.php');
       exit();
   }
   // Fonction connexion
   function connexion() {
       $hostname = "localhost";
       $username = "etang_adminvpt";
       $password = "Quentinntm92!";
       $dbname = "etang_vpt";
       //Connexion à la base de données
       $con = mysqli_connect($hostname, $username, $password, $dbname);
       return $con;
   }
   $con=connexion();
                        
   // Si l'utilisateur appuie sur le bouton valider le paiement
                                 if (isset($_POST['quentintm'])) {
                                     $con=connexion();
                                     // L'utilisateur doit être connecté afin d'ajouter dans son panier
                                   if (empty($_SESSION['id_client']) && empty($_SESSION['mdp_client'])) {
                                       // Si inexistante ou nulle, on redirige vers le formulaire de login
                                       header('Location:connexion.php');
                                       exit();
                                   }
                                   // On stock l'id du prduit sélectionné'
                                   $id_client = $_SESSION['id_client'];
                                   $prixtotco = $_POST['prixtotco'];
                                   $prixhtco = $_POST['prixhtco'];
                                   $livraison = $_POST['radio_livraison'];
                                   $id_client=$_SESSION['id_client'];
                                   // On concatène tous les produits et les prix de la commande
                                    $inserall ="";
                                    $query = "SELECT * FROM Produit as p, Commande co WHERE co.id_produit=p.id_produit AND co.id_client=$id_client";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    //On parcours la table ligne par ligne
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                        $inserall .= $ligne['nom_produit'];
                                        $inserall .= " ";
                                        $inserall .= $ligne['prix_produit'];
                                        $inserall .= ",";
                                    }
                                    // On insère
                                   $query = "INSERT INTO Paiement (prix_total, livraison, prixht, produitxprix, id_client) VALUES ('$prixtotco', '$livraison', '$prixhtco', '$inserall', '$id_client')";
                                   mysqli_query($con, "SET NAMES 'utf8'");
                                   $result = mysqli_query($con, $query);
                                   $id_client = $_SESSION['id_client'];
                                   /*Génération d'un PDF avec FPDF*/
                                    require('fpdf.php');
                                    
                                    // Format A4
                                    $pdf = new FPDF('P','mm','A4');
                                    // Encodage euro
                                    define('EURO',chr(128));
                                    // Ajout d'une page
                                    $pdf->AddPage();
                                    
                                    /*Police*/
                                    $pdf->SetFont('Arial','B',20);
                                    
                                    /*Cell(width , height , text , border , end line , [align] )*/
                                    
                                    $pdf->Cell(71 ,10,'',0,0);
                                    // Logo
                                    $pdf->Image('documents/img/logo.png',80,12,50);
                                    // Saut de ligne
                                    $pdf->Ln(40);
                                    $pdf->Cell(59 ,10,'',0,1);
                                    
                                    $pdf->SetFont('Arial','B',15);
                                    $txt  = "Coordonnées";
                                    // Encodage des accents
                                    $txt  = utf8_decode($txt);
                                    $pdf->Cell(71 ,5,$txt,0,0);
                                    $pdf->Cell(59 ,5,'',0,0);
                                    $txt  = "Détails";
                                    $txt  = utf8_decode($txt);
                                    $pdf->Cell(59 ,5,$txt,0,1);
                                    
                                    $pdf->SetFont('Arial','',10);
                                    
                                    $pdf->Cell(130 ,5,'vosptitsoins@gmail.com',0,0);
                                    $pdf->Cell(25 ,5,'Nom du client : ',0,0);
                                    $query = "SELECT nom_client, prenom_client FROM Client WHERE id_client=$id_client";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    //On parcours la table ligne par ligne
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                        $txt=$ligne['nom_client']. " ". $ligne['prenom_client'];
                                        $txt  = utf8_decode($txt);
                                        $pdf->Cell(34 ,5,$txt,0,1);
                                    }
                                    $txt  = "Vélizy-Villacoublay, 78140";
                                    $txt  = utf8_decode($txt);
                                    $pdf->Cell(130 ,5,$txt,0,0);
                                    $pdf->Cell(25 ,5,'Date : ',0,0);
                                    $date=date('l jS \of F Y');
                                    $pdf->Cell(34 ,5,$date,0,1);
                                     
                                    $pdf->Cell(130 ,5,'',0,0);
                                    $pdf->Cell(25 ,5,'Commande : ',0,0);
                                    $id_client = $_SESSION['id_client'];
                                    $query = "SELECT MAX(id_paiement) as m FROM Paiement WHERE Paiement.id_client=$id_client";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    //On parcours la table ligne par ligne
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                        $id_p=$ligne['m'];
                                        //INT TO STR
                                        $txt = strval($id_p);
                                        $txt = 'FR-'.$txt;
                                    $pdf->Cell(34 ,5,$txt,0,1);
                                    }
                                    $pdf->Cell(50 ,10,'',0,1);
                                    
                                    $pdf->SetFont('Arial','B',10);
                                    /*Heading Of the table*/
                                    $pdf->Cell(80 ,6,'Produit',1,0,'C');
                                    $pdf->Cell(25 ,6,'Prix',1,1,'C');/*end of line*/
                                    /*Heading Of the table end*/
                                    $pdf->SetFont('Arial','',10);
                                    $query = "SELECT nom_produit, prix_produit FROM Produit as p, Commande co WHERE co.id_produit=p.id_produit AND co.id_client=$id_client";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    //On parcours la table ligne par ligne
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                            $txt=$ligne['nom_produit'];
                                            $txt  = utf8_decode($txt);
                                    		$pdf->Cell(80 ,6,$txt,1,0);
                                    		$pdf->Cell(25 ,6,$ligne['prix_produit'].EURO,1,1,'R');
                                    	}
                                    
                                    $pdf->Cell(80 ,6,'Prix Livraison',0,0);
                                    
                                    $query = "SELECT livraison FROM Paiement WHERE Paiement.id_client=$id_client AND Paiement.id_paiement=$id_p";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    //On parcours la table ligne par ligne
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                    $pdf->Cell(25 ,6,$ligne['livraison'].EURO,1,1,'R');
                                    }
                                    $pdf->Cell(80 ,6,'Prix H.T',0,0);
                                    $query = "SELECT prixht FROM Paiement WHERE Paiement.id_client=$id_client AND Paiement.id_paiement=$id_p";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                    $pdf->Cell(25 ,6,$ligne['prixht'].EURO,1,1,'R');
                                    }
                                    $pdf->Cell(80 ,6,'Prix TTC',0,0);
                                    $query = "SELECT prix_total FROM Paiement WHERE Paiement.id_client=$id_client AND Paiement.id_paiement=$id_p";
                                    mysqli_query($con, "SET NAMES 'utf8'");
                                    $result = mysqli_query($con, $query);
                                    while ($ligne = mysqli_fetch_assoc($result)) {
                                    $pdf->Cell(25 ,6,$ligne['prix_total'].EURO,1,1,'R');
                                    }
                                    $id_p2=strval($id_p);
                                    $fichier ="public/facture-".$id_p2.".pdf";
                                    $pdf->Output($fichier,'F');
                                    
                                 
                                 $id_client = $_SESSION['id_client'];
                                   $query = "DELETE FROM Commande WHERE id_client=$id_client";
                                   mysqli_query($con, "SET NAMES 'utf8'");
                                   $result = mysqli_query($con, $query);
                                   $message_ajouter1 = "Votre commande a bien été prise en compte. Elle est disponible et téléchargeable sur votre espace personnel";
                                    echo '<script type="text/javascript">window.alert("' . $message_ajouter1 . '");</script>';
                                 }
                                    // Si l'utilisateur appuie sur le bouton Supprimer le panier
                                    if (isset($_POST['supprimerpanier'])) {
                                     $con=connexion();
                                     // L'utilisateur doit être connecté afin de supprimer son panier
                                   if (empty($_SESSION['id_client']) && empty($_SESSION['mdp_client'])) {
                                       // Si inexistante ou nulle, on redirige vers le formulaire de login
                                       header('Location:connexion.php');
                                       exit();
                                   }
                                    $id_client = $_SESSION['id_client'];
                                   $query = "DELETE FROM Commande WHERE id_client=$id_client";
                                   mysqli_query($con, "SET NAMES 'utf8'");
                                   $result = mysqli_query($con, $query);
                                   $message_ajouter1 = "Panier supprimé";
                                    echo '<script type="text/javascript">window.alert("' . $message_ajouter1 . '");</script>';
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
      <title>Panier - Vos P'tits Soins</title>
      <!-- Fichier CSS -->
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
      <link rel="stylesheet" href="documents//css/owl.carousel.css">
      <link rel="stylesheet" href="documents/css/style.css">
   </head>
   <body>
      <?php include 'header2.php';?>
      <main>
         <section class="section_panier">
            <div class="list-wrapper">
            <div class="card">
               <div class="row">
                  <div class="col-lg-8 cart">
                     <div class="title">
                        <div class="row">
                           <div class="col">
                              <p style="font-weight: bold;">Panier Vos P'tits Soins</p>
                           </div>
                           <div class="col align-self-center text-end">
                              <?php
                                 $con=connexion();
                                 $id_client=$_SESSION['id_client'];
                                 // on sélectionne le nombre de produits dans le panier
                                 $query = "SELECT COUNT(Commande.id_produit) as c FROM Produit, Commande WHERE Commande.id_produit=Produit.id_produit AND Commande.id_client=$id_client";
                                 mysqli_query($con, "SET NAMES 'utf8'");
                                 $result = mysqli_query($con, $query);
                                 //On parcours la table ligne par ligne
                                 while ($ligne2 = mysqli_fetch_assoc($result)) {
                                     ?>
                              <p>Nombre d'articles : <?php echo $ligne2['c']?></p>
                              <?php }?>
                           </div>
                        </div>
                     </div>
                     <?php
                        $con=connexion();
                        $id_client=$_SESSION['id_client'];
                        $query = "SELECT * FROM Produit as p, Commande co WHERE co.id_produit=p.id_produit AND co.id_client=$id_client";
                        mysqli_query($con, "SET NAMES 'utf8'");
                        $result = mysqli_query($con, $query);
                        //On parcours la table ligne par ligne
                         
                        while ($ligne = mysqli_fetch_assoc($result)) {
                        
                                ?>
                     <div class="list-item">
                        <div class="row border-top border-bottom">
                           <div class="row main align-items-center">
                              <div class="col-2"><img class="img-fluid rounded" src="documents/img/<?php echo $ligne['img_produit_1']?>"></div>
                              <div class="col align-items-start col_nom">
                                 <div class="row col_nom"><?php echo $ligne['nom_produit']?></div>
                              </div>
                              <div class="col text-end">Prix : <?php echo $ligne['prix_produit']?> &euro;</div>
                           </div>
                        </div>
                     </div>
                     
                     
                     <?php 
                        }
                        
                        ?>
                        <div class='no-article'>
                     <p>Vous n'avez aucun article dans votre panier</p>
                     <button class="btn bouton_general mt-5" id="btn_acheter_index" aria-label="Acheter"
                                onclick="window.location.href = 'produits.php';">Accéder aux produits</button>
                     </div>
                     </br>
                     <div id="pagination-panier"></div>
                     <form class="panier_modifier" method="post" action="panier.php">
                         <div class="back-to-shop seconde"><a href="produits.php"><i class="bi bi-arrow-left"></i><span class="text-muted"> Revenir à la
                        boutique</span></a>
                     </div>
                         <input type="submit" class="btn bouton_general" id="supprimerpanier" name="supprimerpanier" value="Vider le panier">
                     </form>
                  </div>
                  <div class="col-lg-4 summary">
                     <div class="img_class">
                        <div class="row img_panier">
                           <img src="documents/img/logo.png">
                        </div>
                     </div>
                     <hr>
                     <form class="cd_livraison" method="post" action="panier.php">
                        <p>Mode de livraison</p>
                        <?php
                            // On se connecte
                           $con=connexion();
                           $standard=3.99;
                           $rapide=7.99;
                           $express=9.99;
                           $id_client=$_SESSION['id_client'];
                           // on selectionne la sum des prix de tous les produits de la commande afin d'avoir le prix total hors taxes
                           $query = "SELECT SUM(prix_produit) as s FROM Produit as p, Commande co WHERE co.id_produit=p.id_produit AND co.id_client=$id_client";
                           mysqli_query($con, "SET NAMES 'utf8'");
                           $result = mysqli_query($con, $query);
                           //On parcours la table ligne par ligne
                           while ($ligne = mysqli_fetch_assoc($result)) {
                               $prixhthl=$ligne['s'];
                           }
                           ?>
                        <div class="cd_radio_livraison">
                           <label class="label_livrason" for="radio_livraison">Livraison Standard (3.99 €)</label>
                           <input class="input_panier" type="radio" name="radio_livraison" value="3.99" id="standard" checked>
                        </div>
                        <div class="cd_radio_livraison">
                           <label for="radio_livraison">Livraison Rapide (7.99 €)</label>
                           <input class="input_panier" type="radio" name="radio_livraison" value="7.99" id="rapide">
                        </div>
                        <div class="cd_radio_livraison mb-5">
                           <label for="radio_livraison">Livraison Express (9.99 €)</label>
                           <input class="input_panier" type="radio" name="radio_livraison" value="9.99" id="express">
                        </div>
                        <div class="row text-end">
                           <p>Prix H.T : <i id="prixht"></i> €</p>
                           <p>Prix Total : <i id="prixtot"></i> €</p>
                           <input type="checkbox" class="novisible" name="prixtotco" id="prixtotco" value="" checked>
                           <input type="checkbox" class="novisible" name="prixhtco" id="prixhtco" value="" checked>
                        </div>
                        <div class="bouton_panier">
                           <input type="submit"class="btn bouton_general" name="quentintm" id="quentintm" value="Valider le panier">
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <!--Script permettant d'actualiser en temps réel le prix selon la livraison et d'envoyer cela dans la base grâce a des input cachés-->
                           <script>
                           // Si aucun élément n'est dans le panier, on enlève la pagination et on affiche un bouton permettant d'acheter un produit. On fait en sorte que le prix soit de 0
                              var panier_nb = $(".list-item").length
                              if (panier_nb<1){
                                 var prixht = 0
                                 var prixtotal = 0
                                 document.getElementById("prixht").innerHTML = prixht;
                                 document.getElementById("prixtot").innerHTML = prixtotal;
                                 $("#prixtotco").val(prixtotal);
                                 $("#prixhtco").val(prixht);
                                 $("input").attr('disabled','disabled');
                                 $("#pagination-panier").css("display","none")
                                 $(".no-article").css("display","flex")
                              }
                              else{
                                  var valeur = 3.99;
                                  const btn = document.getElementById('standard');
                                  // Si la radio livraison standard est sélectionnée
                                  btn.onclick = function(){
                                     valeur = 3.99
                                     // On stock la valeur php dans une variable js
                                      var valeur2 = <?php echo json_encode($prixhthl)?>;
                                  valeur2=Number(valeur2)
                                  var prixht = valeur+valeur2
                                  // on arrondi à deux chiffres après la virgule
                                  prixht = Math.round(prixht*100)/100;
                                  var prixtotal = prixht*1.2
                                  prixtotal = Math.round(prixtotal*100)/100;
                                  // on ecrit dans les balises correspondantes les prix
                                  document.getElementById("prixht").innerHTML = prixht;
                                  document.getElementById("prixtot").innerHTML = prixtotal;
                                  // on attribut les prix en valeur à des checkbox cachées et checked afin de pouvoir les récupérer en php
                                  $("#prixtotco").val(prixtotal);
                                  $("#prixhtco").val(prixht);
                                  // on fait disparaitre le bouton achter un produit si produit(s) il y a
                                  $(".no-article").css("display","none")
                                  }
                                  // on fait la même pour les autres radio
                                  const btn2 = document.getElementById('rapide');
                                  btn2.onclick = function(){
                                     valeur = 7.99;
                                      var valeur2 = <?php echo json_encode($prixhthl)?>;
                                  valeur2=Number(valeur2)
                                  var prixht = valeur+valeur2
                                  prixht = Math.round(prixht*100)/100;
                                  var prixtotal = prixht*1.2
                                  prixtotal = Math.round(prixtotal*100)/100;
                                  document.getElementById("prixht").innerHTML = prixht;
                                  document.getElementById("prixtot").innerHTML = prixtotal;
                                  $("#prixtotco").val(prixtotal);
                                  $("#prixhtco").val(prixht);
                                  v$(".no-article").css("display","none")
                                  }
                                  const btn3 = document.getElementById('express');
                                  btn3.onclick = function(){
                                     valeur = 9.99;
                                      var valeur2 = <?php echo json_encode($prixhthl)?>;
                                  valeur2=Number(valeur2)
                                  var prixht = valeur+valeur2
                                  prixht = Math.round(prixht*100)/100;
                                  var prixtotal = prixht*1.2
                                  prixtotal = Math.round(prixtotal*100)/100;
                                  document.getElementById("prixht").innerHTML = prixht;
                                  document.getElementById("prixtot").innerHTML = prixtotal;
                                  $("#prixtotco").val(prixtotal);
                                  $("#prixhtco").val(prixht);
                                  $(".no-article").css("display","none")
                                  }
                                  var valeur2 = <?php echo json_encode($prixhthl)?>;
                                  valeur2=Number(valeur2)
                                  var prixht = valeur+valeur2
                                  prixht = Math.round(prixht*100)/100;
                                  var prixtotal = prixht*1.2
                                  prixtotal = Math.round(prixtotal*100)/100;
                                  document.getElementById("prixht").innerHTML = prixht;
                                  document.getElementById("prixtot").innerHTML = prixtotal;
                                  $("#prixtotco").val(prixtotal);
                                  $("#prixhtco").val(prixht);
                                  $(".no-article").css("display","none")
                              }
                           </script>
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
      <script src="documents/js/pagination_panier.js"></script>
   </body>
</html>