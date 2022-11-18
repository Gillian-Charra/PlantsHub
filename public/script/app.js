function menuVertical() {
    var navbar = document.getElementById('navbar-laterale');
    var main = document.getElementById('le-main');
    navbar.classList.remove("w-0");
    navbar.classList.add("menu-lateral");
    main.classList.add("opacity-30");
    main.addEventListener('click', function() {
        navbar.classList.add("w-0");
        navbar.classList.remove("menu-lateral");
        main.classList.remove("opacity-30");
    });
}
function navbaractivation() {
    
    var navbarTitre = document.getElementById('navbar-titre');
    var navbar   =document.getElementById('navbar');
    window.addEventListener('scroll', function() {
        if (window.pageYOffset+50>document.getElementById('pointdaffichagenavbar').offsetTop){
            navbar.classList.remove("overflow-hidden")
            navbar.classList.remove("h-0")
            navbar.classList.add("h-navbar")
        };
        if (window.pageYOffset+50<document.getElementById('pointdaffichagenavbar').offsetTop){
            navbar.classList.add("overflow-hidden")
            navbar.classList.add("h-0")
            navbar.classList.remove("h-navbar")
        };
    });    
  }
  
  if (document.readyState === 'complete') {
    navbaractivation();
  } else {
    document.addEventListener('DOMContentLoaded', function() {
        navbaractivation();
    });
  }