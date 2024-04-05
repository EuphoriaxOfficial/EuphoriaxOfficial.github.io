// veranderingen hartje bij productprevieuw
function HeartChange(img)
{
  if(img.getAttribute('src') == 'icons/heart.png')
  {
    img.src = 'icons/heart2.png';
  }
  else
  {
    img.src = 'icons/heart.png';
  }
}



// zoekbar
document.getElementById('zoekknop').addEventListener('click', function() {
  document.getElementById('zoekbar').focus();
});
document.getElementById('zoekknop2').addEventListener('click', function() {
  document.getElementById('zoekbar2').focus();
});

// scroll to top
function ScrollToTop(){
  window.scrollTo(0, 0);
}

// aantal orders van een onderdeel in basket

const numberInput = document.getElementById("number-input");

numberInput.addEventListener("input", function () {
    const inputValue = parseInt(numberInput.value, 10);
    if (inputValue < 0) {
        numberInput.value = "0";
    } else if (inputValue > 10) {
        numberInput.value = "10";
    }
});




// email sender

function sendMail() {
  // Haal referenties naar de invoervelden op
  const emailErrorContactElement = document.querySelector('.emailerrorcontact');
  const emailSendContactElement = document.querySelector('.emailsendcontact');
  

  var nameInput = document.getElementById("name");
  var usernameInput = document.getElementById("username");
  var emailInput = document.getElementById("email");
  var messageInput = document.getElementById("message");

  // Controleer of een van de invoervelden leeg is
  if (
    nameInput.value === "" ||
    usernameInput.value === "" ||
    emailInput.value === "" ||
    messageInput.value === ""
  ) {
    emailErrorContactElement.style.visibility = 'visible';
    emailErrorContactElement.style.display = 'block';
    emailSendContactElement.style.display = 'none';
  } else {
    var params = {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      message: document.getElementById("message").value,
      username: document.getElementById("username").value,
    };
    const serviceID = "service_97432lg";
    const templID = "template_r3uv4a6";

    emailErrorContactElement.style.display = 'none';
    emailSendContactElement.style.display = 'block';

  emailjs.send(serviceID,templID,params)
  .then((res) =>{
      document .getElementById("name").value= "";
      document .getElementById("email").value= "";
      document .getElementById("message").value= "";
      document .getElementById("username").value= "";
      console.log(res);
    }
  )
  .catch((err) => console.log(err));
  
    }
}

