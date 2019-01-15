$(document).ready(iniciar);
function iniciar() {
   initialSlick();
   initialSlickTwo();
}

function initialSlickTwo(){
   $('.slick').slick({
      dots: false,
      accessibility: false,
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 3000,
      slideToShow: 1,
      slideToScroll: 1,
      fade: true,
      cssEase: 'linear'
   });
}

function initialSlick() {
   $('#your-class').slick({
      dots: false,
      accessibility: false,
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 9000,
      slideToShow: 1,
      slideToScroll: 1
   });
}
