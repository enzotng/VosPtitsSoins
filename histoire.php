<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Configuration générale -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/img" href="documents/img/logo.png">
    <title>Notre P'tite Histoire - Vos P'tits Soins</title>

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

        <section class="hero_histoire">
            <h1 data-aos="fade-up">
                Notre P'tite Histoire
            </h1>
        </section>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="transparent"><path fill="#ffffff" fill-opacity="1" d="M0,192L80,192C160,192,320,192,480,213.3C640,235,800,277,960,288C1120,299,1280,277,1360,266.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>

        <section class="section_equipe">
                    
                <div class="container rounded mb-5">
        
                    <div class="row" data-aos="fade-left" data-aos-delay="0">
                        
                        <div class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                                <h3 class="gloss-2">Notre équipe</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam consequatur voluptas laboriosam ab totam dolor suscipit magni beatae provident, aut, ut unde accusamus, eos repudiandae inventore similique aperiam rerum eum.</p>
                                <a href="equipe.php" class="btn bouton_general">Voir notre équipe</a>
                        </div>
                        
                        <div class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                            <img style="border-radius: 50px 10px 50px 10px; height: 400px;" src="documents/img/background2.png" alt="Logo">
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="container rounded mb-5">
        
                    <div class="row" data-aos="fade-right" data-aos-delay="200">
                        
                        <div class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                            <img style="border-radius: 50px 10px 50px 10px; height: 400px;" src="documents/img/background2.png" alt="Logo">
                        </div>
                        
                        <div style="text-align: right" class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                                <h3 class="gloss-2">Nos artisans</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam consequatur voluptas laboriosam ab totam dolor suscipit magni beatae provident, aut, ut unde accusamus, eos repudiandae inventore similique aperiam rerum eum.</p>
                                <div class="d-flex justify-content-end">
                                    <a href="artisan.php" class="btn bouton_general">Voir nos artisans</a>
                                </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="container rounded">
        
                    <div class="row" data-aos="fade-left" data-aos-delay="400">
                        
                        <div class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                                <h3 class="gloss-2">Vos P'tits Soins</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam consequatur voluptas laboriosam ab totam dolor suscipit magni beatae provident, aut, ut unde accusamus, eos repudiandae inventore similique aperiam rerum eum.</p>
                                <a href="equipe.php" class="btn bouton_general">Qui sommes-nous ?</a>
                        </div>
                        
                        <div class="col-md-6 d-flex justify-content-center flex-column mt-3 mb-3">
                            <img style="border-radius: 50px 10px 50px 10px; height: 400px;" src="documents/img/background2.png" alt="Logo">
                        </div>
                        
                    </div>
                    
                </div>
                
        </section>
        
        <div class="d-flex justify-content-center">
            <a href="produits.php" class="btn bouton_general">Accéder aux produits</a>
        </div>
        <! -- Back to top -->
        <a class='arrow-up' id="up" href="#top"><span class='left-arm' id='down-left'></span><span class='right-arm' id='down-right'></span></a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="white"><path fill="#f8f8f8" fill-opacity="1" d="M0,192L80,192C160,192,320,192,480,213.3C640,235,800,277,960,288C1120,299,1280,277,1360,266.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>            


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
    
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    
    <script src="documents/js/livraison.js"></script>

    <script src="documents/js/main.js"></script>

</body>

</html>