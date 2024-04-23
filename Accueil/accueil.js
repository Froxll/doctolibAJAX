const input = document.querySelector("input");
const log = document.getElementById("log");


function handleKeyUp(event) {
  if (event.key === "Enter") {
      var inputValue = input.value;
      //ENVOYER inputValue dans GET qui va me permettre de récuperer les docteurs s'appellant "inputValue"
      ajaxRequest('GET','/doctolibAJAX/doctolibAJAX/request.php/medecin/?nom=' + inputValue + '',displayMedecin)
  }
}

function afficherDiv(divId) {
  
  if(divId == 'accueil'){
    document.getElementById(divId).classList.remove('invisible');
    document.getElementById("rdv").classList.add("invisible");
    document.getElementById("connexion").classList.add("invisible");
  }
  else if(divId == 'rdv'){
    document.getElementById(divId).classList.remove('invisible');
    document.getElementById("accueil").classList.add("invisible");
    document.getElementById("connexion").classList.add("invisible");
  }
  else if(divId == 'connexion'){
    document.getElementById(divId).classList.remove('invisible');
    document.getElementById("accueil").classList.add("invisible");
    document.getElementById("rdv").classList.add("invisible");
  }
  
  
}

function displayMedecin(data){
  var medecinsHTML = ''; 

  

    for (var i = 0; i < data.length; i++) {
        var medecin = data[i]; 

        nom = data[i].nom
        prenom = data[i].prenom
        mail = data[i].mail
        telephone = data[i].telephone
        ville = data[i].ville
        specialite = data[i].specialite

        var medecinHTML = '<div class="medecin">';
        medecinHTML += '<p>Nom: ' + medecin.nom + '</p>';
        medecinHTML += '<p>Prénom: ' + medecin.prenom + '</p>';
        medecinHTML += '<p>Email: ' + medecin.mail + '</p>';
        medecinHTML += '<p>Téléphone: ' + medecin.telephone + '</p>';
        medecinHTML += '<p>Ville: ' + medecin.ville + '</p>';
        medecinHTML += '<p>Spécialité: ' + medecin.specialite + '</p>';
        medecinHTML += '</div>';

        medecinsHTML += medecinHTML; 
    }

    document.getElementById('medecins').innerHTML = medecinsHTML;
}





function ajaxRequest(type, url, callback, data = null)
{
  let xhr;

  // Create XML HTTP request.
  xhr = new XMLHttpRequest();
  xhr.open(type, url);

  xhr.onload = () =>
  {
    switch (xhr.status)
    {
      case 200:
      case 201:
        console.log(xhr.responseText);
        callback(JSON.parse(xhr.responseText));
        break;
      default:
        httpErrors(xhr.status);
    }
  };

  // Send XML HTTP request.
  xhr.send(data);
}

function httpErrors(errorCode)
{
  let messages = {
    400: 'Requête incorrecte',
    401: 'Authentifiez vous',
    403: 'Accès refusé',
    404: 'Page non trouvée',
    500: 'Erreur interne du serveur',
    503: 'Service indisponible'
  };

  // Display error.
  if (errorCode in messages)
  {
    console.log("errorCode in message")
  }
}