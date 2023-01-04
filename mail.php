 <?php

$to = "vosptitsoins@gmail.com"; // Email de réception
$from = "contact@etang.velizy-mmi.o2switch.site"; // Adresse email du destinataire de l'envoi, celui rattaché au domaine.

// Ne pas modifier les lignes ci-dessous

$JOUR = date("Y-m-d");  // Jour de l'envoi de l'email
$HEURE = date("H:i"); // Heure d'envoi de l'email
$name = $_POST["name"]; // Nom de la personne
$email = $_POST["email"]; // Email de la personne
$message = $_POST["message"]; // Message de la personne
$select = $_POST["select_demande"]; // Select de la personne

$Subject = "Nouveau message - Vos P'tits Soins ($JOUR $HEURE)";
$mail_Data .= " Nom : $name \n";
$mail_Data .= " Adresse mail de la personne : $email \n";
$mail_Data .= "\n Demande choisie : $select \n";
$mail_Data .= "\n Corps du message : $message \n";

$headers  = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=utf-8 \n";
$headers .= "De: $from  \n";
$headers .= "Disposition-Notification-To: $from  \n";

   // Message de Priorité haute
   // -------------------------
   $headers .= "X-Priority: 1  \n";
   $headers .= "X-MSMail-Priority: High \n";

   $CR_Mail = TRUE;

   $CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);
?>

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
    
    <body>
        <main>   
            <div id="accueil" class="section_mail">
                <div class="overlay-itro">
                </div>
                    <div class="accueil-content display-table">
                        <div class="table-cell">
                            <div class="container">
                                      <?php
                                        if ($CR_Mail === FALSE)   
                                        echo " Erreur, votre message ne s'est pas bien envoyé \n";
                                   else                      
                                        echo " Votre mail a bien été envoyé ! \n";
                                ?>
                                    <br/>
                              <button class="btn bouton_general" style="color: white !important"><a href="index.php">Revenir à l'accueil</button></a>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
    </body>
</html>