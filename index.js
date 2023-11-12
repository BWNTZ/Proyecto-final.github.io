$(document).ready(ini);
function ini() {

    $("#sliderIndex").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        /*nextArrow:"<button> NEXT </button>",
        prevArrow:"<button> PREV </button>",*/
        autoplay: true,
        autoplaySpeed: 1000,
        dots: true,

    });
}

