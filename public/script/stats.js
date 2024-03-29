// work in progress - needs some refactoring and will drop JQuery i promise :)
var instance = $(".hs__wrapper");
$.each( instance, function(key, value) {
    
  var arrows = $(instance[key]).find(".arrow"),
      prevArrow = arrows.filter('.arrow-prev'),
      nextArrow = arrows.filter('.arrow-next'),
      box = $(instance[key]).find(".hs"), 
      x = 0,
      mx = 0,
      maxScrollWidth = box[0].scrollWidth - (box[0].clientWidth / 2) - (box.width() / 2);

  $(arrows).on('click', function() {
      
    if ($(this).hasClass("arrow-next")) {
      x = ((box.width() / 2)) + box.scrollLeft() - 10;
      box.animate({
        scrollLeft: x,
      })
    } else {
      x = ((box.width() / 2)) - box.scrollLeft() -10;
      box.animate({
        scrollLeft: -x,
      })
    }
      
  });
    
  $(box).on({
    mousemove: function(e) {
      var mx2 = e.pageX - this.offsetLeft;
      if(mx) this.scrollLeft = this.sx + mx - mx2;
    },
    mousedown: function(e) {
      this.sx = this.scrollLeft;
      mx = e.pageX - this.offsetLeft;
    },
    scroll: function() {
      toggleArrows();
    }
  });

  $(document).on("mouseup", function(){
    mx = 0;
  });
  
  function toggleArrows() {
    if(box.scrollLeft() > maxScrollWidth - 10) {
        // disable next button when right end has reached 
        nextArrow.addClass('disabled');
      } else if(box.scrollLeft() < 10) {
        // disable prev button when left end has reached 
        prevArrow.addClass('disabled')
      } else{
        // both are enabled
        nextArrow.removeClass('disabled');
        prevArrow.removeClass('disabled');
      }
  }
  
});
async function jsonFetch(url){
  const response = await fetch(url, {
      headers:{
          Accept:'application/json',
      },
  })
  if (response.status===204){
      return null;
  }
  if (response.ok) {
      return await response.json()
  }
  throw response
}
async function getDescriptionPopUp(planteId,userId){
  const popup=document.getElementById('popup');
  const body=document.getElementById('container');
  var a=await jsonFetch(`/stats/api/photo/${planteId}/${userId}`)
  popup.innerHTML=`<div style="font-size:17px;color:grey;"class="color-sec-darker flex-row"><img style="height:10vh;" src="/images/photo/${a.photo}"/><p>Découverte le: ${a.date}, lat: ${a.latitude} long: ${a.longitude}</p></div>`
  popup.innerHTML+=await jsonFetch(`/stats/api/descriptionAfter/${planteId}`);

  popup.classList.remove('display-no');
  body.classList.add("opacity-30");
  body.addEventListener('click', function() {
    popup.classList.add('display-no');
    body.classList.remove("opacity-30");
  });

}