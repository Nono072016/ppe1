function getVisiteur(f)
{
    var ID1;
    ID1= f.lstVisiteur.options[f.lstVisiteur.selectedIndex].value;
    location.replace('cValidFichesFrais.php?ID1=' +ID1);
}
function getMois(f)
{
    var ID2;
    ID2= f.lstMois.options[f.lstMois.selectedIndex].value;
    location.replace('cValidFichesFrais.php?ID2='+ID2);
}

function changerVisiteur(){
   window.location="cValidFichesFrais.php";
}

function reinitialiserLigneFraisForfait() {
    document.getElementById('formFraisForfait').reset();
           
}

function actualiserLigneFraisForfait(rep,nui,etp,km) {
    // Trouver quelles sont les mises à jour à réaliser
    var modif = false;
    var txtModifs = '';
    if (rep != document.getElementById('idREP').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne quantité de repas : ' + rep + ' \n Nouvelle quantité : ' + document.getElementById('idREP').value;
     
    }
    if (nui != document.getElementById('idNUI').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne quantité de nuitées : ' + nui + ' \n Nouvelle quantité : ' + document.getElementById('idNUI').value;
        
    }
    if (etp != document.getElementById('idETP').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne quantité d\'étapes : ' + etp + ' \n Nouvelle quantité : ' + document.getElementById('idETP').value;
     
    }
    if (km != document.getElementById('idKM').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne quantité de kilomètres : ' + km + ' \n Nouvelle quantité : ' + document.getElementById('idKM').value;
         
    }
    if (modif) {
        var question = 'Souhaitez-vous vraiment effectuer la ou les modifications suivantes cette ligne de frais forfaitisés ?' + txtModifs;
        if (confirm(question)) {
            document.getElementById('formFraisForfait').submit();
        }
    } else {
        alert('Aucune modification à actualiser...');
        reinitialiserLigneFraisForfait();
    }
}

    
function actualiserLigneFraisHF(date,libelle,montant) {
    // Trouver quelles sont les mises à jour à réaliser
    var modif = false;
    var txtModifs = '';
    if (date != document.getElementById('idDate').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne date : "' + date + '" \n \'--> Nouvelle date : "' + document.getElementById('idDate').value + '"';
    }
    if (libelle != document.getElementById('idLibelle').value) {
        // Modification portant sur le libellé
        modif = true;
        txtModifs += '\n\nAncien libellé : "' + libelle + '" \n \'--> Nouveau libellé : ' + document.getElementById('idLibelle').value + '"';
    }
    if (montant != document.getElementById('idMontant').value) {
        // Modification portant sur le montant
        modif = true;
        txtModifs += '\n\nAncien montant : ' + montant + '\u20AC \n \'--> Nouveau montant : ' + document.getElementById('idMontant').value + '\u20AC';
    }
    // Demande de confirmation s'il y a des modifications à réellement actualiser
    if (modif) {
        var question = 'Souhaitez-vous vraiment effectuer la ou les modifications suivantes cette ligne de frais hors forfait ?' + txtModifs;
        if (confirm(question)) {
            document.getElementById('formFraisHorsForfait').submit();
        }
    } else {
        alert('Aucune modification à actualiser...');
        reinitialiserLigneFraisHorsForfait();
    }
}

function actualiserJustificatifs(nb) {
    // Trouver quelles sont les mises à jour à réaliser
    var modif = false;
    var txtModifs = '';
    if (nb != document.getElementById('nbJusti').value) {
        // Modification portant sur la date
        modif = true;
        txtModifs += '\n\nAncienne quantité de repas : ' + nb + ' \n Nouvelle quantité : ' + document.getElementById('nbJusti').value;
     
    }
   
    if (modif) {
        var question = 'Souhaitez-vous vraiment effectuer la ou les modifications suivantes cette ligne de frais forfaitisés ?' + txtModifs;
        if (confirm(question)) {
            document.getElementById('formJustificatifs').submit();
        }
    } else {
        alert('Aucune modification à actualiser...');
        reinitialiserJustificatifs();
    }
}

function reinitialiserJustificatifs(){
    document.getElementId('formJustificatifs').reset();
}

function reinitialiserLigneFraisHorsForfait() {
    document.getElementById('formFraisHorsForfait').reset();
}

function supprimerLigneFraisHorsForfait(){
    document.getElementById('formFraisHorsForfait').submit();
    }
    
function validerFicheFrais(){
    document.getElementById('formValidFiche').submit();
}
    function connecte(nom,prenom,id,type){   
        if(type=='C'){
        window.location="cAccueil.php";
        alert('Bienvenue '+nom+' '+prenom+' '+id+'\n Vous êtes connecté!');
    } else{
        window.location="cAccueilVisiteur.php";
        alert('Bienvenue '+nom+' '+prenom+' '+id+'\n Vous êtes connecté!');
    }
    }
    
    function test1(rep,nui,etp,km){
        alert('Quantite de Repas = '+rep+'\n'+
                'Quantite de Nuitée = '+nui+'\n'+
                'Quantite Etape  = '+etp+'\n'+
                'Quantite de kilomètre = '+km);
    }