
var afficher=0;

$(window).scroll(function(){
  if ($(window).scrollTop() >= $(document).height() - $(window).height()-2){
    //document.getElementById("partieInfo").hidden=false;
    openNav();
    
  }
  else{
    //document.getElementById("partieInfo").hidden=true;
    afficher=0;
    closeNav();
  }
});

function cacherInfo(){
  //document.getElementById("partieInfo").hidden=true;
  closeNav();
}


function openNav() {
  document.getElementById("partieInfo").style.height = "200px";

}

function closeNav() {
  document.getElementById("partieInfo").style.height = "0px";
}
