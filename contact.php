<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Configuration générale -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/img" href="documents/img/logo.png">
    <title>Contact - Vos P'tits Soins</title>

    <!-- Fichier CSS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="documents//css/owl.carousel.css">
    <link rel="stylesheet" href="documents/css/style.css">

</head>

<?php include 'header2.php';?>
<main>


<section class="section_contact mt-5">

<h1 class="titre_section">Notre <b class="gloss">P'tit</b> Contact</h1>

<div class="container rounded">
    
    <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="mt-2 mx-auto p-4">
            <div class="bg-light">
       
            <div class = "container">
        
            <form id="contact-form" role="form" method="post" action="mail.php">

            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Prénom *</label>
                            <input id="form_name" type="text" name="prenom" class="form-control" placeholder="Votre prénom" required="required" data-error="Firstname is required.">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_lastname">Nom *</label>
                            <input id="form_lastname" type="text" name="nom" class="form-control" placeholder="Votre nom" required="required" data-error="Lastname is required.">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_email">Email *</label>
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Votre email" required="required" data-error="Valid email is required.">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_need">Veuillez préciser votre demande *</label>
                            <select id="form_need" name="select_demande" class="form-control text-center" required="required" data-error="Please specify your need.">
                                <option value="" selected disabled>-- Quelle est votre question ? --<option>
                                <option >Demander une facture pour une commande</option>
                                <option >Demander le statut de la commande</option>
                                <option >Demande administrateur</option>
                                <option >Autre demande</option>
                            </select>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Ecrivez votre message ici..." rows="4" required="required" data-error="Please, leave us a message."></textarea
                                >
                            </div>

                        </div>


                    <div class="col-md-12">
                        <input type="submit" class="btn bouton_general mt-3" name="btnContact" value="Envoyer le message" >
                        <input type="reset" class="btn bouton_general mt-3" value="Réinitialiser" >
                    </div>
          
                </div>


        </div>
         </form>
        </div>
            </div>


    </div>
        <!-- /.8 -->

    </div>
    <!-- /.row-->

</div>
</div>
<! -- Back to top -->
        <a class='arrow-up' id="up" href="#top"><span class='left-arm' id='down-left'></span><span class='right-arm' id='down-right'></span></a>
</section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f8f8f8" fill-opacity="1"
                d="M0,192L80,192C160,192,320,192,480,213.3C640,235,800,277,960,288C1120,299,1280,277,1360,266.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
</main>

<?php include 'footer.php';?>

</body>

</html>