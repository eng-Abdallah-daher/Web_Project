
let content = document.getElementById('content');




let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    profile.classList.remove('active');
}




document.getElementById("explore").addEventListener("click", function() {
    setTimeout(function() {
        window.location.href = "car-page.html";
    }, 500);
});


document.querySelector('.home').onmousemove = (e) =>{

    document.querySelectorAll('.home-parallax').forEach(elm=>{

        let speed = elm.getAttribute('data-speed');
        let x = (window.innerWidth - e.pageX * speed) / 90;
        let y = (window.innerHeight - e.pageY * speed) / 90;

        elm.style.transform = `translateX(${y}px) translateY(${x}px)`;
    });

}

document.querySelector('.home').onmouseleave = () =>{

    document.querySelectorAll('.home-parallax').forEach(elm=>{


        elm.style.transform = `translateX(0px) translateY(0px)`;
    });

}


var swiper = new Swiper(".cars-slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop:true,
    grabCursor:true,
    centeredSlides:true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});





var swiper = new Swiper(".featured-slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop:true,
    grabCursor:true,
    centeredSlides:true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".reviews-slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop:true,
    grabCursor:true,
    centeredSlides:true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});
let z=document.getElementById('tool');
z.addEventListener("click",function (){
    window.location.href="check.php";
})