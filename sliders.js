$(document).ready(function() {
    funcionSlider();
});


function funcionSlider(){
    $('#slider').slick({
        dots: false,
        infinite: true,
        autoplay: true, 
        autoplaySpeed: 2000, 
        slidesToShow: 3, 
        slidesToScroll: 3, 
        prevArrow: '#slick-prev',
        nextArrow: '#slick-next',
        /*prevArrow: '<span class="slick-prev slider-arrow"><img src="flecha-izquierda.png" alt="Flecha izquierda"></span>',
        nextArrow: '<span class="slick-next slider-arrow"><img src="flecha-derecha.png" alt="Flecha derecha"></span>',*/

        /*
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                    dots: true,
                    slidesToScroll: 1,
                    autoplay: false   
                }
            }
        ]
        */
    });
}
