window.onload = function(){
    // Carousel accueil
    var slideImages = document.querySelectorAll('.slide'),
        dirRight = document.getElementById('dir-control-right'),
        dirLeft = document.getElementById('dir-control-left'),
        current = 0;
    //if javascript is on apply styling
    function jsActive() {
        for (var i = 0; i < slideImages.length; i++) {
            slideImages[i].classList.add('slider-active');
        }
    }
    // Clear images
    function reset() {
        for (var i = 0; i < slideImages.length; i++) {
            slideImages[i].classList.remove('slide-is-active');
        }
    }
    //init slider
    function startSlide() {
        reset();
        slideImages[0].classList.add('slide-is-active');
        setTimeout(function () {
            for (var i = 0; i < slideImages.length; i++) {
                slideImages[i].classList.add('slide-transition');
            }
        }, 2000);


    }

    //slide lft
    function slideLeft() {
        reset();
        slideImages[current - 1].classList.add('slide-is-active');
        current--;
    }
    //slide right
    function slideRight() {
        reset();
        slideImages[current + 1].classList.add('slide-is-active');
        current++;
    }

    dirLeft.addEventListener('click', function () {
        if (current === 0) {
            current = slideImages.length;
        }
        slideLeft();
    })

    dirRight.addEventListener('click', function () {
        if (current === slideImages.length - 1) {
            current = -1;
        }
        slideRight();
    })
    //apply styling
    jsActive();
    startSlide();

};

$(document).ready(function () {
    // Importation d'AOS pour les apparitions au scroll
    AOS.init();
    
    // Header telephone
    const toggle = document.querySelector(".toggle");
    const toggleBtn = document.querySelector(".toggle-btn");
    const menu = document.querySelector(".menu");
    const menuList = document.querySelector(".menu-list");
    const menuItems = document.querySelectorAll(".menu-item");

    let showMenu = false;


    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".dropdown-menu li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    toggle.addEventListener("click", toggleMenu);

    function toggleMenu() {
        if (!showMenu) {
            toggleBtn.classList.add("open");
            menu.classList.add("open");
            menuList.classList.add("open");
            menuItems.forEach(item => item.classList.add("open"));

            showMenu = true;
        } else {
            toggleBtn.classList.remove("open");
            menu.classList.remove("open");
            menuList.classList.remove("open");
            menuItems.forEach(item => item.classList.remove("open"));

            showMenu = false;
        }
    }
    $('.menu-link').click(function () {
        $('.menu').hide();
    });

    $('.toggle-btn').click(function () {
        $('.menu').show();
    });

    $("#status").delay(2000).fadeOut("slow"); 
    $("#preloader").delay(2000).fadeOut("slow"); 

    let summaryCollection = document.getElementsByTagName('summary');
    let signsCollection = document.getElementsByClassName('faq-open-icon');

    for (let i = 0; i < summaryCollection.length; i++) {
        summaryCollection[i].onclick = function () {
            if (signsCollection[i].innerHTML === '+') signsCollection[i].innerHTML = '—';
            else signsCollection[i].innerHTML = '+';
        }
    }
    // Filtre
    $('.la1').click(function () {
        $('.ul1').fadeToggle(100);
        $('.la1').toggleClass('arrow_filtre_after');
    });
    $('.la2').click(function () {
        $('.ul2').fadeToggle(100);
        $('.la2').toggleClass('arrow_filtre_after');
    });
    $('.la3').click(function () {
        $('.ul3').fadeToggle(100);
        $('.la3').toggleClass('arrow_filtre_after');
    });
    $('.la4').click(function () {
        $('.ul4').fadeToggle(100);
        $('.la4').toggleClass('arrow_filtre_after');
    });

    $('.tri_phone').click(function () {
        $('.pop_up_filtre').fadeToggle(100);
    });
    $('.filtre_phone').click(function () {
        $('.pop_up_tri').css('left', '0');
        $('.pop_up_tri1').css('left', '175vh');
        $('.pop_up_tri2').css('left', '175vh');
        $('.pop_up_tri3').css('left', '175vh');
        $('.pop_up_tri4').css('left', '175vh');
        $('.dark_overlay').css('bottom', '50%');
        $('.dark_overlay2').css('top', '50%');
    });
    $('.cd_croix_filtre').click(function () {
        $('.pop_up_tri').css('left', '175vh');
        $('.dark_overlay').css('bottom', '250vw');
        $('.dark_overlay2').css('top', '250vw');
    });
    $('.categorie1').click(function () {
        $('.pop_up_tri1').css('left', '8vh');
    });
    $('.categorie2').click(function () {
        $('.pop_up_tri2').css('left', '8vh');
    });
    $('.categorie3').click(function () {
        $('.pop_up_tri3').css('left', '8vh');
    });
    $('.categorie4').click(function () {
        $('.pop_up_tri4').css('left', '8vh');
    });
    $('.bi-arrow-left').click(function () {
        $('.pop_up_tri1').css('left', '175vh');
        $('.pop_up_tri2').css('left', '175vh');
        $('.pop_up_tri3').css('left', '175vh');
        $('.pop_up_tri4').css('left', '175vh');
    });
    $('.cd_liste_filtre ul li').click(function () {
        $('.cd_liste_filtre ul li').css('background-color', 'white');
        $(this).css('background-color', 'whitesmoke');
    });
    // Carousel fiche produit
    // Inter-change les images lorsque l'on click dessus 
    var bigzoo = 0;
    $('.one').click(function () {
        if (bigzoo > 0) {
            $('.one').removeClass('one');
            $(this).removeClass();
            $(this).addClass('one');
        }
    });
    $('.two').click(function () {
        bigzoo = bigzoo + 1;
        $('.one').addClass('two');
        $('.one').removeClass('one');
        $(this).addClass('one');
        $('.two').removeClass('two');
    });
    $('.three').click(function () {
        bigzoo = bigzoo + 1;
        $('.one').addClass('three');
        $('.one').removeClass('one');
        $(this).addClass('one');
        $('.three').removeClass('three');
    });
    $('.four').click(function () {
        bigzoo = bigzoo + 1;
        $('.one').addClass('four');
        $('.one').removeClass('one');
        $(this).addClass('one');
        $('.four').removeClass('four');
    });
    // Permet de rendre modifiable les informations du client ou de l'artisan
    $('#btn-modifier-admin').click(function () {
        $('.activation')[0].disabled = false;
        $('.activation')[1].disabled = false;
        $('.activation')[2].disabled = false;
        $('.activation')[3].disabled = false;
        $('.activation')[4].disabled = false;
        $('.activation')[5].disabled = false;
        $('#btn-modifier-valider-admin').css("display","block");
        $('#btn-modifier-admin').css("display","none");
    });
    $('#btn-valider-modifier-admin').click(function () {
        $('.activation')[0].disabled = true;
        $('.activation')[1].disabled = true;
        $('.activation')[2].disabled = true;
        $('.activation')[3].disabled = true;
        $('.activation')[4].disabled = true;
        $('.activation')[5].disabled = true;
        $('#btn-modifier-admin').css("display","block");
        $('#btn-modifier-valider-admin').css("display","none");
    });
    // Dashboard (ne fonctionne pas)
    $('.accueilli').click(function () {
        $('.accueilli').css('background-color', 'var(--vert-color)');
        $('.vosproduits').css('background-color', 'none');
        $('.addproduit').css('background-color', 'none');
        $('.statartisan').css('background-color', 'none');
        $('.cd_info_artisan').css('display', 'block');
        $('.add_art_form').css('display', 'none');
        $('.ptitprdotitle').css('display', 'none');
        $('.cd_produit_admin').css('display', 'none');
    });
    $('.vosproduits').click(function () {
        $('.vosproduits').css('background-color', 'var(--vert-color)');
        $('.accueilli').css('background-color', 'none');
        $('.addproduit').css('background-color', 'none');
        $('.statartisan').css('background-color', 'none');
        $('.cd_info_artisan').css('display', 'none');
        $('.add_art_form').css('display', 'none');
        $('.ptitprdotitle').css('display', 'block');
        $('.cd_produit_admin').css('display', 'block');
    });
    $('.addproduit').click(function () {
        $('.addproduit').css('background-color', 'var(--vert-color)');
        $('.accueilli').css('background-color', 'none');
        $('.vosproduits').css('background-color', 'none');
        $('.statartisan').css('background-color', 'none');
        $('.cd_info_artisan').css('display', 'none');
        $('.add_art_form').css('display', 'block');
        $('.ptitprdotitle').css('display', 'none');
        $('.cd_produit_admin').css('display', 'none');
    });
    $('.statartisan').click(function () {
        $('.statartisan').css('background-color', 'var(--vert-color)');
        $('.accueilli').css('background-color', 'none');
        $('.vosproduits').css('background-color', 'none');
        $('.addproduit').css('background-color', 'none');
    });
    
    
    // Lors du click de la pagination, on effectue une animation qui va faire un back to top

        $('#pagination-container').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return true;
    });
    
    // Carousel Box Accueil

    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 4,
        margin: 20,
        // nav: true,
        stagePadding: 100,
        mouseDrag: true,
        touchDrag: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 4000,
        // navSpeed: 700,
        // navText: ["<a class='arrow-up' id='left'><span class='left-arm'></span><span class='right-arm'></span></a>", "<a class='arrow-up' id='right'><span class='left-arm'></span><span class='right-arm'></span></a>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            300: {
                items: 1,
                stagePadding: 0,
            },
            400: {
                items: 1,
            },
            600: {
                items: 2,
            },
            800: {
                items: 3,
            },
            1000: {
                items: 4,
            }
        }
    })

});