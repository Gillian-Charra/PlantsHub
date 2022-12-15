function menuVertical() {
    const navbar = document.getElementById('navbar-laterale');
    const body = document.getElementById('content');
    navbar.classList.remove("w-0");
    navbar.classList.add("w-350px");
    body.classList.add("opacity-30");
    body.addEventListener('click', function() {
        navbar.classList.add("w-0");
        navbar.classList.remove("w-350px");
        body.classList.remove("opacity-30");
    });
}
