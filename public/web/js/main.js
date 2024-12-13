(function ($) {
    'use strict';

    // Menu JS
    /*==============================================================*/
    $('.navbar-area .navbar-nav li a, .main-banner .ca3-scroll-down-link, .about-text .btn').on('click', function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 50
        }, 50);
        e.preventDefault();
    });

    $(document).on('click', '.navbar-collapse.in', function (e) {
        if ($(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle') {
            $(this).collapse('hide');
        }
    });

    // Animation Text
    /*==============================================================*/
    // var TxtType = function(el, toRotate, period) {
    //     this.toRotate = toRotate;
    //     this.el = el;
    //     this.loopNum = 0;
    //     this.period = parseInt(period, 10) || 2000;
    //     this.txt = '';
    //     this.tick();
    //     this.isDeleting = false;
    // };
    // TxtType.prototype.tick = function() {
    //     var i = this.loopNum % this.toRotate.length;
    //     var fullTxt = this.toRotate[i];
    //     if (this.isDeleting) {
    //         this.txt = fullTxt.substring(0, this.txt.length - 1);
    //     } else {
    //         this.txt = fullTxt.substring(0, this.txt.length + 1);
    //     }
    //     this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
    //     var that = this;
    //     var delta = 200 - Math.random() * 100;
    //     if (this.isDeleting) { delta /= 2; }
    //     if (!this.isDeleting && this.txt === fullTxt) {
    //         delta = this.period;
    //         this.isDeleting = true;
    //     } else if (this.isDeleting && this.txt === '') {
    //         this.isDeleting = false;
    //         this.loopNum++;
    //         delta = 500;
    //     }
    //     setTimeout(function() {
    //         that.tick();
    //     }, delta);
    // };

    // window.onload = function() {
    //     var elements = document.getElementsByClassName('typewrite');
    //     for (var i=0; i<elements.length; i++) {
    //         var toRotate = elements[i].getAttribute('data-type');
    //         var period = elements[i].getAttribute('data-period');
    //         if (toRotate) {
    //             new TxtType(elements[i], JSON.parse(toRotate), period);
    //         }
    //     }
    //     // INJECT CSS
    //     var css = document.createElement("style");
    //     css.type = "text/css";
    //     css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    //     document.body.appendChild(css);
    // };

    // Header Sticky

    // $.ajax({
    //     async: true,
    //     type: "POST",
    //     dataType: "json",
    //     url: "./api/txtbanner/",  // Ajusta esta URL si es necesario
    //     data: [],
    //     contentType: "application/json; charset=utf-8",
    //     processData: false,
    // })
    //     .done(function (Response) {
    //         //do something when get response

    //         console.log('txtbanner',Response);
    //     })
    //     .fail(function (Response) {
    //         //do something when any error occurs.
    //         // showAlert("danger", Response.error);
    //         console.error('txtbanner',Response);
    //     });

    // new TypeIt('.animated-text', {
    //     speed: 65,
    //     loop: true
    // })
    //     .type("Hola! Soy Matias Aguirre, Desarrollador Web.", { delay: 500 })
    //     .move(1, { delay: 500 })
    //     .delete(70, { pause: 500 })
    //     .type("Developer. ", { delay: 750 })
    //     .delete(15, { pause: 750 })
    //     .type("BackEnd. ", { delay: 750 })
    //     .delete(10, { pause: 750 })
    //     .type("FrontEnd. ", { delay: 750 })
    //     .delete(10, { pause: 750 })
    //     .type("Full-Stack. ", { delay: 750 })
    //     .delete(60, { pause: 750 })
    //     .move(null, { to: 'end' })
    //     .move(null, { speed: 30, to: 'start', instant: true })
    //     .type("Bienvenido</em>", { delay: 750 })
    //     .delete(1, { delay: 750 })
    //     .type("a", { delay: 750 })
    //     .delete(1, { delay: 750 })
    //     .type('os.', { delay: 750 })
    //     .move(null, { delay: 500, to: 'end', instant: true })
    //     .go();

    /*==============================================================*/

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url: "./api/txtbanner/?activo=1",  // Ajusta esta URL si es necesario
        contentType: "application/json; charset=utf-8",
        processData: false,
    })
        .done(function (response) {
            //do something when get response
            console.log('txtbanner', response);

            // Extraer los textos de la respuesta
            // Aquí vamos a usar los datos obtenidos de la API para inicializar TypeIt
            let texts = response.map(item => item.txtBanner);
            // Inicializar TypeIt con los textos obtenidos

            let instance = new TypeIt('.animated-text', {
                speed: 25,
                loop: true
            });
            // Agregar cada texto a la animación
            response.forEach((item, index) => {
                console.log("INDEX: ", index);
                if (item.cambio1 && item.cambio2) {
                    console.log("AQUI ESTAMOS EN LA CUARTA: ", index);

                    let cantotal = item.texto.length - parseInt(item.delete1) + item.cambio2.length;
                    // cantotal es la cantidad de caracteres despues de la resta y suma de los caracteres de cambio 1 y cambio 2

                    instance = instance.type(item.texto, { delay: 750 })
                        .delete(parseInt(item.delete1), { delay: 750 })
                        .type(item.cambio1, { delay: 750 })
                        .delete(item.cambio1.length, { delay: 750 })
                        .type( item.cambio2, { delay: 750 })
                        .pause(500)
                        .delete(cantotal, { delay: 750 });

                } else {
                    instance = instance.type(item.texto, { delay: 750 })
                        .pause(500)
                        .delete(item.texto.length, { delay: 750 });
                }
            });
            // Iniciar la animación
            instance.go();
        })
        .fail(function (response) {
            //do something when any error occurs.
            console.error('txtbanner', response);
        });

    /*==============================================================*/

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 70) {
            $('.header-sticky').addClass("is-sticky");
        }
        else {
            $('.header-sticky').removeClass("is-sticky");
        }
    });

    // Shorting
    /*==============================================================*/
    try {
        var mixer = mixitup('.shorting', {
            controls: {
                toggleDefault: 'none'
            }
        });
    } catch (err) { }

    /* Services Slider
    ========================================================*/
    $(".services-slider").owlCarousel({
        nav: false,
        dots: true,
        center: false,
        touchDrag: false,
        mouseDrag: true,
        margin: 30,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 750,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /* Zoom Portfolio
    ========================================================*/
    $('.zoom-portfolio').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* Testimonial Slider
    ========================================================*/
    $(".testimonial-slider").owlCarousel({
        nav: false,
        dots: true,
        center: false,
        margin: 30,
        touchDrag: false,
        mouseDrag: true,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 750,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 2,
            }
        }
    });

    /* Ripple Effect
    ========================================================*/
    $('.ripple-effect, .ripple-playing').ripples({
        resolution: 512,
        dropRadius: 25,
        perturbance: 0.04,
    });

    /* Blog Slider
    ========================================================*/
    $(".blog-slider").owlCarousel({
        nav: false,
        dots: true,
        center: false,
        touchDrag: false,
        mouseDrag: true,
        margin: 30,
        autoplay: true,
        smartSpeed: 750,
        autoplayHoverPause: true,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /* Practicle JS
    ========================================================*/
    if (document.getElementById("particles-js")) particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 150,
                "density": {
                    "enable": true,
                    "value_area": 1000
                }
            },
            "color": {
                "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
            },

            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#fff"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.6,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 2,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 120,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": false
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 140,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });

    /* Go To Top
    ========================================================*/
    //Scroll event
    $(window).on('scroll', function () {
        var scrolled = $(window).scrollTop();
        if (scrolled > 200) $('.go-top').fadeIn('slow');
        if (scrolled < 200) $('.go-top').fadeOut('slow');
    });

    //Click event
    $('.go-top').on('click', function () {
        $("html, body").animate({ scrollTop: "0" }, 500);
    });

    /* Preloader
    ========================================================*/
    jQuery(window).on('load', function () {
        $('.preloader-area').fadeOut();
    });

    // Buy Now Btn
    // $('body').append("<a href='https://themeforest.net/checkout/from_item/22745035?license=regular&support=bundle_6month&_ga=2.51442410.233315998.1651981865-1425290503.1590986634' target='_blank' class='buy-now-btn'><img src='web/img/envato.png' alt='envato'/>Buy Now</a>");

    // Switch Btn
    $('body').append("<div class='switch-box'><label id='switch' class='switch'><input type='checkbox' onchange='toggleTheme()' id='slider'><span class='slider round'></span></label></div>");

})(jQuery);

// function to set a given theme/color-scheme
function setTheme(themeName) {
    localStorage.setItem('phkr_theme', themeName);
    document.documentElement.className = themeName;
}
// function to toggle between light and dark theme
function toggleTheme() {
    if (localStorage.getItem('phkr_theme') === 'theme-dark') {
        setTheme('theme-light');
    } else {
        setTheme('theme-dark');
    }
}
// Immediately invoked function to set the theme on initial load
(function () {
    if (localStorage.getItem('phkr_theme') === 'theme-dark') {
        setTheme('theme-dark');
        document.getElementById('slider').checked = false;
    } else {
        setTheme('theme-light');
        document.getElementById('slider').checked = true;
    }
})();

// showalert para la web  NO ES NECESARIO, solo se uso para ver como funcionaba el error.
// function showAlert(type, message) {
//     let errorMessagePrefix = message.split(":")[0];
//     let content = `
//     <div class="text-light alert bg-${type} alert-dismissible fade show" role="alert">
//         <strong>${errorMessagePrefix}</strong>:${message.substring(errorMessagePrefix.length + 1)}
//         <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
//     </div>
//     `;
//     $(".alert-content").html(content);
//     setTimeout(() => {
//         $(".alert-content .close").click();
//     }, 3000);
// }


const $form = $('#contactForm2');
let $exist = true;

function onSubmit(token) {
    console.log("TOKEN: ",  token);

    if ($exist) {
        // Comprobamos si el formulario es válido
        if ($form[0].checkValidity()) {
            // Deshabilitamos los campos del formulario
            // $form.find('input, select, textarea, button').prop("disabled", true);
            $form.find('button').prop("disabled", true);

            $exist = false;
            // Enviamos el formulario
            $form.trigger('submit'); // Activamos el evento submit para capturarlo con jQuery
        } else {
            // Si no es válido, mostramos los mensajes de error del navegador
            $form[0].reportValidity();
        }
        
    }
}

function showAlert(type, message) {
    let errorMessagePrefix = message.split(':')[0];
    let originalTitle = document.title;
    let alertTitle = errorMessagePrefix;
    let alertMessage = message.substring(errorMessagePrefix.length + 1);
    let iconType = (type === 'success') ? 'success' : (type === 'warning') ? 'warning' : 'error';

    // Cambiar el título de la página
    document.title = '🔔 ' + alertTitle;

    // // Reproducir un sonido
    // let audio = new Audio('notification.mp3');
    // audio.play();

    Swal.fire({
        title: alertTitle,
        text: alertMessage,
        icon: iconType,
        timer: 5000,
        showConfirmButton: false
    }).then(() => {
        // Restaurar el título de la página
        document.title = originalTitle;
    });

    // Restaurar el título de la página después de 5 segundos si el usuario no interactúa con la alerta
    setTimeout(() => {
        document.title = originalTitle;
    }, 5000);
}