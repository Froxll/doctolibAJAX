
const log = document.getElementById("log");


function handleKeyUp(event) {
  const input = document.querySelector("input");
  if (event.key === "Enter") {
      var inputValue = input.value;

      var selectElement = document.getElementById("specialite");
      var optionChoisie = selectElement.options[selectElement.selectedIndex].value;

      if (optionChoisie == "pas_de_preference") {
        // ENVOYER inputValue dans GET qui va me permettre de récupérer les docteurs s'appelant "inputValue"
        ajaxRequest('GET', '/doctolibAJAX/doctolibAJAX/request.php/medecin/?nom=' + inputValue + '', displayMedecin);
      } 
      else {
        ajaxRequest('GET', '/doctolibAJAX/doctolibAJAX/request.php/medecin/?nom=' + inputValue + '&specialite=' + optionChoisie, displayMedecin);
      }

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
    medecinHTML += '<button class="rdv-btn" data-email="' + medecin.mail + '">Prendre rendez-vous</button>';
    medecinHTML += '</div>';

    medecinsHTML += medecinHTML; 
  }

  document.getElementById('medecins').innerHTML = medecinsHTML;

  var rdvButtons = document.querySelectorAll('.rdv-btn');
  rdvButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var email = this.getAttribute('data-email');
      ajaxRequest('GET', '/doctolibAJAX/doctolibAJAX/request.php/rdv/?email=' + email + '', displayRdv);
    });
  });
}

function displayRdv(data) {
  var change = document.getElementById('medecins');
  change.innerHTML = '';

  // Structure de données pour stocker les horaires correspondant à chaque jour
  var rdvParJour = {};

  
  for (var i = 0; i < data.length; i++) {
      var rdv = data[i]; 


      if (!rdvParJour.hasOwnProperty(rdv.date)) {
          rdvParJour[rdv.date] = []; 
      }
      rdvParJour[rdv.date].push({
        id: rdv.id,
        horaire: rdv.horaire,
        mail: rdv.mail_1
    });
  }

  for (var jour in rdvParJour) {
    if (rdvParJour.hasOwnProperty(jour)) {
        var horaires = rdvParJour[jour];

        var rdvHTML = '<div class="rdv">';
        rdvHTML += '<p class="date">' + jour + '</p>';
        for (var j = 0; j < horaires.length; j++) {
            var classeHoraire;
            if (datePassee(jour, horaires[j].horaire) == true) {
                classeHoraire = 'indisponible';
            } else {
                classeHoraire = 'disponible';
            }

            rdvHTML += '<div class="' + classeHoraire + '">';
            rdvHTML += '<button onclick="deleteAppointment(\'' + horaires[j].id + '\')">' + horaires[j].horaire + '</button>';   //MODIFIER ICI
            rdvHTML += '</div>';
        }
        rdvHTML += '</div>';

        change.innerHTML += rdvHTML;
    }
  }
}

function deleteAppointment(id) {
  console.log("Ici supprimer le rdv " + id)
}

/*
function appointmentDeleted(response) {
  if (response.success) {
      console.log('Rendez-vous supprimé avec succès.');
  } else {
      console.error('Erreur lors de la suppression du rendez-vous.');
  }
}
*/

function datePassee(date,horaire){
  var elementsDate = date.split('/');
    var jour = parseInt(elementsDate[0], 10);
    var mois = parseInt(elementsDate[1], 10) - 1; //ahhh les ptn de mois commencent a 0 en js zobiiii
    var annee = parseInt(elementsDate[2], 10);

    var elementsHoraire = horaire.split(':');
    var heure = parseInt(elementsHoraire[0], 10);
    var minute = parseInt(elementsHoraire[1], 10);

    var dateRdv = new Date(annee, mois, jour, heure, minute);

    var dateActuelle = new Date();

    dateRdv.setMinutes(dateRdv.getMinutes() + 30);
    
    //console.log("LA DATE DU JORU EST : " + dateActuelle);

    if(dateRdv <= dateActuelle){
      return true // la date est passée
    }
    else{
      return false // la date n'est pas passée
    }
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
        //console.log(xhr.responseText);
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