
$(document).ready(function(){

    $(".resbtn ,.rescross").click(function () {
        $(".headernav,.headernav").toggleClass("main");
    });

    $('.banner').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        navText:["<i class='fa-solid fa-chevron-left'></i>","<i class='fa-solid fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })


    $('.categories').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        navText:["<i class='fa-solid fa-chevron-left'></i>","<i class='fa-solid fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })


    window.addEventListener("scroll", () => {

        let navcontrol = document.querySelector (".navcontrol");
        if ( window.pageYOffset >= 350){
        
        
            navcontrol.classList.add  ("sticky");
        
        }else{
        
            navcontrol.classList.remove ( "sticky");
        }
        
        
        })

})