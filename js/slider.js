//slider
var swiper;
function initializeSwiper() {
  var screenWidth = window.innerWidth;

  //normale instellingen
  var slidesOffsetBefore = 25;
  var slidesOffsetAfter = 25;

  if (screenWidth >= 768 && screenWidth <= 1023) {
    //instellingen bij bepaalde breedte
    slidesOffsetBefore = 50;
    slidesOffsetAfter = 50;
  }

  swiper = new Swiper(".mySwiper", {
    slidesPerView: 1.5,
    slidesOffsetBefore: slidesOffsetBefore,
    slidesOffsetAfter: slidesOffsetAfter,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
}
initializeSwiper();

window.addEventListener("resize", initializeSwiper);