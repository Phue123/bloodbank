 // carouel section 
 $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dotS:false,
    autoplay:true,
    autoplayTimeout:3000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1285:{
            items:3
        }
    }
})