window.onload = function() {
    document.querySelector(".popup").style.display = "block";
};
//window.onload = function() {
//    document.querySelector(".page").classList.add("hidden");
//};
function closePopup() {
    document.querySelector(".popup").style.display = "none";
    document.querySelector("page").classList.remove("hidden");
}