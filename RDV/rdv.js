function getRDV(){
  ajaxRequest('GET','/Doctolib-AJAX/doctolibAJAX/doctolibAJAX/request.php/rdv',displayRDV)
}

function displayRDV(data){
  console.log(data);
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