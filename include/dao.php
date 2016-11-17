<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function connect(){
   $dsn= 'mysql:dbname=db554417509;host=db554417509.db.1and1.com;charset=utf8';
  $user='dbo554417509';
   $pass='Hinata21';
    $dbh = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $dbh;

}
function connect1(){
    $dsn= 'mysql:dbname=gsb_frais;host=127.0.0.1;charset=utf8';
    $user='usergsb';
    $pass='secret';
    $dbh = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $dbh;

}
function allUsers(){
    $dbh=connect();
    $query="select * from utilisateur";
    $resu= $dbh->prepare($query);
    $resu->execute();
    return $resu;
}
function getUtilisateur($login) {
        $dbh = connect();
        $query = "SELECT * FROM utilisateur WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array($login));
        if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth->fetch();
        }
        return $resu;
    }
function libelleType($type){
    $dbh= connect();
    $query="select * from type where id=?";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($type));
    if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth->fetch();
        }
        return $resu;
}
function obtenirReqEltsForfaitFicheFrais($moisChoisi,$userChoisi){
    $dbh=connect();
    $query="select *
from lignefraisforfait 
where mois=?
and idVisiteur=?
order by 1 desc";
    $sth= $dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($moisChoisi,$userChoisi));
        if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth;
        }
        return $resu;
        
    }

function obtenirReqEltsHorsForfaitFicheFrais($moisChoisi,$userChoisi){
    $dbh=connect();
    $query="select *
from lignefraishorsforfait
where mois=?
and idVisiteur=?";
    $sth= $dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($moisChoisi,$userChoisi));
        if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth;
        }
        return $resu;
        
    }
function nbJustificatifs($moisChoisi, $userChoisi){
    $dbh=connect();
    $query="select nbJustificatifs from fichefrais where mois=? and idVisiteur=?";
    $sth= $dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($moisChoisi,$userChoisi));
        if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth;
        }
        return $resu;
}
function obtenirReqSommeFraisHorsForfait(){
    $dbh=connect();
    $query="select nom, prenom, sum(montant)as somme
from utilisateur join lignefraishorsforfait
on idUtilisateur= idU
where date like '2012%'
group by 1";
    $resu= $dbh->prepare($query);
    $resu->execute();
    return $resu;
}
function afficherTypeVehicule(){
    $dbh=connect();
    $query="select t.libelle from typevehicule t join fichefrais join utilisateur on idTypeVehicule=t.id and idUtilisateur= idU where idU= ?";
    $resu=$dbh->prepare($query);
    $resu->execute();
    return $resu; 
}
function obtenirReqSommeFrais(){
    $dbh=connect();
    $query="select nom, prenom,mois,login, sum(montantValide)as somme
from fichefrais join utilisateur
on idUtilisateur= idU
group by 3";
    $resu= $dbh->prepare($query);
    $resu->execute();
    return $resu;
}
 function obtenirReqMoisFicheFrais($idUtilisateur){
     $dbh=connect();
     $query="select mois from fichefrais where idVisiteur= ? and idEtat='CL'";
     $sth = $dbh->prepare($query);
     $sth->execute(array($idUtilisateur)); 
     return $sth;
 }          
 function obtenirReqMoisFicheFraisVisiteur($idUtilisateur){
     $dbh=connect();
     $query="select mois from fichefrais where idVisiteur= ? and idEtat='VA'";
     $sth = $dbh->prepare($query);
     $sth->execute(array($idUtilisateur)); 
     return $sth;
 }
function obtenirReqListeVisiteurs(){
    $dbh=connect();
    $query="select * from utilisateur where idType='V'";
    $resu=$dbh->prepare($query);
    $resu->execute();
    return $resu;
}
function obtenirReqListeTypeVehicule($idUtilisateur,$mois){
   $dbh = connect();
        $query = "select * from typevehicule join fichefrais on(idTypeVehicule=id)
where idVisiteur=? and mois= ?";

        $sth = $dbh->prepare($query);
        //$sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array($idUtilisateur,$mois));
        if ($sth->rowCount() == 0) {
            $resu= null;
        } else {
            $resu= $sth;
        }
        return $resu;  
    }

function obtenirEtatFicheFrais($login,$mois){
    $dbh=connect();
    $query="select libelle from etat join fichefrais on (idEtat=id)where idVisiteur=? and mois=?";
    $sth=$dbh->prepare($query);
    //$sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($login, $mois));
    if($sth->rowCount()){
        $resu=null;
    }else{
        $resu=$sth;
    }
     return $resu;   
}
function obtenirSommeTotalFicheFrais($login,$mois,$login, $mois,$login,$login,$mois,$mois){
    $dbh=connect();
    $query="select (select sum(montant * quantite)
from lignefraisforfait join fraisforfait
on idFraisForfait=id
where idFraisForfait<> 'KM'
and idVisiteur=?
and mois=?)+(select sum(montant)
from lignefraishorsforfait 
where idVisiteur=?
    and mois=?)+ (select (indemniteKM*quantite)
    from typevehicule t join fichefrais f join lignefraisforfait l 
    on f.idTypeVehicule=t.id
    where f.idVisiteur=?
    and l.idVisiteur=?
    and f.mois=?
    and l.mois=?
    and l.idFraisForfait ='KM') as somme";
    $sth=$dbh->prepare($query);
    //$sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($login,$mois,$login, $mois,$login,$login,$mois,$mois));
    if($sth->rowCount() ==0){
        $resu=null;
    }else {
        $resu=$sth;
    }
    return $resu;
    
}   

function obtenirFicheFraisForfait($id,$mois,$id,$id,$mois,$mois){ 
$dbh=connect();
    $sql="select libelle, quantite, montant, sum(quantite*montant)as somme from fraisforfait join lignefraisforfait
on(idFraisForfait=id)
where idVisiteur=?
and mois=?
and idFraisForfait<>'KM'
group by idFraisForfait

union

select s.libelle, l.quantite, t.indemniteKM as montant,sum(t.indemniteKM*l.quantite)as somme
from typevehicule t join fichefrais f join lignefraisforfait l join fraisforfait s 
on f.idTypeVehicule=t.id
and l.idFraisForfait=s.id
where f.idVisiteur=?
and l.idVisiteur=?
and f.mois=?
and l.mois=?
and l.idFraisForfait ='KM' ";
    $sth=$dbh->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$mois,$id,$id,$mois,$mois));
         if($sth->rowCount() ==0){
        $resu=null;
    }else {
        $resu=$sth;
    }
    return $resu;
}

function obtenirFraisHorsForfait($id,$mois){
    $dbh=connect();
    $sql="SELECT * FROM lignefraishorsforfait WHERE idVisiteur=? and mois=?";
    $sth=$dbh->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$mois));
         if($sth->rowCount() ==0){
        $resu=null;
    }else {
        $resu=$sth;
    }
    return $resu;
}
 function obtenirReqMoisUniqueFicheFrais(){
     $dbh=connect();
     $query="select mois from fichefrais where idEtat='CL'";
     $sth = $dbh->prepare($query);
     $sth->execute(array($idUtilisateur)); 
     return $sth;
 } 

function obtenirReqTableau(){
    $dbh=connect();
    $sql="select u.nom, u.prenom,u.id ,f.mois from utilisateur u join fichefrais f on (f.idVisiteur=u.id) where f.idEtat='VA' order by 1";
    $resu=$dbh->prepare($sql);
    $resu->execute();
    return $resu;
}
function obtenirReqSommeTableau($id,$mois,$id,$id,$mois,$mois,$id,$mois){
    $dbh=connect();
    $query="select((select sum(montant * quantite)
from lignefraisforfait join fraisforfait
on idFraisForfait=id
where idFraisForfait<> 'KM'
and idVisiteur=?
and mois=?)+(select (indemniteKM*quantite)
    from typevehicule t join fichefrais f join lignefraisforfait l 
    on f.idTypeVehicule=t.id
    where f.idVisiteur=?
    and l.idVisiteur=?
    and f.mois=?
    and l.mois=?
    and l.idFraisForfait ='KM')) as sommeF


union

select(select sum(montant)as somme from lignefraishorsforfait where idVisiteur=? and mois=?)as sommeH

";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$mois,$id,$id,$mois,$mois,$id,$mois));
         if($sth->rowCount() ==0){
        $resu=null;
    }else {
        $resu=$sth;
    }
    return $resu;
}
function updateFicheFraisForfait($id,$mois){
    $dbh=connect();
    $sql="update fichefrais set idEtat='VA' where idVisiteur=? and mois=?";
    $sth=$dbh->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$mois));
    return $sth;
}

function updateQuantiteFraisForfait($quantite,$id,$mois,$frais){
    $dbh=connect();
    $query="update lignefraisforfait set quantite= ? where idVisiteur=? and mois=? and idFraisForfait=?";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($quantite,$id,$mois,$frais));
    return $sth;
           
}

function updateLigneFraisHorsForfait($date,$libelle,$montant,$id){
    $dbh=connect();
    $query="update lignefraishorsforfait set date=? set libelle=? set montant=? where id=? ";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($date,$libelle,$montant,$id));
    return $sth;
}
function supprimerLigneFraisHorsForfait($id){
    $dbh=connect();
    $query="delete from lignefraishorsforfait where id=? ";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id));
}

function obtenirIdFraisHorsForfait($user,$mois,$libelle,$montant,$date){
    $dbh=connect();
    $query="select id from lignefraishorsforfait where idVisiteur=? and mois=? and libelle=? and montant=? and date=?";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($user,$mois,$libelle,$montant,$date));
    return $sth;
}
function insererRejetFicheFraisHorsForfait($id,$user,$mois,$libelle,$date,$montant,$date2){
    $dbh=connect();
    $query="insert into rejetfraishorsforfait value(?,?,?,?,?,?,?)";
    $sth=$dbh->prepare($query); 
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$user,$mois,$libelle,$date,$montant,$date2));
}
function reporterFicheFraisForfait($date,$id){
    $dbh=connect();
    $query="update lignefraishorsforfait set mois=? where id=?";
    $sth=$dbh->prepare($query);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($date,$id));
    return $sth;
}
function miseEnPaiementFicheFraisForfait($id,$mois){
    $dbh=connect();
    $sql="update fichefrais set idEtat='MP' where idVisiteur=? and mois=?";
    $sth=$dbh->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($id,$mois));
    return $sth;
}
function updateNbJustificatifs($justi,$user,$mois){
    $dbh=connect();
    $sql="update fichefrais set nbJustificatifs=? where idVisiteur=? and mois=?";
    $sth=$dbh->prepare($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array($justi,$user,$mois));
    return $sth;
}
?>