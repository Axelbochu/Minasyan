function affichageIcon(divSelect){
    divSelect.querySelector(".iconeModif").classList.remove('hiddenBtn');
    divSelect.querySelector(".iconeModif").classList.add('visibleBtn');

    //on blur
    divSelect.querySelector(".blurCont").classList.remove('withoutBlur');
    divSelect.querySelector(".blurCont").classList.add('withBlur');
}

function sortirIcon(divSelect){
    divSelect.querySelector(".iconeModif").classList.add('hiddenBtn');
    divSelect.querySelector(".iconeModif").classList.remove ('visibleBtn');

    //on déblur
    divSelect.querySelector(".blurCont").classList.add('withoutBlur');
    divSelect.querySelector(".blurCont").classList.remove('withBlur');
}

function modifierGuest(info){ //info est l'id du block sur lequel on a cliquer
    //on récupère nos données
    ancienneDiv = document.querySelector('.ancienContainer');
    majDiv = document.querySelector('.majContainer');

    //on cache l'ancienne et affiche la nouvelle
    ancienneDiv.style.display = 'none';
    //pour eviter le bug de la barre de défilement  
    document.querySelector('body').style.overflowY = 'hidden';
    majDiv.style.display = 'flex';
    majDiv.classList.add('apparitionMajDiv');

    //on met à jour les input
    majDiv.querySelector('.idGuest').value = infoDb[info].id;
    majDiv.querySelector('.nomInput').value = infoDb[info].nom;
    majDiv.querySelector('.prenomInput').value = infoDb[info].prenom;
    majDiv.querySelector('.fonctionInput').value = infoDb[info].fonction;
    majDiv.querySelector('.desfonctionInput').value = infoDb[info].fonctionExplain;
}

function newTeams(){
    //on recup
    ancienneDiv = document.querySelector('.containerPlus');
    newDiv = document.querySelector('.containerNewTeam');

    //on mets à jour les affichage
    ancienneDiv.style.display = 'none';
    newDiv.style.display = 'flex';
}

var infoDb = new Array();
console.log(infoDb);

function modifierValeur(info){ //info est l'id du block sur lequel on a cliquer
    //on récupère nos données
    ancienneDiv = document.querySelector('.ancienContainer');
    majDiv = document.querySelector('.majContainer');

    //on cache l'ancienne et affiche la nouvelle
    ancienneDiv.style.display = 'none';
    //pour eviter le bug de la barre de défilement  
    document.querySelector('body').style.overflowY = 'hidden';
    majDiv.style.display = 'flex';
    majDiv.classList.add('apparitionMajDiv');

    //on met à jour les input
    majDiv.querySelector('.idInput').value = infoDb[info].id;
    majDiv.querySelector('.valeurInput').value = infoDb[info].valeur;
    majDiv.querySelector('.descriptionInput').value = infoDb[info].descriptionValeur;
}