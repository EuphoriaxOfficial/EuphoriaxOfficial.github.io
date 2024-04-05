// Menu instellingen
var SideMenu = document.getElementById("SideMenu");
function showMenu(){
  SideMenu.style.left = "0";
}
function hideMenu(){
  SideMenu.style.left = "-100%"
}




// veranderingen slidemenuup to slidemenudown
function SubiconChange(img)
{
  if(img.getAttribute('src') == 'icons/slidemenuup.png')
  {
    img.src = 'icons/slidemenudown.png';
  }
  else
  {
    img.src = 'icons/slidemenuup.png';
  }
}

//opensub in sidemenu
function SubOpenClose(icon, submenuId) {
    var submenu = document.getElementById(submenuId + "-submenu");
    if (submenu.classList.contains("closesub")) {
        submenu.classList.remove("closesub");
        submenu.classList.add("opensub");
    } else {
        submenu.classList.remove("opensub");
        submenu.classList.add("closesub");
    }
}
