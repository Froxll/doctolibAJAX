function afficherDiv(divId) {
  
    if(divId == 'accueil'){
      document.getElementById(divId).classList.remove('invisible');
      document.getElementById("rdv").classList.add("invisible");
      document.getElementById("connexion").classList.add("invisible");
      document.getElementById("inscription").classList.add("invisible");
      document.getElementById("formulaire").classList.add("invisible");
    }
    else if(divId == 'rdv'){
      document.getElementById(divId).classList.remove('invisible');
      document.getElementById("accueil").classList.add("invisible");
      document.getElementById("connexion").classList.add("invisible");
      document.getElementById("inscription").classList.add("invisible");
      document.getElementById("formulaire").classList.add("invisible");
    }
    else if(divId == 'connexion'){
      document.getElementById(divId).classList.remove('invisible');
      document.getElementById("accueil").classList.add("invisible");
      document.getElementById("rdv").classList.add("invisible");
      document.getElementById("inscription").classList.add("invisible");
      document.getElementById("formulaire").classList.add("invisible");
    }
    else if(divId == 'inscription'){
        document.getElementById(divId).classList.remove('invisible');
        document.getElementById("accueil").classList.add("invisible");
        document.getElementById("rdv").classList.add("invisible");
        document.getElementById("connexion").classList.add("invisible");
        document.getElementById("formulaire").classList.add("invisible");
      }
}