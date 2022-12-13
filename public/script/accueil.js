function navbaractivation() {
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