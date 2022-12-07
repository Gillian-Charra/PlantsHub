function menuVertical() {
    var navbar = document.getElementById('navbar-laterale');
    var body = document.getElementById('content');
    navbar.classList.remove("w-0");
    navbar.classList.add("w-350px");
    body.classList.add("opacity-30");
    body.addEventListener('click', function() {
        navbar.classList.add("w-0");
        navbar.classList.remove("w-350px");
        body.classList.remove("opacity-30");
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